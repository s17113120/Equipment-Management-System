@extends('pages.index') @section('content')
<div class="container">


    <div class="paper">
        <div class="paper-title">{{ $title }}</div>
        <form action="{{ url('devices/update') }}" method="post">
            @csrf

            <div class="form-group" hidden>
                <div class="group-div group-input"><input type="text" name="device_id" value="{{ $posts->id }}"><span class="help-text"></div>
            </div>
            <div class="form-group">
                <div class="group-div group-title">產編</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input"><input type="text" name="device_no" value="{{ $posts->device_id }}"><span class="help-text"></div>
            </div>

            <div class="form-group">
                <div class="group-div group-title">名稱</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input"><input type="text" name="device_name" value="{{ $posts->device_name }}"><span class="help-text"></div>
            </div>

            <div class="form-group">
                <div class="group-div group-title">型號</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input"><input type="text" name="device_model" value="{{ $posts->device_model }}"><span class="help-text"></div>
            </div>

            <div class="form-group">
                <div class="group-div group-title">狀態</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input">
                    <select name="device_status">
                        <option value="{{ $posts->device_status }}">{{ $posts->device_status_content }}</option>
                        <option value="4">毀損</option>
                        <option value="1">正常</option>
                    </select>
                    {{-- <input type="text" name="device_status" value="{{ $posts->device_status }}"> --}}
                </div>
            </div>

            <div class="form-group-b">
                <div class="group-div group-title">備註</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-textarea"><textarea class="form-control" id="summary-ckeditor" name="device_remarks">{!! $posts->device_remarks !!}</textarea></div>
            </div>
            <button class="form-btn btn createBtn"><i class="fas fa-pencil-alt"></i></button>

        </form>
        @include('inc.message')

    </div>
</div>
@endsection @section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>
@endsection
