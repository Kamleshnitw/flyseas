<?php

namespace App\Http\Controllers\Api;

use App\Models\Retailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProfileResource;

class ProfileApiController extends Controller
{
    public function profile()
    {
        return response([
            'success'     => true,
            'profile'     => new ProfileResource(auth()->user()),
        ],200);
    }

    public function updateProfilePhoto(Request $request)
    {
        $this->validate($request, [
            'photo'     => 'required',
        ]);
        $data = Retailer::where('user_id', auth()->id())->first();
        $photo = time().rand(10,100).'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads/retailer_photo'), $photo);
        $data->photo = $photo;
        $data->save();
        return response([
            'success'     => true,
            'message'     => "Profile photo updated Successfully",
            'profile'     => new ProfileResource($data->User),
        ],200);
    }

    public function updateProfile(Request $request)
    {
        $data = auth()->user();
        $data->email = $request->email;
        $data->save();

        $data->retailerUserDetails->gender = $request->gender;
        $data->retailerUserDetails->save();

        return response([
            'success'     => true,
            'message'     => "Profile updated Successfully",
            'profile'     => new ProfileResource($data),
        ],200);
    }
}
