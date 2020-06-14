@extends('pages.index')

@section('content')
    <div class="container">
        <div class="table-search_div">
            <div class="table-search">
                <div class="icon"><i class="fas fa-search"></i></div>
                <form method="get" id="searchForm">
                    {{-- @csrf --}}
                    <input type="text" name="lend_search">
                </form>
            </div>
        </div>
        <div class="paper">
            <div class="paper-title">{{ $title }}</div>
            <div class="card-container">


                <div class="card-div">
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="cardTitle">{{ $post->record_id }}</div>
                                <div class="cardBody">
                                    <div class="cardBody-content"><div class="title">姓名</div>{{ $post->user_name }}</div>
                                    <div class="cardBody-content"><div class="title">產編</div>{{ $post->device_id }}</div>
                                    <div class="cardBody-content"><div class="title">數量</div>{{ $post->record_amount }}</div>
                                    <div class="cardBody-content"><div class="title">借出時間</div>{{ $post->record_dateOfTake }}</div>
                                    <div class="cardBody-content"><div class="title">歸還時間</div>{{ $post->record_dateOfReturn }}</div>
                                    <div class="cardBody-content"><div class="title">審核狀態</div>{{ $post->record_status_content }}</div>
                                    <div class="cardBody-content"><div class="title">備註</div>{!! $post->record_content !!}</div>
                                </div>
                            </div>
                        @endforeach


                    @else
                        <p style="color: white; font-weight: bold;">沒有借出資料</p>
                    @endif

                </div>
                <div class="card-btns">
                    {{ $posts->links() }}
                </div>

            </div>

        </div>

    </div>
@endsection


@section('script')
<script>

    document.querySelector('#searchForm').addEventListener("submit", function(event) {
        event.preventDefault();
        let data = document.querySelector('input[name="lend_search"]').value;

        if (data != "") {
            this.action = `{{ url('/records/lendHistory/search/${data}') }}`;
            this.submit();
        } else {
            this.action = `{{ url('/records/lendHistory') }}`;
            this.submit();
        }


    });
</script>
@endsection

