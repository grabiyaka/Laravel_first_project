@extends('layouts.main')
@section('content')
<div>
{{ $post->image }}
  <form action="{{ route('post.update', $post->id) }} " method="post">
    @csrf
    @method('patch')
      <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" placeholder="title">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" class="form-control" id="content" placeholder="Content">{{ $post->content }}</textarea>
    </div>
    <div class="form-group">
      <label for="image">Image</label>
      <textarea name="image" class="form-control" id="image" placeholder="image">{{ $post->image }}</textarea>
    </div>
    <!-- <div class="form-group">
      <label for="is_published">is_published</label>
      <input name="is_published" class="form-control" id="is_published" placeholder="is_published">
    </div>
    <div class="form-group">
      <label for="text">text</label>
      <textarea name="text" class="form-control" id="text" placeholder="text"></textarea>
    </div> -->
    <div class="form-group"> 
      <label for="Category">Category</label>
      <select class="form-control" id="Category" name="category_id">
        @foreach($categories as $category)
          <option value="{{ $category->id }}"
            {{ $category->id == $post->category->id ? 'selected' : '' }} >
             {{ $category->title }}

            </option>
        @endforeach
      </select>
    </div>
    
    <div class="form-group">
      <label for="tags">Tags</label>
      <select multiple class="form-control" id="tags" name="tags[]">
        @foreach($tags as $tag)
          <option value="{{ $tag->id }}"
          @foreach($post->tags as $postTag)
            {{ $tag->id == $postTag->id ? 'selected' : '' }}
          @endforeach
          >{{ $tag->title }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

@endsection