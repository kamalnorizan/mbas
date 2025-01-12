<?php

namespace App\Http\Controllers\Api;

use App\Models\Iklan;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IklanController extends Controller
{
    function index() {
        $iklan = Iklan::with('user')->get();
        return response()->json([
            'status' => 'success',
            'data' => $iklan
        ]);
    }

    function show(Iklan $iklan) {

        return response()->json([
            'status' => 'success',
            'data' => $iklan
        ]);
    }

    function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $iklan = new Iklan();
        $iklan->uuid = Uuid::uuid4();
        $iklan->title = $request->title;
        $iklan->description = $request->description;
        $iklan->start_date = $request->start_date;
        $iklan->end_date = $request->end_date;
        $iklan->is_active = $request->status;
        $iklan->created_by = auth()->user()->id;
        $iklan->save();

        return response()->json(['status' => true, 'data' => $iklan]);
    }

    function update(Request $request, Iklan $iklan) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $iklan->title = $request->title;
        $iklan->description = $request->description;
        $iklan->start_date = $request->start_date;
        $iklan->end_date = $request->end_date;
        $iklan->is_active = $request->status;
        $iklan->save();

        return response()->json([
            'status' => 'success',
            'data' => $iklan
        ]);
    }

    function destroy(Iklan $iklan) {
        $iklan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted Successfully'
        ]);
    }

}
