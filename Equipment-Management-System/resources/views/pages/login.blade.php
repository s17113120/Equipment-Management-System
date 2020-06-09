@extends('pages.index')

@section('content')
    <div class="container-fluid">
        <div class="paper-tall-thin-3 flex-c-paper">
            <div class="paper-title">{{ $title }}</div>
            <div class="paper-body">
                <form action="#">
                    @csrf
                    <div class="form-group">
                        <div class="group-div group-title">帳號</div>
                        <div class="group-div group-line"></div>
                        <div class="group-div group-input"><input type="text"></div>
                    </div>
                    <div class="form-group">
                        <div class="group-div group-title">密碼</div>
                        <div class="group-div group-line"></div>
                        <div class="group-div group-input"><input type="text"></div>
                    </div>
                    <button class="form-btn btn createBtn"><i class="fas fa-sign-in-alt"></i></button>
                </form>
            </div>
        </div>

    </div>
@endsection

