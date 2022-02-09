<?php

namespace App\Models;

use App\Http\ModelManagers\PostManager;
use App\Http\Traits\HasTask;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

//
//    protected $postManager;
//
//    public function __construct()
//    {
//        $this->postManager = new PostManager($this);
//    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function points(){
        return $this->hasMany(PostPoint::class);
    }

    /**
     * @param string $body
     * @return $this
     */
    public function addPoint(string $body){
        return  $this->points()->create(compact('body'));

    }

    /**
     * @return string
     */
    public function path()
    {
        # code...
        return "/posts/{$this->id}";
    }

}
