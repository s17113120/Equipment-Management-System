@extends('pages.index') @section('content')
<div class="container">


    <div class="paper">
        <div class="paper-title">{{ $title }}</div>
        <form action="{{ url('user/update') }}" method="post">
            @csrf

            <div class="form-group" hidden>
                <div class="group-div group-input"><input type="text" name="user_id" value="{{ $user->user_id }}"><span class="help-text"></div>
            </div>
            <div class="form-group">
                <div class="group-div group-title">姓名</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input"><input type="text" name="user_name" value="{{ $user->user_name }}"><span class="help-text"></div>
            </div>

            <div class="form-group">
                <div class="group-div group-title">權限</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input">
                    <select name="user_authority">
                        <option value="{{ $user->user_authority }}">{{ $user->user_status_content }}</option>
                        @if (session('userdata')->user_status_content == "management")
                            <option value="1">management</option>
                        @endif
                        <option value="2">admin</option>
                        <option value="3">user</option>
                    </select>
                    <span class="help-text">
                </div>
            </div>

            <div class="form-group">
                <div class="group-div group-title">密碼</div>
                <div class="group-div group-line"></div>
                <div class="group-div group-input"><input type="password" name="user_password" value="{{ $user->user_password }}"></div>
            </div>
            <button class="form-btn btn createBtn"><i class="fas fa-pencil-alt"></i></button>

        </form>
        @include('inc.message')

    </div>
</div>
@endsection @section('script')

@endsection
