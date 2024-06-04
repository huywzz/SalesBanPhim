@extends('clients.root.master')
@section('content')

    <div class="grid wide cart-page-container">
        <div class="title">Giỏ hàng</div>

        <div class="content">
            @if (session()->get('cart') != null)
                <div class="cart-page">
                    <table style="width: 100%;" class="table-cart-page" id="table">
                        <thead style="height: 40px; border-bottom: 1px solid #000;">
                            <tr>
                                <th style="width: 43%;">Sản phẩm</th>
                                <th style="width: 20%;">Giá</th>
                                <th style="width: 15%;">Số lượng</th>
                                <th style="width: 15%;">Tổng tiền</th>
                                <th style="width: 7%;"></th>
                            </tr>
                        </thead>
                        <tbody id="cart">
                            @if (session()->get('cart') != null)
                                @foreach (session()->get('cart') as $key)
                                    <tr id="{{ $key['id'] }}">
                                        <td>
                                            <a href="">
                                                <div class="product-cart-page-info">
                                                    <div class="product-cart-page-info__img">
                                                        <img src="{{ Storage::url($key['product_image']) }}" alt="">
                                                    </div>
                                                    <div class="product-cart-page-info__detail">
                                                        <div class="product-cart-page-info__detail--name">
                                                            {{ $key['name'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="product-cart-page-price">
                                                <strong>{{ number_format($key['price'], 0, '.', ',') }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-page-amount">
                                                <div class="buttons_added">
                                                    <a type="button" class="decrease minus is-form"
                                                        data-id="{{ $key['id'] }}">-</a>

                                                    <input type="number" min="1" value="{{ $key['quantity'] }}"
                                                        class="form-control input-qty" placeholder="Qty"
                                                        style="width: 45px;" id="quantity_{{ $key['id'] }}">

                                                    <a type="button" class="increase plus is-form"
                                                        data-id="{{ $key['id'] }}">+</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-page-total" id="price_{{ $key['id'] }}">
                                                <strong>{{ number_format($key['quantity'] * $key['price'], 0, '.', ',') }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-page-delete">
                                                <a href="javascript:void(0);" class="delete" data-id="{{ $key['id'] }}">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="cart-page-total">
                        <span>Tổng tiền:</span>
                        <p id="total"><strong>{{ number_format($total, 0, '.', ',') }}</strong></p>
                        <span>VND</span>
                    </div>


                    <div class="cart-page-checkout-btn" id="checkout">
                        <button type="submit" class="cart-checkout-btn--btn" name="checkout"><a
                                href="{{ route('checkoutForm') }}">Thanh toán COD</a></button>
                        <button type="submit" class="cart-checkout-btn--btn" name="checkout"><a
                                href="{{ route('formVnpay') }}">Thanh toán VNPAY</a></button>
                        {{-- <a href="{{ route('formVnpay') }}">Thanh toán VNPAY</a> --}}
                    </div>

                </div>
            @else
                <div class="cart-page continue-buy-btn">
                    <button id="btn-continue"><a href="{{ route('products.list') }}">Tiếp tục mua hàng</a></button>
                </div>
            @endif

        </div>
    </div>
@endsection
@push('js')
    <script>
        function formatNumber(x) {
            return x.toLocaleString().replace(',', ',');
        }

        $(function() {
            $(document).ready(function() {

                $('.delete').click(function() {
                    // let form = $(this).parents('form');
                    let id = $(this).data('id');
                    confirm('Xóa sản phẩm này')

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('cart.delete') }}',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            // console.log("ss");
                            toastr.success('Xoá sản phẩm thành công!')
                            $('#' + data['id']).remove();
                            $('#total').html('Tổng tiền:' +
                                `<strong>${formatNumber(data['total'])}</strong>`);

                            if (data['total'] == 0) {
                                $('#table').remove();
                                $('#checkout').empty();
                                $('#total').remove();
                                $('#title').empty();
                                $('#title').text('Chưa có sản phẩm nào trong giỏ hàng');
                                $('.cart-page').html(
                                    '<button><a href="{{ route('products.list') }}">Tiếp tục mua hàng</a></button>'
                                )
                            }
                        },
                        error: function() {
                            toastr.error('Lỗi, hãy thử lại!');
                        }
                    });

                });

                $('.increase').click(function() {

                    let id = $(this).data('id');

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('cart.increase') }}',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            console.log("ss");
                            $('#quantity_' + data['id']).attr('value', data[
                                'quantity']);
                            $('#total').html(
                                `<strong>${formatNumber(data['total'])}</strong>`);
                            $('#price_' + data['id']).html(
                                `<strong>${formatNumber(data['totalDetail'])}</strong>`
                            );
                        },
                        error: function() {
                            // console.log("error");
                            toastr.error('Lỗi, hãy thử lại!');
                        }
                    })
                });
                //
                $('.decrease').click(function() {
                    var id = $(this).data('id');

                    var quantity = $('#quantity_' + id).val();

                    console.log(quantity);
                    // console.log(id);
                    if (quantity != 1) {
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('cart.decrease') }}',
                            data: {
                                id: id,
                            },
                            success: function(data) {
                                console.log("ss");
                                $('#quantity_' + data['id']).attr('value', data[
                                    'quantity']);
                                $('#total').html(
                                    `<strong>${formatNumber(data['total'])}</strong>`
                                );
                                $('#price_' + data['id']).html(
                                    `<strong>${formatNumber(data['totalDetail'])}</strong>`
                                );
                            },
                            error: function() {
                                toastr.error('Lỗi, hãy thử lại!');
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('cart.delete') }}',
                            data: {
                                id: id,
                            },
                            success: function(data) {
                                toastr.success('Xoá sản phẩm thành công!')
                                $('#' + data['id']).remove();
                                $('#total').html(
                                    `<strong>${formatNumber(data['total'])}</strong>`
                                );
                                if (data['total'] == 0) {
                                    $('#table').remove();
                                    $('#checkout').empty();
                                    $('#total').remove();
                                    $('#title').empty();
                                    $('#title').text(
                                        'Chưa có sản phẩm nào trong giỏ hàng');
                                    $('.cart-page').html(
                                        '<button><a href="{{ route('products.list') }}">Tiếp tục mua hàng</a></button>'
                                    )
                                }
                            },
                            error: function() {
                                toastr.error('Lỗi, hãy thử lại!');
                            }
                        });

                    }


                });
            });

        });
    </script>
@endpush
