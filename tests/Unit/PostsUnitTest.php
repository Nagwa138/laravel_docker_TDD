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

        $post = Post::factory()->create();

        $this->assertEquals('/posts/' . $post->id, $post->manage()->path());
    }
    /** @test */
    public function it_has_owner()
    {

        $post = Post::factory()->create();

        $this->assertInstanceOf('App\Models\User', $post->owner);

    }


}
