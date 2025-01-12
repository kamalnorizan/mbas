<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IklanController extends Controller
{
    public function index()
    {
        return view('iklan.index');
    }

    function ajaxLoadIklan(Request $request)
    {
        $iklan = Iklan::with('user');
        return DataTables()->of($iklan)
            ->addIndexColumn()

            ->addColumn('status', function ($row) {
                if ($row->is_active == 1) {
                    return '<span class="badge bg-success" style="width:100%">Aktif</span>';
                } else {
                    return '<span class="badge bg-danger" style="width:100%">Tidak Aktif</span>';
                }
            })
            ->addColumn('start_date', function ($row) {
                return Carbon::parse($row->start_date)->format('d-m-Y');
            })
            ->addColumn('end_date', function ($row) {
                return Carbon::parse($row->end_date)->format('d-m-Y');
            })
            ->addColumn('created_by', function ($row) {
                return $row->user ? $row->user->name : $row->created_by;
            })
            ->addColumn('action', function ($row) {
                $btn = '<button data-uuid="'.$row->uuid.'" class="edit btn btn-primary btn-sm"><span class="fas fa-edit"></span></button>';
                $btn = $btn . ' <button data-uuid="'.$row->uuid.'" class="delete btn btn-danger btn-sm"><span class="fas fa-trash"></span></button>';
                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $iklan = new Iklan();
        $iklan->title = $request->title;
        $iklan->description = $request->description;
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/iklan'), $image_name);
            $iklan->image = $image_name;
        }
        $iklan->start_date = $request->start_date;
        $iklan->end_date = $request->end_date;
        $iklan->is_active = $request->status;
        $iklan->created_by = auth()->user()->id;
        $iklan->save();

        return response()->json(['status' => true]);

    }

    public function edit(Iklan $uuid)
    {
        $iklan = $uuid;
        return response()->json($iklan);
    }

    public function update(Request $request, Iklan $uuid)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $iklan = $uuid;
        $iklan->title = $request->title;
        $iklan->description = $request->description;
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/iklan'), $image_name);
            $iklan->image = $image_name;
        }

        $iklan->start_date = $request->start_date;
        $iklan->end_date = $request->end_date;
        $iklan->is_active = $request->status;
        $iklan->created_by = auth()->user()->id;
        $iklan->save();

        return response()->json(['status' => true]);

    }

    public function destroy(Iklan $uuid)
    {
        $uuid->delete();

        flash('Iklan berjaya dihapuskan');
        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil dihapus');
    }
}
