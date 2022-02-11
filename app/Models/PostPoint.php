<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPoint extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['post'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function path(){
        return $this->post->manage()->path() . '/points/' . $this->id;
    }

}
