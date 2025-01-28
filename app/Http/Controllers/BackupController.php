<?php

namespace App\Http\Controllers;

use App\Models\BackupLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\DataTables;

class BackupController extends Controller
{
    public function index()
    {
        $backups = BackupLog::all();
        return view('backup.index', compact('backups'));
    }

    public function ajaxLoadBackupLog(Request $request)
    {
        $backups = BackupLog::query();
        return DataTables::of($backups)
            ->addIndexColumn()
            ->addColumn('statusbc', function ($backup) {
                if ($backup->status == '1') {
                    $badge = '<span class="badge bg-success">Active</span>';
                } else {
                    $badge = '<span class="badge bg-danger">Inactive</span>';
                }
                return $badge;
            })
            ->addColumn('date', function ($backup) {
                $created_at = date('d-m-Y', strtotime($backup->created_at));
                return '<span class="badge bg-warning">'.$created_at.'</span>';
            })
            ->addColumn('time', function ($backup) {
                $created_at = date('H:i:s', strtotime($backup->created_at));
                return '<span class="badge bg-info">'.$created_at.'</span>';
            })
            ->addColumn('ation', function ($backup) {
                $button = '<a target="_blank" href="'.route('backup.download', $backup->id).'" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Download</a>';
                return $button;
            })
            ->rawColumns(['statusbc','date','time','ation'])
            ->make(true);

    }

    public function download($id)
    {
        $backup = BackupLog::find($id);
        $file = storage_path('app/'.$backup->path);
        return response()->download($file);
    }

    public function backuprun()
    {
        Artisan::call('backup:run');
        flash('Backup has been created successfully')->success();
        return redirect()->route('backup.index')->with('success', 'Backup has been created successfully');
    }
}
