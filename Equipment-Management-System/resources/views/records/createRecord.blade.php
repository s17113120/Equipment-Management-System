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
                    <div class="group-div group-title">借出日期</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="date" id="oDate" name="outDate" onchange="odate_onchange()"><span class="help-text" style="color: var(--orange);"> 可提前7天預借</div>
                </div>
                <div class="form-group">
                    <div class="group-div group-title">歸還日期</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="date" id="rDate" name="returnDate"><span class="help-text"></div>
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


        function dateShow () { // 限制 可提前7天預借
            let rdate_input = document.getElementById('rDate');
            let odate_input = document.getElementById('oDate');

            // 當天
            let odate_min = new Date().toLocaleString();

            // +7天
            let odate = new Date();
            odate.setDate(odate.getDate() + 7);
            let odate_max = odate.toLocaleString();

            odate_min = dateSplit(odate_min);
            odate_max = dateSplit(odate_max);

            // odate_input.value = odate_min;
            odate_input.min = odate_min;
            odate_input.max = odate_max;

            // rdate_input.value = odate_min;
            rdate_input.min = odate_min;
            rdate_input.max = odate_min;
        }

        function dateSplit(date){
            let date_arr = date.split(' ');
            let date_time = date_arr[0].replace(/\//g,"-");
            date_arr = date_time.split('-');
            let res_date = ("0" + (date_arr[0])).slice(-4) + "-" + ("0" + (date_arr[1])).slice(-2) + "-" + ("0" + (date_arr[2])).slice(-2);
            return res_date;
        }

        function odate_onchange() {
            let rdate_input = document.getElementById('rDate');

            let odate_input = document.getElementById('oDate');
            let odate_val = odate_input.value;

            rdate_input.min = odate_val;
            rdate_input.max = "";
            console.log(odate_val);
        }




    </script>
@endsection

