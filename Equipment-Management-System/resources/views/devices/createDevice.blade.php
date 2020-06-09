@extends('pages.createForm_index')

@section('content')
    <div class="container-fluid">
        <div class="paper">
            <div class="paper-title">{{ $title }}</div>
            <form action="#">
                @csrf
                <div class="form-group">
                    <div class="group-div group-title">產編</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text"></div>
                </div>

                <div class="form-group">
                    <div class="group-div group-title">名稱</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text"></div>
                </div>

                <div class="form-group">
                    <div class="group-div group-title">型號</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-input"><input type="text"></div>
                </div>
                <div class="form-group-b">
                    <div class="group-div group-title">備註</div>
                    <div class="group-div group-line"></div>
                    <div class="group-div group-textarea"><textarea class="form-control" id="summary-ckeditor" name="body"></textarea></div>
                </div>
                <button class="form-btn btn createBtn"><i class="fas fa-plus fa-2x"></i></button>
            </form>
        </div>
    </div>
@endsection

