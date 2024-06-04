@extends('admin.layout.master')
@section('content')
    <form action=" {{ route('categories.update', ['categories' => $categories->id]) }} " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Tên danh mục</label>
            <input type="text" id="name" class="form-control" name="name" value="{{ $categories->name }}">
        </div>
        <div class="form-group">
            <label for="example-fileinput-1">Ảnh danh mục</label>
            <input type="file" id="example-fileinput-1" class="form-control-file" name="category_img">
        </div>
        <button class="btn btn-success">Sửa</button>
    </form>
@endsection
