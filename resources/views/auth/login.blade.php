@extends('clients.root.master')

@section('title')
    Đăng nhập
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <div class="grid wide login-container">
        <div class="login">
            <h1>Đăng nhập</h1>
            @if (session()->has('mess'))
                {{ session()->get('mess') }}
            @endif

            <form class="form" action="{{ route('processLogin') }}" method="POST">
                @csrf
                <p>Email</p>
                <input type="text" name="email" placeholder="username@domain.com">
                <div class="pass-forgot">
                    <p>Mật khẩu</p>
                    <a href="">Quên mật khẩu?</a>
                </div>
                <input type="password" name="password" placeholder="Nhập mật khẩu">

                <input class="login-btn" type="submit" name="login" value="Đăng nhập">

                <a class="create-acc" href="{{ route('register') }}">Tạo tài khoản <i class="fa-solid fa-arrow-right"></i></a>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
