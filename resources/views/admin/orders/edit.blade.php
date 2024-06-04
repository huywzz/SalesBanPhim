@extends('admin.layout.master')
@section('content')
    <form action=" {{ route('orders.update', ['order' => $order]) }} " method="POST">
        @csrf

        <div class="form-group">
            <label for="simpleinput">Tên khách hàng</label>
            <input type="text" id="name" class="form-control" placeholder="Tên" name="nameUser"
                value="{{ $order->getNameUser->name }}" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="simpleinput">Tổng tiền</label>
            <input type="text" id="name" class="form-control" placeholder="Tổng tiền" name="order_total"
                value="{{ $order->order_total }} " readonly="readonly">
        </div>
        <div class="form-group">
            <label for="simpleinput">Địa chỉ</label>
            <input type="text" id="name" class="form-control" placeholder="Địa chỉ" name="order_address"
                value="{{ $order->order_address }}" readonly="readonly">
        </div>

        <label for="simpleinput">Trạng thái</label>
        <select name="status" id="" class="custom-select mb-3">
            <option value="0" @if ($order->order_status === 0) selected @endif>Đang xác nhận</option>
            <option value="1" @if ($order->order_status === 1) selected @endif>Đã xác nhận</option>
            <option value="2" @if ($order->order_status === 2) selected @endif>Hủy đơn</option>
        </select>
        {{-- <input type="hidden" name="status" id="" value="0"> --}}

        <br>

        <button class="btn btn-success">Sửa</button>
    </form>
@endsection
