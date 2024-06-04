@extends('admin.layout.master')

@section('content')
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right font-weight-bold col-form-label">Tên sản phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <input disabled placeholder="Product Name" type="text" class="form-control"
                                    value="{{ $productName }}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right font-weight-bold col-form-label">Hình ảnh</label>
                            <div class="col-md-9 col-xl-8" style="display: flex; flex-direction: column">

                                {{-- Avatar Images --}}
                                <ul class="text-nowrap" id="images">
                                    <h5>Ảnh đại diện sản phẩm</h5>
                                    @foreach ($productAvatars as $images)
                                        <li class="float-left d-inline-block mr-2 mb-2"
                                            style="position: relative; width: 18%;">

                                            <form action="delete/{{ $images->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn sẽ sẽ xóa ảnh này ?')"
                                                    class="btn btn-delete">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            </form>
                                            <div class="product-img" style="width: 100%; height: 180px; overflow: hidden;">
                                                <img src="{{ asset('/storage/' . $images->file_name) }}" alt="Image">
                                            </div>
                                        </li>
                                    @endforeach

                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 18%;">
                                        <form method="post" action="store" enctype="multipart/form-data">
                                            @csrf
                                            <div class="add-img">
                                                <label for="product_avatar_img">
                                                    <img style="width: 80%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Nhấn vào để thêm ảnh"
                                                        data-placement="bottom" src="{{ asset('img/icon/add.png') }}"
                                                        alt="Add Image">
                                                </label>

                                                <input type="hidden" name="product_id"
                                                    value="{{ $productAvatars[0]->product_id }}">

                                                <input type="hidden" name="type" value="product_avatar_img">

                                                <input id="product_avatar_img" name="product_avatar_img[]" multiple type="file"
                                                    onchange="changeImg(this); this.form.submit()"
                                                    class="image form-control-file" style="display: none;">
                                            </div>
                                        </form>
                                    </li>
                                </ul>

                                {{-- Slider Images --}}
                                <ul class="text-nowrap" id="images">
                                    <h5>Ảnh sản phẩm</h5>
                                    @foreach ($productSliders as $images)
                                        <li class="float-left d-inline-block mr-2 mb-2"
                                            style="position: relative; width: 18%;">

                                            <form action="delete/{{ $images->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn sẽ sẽ xóa ảnh này ?')"
                                                    class="btn btn-delete">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            </form>
                                            <div class="product-img" style="width: 100%; height: 180px; overflow: hidden;">
                                                <img src="{{ asset('/storage/' . $images->file_name) }}" alt="Image">
                                            </div>
                                        </li>
                                    @endforeach

                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 18%;">
                                        <form method="post" action="store" enctype="multipart/form-data">
                                            @csrf
                                            <div class="add-img">
                                                <label for="product_slider_img">
                                                    <img style="width: 80%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Nhấn vào để thêm ảnh"
                                                        data-placement="bottom" src="{{ asset('img/icon/add.png') }}"
                                                        alt="Add Image">
                                                </label>

                                                <input type="hidden" name="product_id"
                                                    value="{{ $productSliders[0]->product_id }}">

                                                <input type="hidden" name="type" value="product_slider_img">

                                                <input id="product_slider_img" name="product_slider_img[]" multiple type="file"
                                                    onchange="changeImg(this); this.form.submit()"
                                                    {{-- accept="image/x-png,image/gif,image/jpeg" --}}
                                                    class="image form-control-file" style="display: none;">
                                                {{-- <input type="hidden" name="id_product" value=""> --}}
                                            </div>
                                        </form>
                                    </li>
                                </ul>

                                {{-- Description Images --}}
                                <ul class="text-nowrap" id="images">
                                    <h5>Ảnh mô tả</h5>
                                    @foreach ($productDescriptions as $images)
                                        <li class="float-left d-inline-block mr-2 mb-2"
                                            style="position: relative; width: 18%;">

                                            <form action="delete/{{ $images->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn sẽ sẽ xóa ảnh này ?')"
                                                    class="btn btn-delete">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                            </form>
                                            <div class="product-img" style="width: 100%; height: 180px; overflow: hidden;">
                                                <img src="{{ asset('/storage/' . $images->file_name) }}" alt="Image">
                                            </div>
                                        </li>
                                    @endforeach

                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 18%;">
                                        <form method="post" action="store" enctype="multipart/form-data">
                                            @csrf
                                            <div class="add-img">
                                                <label for="product_description_img">
                                                    <img style="width: 80%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Nhấn vào để thêm ảnh"
                                                        data-placement="bottom" src="{{ asset('img/icon/add.png') }}"
                                                        alt="Add Image">
                                                </label>

                                                <input type="hidden" name="product_id"
                                                    value="{{ $productDescriptions[0]->product_id }}">
                                                <input type="hidden" name="type" value="product_description_img">

                                                <input id="product_description_img" name="product_description_img[]" multiple
                                                    type="file" onchange="changeImg(this); this.form.submit()"
                                                    {{-- accept="image/x-png,image/gif,image/jpeg" --}}
                                                    class="image form-control-file" style="display: none;">
                                                {{-- <input type="hidden" name="id_product" value=""> --}}
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-3">
                                <a href="{{route('products.edit',$product->id)}}" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-check fa-w-20"></i>
                                    </span>
                                    <span>Lưu ảnh</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        CKEDITOR.replace('example-textarea');

        function changeImg(input) {
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e) {
                    //Thay đổi đường dẫn ảnh
                    $(input).siblings('.thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
@push('css')
    <style>
        #images {
            padding: 0
        }

        #images img {
            width: 100%;
        }

        .product-img {
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
            border-radius: 5px;
        }

        .btn-delete {
            position: absolute !important;
            top: 5px;
            right: 5px;
            padding: 5px 5px;
            background-color: #fff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-delete i {
            font-size: 25px;
            transition: 0.2s ease;
            /* line-height:unset; */
        }

        .btn-delete i:hover {
            color: #f00;
            transition: 0.2s ease;
        }

        .add-img {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
            overflow: hidden;
            border-radius: 10px;
        }

        .add-img label {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 0;
        }
    </style>
@endpush
