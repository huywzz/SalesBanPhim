@extends('admin.layout.master')

@section('content')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="level">Chức vụ</label>
        <select name="level" id="level" class="custom-select mb-3">
            <option value="0">Admin</option>
            <option value="1">Khách hàng</option>
        </select>

        <button class="btn btn-success">Sửa</button>
    </form>
@endsection

@push('js')
@endpush
