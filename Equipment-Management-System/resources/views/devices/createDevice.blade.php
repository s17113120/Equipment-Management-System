@extends('pages.index')

@section('content')
    <div class="container-fluid">
        <div class="paper">
            <div class="paper-title">{{ $title }}</div>
            <form action="{{ url('devices/store') }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="group-div group-title">產編</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text" name="device_no"><span class="help-text"></div>
                </div>

                <div class="form-group">
                    <div class="group-div group-title">名稱</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text" name="device_name"><span class="help-text"></div>
                </div>

                <div class="form-group">
                    <div class="group-div group-title">型號</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text" name="device_model"></div>
                </div>
                <div class="form-group-b">
                    <div class="group-div group-title">備註</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-textarea"><textarea class="form-control" id="summary-ckeditor" name="device_remarks"></textarea></div>
                </div>
                <button class="form-btn btn createBtn"><i class="fas fa-plus fa-2x"></i></button>

            </form>
        @include('inc.message')

        </div>

    </div>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endsection

