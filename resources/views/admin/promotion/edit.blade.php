@extends('admin.layout.master')
@section('content')
    <form action="{{ route('promotion.update', ['promotion' => $promotion->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Mã khuyến mãi</label>
            <input type="text" id="simpleinput" class="form-control" name="code" value="{{ $promotion->code }}">
        </div>
        <label for="example-textarea">Giảm giá</label>
        <div class="input-group mb-3 ">
            <input type="text" id="simpleinput" class="form-control" name="discount" value="{{ $promotion->discount }}">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">VND</label>
            </div>
        </div>
        <label for="simpleinput">Trạng thái</label>
        <select name="status" id="" class="custom-select mb-3">
            <option value="0">Còn hạn sử dụng</option>
            <option value="1">Hết hạn sử dụng</option>
        </select>
        <br>
        <button class="btn btn-success">Thêm</button>
    </form>
@endsection