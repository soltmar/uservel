<?php

namespace marsoltys\uservel\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('uservel::role.list', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uservel::role.form', [
            'title' => 'Create Role'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request = $this->handleEmptyRight($request);

        $data = $request->validate([
            'name' => 'required|unique:roles|max:255'
        ]);

        if (Role::create($data)) {
            return redirect()->route('role.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions->pluck('id');

        return view('uservel::role.form', [
            'role'        => $role,
            'permissions' => Permission::whereNotIn('id', $permissions)->get(),
            'title'       => "Update {$role->name} role"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $this->handleEmptyRight($request);

        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name'  => 'required|max:255|unique:roles,name,' . $role->id,
            'perms' => 'nullable' . $this->rightsInstalled ? '|array' : ''
        ]);

        if ($role->update(['name' => $data['name']])) {
            if ($this->rightsInstalled) {
                $role->syncPermissions($data['perms']);
            }

            return redirect()->route('role.index')->with('laralert', [[
                'type'    => 'success',
                'content' => 'User has been updated successfully.'
            ]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Role::destroy($id)) {
            $request->session()->flash('laralert', [[
                'type'    => 'success',
                'content' => 'Role has been deleted.'
            ]]);
        }

        $request->session()->flash('laralert', [[
            'type'    => 'error',
            'content' => "Error - Role hasn't been deleted!"
        ]]);
    }
}
