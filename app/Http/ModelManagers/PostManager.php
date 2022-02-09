<?php

namespace App\Http\ModelManagers;
use App\Models\Post;

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
     * @return Post
     */
    public function addPoint(string $body){
        $this->post->points()->create(compact('body'));

        return $this->post;
    }

    /**
     * @return string
     */
    public function path()
    {
        return "/posts/{$this->post->id}";
    }

}
