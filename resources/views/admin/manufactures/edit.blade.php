@extends('admin.layout.master')
@section('content')
    <form action=" {{ route('manufactures.update', ['manufacture' => $manufacture->id]) }} " method="POST">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Tên nhà cung cấp</label>
            <input type="text" id="name" class="form-control" placeholder="Tên" name="name"
                value=" {{ $manufacture->name }} ">
        </div>
        <div class="form-group">
            <label for="simpleinput">Địa chỉ </label>
            <input type="text" id="address" class="form-control" placeholder="Địa chỉ" name="address"
                value=" {{ $manufacture->address }} ">
        </div>
        <div class="form-group">
            <label for="example-email">Số điện thoại</label>
            <input type="text" id="example-email" name="phone" class="form-control" placeholder="Số điện thoại"
                value=" {{ $manufacture->phone }} ">
        </div>
        <div class="form-group">
            <label for="example-email">Email</label>
            <input type="text" id="example-email" name="email" class="form-control" placeholder="Email"
                value=" {{ $manufacture->email }} ">
        </div>
        <br>
        <button class="btn btn-success">Sửa</button>
    </form>
@endsection
