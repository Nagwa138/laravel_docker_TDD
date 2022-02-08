<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;


    /**
     * BE METHOD IS USER AUTHENTICATED BUT NOT THE OWNER
     * ACTING AS IS USER AND NOT AUTHENTICATED
     */

    /** @test  */
    public function has_posts()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->posts);
    }

}
