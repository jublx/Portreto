<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserInformations;
use Illuminate\Support\Facades\File; 

class UserInformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->informations;
    }

    public function contacts(Request $request)
    {
      return UserInformations::with(array('User' => function($query) {
        $query->select('id','name', 'first_name');
      }))
      ->whereIn('user_id', $request->user()->contacts->pluck('id'))->get();
    }

    public function followers(Request $request)
    {
      return $request->user()->followers;
    }

    public function updateAvatar(Request $request)
    {
      if($request->hasFile('avatar')) {
        $request->validate([
          'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $avatar_name = $request->user()->id.'_avatar'.time().'.'.$request->avatar->getClientOriginalExtension();
        $avatar_path = public_path('/images/avatars/');
        $request->avatar->move($avatar_path, $avatar_name);
        $currentUserImageName = $request->user()->informations->avatar;
        if(strcmp($currentUserImageName, 'user_default.png') != 0) {
          File::delete($avatar_path .''. $currentUserImageName);
        }
        $request->user()->informations()->update([
          'avatar' => $avatar_name
        ]);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserInformations  $userInformations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserInformations $userInformations)
    {
        $user = $request->user();

        $request->validate([
          'contact_email' => 'email',
        ]);

        $user->informations()->update([
          'contact_email' => $request->contact_email,
          'phone_number' => $request->phone_number,
          'nationality' => $request->nationality,
          'adresse' => $request->adresse,
          'biography' => $request->biography,
          'diploma' => $request->diploma,
          'job' => $request->job,
          'interests' => $request->interests,
          'linkedin' => $request->linkedin,
          'facebook' => $request->facebook,
          'instagram' => $request->instagram,
          'twitter' => $request->twitter
        ]);
    }
}
