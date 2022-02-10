<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostsTest extends TestCase
{
   use WithFaker;



    /** @test */
    public function guests_cannot_create_posts()
    {
        $post = Post::factory()->create();
        $this->post('/posts', $post->toArray())->assertRedirect('login');
        $this->get('/posts/create')->assertRedirect('login');
        $this->get('/posts')->assertRedirect('login');
        $this->get($post->path())->assertRedirect('login');
    }


    /** @test */
    public function a_user_can_create_post(){

        $this->withoutExceptionHandling();

        $this->sign_in();

        $this->get('/posts/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'notes' => $this->faker->paragraph,
        ];

        $response = $this->post('/posts', $attributes);

        $response->assertRedirect(Post::where($attributes)->first()->path());

        $this->assertDatabaseHas('posts', $attributes);

        $this->get('/posts')
            ->assertSee($attributes['title'])
            ->assertSee($attributes['notes']);

    }



    /** @test */
    public function a_user_can_update_post(){

        $this->withoutExceptionHandling();

        $this->sign_in();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'notes' => $this->faker->paragraph,
        ];

        $post = auth()->user()->posts()->create($attributes);

        $notes = [
            'notes' => $this->faker->sentence
        ];

        $this->patch($post->path(), $notes);

        $this->assertDatabaseHas('posts', $notes);

        $this->get('/posts')
            ->assertSee($notes['notes']);

    }


    /** @test */
    public function a_user_can_only_update_his_post(){


       $post = Post::factory()->create();

        $notes = [
            'notes' => $this->faker->sentence
        ];

        $this->sign_in();

        $this->patch($post->path(), $notes)
            ->assertStatus(403);

    }


    /** @test */
    public function a_post_requires_title()
    {
                $this->sign_in();


        $attributes = Post::factory()->raw(['title' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('title');
    }


    /** @test */
    public function a_post_notes_min_3()
    {
        $this->sign_in();

        $attributes = Post::factory()->raw(['notes' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('notes');
    }

    /** @test */
    public function a_post_requires_description()
    {
        $this->sign_in();

        $attributes = Post::factory()->raw(['description' => '']);

        $this->post('/posts', $attributes)->assertSessionHasErrors('description');
    }


      /** @test */
       public function a_post_requires_an_owner()
       {
           /**
            * Only Authenticated Users Can Create Posts
            */
//                  $this->sign_in();

//
//           $attributes = Post::factory()->raw(['owner_id' => null]);
//
//           $this->post('/posts', $attributes)->assertSessionHasErrors('owner_id');

           $attributes = Post::factory()->raw();

           $this->post('/posts', $attributes)->assertRedirect('login');


       }

    /** @test */
    public function an_authenticated_can_view_post_of_other()
    {
        $this->sign_in();

        $post = Post::factory()->create();

        $this->get($post->path())->assertStatus(403);

    }


      /** @test */
      public function a_post_requires_an_authenticated_owner()
      {
          $attributes = Post::factory()->raw();

          $this->post('/posts', $attributes)->assertRedirect('login');
      }


    /** @test */
    public function a_user_can_view_his_post()
    {
        // $this->withoutExceptionHandling();

        $this->be(User::factory()->create());

        $post = auth()->user()->posts()->create(
            [
                'title' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
                'notes' => $this->faker->paragraph,
            ]
        );

        $this->get($post->path())
            ->assertSee($post->title)
            ->assertSee($post->description)
            ->assertSee($post->notes);
    }
}
