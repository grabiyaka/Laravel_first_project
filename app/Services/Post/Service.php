<?php 

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class Service
{

    public function store($data)
    {
        try{
            Db::beginTransaction();
            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);
    
            $data['category_id'] = $this->getCategoryId($category);
            $tagIds = $this->getTagIds($tags);
    
            $post = Post::create($data);
    
            $post->tags()->attach($tagIds);

            Db::commit();
        } catch (\Exception $exception){
            Db::rollBack();
            return  $exception->getMessage();
        }

        return $post;
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        $category = $data['category'];
        unset($data['tags'], $data['category']);

  
        $data['category_id'] = $this->getCategoryIdWhithUpdate($category);
        $tagIds = $this->getTagIdsWhithUpdate($tags);

        $post->update($data);
        $post->tags()->sync($tagIds);
        return $post->fresh();
    }
    
    private function getCategoryId($item)
    {
        $category = !isset($item['id']) ? $category = Category::create($item) : Category::find($item['id']);
        return $category->id;

    }

    private function getCategoryIdWhithUpdate($item)
    {
        try{
            Db::beginTransaction();
            if (!isset($item['id'])) {
                $category = Category::create($item);
            } else {
                $category = Category::find($item['id']);
                $category->update($item);
                $category = $category->fresh();
            }
        } catch (\Exception $exception){
            Db::rollBack();
            return  $exception->getMessage();
        }
        return $category->id;

    }

    private function getTagIds($tags)
    {
        $tagsIds = [];
        foreach ($tags as $tag) {
            $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);  
            $tadIds[] = $tag->id; 
        }
        return $tadIds;
    }

    private function getTagIdsWhithUpdate($tags)
    {
        $tagsIds = [];
        foreach ($tags as $tag) {
            $tag = '';
            if(!isset($tag['id'])){
                $tag = Tag::create($tag);
            } else{
                $currentTag = Tag::find($tag['id']); 
                $currentTag->update($tag);
                $tag = $currentTag->fresh();
            }
            $tadIds[] = $tag->id; 
        }
        return $tadIds;
    }
    
}