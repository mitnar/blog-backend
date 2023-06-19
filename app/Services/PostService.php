<?php

namespace App\Services;

use App\Contracts\PostContract;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService implements PostContract
{
    public function blockPost(int $id, string $comment)
    {
        $post = Post::find($id);

        if(!empty($post)) {
            $post->deleted_comment = $comment;
            $post->save();
            $post->delete();
        }
        else {
            throw new ModelNotFoundException('Указанный пост не найден');
        }
    }
}
