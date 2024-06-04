@extends('clients.root.master')
@section('content')

    <div class="grid wide cart-page-container">
        <div class="title">Chi tiết đơn hàng</div>

        <div class="content">
            <div class="cart-page">
                <table style="width: 100%;" class="table-cart-page">
                    <thead style="height: 40px; border-bottom: 1px solid #000;">
                        <tr>
                            <th>ID sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orderDatails != null)
                            @foreach ($orderDatails as $key)
                                <tr>
                                    <td>{{ $key->product_id }}</td>
                                    <td>{{ $key->product_name }}</td>
                                    <td>{{ number_format($key->product_price, 0, '.', ',') }} ₫</td>
                                    <td>{{ $key->quantity }}</td>
                                    <td>{{ number_format($key->total, 0, '.', ',') }}</td>
                                    <td>{{ $key->created_at }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="cart-page-total">
                    <p id="total">Tổng tiền:<strong>{{ number_format($total, 0, '.', ',') }} ₫</strong></p>
                </div>

            </div>
        </div>
    </div>
@endsection
