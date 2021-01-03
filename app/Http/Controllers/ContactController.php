<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInformations;

class ContactController extends Controller
{
  public function add(Request $request) {
    $request->validate([
      'friend_code' => 'required|min:11|max:11|exists:user_informations,friend_code'
    ], 
    [
      'friend_code.required' => "Le code ami est requis.",
      'friend_code.exists' => "Le code ami ne correspond à aucun utilisateur.",
      'friend_code.min' => "La taille du code ami n'est pas valide (rappel : 3 nombres de 3 chiffres).",
      'friend_code.max' => "La taille du code ami n'est pas valide (rappel : 3 nombres de 3 chiffres).",
    ]);

    $contact_id = UserInformations::select('user_id')->where('friend_code', $request->friend_code)->get()[0]['user_id']; // récupère l'id du contact
    $request->user()->contacts()->attach($contact_id);
  }

  public function remove(Request $request) {
    $request->validate([
      'contact_id' => 'required|exists:users,id'
    ]);

    $request->user()->contacts()->detach($request->contact_id);
  }
}
