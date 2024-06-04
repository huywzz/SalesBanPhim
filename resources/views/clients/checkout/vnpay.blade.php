@extends('clients.root.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
    <div class="grid wide checkout-container">
        <div class="title">
            Thanh toán
        </div>
        <div class="checkout">
            <div class="customer-details">
                <div class="link-to-cart">
                    <a href="{{ route('cart.show') }}">Giỏ hàng</a>
                    <i class="fa-solid fa-caret-right"></i>
                    <span>Thông tin giao hàng</span>
                </div>

                <form action="{{ route('order.vnpay') }}" method="POST" class="form" id="form-checkout">
                    @csrf

                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <p class="heading">Thông tin giao hàng</p>

                    <div class="form-group">
                        <input value="{{ $user->name }}" type="text" name="fullname" class="form-control"
                            id="fullname" placeholder="Họ và tên">
                        <span class="form-message"></span>
                    </div>

                    <div class="email-phone-container">
                        <div class="form-group email">
                            <input value="{{ $user->email }}" type="text" name="email" class="form-control"
                                id="email" placeholder="Email">
                            <span class="form-message"></span>
                        </div>

                        <div class="form-group phone">
                            <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                                id="phone" placeholder="Số điện thoại">
                            <span class="form-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <input value="{{ $user->address }}" type="text" name="address" class="form-control"
                            id="address" placeholder="Địa chỉ">
                        <span class="form-message"></span>
                    </div>

                    <p class="heading">Phương thức thanh toán</p>

                    <div class="form-group">

                        <div class="vnpay-payment">
                            <img src="{{ asset('img/icon/vnpay_logo.png') }}" alt="">
                            <span>Thanh toán VNPAY</span>
                        </div>
                        {{-- <div class="checkout-method">
                            <div class="checkout-method">
                                <input type="radio" name="checkout-method" value="cod" class="form-control"
                                    id="checkout-method-cod">
                                <label for="checkout-method-cod">Thanh toán khi giao hàng (COD)</label>
                            </div>
                            <div class="checkout-method">
                                <input type="radio" name="checkout-method" value="qr" class="form-control"
                                    id="checkout-method-qr">
                                <label for="checkout-method-qr">Thanh toán mã QR</label>
                            </div>
                        </div>

                        <span class="form-message"></span> --}}
                    </div>

                    <div class="form-submit">
                        <button name="redirect" class="submit-btn">Hoàn tất đơn hàng</button>
                    </div>
                </form>
            </div>
            <div class="checkout-sidebar">

                @if (session()->get('cart') != null)
                    @foreach (session()->get('cart') as $key)
                        <div class="checkout-sidebar__product">
                            <div class="checkout-sidebar__product--product-detail">
                                <div class="product-detail__img">
                                    <img src="{{ Storage::url($key['product_image']) }}" alt="">
                                </div>
                                <div>
                                    <div class="product-detail__name">{{ $key['name'] }}</div>

                                    <div class="product-detail__price">{{ number_format($key['price'], 0, '.', ',') }}₫
                                    </div>

                                    <div class="product-detail__quantity">Số lượng: <span>{{ $key['quantity'] }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="checkout-sidebar__product--price">
                                <span>{{ number_format($key['quantity'] * $key['price'], 0, '.', ',') }}₫</span>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- <div class="checkout-sidebar__promotion">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <input id="code_promotion" type="text" name="code_promotion" placeholder="Mã giảm giá">
                        </div>
                        <input disabled type="submit" id="code-promo-btn" value="Sử dụng" />
                    </form>
                </div> --}}

                <div class="checkout-sidebar__payment">
                    <div class="checkout-sidebar__payment--subtotal-shipping">
                        <div class="subtotal">
                            <span>Tạm tính</span>
                            <span>{{ number_format($total, 0, '.', ',') }}₫</span>
                        </div>
                        <div class="shipping">
                            <span>Phí vận chuyển</span>
                            <span>0₫</span>
                        </div>
                    </div>
                    <div class="checkout-sidebar__payment--total">
                        <span>Tổng cộng</span>
                        <span>{{ number_format($total, 0, '.', ',') }}₫</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- @push('js')
    <script src="{{ asset('js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#form-checkout',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname'),
                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
                Validator.isRequired('#phone'),
                Validator.isPhone('#phone'),
                Validator.isRequired('#address'),
                // Validator.isRequired('input[name="checkout-method"]', 'Vui lòng chọn trường này'),
                // Validator.isRequired('#city', 'Vui lòng chọn trường này'),
                // Validator.isRequired('#district', 'Vui lòng chọn trường này'),
                // Validator.isRequired('#ward', 'Vui lòng chọn trường này'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
            }
        });

        var codePromoInput = document.querySelector('#code_promotion')
        var submitCodePromo = document.querySelector('#code-promo-btn')

        codePromoInput.addEventListener('input', function() {
            submitCodePromo.removeAttribute('disabled')
            // console.log(codePromoInput.value);
        })

        codePromoInput.addEventListener('input', function() {
            if (codePromoInput.value == '') {
                submitCodePromo.setAttribute('disabled', 'true');
            }
        })
    </script>
@endpush --}}
