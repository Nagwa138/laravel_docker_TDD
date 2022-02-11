<?php

namespace App\Models;

use App\Http\ModelManagers\PostManager;
use App\Http\Traits\HasTask;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isInstanceOf;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

//    protected $fillable = ['title', 'description', 'notes', 'owner_id'];

    protected $touches = ['owner'];

    public $postManager;

//
//    public function __construct()
//    {
//        $this->postManager = new PostManager($this);
//    }


    public function manage(){
        if(!isInstanceOf(PostManager::class, $this->postManager)){
            $this->postManager = new PostManager($this);
        }
        return new PostManager($this);
    }


    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function points(){
        return $this->hasMany(PostPoint::class);
    }

//    /**
//     * @param string $body
//     * @return $this
//     */
//    public function addPoint(string $body){
//        return  $this->points()->create(compact('body'));
//    }
//
//    /**
//     * @return string
//     */
//    public function path()
//    {
//        # code...
//        return "/posts/{$this->id}";
//    }


    public function activity(){
        return $this->hasMany(Activity::class);
    }
}
