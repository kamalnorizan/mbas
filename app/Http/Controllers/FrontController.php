<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Iklan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    function index() {
        // dd(Carbon::now());
        $iklanList = Iklan::where('is_active', 1)->whereDate('start_date','<=',Carbon::now())->whereDate('end_date','>=',Carbon::now())->get();
        $latestPosts = Post::orderBy('created_at', 'desc')->limit(3)->get();
        return view('front.index', compact('latestPosts','iklanList'));
    }
}
