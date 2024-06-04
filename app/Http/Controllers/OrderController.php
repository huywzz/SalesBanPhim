<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\View;
use App\Models\categories;
use App\Models\orderDetail;
use App\Models\product;
use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $categories;
    private $model;
    private $title;
    public function __construct()
    {
        $this->model = new Order();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        $this->categories = categories::all();
        View::share('categories', $this->categories);
        View::share('title', $this->title);
    }
    
    public function totalCart()
    {
        $total = 0;
        if (session()->get('cart') != null) {
            foreach (session()->get('cart') as $key) {
                $total = $key['price'] * $key['quantity'] + $total;
            }
        }
        return $total;
    }

    public function checkoutForm(Request $request)
    {
        $id = session()->get('id');
        $user = User::all()->find($id);
        $total = $this->totalCart();
        return view('clients.checkout.formCheckOut', ['total' => $total, 'user' => $user]);
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function getdata()
    {
        return DataTables::of(Order::query())
            ->editColumn('order_status', function ($object) {
                return $object->getStatus();
            })
            ->editColumn('created_at', function ($object) {
                return $object->getDate();
            })
            ->editColumn('updated_at', function ($object) {
                return $object->getDate();
            })
            ->addColumn('user_name', function ($object) {
                return $object->getNameUser->name;
            })
            ->editColumn('order_total', function ($object) {
                return number_format($object->order_total, 0, '.', ',');
            })
            ->addColumn('id', function ($user) {
                $arr = [];
                $arr['link'] = route('order.detail', ['order' => $user]);
                $arr['id'] = $user->id;
                return $arr;
            })
            ->addColumn('edit', function ($user) {

                return route('orders.edit', ['order' => $user]);
            })
            ->addColumn('destroy', function ($user) {
                return route('orders.destroy', ['order' => $user->id]);
            })
            ->filterColumn('user_name', function ($query, $keyword) {

                if ($keyword !== 'null') {
                    $query->whereHas('getNameUser', function ($q) use ($keyword) {
                        return $q->where('id', $keyword);
                    });
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword !== '3') {
                    $query->where('status', $keyword);
                }
            })
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(StoreOrderRequest $request)
    {
        $orderObj = new Order();
        $orderObj->user_id = $request->get('id');
        $orderObj->order_total = $this->totalCart();
        $orderObj->order_status = 0;
        $orderObj->order_address = $request->get('address');
        $orderObj->save();

        $orderID = $orderObj->id;
        $cart = session()->get('cart');
        foreach ($cart as $key) {
            $orderDetailObj = new OrderDetail();
            $orderDetailObj->order_id = $orderID;
            $orderDetailObj->product_id = $key['id'];
            $orderDetailObj->product_name = $key['name'];
            $orderDetailObj->product_price = $key['price'];
            $orderDetailObj->quantity = $key['quantity'];
            $orderDetailObj->total = $key['price'] * $key['quantity'];
            $orderDetailObj->save();
        }
        session()->forget('cart');
        
        return redirect()->route('products.list');
    }

    public function listOrder()
    {
        $id = session()->get('id');
        $orders = User::find($id)->listOrder;
        $user = User::all()->find($id);
        // dd(count($orders));
        if (count($orders) != 0) {
            $order = User::find($id)->listOrder->sortByDesc('created_at')->first();
            $orderDetails = Order::find($order->id)->listOrderDetail->first();
            $id_product = $orderDetails->product_id;
            $category_id = product::find($id_product)->categories_id;
            $productRecommend = categories::find($category_id)->listProduct->take(4);

            return view('clients.orders.listOrder', compact('orders', 'user', 'productRecommend'));
        } else {
            return view('clients.orders.listOrder', compact('user'));
        }
        

        
    }

    public function orderDetail(Order $order)
    {
        $id_user = Order::find($order->id)->getNameUser->id;
        $user = User::all()->find($id_user);
        if (session()->get('id') === $id_user or session()->get('level') === 0) {

            $orderDetails = Order::find($order->id)->listOrderDetail;
            $total = $order->order_total;

            return view('clients.orders.orderDetail', ['orderDatails' => $orderDetails, 'total' => $total, 'user' => $user]);
        }
        return redirect()->route('listOrder');
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', ['order' => $order]);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $obj = $this->model->find($order->id);
        $user = $obj->getNameUser->email;

        $old_status = $obj->order_status;
        $obj->update([
            'order_status' => $request->get('status'),
        ]);
        $order_detail = Order::find($order->id)->listOrderDetail;
        if ($request->get('status') === '1' && $old_status === 0) {
            foreach ($order_detail as $key) {
                $product = new Product();
                $product = $product->find($key->product_id);
                $quantity = $product->quantity - $key->quantity;

                $sales_quantity = $product->sales_quantity + $key->quantity;
                
                $product->update([
                    'quantity' => $quantity,
                    'sales_quantity' => $sales_quantity,
                ]);
                // dd($sales_quantity);
                if ($quantity == 0) {
                    $product->update([
                        'status' => 1,
                    ]);
                }
            }
            
            $message = [
                'type' => 'Đã xác nhận đơn hàng',
                'task' => $order_detail,
                'content' => 'Thành công',
            ];
            Mail::to($user)->send(new MailNotify($message));
        }

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        //
    }

    // VNPAY
    public function formVnpay()
    {
        $id = session()->get('id');
        $user = User::find($id);
        $total = $this->totalCart();
        return view('clients.checkout.vnpay', ['total' => $total, 'user' => $user]);
    }

    public function proccessVnPay(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            $orderObj = new Order();
            $arr = session()->get('orderIf');
            $orderObj->user_id = $arr['id'];
            $orderObj->order_total = $this->totalCart();
            $orderObj->order_status = 0;
            $orderObj->order_address = $arr['address'];
            // $orderObj->order_note=$request->get('orders_note');
            $orderObj->order_phone = $arr['phone'];
            $orderObj->save();

            $orderID = $orderObj->id;
            session()->forget('orderIf');
            $cart = session()->get('cart');
            foreach ($cart as $key) {
                $orderDetailObj = new OrderDetail();
                $orderDetailObj->order_id = $orderID;
                $orderDetailObj->product_id = $key['id'];
                $orderDetailObj->product_name = $key['name'];
                $orderDetailObj->product_price = $key['price'];
                $orderDetailObj->quantity = $key['quantity'];
                $orderDetailObj->total = $key['price'] * $key['quantity'];
                $orderDetailObj->save();
            }
            session()->forget('cart');
            return redirect()->route('products.list')->with(['success' => 'Dat hang thanh cong']);
        }
        return redirect()->route('formVnpay')->with(['error' => 'loi trong qua trinh giao dich']);
    }

    public function vnpay_payment(Request $request)
    {
        $arr = $request->all();
        session(['orderIf' => $arr]);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/proccessvnpay";
        $vnp_TmnCode = "CRTILMUQ"; // Mã website tại VNPAY
        $vnp_HashSecret = "DLLGDWUFEOEFFPNMLBTWEMJKVHMRNOAW"; //Chuỗi bí mật

        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = 'thanh toan don hang';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $this->totalCart() * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->get('bank_code');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {

            // header('Location: ' . );
            return redirect($vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo

    }
}
