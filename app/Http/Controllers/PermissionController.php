<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $permissons = DB::table('permissions')->get();
        $permissions = Permission::join('model_has_permissions', 'model_has_permissions.permission_id', '=', 'permissions.id')
            ->join('users', 'users.id', '=', 'model_has_permissions.model_id')
            ->get(['permissions.id', 'permissions.name', 'users.id', 'users.username']);
        return view('admin.permissions.permissions-index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->get()->pluck('username', 'id')->prepend('none');
        $permissions = DB::table('permissions')->get()->pluck('name', 'id')->prepend('none');
        return view('admin.permissions.permissions-create')
            ->with('users', $users)
            ->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('model_has_permissions')->insert([
           'permission_id' => $request->input('permission_id'),
            'model_type' => 'App\Models\User',
            'model_id' => $request->input('user_id'),
        ]);
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.permissions-show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $users = DB::table('users')->get()->pluck('username', 'id')->prepend('none');
        $permissions = DB::table('permissions')->get()->pluck('name', 'id')->prepend('none');
        return view('admin.permissions.permissions-edit')
            ->with('users', $users)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
