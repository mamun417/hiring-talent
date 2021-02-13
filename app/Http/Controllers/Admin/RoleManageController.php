<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:admin');
    }


    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $roles = Role::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $roles = $roles->where('name', 'like', $keyword);
        }
        $roles = $roles->paginate($perPage);

        return view('admin.pages.authorizations.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::latest()->get()->sortBy('module_name')->groupBy('module_name')->sortDesc();
        return view('admin.pages.authorizations.roles.create', compact('permissions'));
    }


    public function store(RoleRequest $request)
    {
        DB::beginTransaction();

        try {
            $role = Role::create(['name' => strtolower($request->name)]);

            $role->syncPermissions($request->permission_ids);

            DB::commit();

            return redirect()->route('admin.roles.index')->with('success', 'Role Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function show(Role $role)
    {
        abort(404);
    }


    public function edit(Role $role)
    {
        if ($role->name == 'admin') { // can not delete admin role
            abort(403);
        }
        $permissions = Permission::latest()->get()->sortBy('module_name')->groupBy('module_name')->sortDesc();
        return view('admin.pages.authorizations.roles.edit', compact('role', 'permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $role->name = strtolower($request->name);
            $role->save();
            $role->syncPermissions($request->permission_ids);

            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Role Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }


    public function destroy(Role $role)
    {
        if ($role->name == 'admin') { // can delete admin role
            abort(403);
        }

        $role->delete();

        return redirect()->back()->with('success', 'Role Successfully Deleted');
    }

}
