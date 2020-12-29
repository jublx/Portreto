<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {

      $request->validate([
        'name' => ['required'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:8', 'confirmed'],
      ]);
      
      $user = User::create([
        "name" => ucwords($request->name), // on met la première lettre du nom et prénom en majuscule
        "email" => $request->email,
        "password" => Hash::make($request->password)
      ]);

      $user->informations()->save(\App\Models\UserInformations::factory()->make());
    }
}
