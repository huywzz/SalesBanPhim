@extends('admin.layout.master')
@section('content')
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Tên danh mục</label>
            <input type="text" id="simpleinput" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="example-fileinput-1">Ảnh danh mục</label>
            <input type="file" id="example-fileinput-1" class="form-control-file" name="category_img">
        </div>
        <br>
        <button class="btn btn-success">Thêm</button>
    </form>
@endsection
