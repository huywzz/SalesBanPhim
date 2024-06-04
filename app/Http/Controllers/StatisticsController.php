<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class StatisticsController extends Controller
{
    //
    private $title;
    public function __construct()
    {
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;

        View::share('title', $this->title);
    }
    
    public function index()
    {
        $current = Carbon::tomorrow();
        $now = $this->convertToDate($current);
        $first = '2022-11-19';
        $orderSum = Order::selectRaw('sum(order_total) as sum')
            ->whereBetween('updated_at', [$first, $now])
            ->groupByRaw("DATE_FORMAT(updated_at, '%Y-%m-%d')")
            ->get();
        $prices = [];
        foreach ($orderSum as $key) {
            $prices[] = $key->sum;
        }

        $orderTime = Order::selectRaw("DATE_FORMAT(updated_at, '%Y-%m-%d') as day")
            ->whereBetween('updated_at', [$first, $now])
            ->groupByRaw("DATE_FORMAT(updated_at, '%Y-%m-%d')")
            ->get();
        $labels = [];
        foreach ($orderTime as $key) {
            $labels[] = $key->day;
        }

        $order = Order::whereBetween('updated_at', [$first, $now])->get();
        $countOrder = Order::whereBetween('updated_at', [$first, $now])->count();
        $sum = Order::whereBetween('updated_at', [$first, $now])->sum('order_total');

        $sumOrder = DB::table('order_details')->selectRaw('sum(total) as totall, count(quantity) as quantityy, product_name')
            ->whereBetween('updated_at', [$first, $now])
            ->groupBy('product_name')->take(5)->get();

        $labelsDonut = [];
        $pricesDonut = [];
        foreach ($sumOrder as $key) {
            $labelsDonut[] = $key->product_name;
            $pricesDonut[] = $key->totall;
        }

        return view('admin.statistics.index', [
            'labels' =>  $labels, 'prices' => $prices,
            'topSale' => $sumOrder,
            'countOrder' => $countOrder,
            'sumOrder' => $sum,
            'orders' => $order,
            'labelsDonut' => $labelsDonut, 'pricesDonut' => $pricesDonut
        ]);
    }

    public function filterByDate(Request $request)
    {

        if ($request->get('date1') != null && $request->get('date2') != null) {
            $date1 = $this->convertToDate($request->get('date1'));
            $date2 = $this->convertToDate($request->get('date2'));

            $orderSum = Order::selectRaw('sum(order_total) as sum')
                ->whereBetween('updated_at', [$date1, $date2])
                ->groupByRaw("DATE_FORMAT(updated_at, '%Y-%m-%d')")
                ->get();
            $prices = [];
            foreach ($orderSum as $key) {
                $prices[] = $key->sum;
            }

            $orderTime = Order::selectRaw("DATE_FORMAT(updated_at, '%Y-%m-%d') as day")
                ->whereBetween('updated_at', [$date1, $date2])
                ->groupByRaw("DATE_FORMAT(updated_at, '%Y-%m-%d')")
                ->get();
            $labels = [];
            foreach ($orderTime as $key) {
                $labels[] = $key->day;
            }

            $order = Order::whereBetween('updated_at', [$date1, $date2])->get();
            $countOrder = Order::whereBetween('updated_at', [$date1, $date2])->count();
            $sum = Order::whereBetween('updated_at', [$date1, $date2])->sum('order_total');

            // $product = Product::query()->withCount('orderDetail')->get()->toArray();

            $sumOrder = DB::table('order_details')->selectRaw('sum(total) as totall, count(quantity) as quantityy, product_name')
                ->whereBetween('updated_at', [$date1, $date2])
                ->groupBy('product_name')->take(5)->get();

            $labelsDonut = [];
            $pricesDonut = [];

            foreach ($sumOrder as $key) {
                $labelsDonut[] = $key->product_name;
                $pricesDonut[] = $key->totall;
            }

            return view('admin.statistics.index', [
                'labels' =>  $labels, 'prices' => $prices,
                'topSale' => $sumOrder,
                'countOrder' => $countOrder,
                'sumOrder' => $sum,
                'orders' => $order,
                'labelsDonut' => $labelsDonut, 'pricesDonut' => $pricesDonut
            ]);
        }
        return redirect()->route('statistics.index');
    }
    public function convertToDate($date)
    {
        $time = strtotime($date);
        return date('Y-m-d', $time);
    }
    public function totalOrderByDate($orderr)
    {
        $sum = 0;
        foreach ($orderr as $key) {
            $sum = $sum + $key->order_total;
        }
        return $sum;
    }
}
