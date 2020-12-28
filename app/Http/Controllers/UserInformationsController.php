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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInformations  $userInformations
     * @return \Illuminate\Http\Response
     */
    public function show(UserInformations $userInformations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserInformations  $userInformations
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInformations $userInformations)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInformations  $userInformations
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInformations $userInformations)
    {
        //
    }
}
