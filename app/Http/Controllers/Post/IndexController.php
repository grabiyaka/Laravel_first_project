<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BaseController;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;
use App\Http\Filters\PostFilter;
use Illuminate\Auth\Middleware\Authorize;
use App\Http\Resources\Post\PostResource;


class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {

        //$this->authorize('view', auth()->user());

        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        //$query = Post::query();

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);
       
        return PostResource::collection($posts);

        //return view('post.index', compact('posts'));
    }
}
