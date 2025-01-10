<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Ramsey\Uuid\Uuid;
use App\Models\Category;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {

        if (request()->ajax()) {
            $posts = Post::with('user')->latest();
            return DataTables()->of($posts)
                ->addColumn('category', function ($post) {
                    return $post->category->name;
                })
                ->addColumn('author', function ($post) {
                    return $post->user->name;
                })
                ->addColumn('views', function ($post) {
                    return '<i class="fa fa-eye" aria-hidden="true"></i> ' . $post->view_count;
                })
                ->addColumn('action', function ($post) {
                    $buttons = '<a href="' . route('posts.show', $post->uuid) . '" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i></a> ';
                    if (Auth::user()->id == $post->user_id || Auth::user()->hasRole('admin')) {
                        $buttons .= '<a href="' . route('posts.edit', $post->uuid) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> ';
                        $buttons .= '<button class="btn btn-sm btn-danger delete" data-uuid="' . $post->uuid . '"><i class="fa fa-trash"></i></button> ';
                    }
                    return $buttons;
                })
                ->rawColumns(['likes', 'views', 'action'])
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
            $fileName = time() . '_' . $file->getClientOriginalName();
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
    public function show(Post $uuid)
    {
        Post::disableAuditing();
        $post = $uuid;
        $post->view_count += 1;
        $post->save();

        Post::enableAuditing();

        $post->load('comments.user');
        $post->load('category');
        $post->load('user');

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $uuid)
    {
        if (Auth::user()->id != $uuid->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $post = $uuid;
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $uuid)
    {
        if (Auth::user()->id != $uuid->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $post = $uuid;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/posts', $fileName);
            $post->image = $fileName;
        }

        $post->save();

        flash('Post updated successfully')->success()->important();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $uuid)
    {
        $post = $uuid;
        if (Auth::user()->id != $post->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        return response()->json(['success'=>true]);
    }
}
