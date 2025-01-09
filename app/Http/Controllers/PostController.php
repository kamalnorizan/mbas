<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Ramsey\Uuid\Uuid;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $posts = Post::with('user')->latest();
            return DataTables()->of($posts)
                ->addColumn('action', 'post.action')
                ->addColumn('category', function ($post) {
                    return $post->category->name;
                })
                ->addColumn('author', function ($post) {
                    return $post->user->name;
                })
                ->addColumn('views', function ($post) {
                    return '<i class="fa fa-eye" aria-hidden="true"></i> '.$post->view_count;
                })
                ->addColumn('likes', function ($post) {
                    return '<i class="fa fa-thumbs-up text-primary" aria-hidden="true"></i> '.$post->like_count;
                })
                ->rawColumns(['likes','views','action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->uuid = Uuid::uuid4();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/posts', $fileName);
            $post->image = $fileName;
        }

        $post->save();

        flash('Post stored successfully')->success()->important();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
