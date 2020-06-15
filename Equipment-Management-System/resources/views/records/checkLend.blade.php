@extends('pages.index')

@section('content')
<div class="container">
    <div class="paper">
        <div class="paper-title">{{ $title }}</div>
        <div class="card-container">
            @include('inc.message')

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
                                <div class="cardBody-content"><div class="title">設備狀態</div>{{ $post->device_status_content }}</div>
                                <div class="cardBody-content"><div class="title">審核狀態</div>{{ $post->record_status_content }}</div>
                                <div class="cardBody-content"><div class="title">備註</div>{!! $post->record_content !!}</div>

                                @if (session('userdata')->user_id == $post->user_id)

                                @else
                                    <div class="cardBody-content cardBtn"><button class="btns btn-agree" value="{{ $post->record_id }}" onclick="agree_form(this)">同意</button></div>
                                    <div class="cardBody-content cardBtn"><button class="btns btn-disagree" value="{{ $post->record_id }}" onclick="disagree_form(this)">不同意</button></div>
                                @endif

                            </div>
                        </div>
                        <form class="agree_form_{{ $post->record_id }}" method="post" action="{{ url('records/updateLend') }}">
                            @csrf
                            <input type="text" name="form_type" value="agree" hidden>
                            <input type="text" name="record_id" value="{{ $post->record_id }}" hidden>
                        </form>

                        <form class="disagree_form_{{ $post->record_id }}" method="post" action="{{ url('records/updateLend') }}">
                            @csrf
                            <input type="text" name="form_type" value="disagree" hidden>
                            <input type="text" name="record_id" value="{{ $post->record_id }}" hidden>
                        </form>
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
        function agree_form(ob) {
            const id = ob.value;
            document.querySelector(`.agree_form_${id}`).submit();
        }
        function disagree_form(ob) {
            const id = ob.value;
            document.querySelector(`.disagree_form_${id}`).submit();
        }
    </script>
@endsection
