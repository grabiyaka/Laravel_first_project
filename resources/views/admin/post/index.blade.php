@extends('layouts.admin')

@section('content')
    
    <div>

        {{-- <div><h1>This is post page</h1></div> --}}
        <div>
            <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Add one</a>  
        </div>
        <div>
        @foreach($posts as $post)
            <div><a href="{{ route('post.show', $post->id) }}">{{ $post->id }}. {{ $post->title }}</a>
        @endforeach
        <div class="mg-3">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>
@endsection