<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;
class DashboardController extends Controller
{
    function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $viewsCount = Post::sum('view_count');
        return view('dashboard',compact('usersCount','postsCount','viewsCount'));
    }

    function ajaxLoadPostChart(Request $request)
    {
        $posts = Post::select(DB::raw('count(*) as post_count, DATE(created_at) as date'))
            ->groupBy('date')
            ->whereMonth('created_at', $request->month)
            ->get();


        $data = [];
        $labels = [];
        $values = [];
        foreach ($posts as $post) {
            $labels[] = Carbon::parse($post->date)->format('d M');
            $values[] = $post->post_count;
        }

        $data['labels'] = $labels;
        $data['data'] = $values;

        return response()->json($data);
    }

    function ajaxLoadTop5(Request $request)
    {

        switch ($request->type) {
            case '1':
                $data = Post::select(DB::raw('title, view_count as value'))->orderBy('view_count', 'desc')
                    ->take(5)
                    ->get();
                break;
            case '2':
                $data = Post::select(DB::raw('title, like_count as value'))->orderBy('like_count', 'desc')
                    ->take(5)
                    ->get();
                break;
            case '3':
                $data = Post::withCount('comments')
                    ->orderBy('comments_count', 'desc')
                    ->take(5)
                    ->get();
                break;
        }


        return response()->json($data);
    }

    function ajaxLoadStatusCount(Request $request) {

        $data = Post::select(DB::raw('count(*) as count, status'));

        if($request->filter == 'week') {
            //last 7 days
            $data = $data->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
        } else if($request->filter == 'month') {
            $lastMonth = Carbon::now()->subMonth();
            $data = $data->whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year);
        } else if($request->filter == 'year') {
            $data = $data->whereYear('created_at', Carbon::now()->year - 1);
        }

        $data = $data->groupBy('status')->get();

        return response()->json($data);
    }

    function ajaxLoadActivityChart(Request $request){
        $data = Audit::select(DB::raw('count(*) as count, event'));

        if($request->filter == 'week') {
            //last 7 days
            $data = $data->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
        } else if($request->filter == 'month') {
            $lastMonth = Carbon::now()->subMonth();
            $data = $data->whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year);
        } else if($request->filter == 'year') {
            $data = $data->whereYear('created_at', Carbon::now()->year - 1);
        }

        $data = $data->groupBy('event')->get();

        return response()->json($data);

    }
}
