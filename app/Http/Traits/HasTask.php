<?php

namespace App\Http\Traits;

trait HasTask
{

    /**
     * @param string $body
     * @return $this
     */
    public function addPoint(string $body){
        $this->points()->create(compact('body'));

        return $this;
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
