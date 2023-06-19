<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\SetPostBlockedRequest;
use Carbon\Carbon;
use Auth;
use App\Contracts\PostContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\User;

class PostController extends Controller
{
    private $postService;
    private $user;

    public function __construct(PostContract $postService, User $user)
    {
        $this->postService = $postService;
        $this->user = $user;
    }

    public function index()
    {
        return Post::get(['title', 'created_at', 'short']);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function store(CreatePostRequest $request)
    {
        return Auth::user()->posts()->create($request->all());
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        return $post->update($request->all());
    }

    public function setBlocked(SetPostBlockedRequest $request, int $id)
    {
        try {
            return $this->postService->blockPost($id, $request->comment);
        } catch(ModelNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    public function getAuthorizedUserPosts()
    {
        return Auth::user()
                ->posts()
                ->withTrashed()
                ->get();
    }

    public function getRecents()
    {
        return $this->user->getWithPosts();
    }
}
