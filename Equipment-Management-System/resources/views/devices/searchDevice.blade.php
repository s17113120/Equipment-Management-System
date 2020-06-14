@extends('pages.index') @section('content')
<div class="container">
    <div class="table-search_div">
        <div class="table-search">
            <div class="icon"><i class="fas fa-search"></i></div>
            <form method="get" id="searchForm">
                <!-- @csrf -->
                <input type="text" name="device_search">
            </form>
        </div>
    </div>
    <div class="table">
        <div class="thead">
            <div class="tr">
                <div class="th">產編
                    <div class="line"></div>
                </div>
                <div class="th">名稱
                    <div class="line"></div>
                </div>
                <div class="th">型號
                    <div class="line"></div>
                </div>
                <div class="th">狀態
                    <div class="line"></div>
                </div>
                <div class="th">最後更新
                    <div class="line"></div>
                </div>
                <div class="th">上傳時間
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="tbody">
            @if (count($posts) > 0) @foreach ($posts as $post)
            <div class="tr">
                <div class="td">{{ $post->device_id }}
                    @if (session('userdata')->user_authority == "user")

                    @else
                        @if ($post->device_status == 1 || $post->device_status == 4)
                            <a href="devices/modify/{{ $post->id }}" style="margin-left: 15px;color: yellow;"><i class="fas fa-pencil-alt"></i></a>
                        @else

                        @endif
                    @endif
                </div>
                <div class="td">{{ $post->device_name }}</div>
                <div class="td">{{ $post->device_model }}</div>
                <div class="td">{{ $post->device_status_content }}</div>
                <div class="td">{!! $post->device_remarks !!}</div>
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
    // let searchBtn = document.querySelector('#searchForm');
    // console.log(searchBtn);
    // searchBtn.addEventListener

    document.querySelector('#searchForm').addEventListener("submit", function(event) {
        event.preventDefault();

        let data = document.querySelector('input[name="device_search"]').value;
        this.action = `{{ url('/devices/search/${data}') }}`;
        this.submit();

    });
</script>
@endsection
