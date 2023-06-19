<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function saving(Post $post)
    {
        if ($post->isDirty('body')) {
            $post->short = substr($post->body, 0, 100);
        }
    }
}
