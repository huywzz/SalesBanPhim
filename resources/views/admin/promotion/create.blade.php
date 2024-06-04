@extends('admin.layout.master')
@section('content')
    <form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Mã khuyến mãi</label>
            <input type="text" id="simpleinput" class="form-control" name="code">
        </div>
        <label for="example-textarea">Giảm giá</label>
        <div class="input-group mb-3 ">
            <input type="text" id="simpleinput" class="form-control" name="discount">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">VND</label>
            </div>
        </div>
        <br>
        <button class="btn btn-success">Thêm</button>
    </form>
@endsection
