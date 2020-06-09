@extends('pages.index')

@section('content')
    <div class="container-fluid">
        {{-- @if (count($posts) > 0)
        @foreach ($posts as  $post)
            <div class="alert alert-primary">
                <h3><a href="posts/{{ $post->user_student_id }}">{{ $post->user_name }}</a></h3> --}}
                {{-- <small>Written omn {{ $post->created_at }}</small> --}}
            {{-- </div>
        @endforeach --}}
        {{ $posts->links() }} {{-- controller 需加 paginate() --}}
    {{-- @else
        <p>No posts found</p>
    @endif --}}
        checkUser
    </div>
@endsection

