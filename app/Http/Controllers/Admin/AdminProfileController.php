<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\AdminPasswordRequest;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.pages.profile.profile', compact('admin'));
    }

    public function profileUpdate(AdminProfileRequest $request, Admin $admin)
    {
        DB::beginTransaction();
        try {

            if ($request->file('profile_image')) {
                $image = $request->file('profile_image');
                $image_path = FileHandler::upload($image, 'admin_profile_images', ['width' => '84', 'height' => '84']);
                FileHandler::delete($admin->image->base_path); //image delete
                $admin->image()->update([ // image update
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                    'type' => 'sm',
                ]);
            }

            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Profile Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function changePassword(AdminPasswordRequest $request)
    {
        $hasPassword = Auth::user()->password;
        $check_password = Hash::check($request->current_password, $hasPassword);
        if ($check_password) {
            $new_password = Hash::make($request->password);
            Admin::where('id', Auth::id())->update(['password' => $new_password]);
            return redirect()->back()->with('success', 'Password successfully changed');
        } else {
            return redirect()->back()->with('warning', 'Your password dose not match with current password');
        }
    }

}
