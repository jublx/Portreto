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

    public function numberOfFollowers(Request $request)
    {
      return $request->user()->followers->count();
    }

    public function updateAvatar(Request $request)
    {
      $request->validate([
        'avatar' => 'required|image|max:5120|mimes:jpeg,png,jpg,gif,svg'
      ],
      [
        'avatar.max' => "La taille de l'image ne doit pas dépasser 5 Mo."
      ]);
      if($request->hasFile('avatar')) {
        

        $avatar_name = $request->user()->id.'_avatar'.time().'.'.$request->avatar->getClientOriginalExtension(); // détermination du nom de l'image
        $avatar_path = public_path('/images/avatars/'); 
        $request->avatar->move($avatar_path, $avatar_name); // déplace l'image de la requête dans le dossier /public/images/avatars/
        $currentUserImageName = $request->user()->informations->avatar; // récupère le nom de l'avatar actuel de l'utilisateur
        if(strcmp($currentUserImageName, 'user_default.png') != 0) { 
          File::delete($avatar_path .''. $currentUserImageName); // on supprime l'ancien avatar de l'utilisateur
        }
        $request->user()->informations()->update([
          'avatar' => $avatar_name // on met à jour le nom de l'avatar de l'utilisateur
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
    public function update(Request $request)
    {
      // mise à jour des infos de l'utilisateur avec validation des champs
        $user = $request->user();

        $request->validate([
          'contact_email' => 'email',
        ],
        [
          'contact_email.email' => "Le champ email doit contenir une adresse email valide."
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
