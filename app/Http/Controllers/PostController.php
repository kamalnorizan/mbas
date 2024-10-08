<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    function listing() {
        $posts = Post::all();
        // compact() - bawa data ke view
        return view('post.post_list', compact('posts'));
    }

    // show post form
    function create() {
        $p = new Post();
        return view('post.form', compact('p'));
    }

    // save data into table post
    function save(Request $req) {
        // baca data yg di submit
        //echo $req->title . $req->slug;

        if (empty($req->id)) {
            // insert
            $post = new Post();
        } else {
            // update
            $post = Post::find($req->id);
        }

        $post->title = $req->title;
        $post->slug = $req->slug;

        // kalau validation gagal, patah balik ke form asal
        $req->validate([
            'title' => 'required|min:3',
            'slug'  => 'required'
        ]);

        $post->save(); // insert OR update
        return redirect('/post-list');
    }

    function delete($id) {
        // find($id) - cari by primary key, return 1 rekod / obj
        Post::find($id)->delete();
        return redirect('/post-list');
    }

    function edit($id) {
        // cari data original
        $p = Post::find($id);
        return view('post.form', compact('p'));
    }

    //generate odf report
    function report() {
        $posts = Post::all();
        $pdf = Pdf::loadView('post.report', compact('posts'));
        return $pdf->stream(); // papar pdf dlm browser
    }

    function dashboard() {
        // query builder
        // $rs = DB::select("SELECT * FROM post");
        $rs = DB::select("SELECT DAY(created_at) AS hari,
                            COUNT(*) AS bil
                            FROM post
                            GROUP BY DAY(created_at)");
        //dd($rs);
        $x = [];
        $y = [];
        foreach ($rs as $data) {
            $x[] = $data->hari;
            $y[] = $data->bil;
        }
        return view('post.dashboard', compact('x', 'y'));
    }
}
