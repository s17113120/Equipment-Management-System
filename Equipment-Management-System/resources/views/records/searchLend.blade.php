@extends('pages.index')

@section('content')
    <div class="container">
        <div class="paper">
            <div class="paper-title">{{ $title }}</div>
            <div class="card-container">


                <div class="card-div">
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="cardTitle">{{ $post->record_id }}</div>
                                <div class="cardBody">
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

