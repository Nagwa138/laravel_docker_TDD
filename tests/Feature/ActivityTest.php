<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\PostFactory;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /** @test  */
    public function creating_post_generates_activity(){

        $post = PostFactory::create();

        $this->assertCount(1, $post->activity);

        $this->assertEquals('created', $post->activity[0]->description);

    }

    /** @test  */
    public function updating_post_generates_activity(){

        $this->withExceptionHandling();

        $post = PostFactory::create();

        $notes = [
            'notes' => 'hellllo'
        ];

        $this->patch($post->path(), $notes);

        $this->assertDatabaseHas('posts', $notes);

        dd($post);

        $this->assertCount(2, $post->activity);

        $this->assertEquals('updated', $post->activity->last()->description);

    }
}
