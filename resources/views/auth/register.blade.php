@extends('clients.root.master')

@section('title')
    Đăng ký
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/validator_form.css') }}"> --}}
@endpush


@section('content')
    <div class="grid wide register-container">
        <div class="register">
            <h1 style="font-size: 26px;">Đăng ký tài khoản</h1>

            @if (session()->has('mess'))
                {{ session()->get('mess') }}
            @endif

            <form id="form-register" class="form" enctype="multipart/form-data" action="{{ route('processRegister') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nguyen Van A">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="gender" class="form-label">Giới tính</label>
                    <div class="gender">
                        <div class="gender-male">
                            <input type="radio" name="gender" value="Nam" class="form-control" id="male" checked>
                            Nam
                        </div>
                        <div class="gender-female">
                            <input type="radio" name="gender" value="Nữ" class="form-control" id="famale">
                            Nữ
                        </div>
                    </div>
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email"
                        placeholder="username@domail.com">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="0987654321">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="address"
                        placeholder="123 Nguyen Minh Chau, Hoa Hai, NHS, Da Nang">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <input type="file" name="user_avatar" class="form-control" id="avatar" multiple>
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                        placeholder="Nhập lại mật khẩu">
                    <span class="form-message"></span>
                </div>


                <input class="register-btn" type="submit" name="register" value="Đăng ký">

                <a class="back-login" href="{{ route('login') }}">Quay lại đăng nhập <i
                        class="fa-solid fa-arrow-right"></i></a>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#form-register',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#name'),

                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
                
                Validator.isRequired('#phone'),
                Validator.isPhone('#phone'),

                Validator.isRequired('#address'),

                Validator.isRequired('#avatar'),

                Validator.isRequired('input[name="gender"]'),
                // Validator.isRequired('#avatar'),
                Validator.minLength('#password', 3),
                Validator.isRequired('#password_confirmation'),
                // Validator.isRequired('#province'),
                // Validator.isRequired('input[name="favourite"]'),
                Validator.isConfirmed('#password_confirmation', function() {
                    return document.querySelector('#form-register #password').value;
                }, 'Mật khẩu nhập lại không chính xác'),
            ],
            // onSubmit: function (data) {
            //     // Call API
            //     console.log(data);
            // }
        });
    </script>
@endpush
