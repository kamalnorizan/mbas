<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        if (request()->ajax()) {
            $users = User::latest();
            return DataTables()->of($users)
                ->addIndexColumn()
                ->addColumn('profile_picture', function ($user) {
                    $profile = '<div class="avatar avatar-2xl rounded-circle">' .
                        '<div class="h-30 w-30 rounded-circle overflow-hidden position-relative">' .
                        '<img src="http://mbas-template.test/storage/profile/personal/avatar.png" width="200" alt="" data-dz-thumbnail="data-dz-thumbnail">' .
                        '</div>' .
                        '</div>';
                    return $profile;
                })
                ->addColumn('roles', function ($user) {
                    $roles = '';
                    foreach ($user->roles as $role) {
                        if ($role->name == 'admin') {
                            $roles .= '<span data-uuid="'.$user->uuid.'" class="badge bg-success role">' . strtoupper($role->name) . '</span> ';
                        } else if ($role->name == 'user') {
                            $roles .= '<span data-uuid="'.$user->uuid.'" class="badge bg-primary role">' . strtoupper($role->name) . '</span> ';
                        } else {
                            $roles .= '<span data-uuid="'.$user->uuid.'" class="badge bg-info role">' . strtoupper($role->name) . '</span> ';
                        }
                    }
                    return $roles;
                })
                ->addColumn('action', function (User $user) {
                    $buttons = '<a href="' . route('users.edit', ['uuid' => $user->id]) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> ';
                    $buttons .= '<button class="btn btn-sm btn-danger delete" data-uuid="' . $user->uuid . '"><i class="fa fa-trash"></i></button> ';
                    return $buttons;
                })
                ->rawColumns(['profile_picture', 'action', 'roles'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('user.index', compact('roles'));
    }

    function assignrole(Request $request)
    {
        $user = User::where('uuid', $request->user_id)->first();

        $user->syncRoles($request->role);
        return response()->json(['success' => true]);
    }

}
