@extends('clients.root.master')


@section('title')
    Thông tin cá nhân
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
    <div class="grid wide user-container">
        <div class="title">Thông tin cá nhân</div>

        <div class="content">

            <form method="POST" action="{{ route('processUpdateInfor', ['user' => $user->id]) }}" id="form-update-infor"
                class="form" enctype="multipart/form-data">
                @csrf
                <div class="user-row">
                    <div class="user-col-left">
                        <div  title="Nhấn để chọn ảnh đại diện" class="user-avatar">
                            <div class="form-group form-group-avatar">
                                <img style="width: 80%; height: 220px; cursor: pointer;" id="img-preview"
                                    src="{{ asset('/storage/' . $user->avatar) }}" alt="">
                                <label id="img-avatar" for="user_avatar_img">
                                    <img style="width: 80%; height: 220px; cursor: pointer;" class="thumbnail" data-toggle="tooltip"
                                        title="Nhấn vào để chọn ảnh" data-placement="bottom"
                                        src="{{ asset('/storage/' . $user->avatar) }}" alt="Chọn ảnh đại diện">
                                    <i title="Nhấn để chọn ảnh đại diện" class="change-icon fa-regular fa-pen-to-square"></i>
                                </label>

                                <input disabled id="user_avatar_img" name="user_avatar_img" type="file"
                                    class="image form-control-file" style="display: none;">
                                {{--  --}}
                            </div>
                        </div>
                    </div>
                    <div class="user-col-right">

                        <div class="change-btn">
                            <i title="Nhấn để chỉnh sửa thông tin" class="change-icon fa-regular fa-pen-to-square"></i>
                        </div>


                        <div class="form-group">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input disabled type="text" name="name" class="form-control" id="name"
                                value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="gender" class="form-label">Giới tính</label>
                            <div class="gender">
                                <div class="gender-male">
                                    <input type="radio" name="gender" value="Nam" class="form-control" disabled
                                        id="male" checked>
                                    Nam
                                </div>
                                <div class="gender-female">
                                    <input type="radio" name="gender" value="Nữ" class="form-control" disabled
                                        id="famale">
                                    Nữ
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input readonly="readonly" type="text" name="email" class="form-control" id="email"
                                value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input disabled type="text" name="phone" class="form-control" id="phone"
                                value="{{ $user->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input disabled type="text" name="address" class="form-control" id="address"
                                value="{{ $user->address }}">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input disabled type="password" name="password" class="form-control"
                                value="{{ $user->password }}" id="password">
                        </div>

                        <input disabled class="save-btn" type="submit" name="save" value="Lưu thông tin">

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var changeBtn = document.querySelector('.change-btn');
        var saveBtn = document.querySelector('.save-btn')
        var inputDisableds = document.querySelectorAll('.form-group input[disabled]');
        var inputEmail = document.querySelector('.form-group input#email');

        changeBtn.addEventListener('click', function() {

            inputDisableds.forEach((inputDisabled) => {
                if (!inputDisabled.hasAttribute("disabled")) {
                    inputDisabled.setAttribute("disabled", "disabled");
                    saveBtn.setAttribute("disabled", "disabled");

                } else {
                    inputDisabled.removeAttribute("disabled")
                    saveBtn.removeAttribute("disabled")
                }
            })
        })

        const input = document.getElementById('user_avatar_img');
        const image = document.getElementById('img-preview');

        image.style.display = 'none';

        input.addEventListener('change', (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                image.style.display = 'block';
                image.src = src;
            }
        });
    </script>
@endpush
