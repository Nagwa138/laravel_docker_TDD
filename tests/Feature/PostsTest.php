<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostsTest extends TestCase
{
   use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_post(){

        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/posts', $attributes)->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', $attributes);

        $this->get('/posts')->assertSee($attributes['title']);

    }


    /** @test */
    public function a_post_requires_title()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Post::factory()->raw(['title' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('title');
    }

      /** @test */
    public function a_post_requires_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Post::factory()->raw(['description' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('description');
    }


      /** @test */
       public function a_post_requires_an_owner()
       {
           /**
            * Only Authenticated Users Can Create Posts
            */
//          $this->actingAs(User::factory()->create());
//
//           $attributes = Post::factory()->raw(['owner_id' => null]);
//
//           $this->post('/posts', $attributes)->assertSessionHasErrors('owner_id');

           $attributes = Post::factory()->raw();

           $this->post('/posts', $attributes)->assertRedirect('login');


       }




      /** @test */
      public function a_post_requires_an_authenticated_owner()
      {
          $attributes = Post::factory()->raw();

          $this->post('/posts', $attributes)->assertRedirect('login');
      }


    /** @test */
    public function a_user_can_view_a_project()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());


        $post = Post::factory()->create();

        $this->get($post->path())
            ->assertSee($post->title)
            ->assertSee($post->description);
    }
}
