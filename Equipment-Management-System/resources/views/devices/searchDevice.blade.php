@extends('pages.index')

@section('content')
    <div class="container">
        <div class="table">
            <div class="thead">
                <div class="tr">
                    <div class="th">產編<div class="line"></div></div>
                    <div class="th">名稱<div class="line"></div></div>
                    <div class="th">型號<div class="line"></div></div>
                    <div class="th">圖片<div class="line"></div></div>
                    <div class="th">上傳時間<div class="line"></div></div>
                    <div class="th">最後更新<div class="line"></div></div>
                </div>
            </div>
            <div class="tbody">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="tr">
                            <div class="td">{{ $post->device_id }}</div>
                            <div class="td">{{ $post->device_name }}</div>
                            <div class="td">{{ $post->device_model }}</div>
                            <div class="td">{{ $post->device_img }}</div>
                            <div class="td">{{ $post->created_at }}</div>
                            <div class="td">{{ $post->updated_at }}</div>
                        </div>
                    @endforeach
                    <div class="btns">
                        {{ $posts->links() }}
                    </div>
                @else
                    <p>No posts found</p>
                @endif

            </div>
        </div>
    </div>
@endsection

