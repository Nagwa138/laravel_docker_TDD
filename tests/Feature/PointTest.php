<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostPoint;
use Database\Factories\PostPointFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointTest extends TestCase
{

    /** @test */
    public function point_have_path(){

        $point = PostPoint::factory()->create();

        $this->assertEquals('/posts/' . $point->post_id . '/points/' . $point->id, $point->path());
    }


    /** @test */
    public function belongs_to_a_post(){

        $point = PostPoint::factory()->create();

        $this->assertInstanceOf( Post::class, $point->post);
    }
}
