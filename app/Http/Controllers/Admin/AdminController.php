<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {

        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;
        //get all Messages
        $admins = Admin::whereNotIn('id', [1])->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $admins = $admins->where('email', 'like', $keyword)
                ->orWhere('name', 'like', $keyword)
                ->whereNotIn('id', [1]);
        }

        $admins = $admins->paginate($perPage);
        //Show All Messages
        return view('admin.pages.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::latest()->get();
        return view('admin.pages.admins.create', compact('roles'));
    }


    public function store(AdminRequest $request)
    {
        DB::beginTransaction();

        try {
            $has_pass = Hash::make($request->password);

            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $has_pass,
            ]);

            if ($request->file('image')) {
                $image_path = FileHandler::upload($request->image, 'admins_images', ['width' => '84', 'height' => '84']);
                $user->image()->create([
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                ]);
            }

            $user->syncRoles($request->type);

            DB::commit();
            return back()->with('success', 'Admin Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }


    public function show(Admin $admin)
    {
        abort(404);
    }

    public function edit(Admin $admin)
    {
        $roles = Role::latest()->get();
        return view('admin.pages.admins.edit', compact('admin', 'roles'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        DB::beginTransaction();

        try {
            if ($request->password) {
                $update_password = Hash::make($request->password);
            } else {
                $update_password = $admin->password;
            }
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $update_password,
            ]);

            $admin->syncRoles($request->type);

            if ($request->file('image')) {
                $image = $request->file('image');
                $image_path = FileHandler::upload($image, 'admins_images', ['width' => '84', 'height' => '84']);
                FileHandler::delete($user->image->base_path ?? null);

                $image__data = [
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                ];

                if ($admin->image) {
                    $admin->image()->update($image__data);
                } else {
                    $admin->image()->create($image__data);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Admin Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Admin $admin)
    {
        FileHandler::delete($admin->image ? $admin->image->base_path : null);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin Successfully Deleted');
    }
}
