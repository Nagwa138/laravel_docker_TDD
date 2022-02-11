<?php

namespace Tests\Feature;

use App\Http\Traits\HasTask;
use App\Models\Post;
use App\Models\PostPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\PostFactory;
//use Tests\Setup\PostFactory;
use Tests\TestCase;

class PostPointsTest extends TestCase
{

    /** @test */
    public function a_post_can_have_points(){

        $post = PostFactory::create();

        $this->actingAs($post->owner)
            ->post($post->manage()->path() . '/points', ['body' => 'Test Task', 'post_id' => $post->id]);

        $this->get($post->manage()->path() )
            ->assertSee('Test Task');
    }


    /** @test */
    public function a_post_can_have_points_by_its_model(){


        $this->withExceptionHandling();

        $post = Post::factory()->create();

        $point = $post->manage()->addPoint('Test Task');

        $this->assertCount(1, $post->points);

        $this->assertTrue($post->points->contains($point));

    }


    /** @test */
    public function a_point_requires_body()
    {
        $this->sign_in();

        $post = auth()->user()->posts()->create(Post::factory()->raw());

        $attributes = PostPoint::factory()->raw(['body' => '']);

        $this->post($post->manage()->path()  . '/points', $attributes)->assertSessionHasErrors('body');

    }


    /** @test */
    public function only_the_owner_can_add_points_on_his_post(){
        $this->sign_in();

        $post = Post::factory()->create();

        $this->post($post->manage()->path()  . '/points', ['body' => 'Hello'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('post_points', ['body' => 'Hello']);

    }


    /** @test */
    public function a_point_can_be_update(){

        $post = PostFactory::withPoints(2)
            ->create();

        $this->actingAs($post->owner)
            ->patch($post->manage()->path()  . '/points/' . $post->points[0]->id , [
            'body' => 'welcome',
            'completed' => true,
            'point_id' => $post->points[0]->id
        ]);

        $this->assertDatabaseHas('post_points', [
            'body' => 'welcome',
            'completed' => true,
            'id' => $post->points[0]->id
        ]);

    }

    /** @test */
    public function only_the_owner_can_update_point(){

        $this->withExceptionHandling();

        $this->sign_in();

        $post = Post::factory()->create();

        $point = $post->manage()->addPoint('Hello There');

        $this->patch($post->manage()->path()  . '/points/' . $point->id , [
            'body' => 'welcome',
            'completed' => true,
            'point_id' => $point->id
        ])->assertStatus(403);

        $this->assertDatabaseMissing('post_points', [
           'body' => 'welcome'
        ]);


    }

    /** @test */
    public function a_point_requires_body_in_update(){

        $post = PostFactory::withPoints(2)
            ->create();

        $this->actingAs($post->owner)
            ->patch($post->manage()->path()  . '/points/' . $post->points[0]->id, [
            'completed' => true,
            'point_id' => $post->points[0]->id
        ])->assertSessionHasErrors('body');

    }

}
