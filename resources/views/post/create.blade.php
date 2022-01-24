@extends('layouts.main')
@section('content')
<div>
  <form action="{{ route('post.store') }} " method="post">
    @csrf
      <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="title">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" class="form-control" id="content" placeholder="Content"></textarea>
    </div>
    <div class="form-group">
      <label for="image">Image</label>
      <textarea name="image" class="form-control" id="image" placeholder="image"></textarea>
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
          <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>

@endsection