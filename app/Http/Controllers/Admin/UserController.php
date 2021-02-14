<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user edit|user delete', ['only' => ['index']]);
        $this->middleware('permission:user edit')->only(['edit', 'update']);
        $this->middleware('permission:user delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;
        //get all Messages
        $users = User::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $users = $users->where('email', 'like', $keyword)
                ->orWhere('name', 'like', $keyword);
        }

        $users = $users->paginate($perPage);
        //Show All Messages
        return view('admin.pages.users.index', compact('users'));
    }


    public function create()
    {
        abort(404);
    }


    public function store(UserRequest $request)
    {
        abort(404);
    }


    public function show(User $user)
    {
        abort(404);
    }

    public function edit(User $user)
    {
        return view('admin.pages.users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {

        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $image_path = FileHandler::upload($image, 'user_images', ['width' => User::IMAGE_WIDTH, 'height' => User::IMAGE_HEIGHT]);
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

            return redirect()->back()->with('success', 'User successfully updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(User $user)
    {
        FileHandler::delete($user->image ? $user->image->base_path : null);

        if ($user->talent && $user->talent->images) {
            foreach ($user->talent->images as $image) {
                FileHandler::delete($image->base_path ? $image->base_path : null);
            }
        }

        $user->talent()->delete();

        $user->delete();

        return redirect()->back()->with('success', 'User successfully deleted');
    }
}
