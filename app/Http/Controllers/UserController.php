<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Notifications\EmailUpdateNotification;
use App\Notifications\ResetPasswordNotification;

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
                        }else if ($role->name == 'author') {
                            $roles .= '<span data-uuid="'.$user->uuid.'" class="badge bg-warning role">' . strtoupper($role->name) . '</span> ';
                        }
                        else {
                            $roles .= '<span data-uuid="'.$user->uuid.'" class="badge bg-info role">' . strtoupper($role->name) . '</span> ';
                        }
                    }
                    return $roles;
                })
                ->addColumn('action', function (User $user) {
                    $buttons = '<a href="' . route('users.edit', ['uuid' => $user->uuid]) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> ';
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

    public function edit($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.edit', compact('user', 'roles','permissions'));
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $uuid . ',uuid',
            'phone' => 'required',
            'heading' => 'required',
        ]);

        $user = User::where('uuid', $uuid)->first();
        $oldVal = clone $user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->heading = $request->heading;
        $user->intro = $request->intro;
        $user->save();
        if ($request->email != $oldVal->email) {
            $user->notify(new EmailUpdateNotification());
        }

        flash('User updated successfully')->success();
        return back();
    }

    public function destroy($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $user->posts()->delete();
        $user->comments()->delete();
        $user->delete();

        flash('User deleted successfully')->success();
        return redirect()->route('users.index');
    }

    public function resetPassword(Request $request)
    {
        $password = Str::random(8);
        $user = User::where('uuid', $request->uuid)->first();
        $user->password = Hash::make($password);
        $user->save();

        //send ResetPassword Notification
        $user->notify(new ResetPasswordNotification($password));


        flash('Password reset successfully')->success();
        return back();
    }

    function updateimage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // dd($request->all());
        $user = User::where('uuid', $request->uuid)->first();
        $image = $request->file('profile_image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('storage/profile/personal'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        flash('Profile image updated successfully')->success();
        return back();
    }

    function updatecover(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::where('uuid', $request->uuid)->first();
        $image = $request->file('cover_image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('storage/profile/cover'), $imageName);

        $user->cover_image = $imageName;
        $user->save();

        flash('Cover picture updated successfully')->success();
        return back();
    }

    function updaterole(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();
        $user->syncRoles($request->roles);
        flash('Role(s) assigned successfully')->success()->important();
        return back();
    }

    function updatepermission(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();
        $user->syncPermissions($request->permissions);
        flash('Permission(s) assigned successfully')->success()->important();
        return back();
    }

}
