<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use Crypt;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        //get all Messages
        $users = Admin::whereNotIn('id', [1])->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $users = $users->where('email', 'like', $keyword)
                ->orWhere('name', 'like', $keyword)
                ->whereNotIn('id', [1]);
        }

        $users = $users->paginate($perPage);
        //Show All Messages
        return view('admin.pages.users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::latest()->get();
        return view('admin.pages.users.create', compact('roles'));
    }


    public function store(UserRequest $request)
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
                $image_path = FileHandler::upload($request->image, 'user_images', ['width' => '84', 'height' => '84']);
                $user->image()->create([
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                ]);
            }

            $user->syncRoles($request->type);

            DB::commit();
            return back()->with('success', 'User Create Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }


    public function show($id)
    {
        //
    }

    public function edit(Admin $user)
    {
        $roles = Role::latest()->get();
        return view('admin.pages.users.edit', compact('user', 'roles'));
    }


    public function update(UserRequest $request, Admin $user)
    {

        DB::beginTransaction();
        try {
            if($request->password){
                $update_password = Hash::make($request->password);
            }else{
                $update_password = $user->password;
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $update_password,
            ]);

            $user->syncRoles($request->type);

            if ($request->file('image')) {
                $image = $request->file('image');
                $image_path = FileHandler::upload($image, 'user_images', ['width' => '84', 'height' => '84']);
                FileHandler::delete($user->image->base_path ?? null);

                $image__data = [
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                ];

                if ($user->image) {
                    $user->image()->update($image__data);
                } else {
                    $user->image()->create($image__data);
                }
            }


            DB::commit();

            return redirect()->back()->with('success', 'User Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Admin $user)
    {

        FileHandler::delete($user->image ? $user->image->base_path : null);
        $user->delete();

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
}
