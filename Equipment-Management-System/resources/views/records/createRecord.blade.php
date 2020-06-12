@extends('pages.index')

@section('content')
    <div class="container-fluid">
        <div class="paper">
            <div class="paper-title">{{ $title }}</div>
            <form action="{{ url('records/store') }}" method="post">
                @csrf
                {{-- <div class="form-group" hidden>
                    <div class="group-div group-title">申請人</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text" name="user_account"><span class="help-text"></div>
                </div> --}}
                <div class="form-group">
                    <div class="group-div group-title">產編</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text" name="device_id"><span class="help-text"></div>
                </div>
                {{-- <div class="form-group" hidden>
                    <div class="group-div group-title">數量</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="number" value="1" name="amount"><span class="help-text"></div>
                </div> --}}
                <div class="form-group">
                    <div class="group-div group-title">歸還日期</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="date" id="date" name="returnDate"><span class="help-text"></div>
                </div>
                <div class="form-group-b">
                    <div class="group-div group-title">備註</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-textarea"><textarea class="form-control" id="summary-ckeditor" name="body"></textarea></div>
                </div>
                <button class="form-btn btn createBtn"><i class="fas fa-plus fa-2x"></i></button>
            </form>
            @include('inc.message')
        </div>
    </form>



@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'summary-ckeditor' ); // 備註 input
            dateShow();

        }


        function dateShow () {
            let date = document.getElementById('date');
            let now = new Date();
            let day = ("0" + now.getDate()).slice(-2);
            let month = ("0" + (now.getMonth() + 1)).slice(-2);
            let today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            date.value = today;
            date.min = today;
        }




    </script>
@endsection

