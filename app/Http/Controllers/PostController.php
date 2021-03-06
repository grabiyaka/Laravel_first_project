<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        $post = Post::find(1);
        $tag = Tag::find(1);
        $category = Category::find(1);

        // dd($post->tags);
        
        return view('post.index', compact('posts'));
    }

    public function create()
    {

        $categories = Category::all();
        $tags = Tag::all();


        return view('post.create', compact('categories', 'tags'));

        // Добавление в БД
        // foreach($posts_arr as $post){
        //     Post::create($post);
        // }
        // dd('created');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post = Post::create($data);

        $post->tags()->attach($tags);

        // foreach ($tags as $tag){
        //     PostTag::firstOrCreate([
        //         'tag_id' => $tag,
        //         'post_id' => $post->id
        //     ]); 
        // }
        
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));

    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.edit', compact('post', 'categories', 'tags'));
    }   
    
    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        //dd($data);
        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);

    }
    public function destroy(Post $post)
    {
       
        $post->delete();
        return redirect()->route('post.index');

    }

    public function firstOrCreate()
    {

        // $anotherPost = [
        //     'title' => 'POST1',
        //     'content' => 'some post',
        //     'image' => 'ololo',
        //     'likes' => 1,
        //     'is_published' => 1,
        //     'text' => 'jojo'
        // ];
        
        // Короче такая прикольная хрень, в первом массиве оно ищет совпадения в бд, если находит то приравнивается тому что нашло,
        // если не нашло то добавляет 2 массив в бд 
        $post = Post::firstOrCreate([
            'title' => 'some post',
        ],[
            'title' => 'Post1',
            'content' => 'some post',
            'image' => 'ololo',
            'likes' => 1,
            'is_published' => 1,
            'text' => 'jojo'
        ]);
        dump($post->content);
        dd('finished');

    }

    public function updateOrCreate()
    {

        $anotherPost = [
            'title' => 'UPDATEORCREATE POST1',
            'content' => 'UPDATEORCREATE some post',
            'image' => 'UPDATEORCREATE ololo',
            'likes' => 100,
            'is_published' => 1,
            'text' => 'jojo'
        ];
        //Тоже самое но если оно найдет запись в бд то обновит, а ели не найдет то сделает новую запись
        $post = Post::updateOrCreate([
            'title' => 'Post2',
        ],$anotherPost);
        dd($post->title);
    }

}
