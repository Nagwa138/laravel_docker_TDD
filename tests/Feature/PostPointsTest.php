<?php

namespace Tests\Feature;

use App\Http\Traits\HasTask;
use App\Models\Post;
use App\Models\PostPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostPointsTest extends TestCase
{

//    use RefreshDatabase;

    /** @test */
    public function a_post_can_have_points(){

        $this->withoutExceptionHandling();

        $this->sign_in();

        $post = auth()->user()->posts()->create(Post::factory()->raw());

        $this->post($post->path() . '/points', ['body' => 'Test Task', 'post_id' => $post->id]);

        $this->get($post->path())
            ->assertSee('Test Task');
    }

    /** @test */
    public function a_post_can_have_points_by_its_model(){


        $this->withExceptionHandling();

        $post = Post::factory()->create();

        $point = $post->addPoint('Test Task');

        $this->assertCount(1, $post->points);

        $this->assertTrue($post->points->contains($point));

    }



    /** @test */
    public function a_point_requires_body()
    {
        $this->sign_in();

        $post = auth()->user()->posts()->create(Post::factory()->raw());

        $attributes = PostPoint::factory()->raw(['body' => '']);

        $this->post($post->path() . '/points', $attributes)->assertSessionHasErrors('body');

    }

    /** @test */
    public function only_the_owner_can_add_points_on_his_post(){
        $this->sign_in();

        $post = Post::factory()->create();

        $this->post($post->path() . '/points', ['body' => 'Hello'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('post_points', ['body' => 'Hello']);

    }

}
