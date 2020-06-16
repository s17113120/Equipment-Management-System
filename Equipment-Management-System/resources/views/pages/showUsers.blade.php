@extends('pages.index') @section('content')
<div class="container">
    <div class="table">
        <div class="thead">
            <div class="tr">
                <div class="th">帳號
                    <div class="line"></div>
                </div>
                <div class="th">學號
                    <div class="line"></div>
                </div>
                <div class="th">姓名
                    <div class="line"></div>
                </div>
                <div class="th">權限
                    <div class="line"></div>
                </div>
                <div class="th">註冊時間
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="tbody">
            @if (count($posts) > 0) @foreach ($posts as $post)
            <div class="tr">
                {{-- <div class="td">{{ $post->device_id }}

                </div> --}}
                <div class="td">{{ $post->user_account }}
                    @if (session('userdata')->user_authority <  $post->user_authority)
                        @if (($post->user_id == session('userdata')->user_id) || ($post->user_authority == session('userdata')->user_authority))

                        @else
                            <a href="user/modify/{{ $post->user_id }}" style="margin-left: 15px;color: yellow;"><i class="fas fa-pencil-alt"></i></a>
                        @endif
                    @endif
                </div>
                <div class="td">{{ $post->user_student_id }}</div>
                <div class="td">{{ $post->user_name }}</div>
                <div class="td">{{ $post->user_status_content }}</div>
                <div class="td">{{ $post->created_at }}</div>
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
@endsection @section('script')
<script>

</script>
@endsection
