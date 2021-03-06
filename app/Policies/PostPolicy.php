<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post){
        return $user->is($post->owner);
    }

    public function show(User $user, Post $post){
        return $user->is($post->owner);
    }
}
