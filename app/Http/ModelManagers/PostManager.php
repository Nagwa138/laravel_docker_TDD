<?php

namespace App\Http\ModelManagers;
use App\Models\Post;
use App\Models\PostPoint;

class PostManager
{
    /**
     * @var Post $post
     */
    private $post;


    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    /**
     * @param string $body
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addPoint(string $body){

        return $this->post->points()->create(compact('body'));

    }

    /**
     * @return string
     */
    public function path()
    {
        return "/posts/{$this->post->id}";
    }

}
