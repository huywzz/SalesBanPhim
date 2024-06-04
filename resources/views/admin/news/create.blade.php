@extends('admin.layout.master')
@section('content')
    <form action=" {{route('news.store')}} " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Title</label>
            <input type="text" id="title" class="form-control" placeholder="Tiêu đề" name="title">
        </div>
        <div class="form-group">
            <label for="example-fileinput-1">Ảnh</label>
            <input type="file" id="example-fileinput-1" class="form-control-file" name="news_img">
        </div>
        <div class="form-group">
            <label for="example-textarea">Content</label>
            <textarea class="form-control" id="example-textarea" rows="5" name="content"></textarea>
        </div>
        <br>

        <button class="btn btn-success">Thêm tin tức</button>
    </form>
@endsection

@push('js')
    <script>
        CKEDITOR.replace('example-textarea');
    </script>
@endpush
