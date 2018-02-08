<?php

namespace marsoltys\uservel\Controllers;

use Illuminate\Http\Request;
use SCC\EndeavourCMS\Support\Permissions;
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
        $this->authorize('Role.View');
        $roles = Role::orderBy('name')->get();
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
        $this->authorize('Role.Create');
        return view('uservel::role.form', [
            'title' => 'Create Role',
            'permissions' => Permission::all()
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
        $this->authorize('Role.Create');
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
        $this->authorize('Role.Update');
        $role = Role::findOrFail($id);
        $permissions = $role->permissions()->orderBy('name')->get()->pluck('id');

        return view('uservel::role.form', [
            'role'        => $role,
            'permissions' => Permission::whereNotIn('id', $permissions)->orderBy('name')->get(),
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
        $this->authorize('Role.Update');
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
                'content' => 'Role has been updated successfully.'
            ]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return void
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('Role.Delete');
        if (Role::destroy($id)) {
            $request->session()->flash('laralert', [[
                'type'    => 'success',
                'content' => 'Role has been deleted.'
            ]]);

            return;
        }

        $request->session()->flash('laralert', [[
            'type'    => 'error',
            'content' => "Error - Role hasn't been deleted!"
        ]]);
    }
}
