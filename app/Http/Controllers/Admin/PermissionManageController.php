<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionManageController extends Controller
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

        //get all permissions
        $permissions = Permission::latest();


        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $permissions = $permissions->where('name', 'like', $keyword);
        }

        $permissions = $permissions->paginate($perPage);

        return view('admin.pages.authorizations.permissions.index', compact('permissions'));
    }


    public function create()
    {
        abort(404);
        return view('admin.pages.authorizations.permissions.create');
    }


    public function store(PermissionRequest $request)
    {
        abort(404);
        DB::beginTransaction();

        try {
            Permission::create([
                'name' => $request->name,
                'module_name' => $request->module_name
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Permission Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function edit(Permission $permission)
    {
        abort(404);
        return view('admin.pages.authorizations.permissions.edit', compact('permission'));
    }


    public function update(Request $request, Permission $permission)
    {
        abort(404);
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,' . $permission->id . ',id',
        ]);

        DB::beginTransaction();

        try {
            $permission->update($request->all());


            DB::commit();

            return redirect()->route('admin.permissions.index')->with('success', 'Permission Successfully Updated!');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Permission $permission)
    {
        abort(404);
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission Successfully Deleted!');
    }


}
