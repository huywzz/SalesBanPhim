@extends('clients.root.master')

@section('title')
    Tin tức
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endpush

@section('content')
    <div class="grid wide news-container">
        <div class="title">Tin tức</div>

        <div class="content">
            <div class="row news">
                <div class="col l-3 news__sidebar">
                    <div class="news__sidebar--title">Bài viết mới nhất</div>
                    <hr class="hr-3">
                    <div class="news__sidebar--post">

                        @foreach ($latestNews as $news1)
                            <a href="/news/show/{{ $news1->id }}" class="post-item b-b-100">
                                <div class="post-item__img">
                                    <img src="{{ asset('storage/'.$news1->image) }}" alt="">
                                </div>
                                <div>
                                    <div class="post-item__title">{{ $news1->title }}</div>
                                    <div class="post-item__time">{{ $news1->created_at }}</div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
                <div class="col l-9 news-detail__content">
                    
                    <div class="news-post">
                        <div class="news-post__title">{{$news->title}}</div>
                        <hr class="hr-4">
                        <div class="news-post__time">Post on <span>{{ $news->created_at }}</span> by Admin</div>
                        <div class="news-post__img">
                            
                            <img src="{{ asset('storage/'.$news->image) }}" alt=""> 
                            {{-- 'assets/img/news_post/' . $news->image --}}
                            
                        </div>
                        <div class="news-detail-post-content">
                            {!! $news->content !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
