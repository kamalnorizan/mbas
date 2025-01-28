<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use OwenIt\Auditing\Models\Audit;
use App\Http\Controllers\Controller;

class AuditTrailController extends Controller
{
    function index()
    {
        $audits = Audit::orderBy('created_at', 'desc')->get();
        return view('audittrail.index');
    }

    function ajaxLoadAuditTrail(Request $request)
    {
        $audits = Audit::orderBy('created_at', 'desc');

        if($request->datefilter != null){
            $datearr = explode(' to ', $request->datefilter);
            if(count($datearr) != 2){
                $start_date = Carbon::parse($request->datefilter);
                $end_date = Carbon::parse($request->datefilter)->addDay();
            }else{
                $start_date = Carbon::parse(date('Y-m-d', strtotime($datearr[0])));
                $end_date = Carbon::parse(date('Y-m-d', strtotime($datearr[1])))->addDay();
            }

            $audits = $audits->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'desc');
        }
        return DataTables::of($audits)
            ->addColumn('user', function ($audit) {
                if ($audit->user == null) {
                    return 'System';
                }
                return $audit->user->name;
            })
            ->addColumn('action', function ($audit) {
                $action = '';
                if ($audit->event == 'created') {
                    $action = '<span class="badge bg-success">Created</span>';
                } else if ($audit->event == 'updated') {
                    $action = '<span class="badge bg-info">Updated</span>';
                } else if ($audit->event == 'deleted') {
                    $action = '<span class="badge bg-danger">Deleted</span>';
                }else if ($audit->event == 'login') {
                    $action = '<span class="badge bg-warning">Logged In</span>';
                }else if ($audit->event == 'logout') {
                    $action = '<span class="badge bg-warning">Logged Out</span>';
                }
                return $action;
            })
            ->addColumn('datetime', function ($audit) {
                return $audit->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('module', function ($audit) {
                return substr($audit->auditable_type, 11);
            })
            ->addColumn('old_values', function ($audit) {
                $values = '';
                if ($audit->old_values == null) {
                    return '-';
                }

                foreach ($audit->old_values as $key => $value) {
                    $values .= $key . ' : ' . $value . '<br>';
                }
                return $values;
            })
            ->addColumn('new_values', function ($audit) {
                $values = '';
                if ($audit->new_values == null) {
                    return '-';
                }
                foreach ($audit->new_values as $key => $value) {
                    $values .= $key . ' : ' . $value . '<br>';
                }
                return $values;
            })
            ->rawColumns(['old_values', 'new_values', 'action'])
            ->make(true);
    }
}
