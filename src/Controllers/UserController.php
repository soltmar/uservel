<?php

namespace marsoltys\uservel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use User;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $select = config('uservel.displayProperties');
        $select[] = 'id';
        $users = \User::orderBy('name')->get();
        if ($this->rightsInstalled && config('uservel.showRoles')) {
            $users->load('roles');
        }
        return view('uservel::user.list')->with([
            'user'  => Auth::user(),
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uservel::user.form', [
            'title'       => 'Create User',
            'roles'       => Role::orderBy('name')->get(),
            'permissions' => Permission::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created user in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $this->handleEmptyRight($request);

        $data = $request->validate([
            'username'         => 'required|unique:users|max:255',
            'name'             => 'required|max:255',
            'email'            => 'required|email',
            'password'         => 'required',
            'confirm-password' => 'same:password',
            'roles'            => 'nullable' . $this->rightsInstalled ? '|array' : '',
            'perms'            => 'nullable' . $this->rightsInstalled ? '|array' : ''
        ]);

        $data['password'] = bcrypt($data['password']);

        if ($user = User::create($data)) {
            if ($this->rightsInstalled) {
                $user->syncRights($data);
            }
            return redirect()->route('user.index')->with('laralert', [[
                'type'    => 'success',
                'content' => 'User has been created successfully.'
            ]]);
        }

        return redirect()->route('user.index')->with('laralert', [[
            'type'    => 'error',
            'content' => "Error - User hasn't been created!"
        ]]);
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with(['roles', 'permissions'])->firstOrFail();
        $roles = Role::whereNotIn('id', $user->roles->pluck('id'))->orderBy('name')->get();
        $permissions = Permission::whereNotIn('id', $user->permissions->pluck('id'))->orderBy('name')->get();

        return view('uservel::user.form', [
            'user'        => $user,
            'roles'       => $roles,
            'permissions' => $permissions,
            'title'       => 'Update ' . $user->name
        ]);
    }

    /**
     * Update the specified user in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $this->handleEmptyRight($request);
        $user = User::findOrFail($id);

        $data = $request->validate([
            'username'         => 'required|max:255|unique:users,username,' . $user->id,
            'name'             => 'required|max:255',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'password'         => 'nullable',
            'confirm-password' => 'same:password',
            'roles'            => 'nullable' . $this->rightsInstalled ? '|array' : '',
            'perms'            => 'nullable' . $this->rightsInstalled ? '|array' : ''
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        if ($user->update($data)) {
            if ($this->rightsInstalled) {
                $user->syncRights($data);
            }
            return redirect()->route('user.index')->with('laralert', [[
                'type'    => 'success',
                'content' => 'User has been updated successfully.'
            ]]);
        }

        return redirect()->route('user.index')->with('laralert', [[
            'type'    => 'error',
            'content' => "Error - User hasn't been updated!"
        ]]);
    }

    /**
     * Remove the specified user from database.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->isSuperAdmin() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'You have to be Superadmin to delete this user');
        }

        if (User::destroy($id)) {
            return redirect()->route('user.index')->with('laralert', [[
                'type'    => 'success',
                'content' => 'User has been deleted.'
            ]]);
        }

        return redirect()->route('user.index')->with('laralert', [[
            'type'    => 'error',
            'content' => "Error - User hasn't been deleted!"
        ]]);
    }
}
