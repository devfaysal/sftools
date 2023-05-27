<?php

namespace App\Http\Controllers;

use App\Actions\UserCreateAction;
use App\Actions\UserUpdateAction;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        return view('users.index');
    }
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::where('guard_name', 'web')->pluck('name');
        $permissions = Permission::where('guard_name', 'web')->pluck('name');
        return view('users.create',[
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(UserRequest $request, UserCreateAction $userCreateAction)
    {
        $this->authorize('create', User::class);
        
        if($userCreateAction($request->validated())){
            session()->flash('message', 'User created Successfully!!');
            session()->flash('alert-class', 'alert-success');
            return redirect()->route('users.index');
        }

        session()->flash('message', 'Something went wrong!!');
        session()->flash('alert-class', 'alert-danger');
        return redirect()->route('users.create');
    }

    public function show(User $user)
    {
        return view('users.show',[
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', User::class);
        $roles = Role::where('guard_name', 'web')->pluck('name');
        $permissions = Permission::where('guard_name', 'web')->pluck('name');

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function update(UserRequest $request, User $user, UserUpdateAction $userUpdateAction)
    {
        $this->authorize('update', User::class);
        
        if($userUpdateAction($user, $request->validated())){
            session()->flash('message', 'User Updated successfully!!');
            session()->flash('alert-class', 'alert-success');
            return redirect()->route('users.index');
        }
    }

    public function datatable()
    {
        $users = User::query();
        return DataTables::of($users)
            ->addColumn('action', function($user) {
                $string = '';
                if($user->trashed()){
                    $string .= '<a class="btn btn-sm btn-oval btn-warning" href="'. route('users.restore', $user->id) .'">Restore</a> ';
                }
                $string .= '<a class="btn btn-sm btn-oval btn-info" href="'. route('users.edit', $user->id) .'">Edit</a>';
                $string .= ' <a class="btn btn-sm btn-oval btn-primary" href="'. route('users.show', $user->id) .'">Show</a>';
                return $string;
            })
            ->addColumn('roles', function($user) {
                $string = '';
                foreach ($user->roles as $role){
                    $string .= '<span class="badge badge-success">'. $role->name .'</span> ';
                }
                return $string;
            })
            ->addColumn('last_login_at', function($user) {
                return $user->last_login_at ? '<span class="badge badge-success">' . $user->last_login_at->format('d M Y h:i:s A') . '</span>' : '<span class="badge badge-warning">Never Logged In</span>';
            })
            ->rawColumns(['action', 'roles', 'last_login_at'])
            ->make(true);
    }
}
