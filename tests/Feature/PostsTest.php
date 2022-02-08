<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostsTest extends TestCase
{
   use WithFaker, RefreshDatabase;

    /** @test */ 
    public function a_user_can_create_post(){
        
        
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/posts', $attributes);

        $this->assertDatabaseHas('posts', $attributes);

        $this->get('/posts')->assertSee($attributes['title']);


    }
     /** @test */ 
    public function a_post_requires_title()
    {
        $attributes = Post::factory()->raw(['title' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('title');
    }

      /** @test */ 
    public function a_post_requires_description()
    {
        $attributes = Post::factory()->raw(['description' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */ 
    public function a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();
        
        $post = Post::factory()->create();

        $this->get('/posts/' . $post->id)->assertSee($post->title)->assertSee($post->description);
    }
}
