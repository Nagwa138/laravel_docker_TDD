<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsUnitTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_post_has_path()
    {
        # code...
        $post = Post::factory()->create();

        $this->assertEquals('/posts/' . $post->id, $post->path());
    }

}
