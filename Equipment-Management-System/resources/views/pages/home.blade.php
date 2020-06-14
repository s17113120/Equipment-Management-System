@extends('pages.index')

@section('content')
    {{-- <div class="container-fluid">
        <div class="paper">
            <div class="paper-title"></div>
        </div>
    </div> --}}

@endsection

{{-- @section('script')
    <script>
        document.querySelector('.button-lists').addEventListener('click', function() {
            document.querySelector('.button-x').style.display = 'block';
            this.style.display = 'none';

            document.querySelector('.sidebar-top-menu').style.top = '90px';
            document.querySelector('.sidebar-top-menu').classList.add('active');


        });

        document.querySelector('.button-x').addEventListener('click', function() {
            document.querySelector('.button-lists').style.display = 'flex';
            this.style.display = 'none';
            document.querySelector('.sidebar-top-menu').style.top = 'calc(-100vh - 90px)';
            document.querySelector('.sidebar-top-menu').classList.remove('active');
        })
    </script>
@endsection --}}
