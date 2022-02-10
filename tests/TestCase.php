<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase, CreatesApplication;

    public function sign_in($user = null)
    {

        $user = $user ?: User::factory()->create();

        $this->be($user);

        return $user;

    }


}
