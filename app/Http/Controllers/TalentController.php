<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\TalentRequest;
use App\Models\Talent;
use App\Models\TalentDescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TalentController extends Controller
{

    public function create(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        } else {
            session()->forget('referrer');
        }

        if (Auth::check()) {
            $talent = Auth::user()->talent;
        } else {
            $talent = null;
        }
        $talent_description = TalentDescription::first();

        return view('pages.talent.new-talent', compact('talent', 'talent_description'));
    }


    public function store(TalentRequest $request)
    {

        $images = [
            [
                'type' => 'one',
                'image' => $request->talent_image_one
            ], [
                'type' => 'two',
                'image' => $request->talent_image_two
            ], [
                'type' => 'three',
                'image' => $request->talent_image_three
            ], [
                'type' => 'four',
                'image' => $request->talent_image_four
            ], [
                'type' => 'resume',
                'image' => $request->talent_resume
            ],
        ];

        DB::beginTransaction();

        try {

            $request['user_id'] = Auth::id() ? Auth::id() : null;


            if (session()->has('referrer')) {
                $referer_code = session()->get('referrer');
            } else {
                $referer_code = '';
            }


            // if user is not authenticated and this form email exist user table
            if (!Auth::check()) {
                $email = $request->email;
                $user = User::where('email', $email)->first();
                $referer_user = User::where('referral_code', $referer_code)->first();

                if (isset($user) && isset($referer_code) && $user->referral_code == $referer_code) {
                    $request['referred_by'] = null;
                } else {
                    $request['referred_by'] = @$referer_user->id;
                }
            } elseif (Auth::check() && empty(Auth::user()->talent)) { // if auth but not exist any talent
                $referer_user = User::where('referral_code', $referer_code)->first();

                if (isset($referer_code) && Auth::user()->referral_code == $referer_code) {
                    $request['referred_by'] = null;
                } else {
                    $request['referred_by'] = @$referer_user->id;
                }
            } else {
                $request['referred_by'] = null;
            }

            $only_store = $request->only([
                'user_id',
                'talent_name',
                'parent_name',
                'email',
                'phone',
                'date_of_birth',
                'gender',
                'eye_color',
                'hair_color',
                'height',
                'weight',
                'shirt_size',
                'pant_size',
                'shoe_size',
                'ethnicity_one',
                'ethnicity_two',
                'mail_address',
                'subject',
                'referred_by',
                'message',
                'la_casting_profile_link',
                'actor_access_profile_link',
                'website',
                'imdb_page',
                'represent_agency',
            ]);

            if (auth()->check()) { // update existing or create a new talent
                $talent = Talent::updateOrCreate([
                    'user_id' => Auth::id(),
                ], $only_store);
            } else { // only create a new talent
                $talent = Talent::create($only_store);
            }


            // upload every image
            foreach ($images as $image) {
                if ($image['image']) {
                    $image_path = FileHandler::upload($image['image'], 'talents', ['width' => 500, 'height' => 500]);
                    $talent_exist = $talent->images()->where('type', $image['type'])->first();
                    if ($talent_exist) {
                        FileHandler::delete(@$talent_exist->base_path);
                        $talent_exist->delete();
                    }
                    $talent->images()->create([ // save an image
                        'url' => Storage::url($image_path),
                        'base_path' => $image_path,
                        'type' => $image['type'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Talent Successfully Saved');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function show(Talent $talent)
    {
        //
    }


//    public function edit(Talent $talent)
//    {
//        //
//    }
//
//
//    public function update(Request $request, Talent $talent)
//    {
//        //
//    }

}
