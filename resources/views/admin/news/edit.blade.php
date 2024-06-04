@extends('admin.layout.master')

@section('content')
    <form action="{{ route('news.update', ['news' => $news->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Title</label>
            <input value="{{ $news->title }}" type="text" id="title" class="form-control" placeholder="Tiêu đề"
                name="title">
        </div>
        <div class="form-group">
            <label for="example-fileinput">Ảnh</label>
            <input type="file" id="example-fileinput" class="form-control-file" name="news_img">
        </div>
        <div class="form-group">
            <label for="example-textarea">Content</label>
            <textarea class="form-control" id="example-textarea" rows="5" name="content">{{ $news->content }}</textarea>
        </div>
        <br>

        <button class="btn btn-success">Sửa</button>
    </form>
@endsection

@push('js')
    <script>
        CKEDITOR.replace('example-textarea');
    </script>
@endpush
