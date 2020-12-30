<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInformations;

class ContactController extends Controller
{
  public function add(Request $request) {
    $request->validate([
      'friend_code' => 'required|exists:user_informations,friend_code'
    ]);

    $contact_id = UserInformations::select('user_id')->where('friend_code', $request->friend_code)->get()[0]['user_id'];
    $request->user()->contacts()->attach($contact_id);
  }

  public function remove(Request $request) {
    $request->validate([
      contact_id => 'required|exists:users,id'
    ]);

    $request->user()->contacts()->detach($request->contact_id);
  }
}
