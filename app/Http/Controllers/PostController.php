<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Ramsey\Uuid\Uuid;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PostAttachment;
use Illuminate\Support\Facades\Log;
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
        $categories = Category::pluck('name', 'id');
        $authors = Post::select('user_id')->with('user')->distinct()->get();

        return view('post.index', compact('categories', 'authors'));
    }

    function ajaxLoadPosts(Request $request) {
        $posts = Post::with('user')->latest();
            if (!Auth::user()->can(['create-post', 'edit-post', 'delete-post'])) {
                $posts = $posts->where('status', 1);
            }

            if(Auth::user()->can(['edit-post','create-post','delete-post']) && !Auth::user()->can('publish-post') ) {
                $posts = $posts->whereIn('status',[0,1])->where('user_id', Auth::user()->id);
            }

            if($request->has('status') && $request->status != '') {
                $posts = $posts->whereIn('status', [$request->status]);
            }

            if($request->has('categories') && $request->categories != '') {
                $posts = $posts->whereIn('category_id', $request->categories);
            }

            if($request->has('author') && $request->author != '') {
                $posts = $posts->whereIn('user_id', [$request->author]);
            }

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
                ->addColumn('status', function ($post) {
                    if ($post->status == 1) {
                        return '<span class="badge bg-success">Published</span>';
                    } elseif($post->status == 2){
                        return '<span class="badge bg-warning">Approval</span>';
                    }else {
                        return '<span class="badge bg-info">Draft</span>';
                    }
                })
                ->addColumn('action', function ($post) {
                    $buttons = '<a href="' . route('posts.show', $post->uuid) . '" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i></a> ';
                    if (Auth::user()->id == $post->user_id || Auth::user()->can('edit-post')) {
                        $buttons .= '<a href="' . route('posts.edit', $post->uuid) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> ';
                    }
                    if (Auth::user()->id == $post->user_id || Auth::user()->can('delete-post')) {
                        $buttons .= '<button class="btn btn-sm btn-danger delete" data-uuid="' . $post->uuid . '"><i class="fa fa-trash"></i></button> ';
                    }
                    return $buttons;
                })
                ->rawColumns(['likes', 'views', 'action', 'status'])
                ->addIndexColumn()
                ->make(true);
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
        $post->content = $request->contenttiny;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->status = $request->status;
        $post->save();

        if($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $filesingle) {

                $filename = uniqid() . '.' . $filesingle->getClientOriginalExtension();
                $filesingle->storeAs('uploads', $filename, 'public');

                $attachment = new PostAttachment();
                $attachment->post_id = $post->id;
                $attachment->file_path = $filename;
                $attachment->file_type = 'image';
                $attachment->save();
            }
        }

        if($request->ajax()) {
            return response()->json(['success' => true]);
        }

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
        if (Auth::user()->id != $uuid->user_id && !Auth::user()->can('edit-post')) {
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
        if (Auth::user()->id != $uuid->user_id && !Auth::user()->can('edit-post')) {
            abort(403, 'Unauthorized action.');
        }
        $post = $uuid;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        if($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $filesingle) {

                $filename = uniqid() . '.' . $filesingle->getClientOriginalExtension();
                $filesingle->storeAs('uploads', $filename, 'public');

                $attachment = new PostAttachment();
                $attachment->post_id = $post->id;
                $attachment->file_path = $filename;
                $attachment->file_type = 'image';
                $attachment->save();
            }
        }

        $post->save();

        if($request->ajax()) {
            return response()->json(['success' => true]);
        }

        flash('Post updated successfully')->success()->important();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $uuid)
    {
        $post = $uuid;
        if (Auth::user()->id != $post->user_id && !Auth::user()->can('delete-post')) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        return response()->json(['success'=>true]);
    }

    public function destroyimage(Request $request, PostAttachment $id)
    {
        if (Auth::user()->id != $id->post->user_id && !Auth::user()->can('edit-post')) {
            abort(403, 'Unauthorized action.');
        }
        $attachment = $id;
        $attachment->delete();
        return response()->json(['success'=>true]);
    }
}
