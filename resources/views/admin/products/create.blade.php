@extends('admin.layout.master')
@section('content')
    <form action=" {{ route('products.store') }} " method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" id="name" class="form-control" placeholder="Tên" name="name">
        </div>

        <label for="manufacture">Nhà sản xuất</label>
        <select name="manufacture_id" id="manufacture" class="custom-select mb-3">
            @foreach ($arrManu as $value)
                <option value="{{ $value->id }}"> {{ $value->name }} </option>
            @endforeach
        </select>

        <label for="categories">Loại sản phẩm</label>
        <select name="categories_id" id="categories" class="custom-select mb-3">
            @foreach ($arrCate as $value)
                <option value=" {{ $value->id }} "> {{ $value->name }} </option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="example-fileinput-1">Ảnh đại diện sản phẩm</label>
            <input type="file" id="example-fileinput-1" class="form-control-file" name="product_avatar_img[]" multiple>
        </div>

        <div class="form-group">
            <label for="example-fileinput-2">Ảnh sản phẩm</label>
            <input type="file" id="example-fileinput-2" class="form-control-file" name="product_slider_img[]" multiple>
        </div>

        <div class="form-group">
            <label for="example-fileinput-3">Ảnh mô tả sản phẩm</label>
            <input type="file" id="example-fileinput-3" class="form-control-file" name="product_description_img[]"
                multiple>
        </div>

        <div class="form-group">
            <label for="example-textarea">Thông số kĩ thuật</label>
            <textarea class="form-control" id="example-textarea" rows="5" name="specs"></textarea>
        </div>

        {{-- <div class="form-group">
            <label for="price-input"></label>
            <input type="text" id="price-input" class="form-control" placeholder="Giá" name="price">
        </div> --}}

        <label for="price">Giá</label>
        <div class="input-group mb-3">
            <input type="text" id="price" class="form-control" placeholder="Giá" name="price">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">VND</label>
            </div>
        </div>
        {{-- <input type="hidden" name="status" id="" value="0"> --}}
        <div class="form-group">
            <label for="amount">Số lượng</label>
            <input type="text" id="amount" class="form-control" placeholder="Số lượng" name="quantity">
        </div>

        <br>

        <button class="btn btn-success">Thêm sản phẩm</button>
    </form>
@endsection
@push('js')
    <script>
        CKEDITOR.replace('example-textarea');
    </script>
@endpush
