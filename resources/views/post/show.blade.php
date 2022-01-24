@extends('layouts.main')
@section('content')
<div>
  <div>{{ $post->id }}. {{ $post->title }}</div>
  <div>{{ $post->content }}</div>
</div>
<div>
    <a href="{{ route('post.edit', $post->id) }}">edit</a>
</div>
<div>
    <form action="{{ route('post.delete', $post->id) }}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="delete" class="btn btn-danger">
    </form>
    
</div>
<div>
    <a href="{{ route('post.index') }}">back</a>
</div>

@endsection