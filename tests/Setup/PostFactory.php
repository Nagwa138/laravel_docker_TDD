<?php

namespace Tests\Setup;

use App\Models\Post;
use App\Models\PostPoint;
use App\Models\User;

class PostFactory
{
    protected $pointsCount = 0;

    protected $points = [];

    protected $user;

    public function ownedBy(User $user){
        $this->user = $user;
        return $this;
    }

    public function withPoints($count){
        $this->pointsCount = $count;
        return $this;
    }

    public function create(){

        $post = Post::factory()->create(['owner_id' => $this->user ?? User::factory()->create()]);

        PostPoint::factory()->count($this->pointsCount)->create([
            'post_id' => $post->id
        ]);

        return $post;
    }


}
