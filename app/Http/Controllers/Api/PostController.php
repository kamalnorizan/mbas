<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    function index() {
        $posts = Post::select('id', 'title', 'content', 'category_id')->get();
        return response()->json($posts);
    }

    function store(StorePostRequest $request) {
        $post = new Post();
        $post->uuid = Uuid::uuid4();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->save();
        return response()->json($post);
    }

    function update(Request $request, $id) {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();
        return response()->json($post);
    }

    function destroy($id) {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }

}
