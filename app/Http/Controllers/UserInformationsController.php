<?php

namespace App\Http\Controllers;

use App\Models\UserInformations;
use Illuminate\Http\Request;

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
      return $request->user()->contacts;
    }

    public function followers(Request $request)
    {
      return $request->user()->followers;
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
