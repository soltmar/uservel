<?php

namespace marsoltys\uservel\Controllers;

use Illuminate\Http\Request;
use SCC\EndeavourCMS\Support\Permissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(Permissions::PERMISSION_VIEW);
        $permissions = Permission::orderBy('name')->get();
        return view('uservel::permission.list',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Permissions::PERMISSION_CREATE);
        return view('uservel::permission.form', [
            'title' => 'Create permission'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(Permissions::PERMISSION_CREATE);
        $data = $request->validate([
            'name' => 'required|unique:permissions|max:255'
        ]);
        if (Permission::create($data)) {
            return redirect()->route('permission.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);
        $permission = Permission::findOrFail($id);
        return view('uservel::permission.form', [
            'permission'=>$permission,
            'title' => "Update {$permission->name} permission"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);
        $permission = Permission::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255|unique:permissions,name,'.$permission->id,
        ]);

        if ($permission->update($data)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();
            return redirect()->route('permission.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize(Permissions::PERMISSION_DELETE);
        if (Permission::destroy($id)) {
            $request->session()->flash('laralert', [[
                'type' => 'success',
                'content' => 'permission has been deleted.'
            ]]);
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            return redirect()->route('permission.index');
        }

        $request->session()->flash('laralert', [[
            'type' => 'error',
            'content' => "Error - Permission hasn't been deleted!"
        ]]);

        return redirect()->route('permission.index');
    }
}
