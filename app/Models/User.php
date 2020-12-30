<?php

namespace App\Models;

use App\Models\Contact;
use App\Models\UserInformations;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function informations() {
      return $this->hasOne(UserInformations::class);
    }

    public function contacts() {
      return $this->belongsToMany(
        User::class,
        'contacts',
        'user_id',
        'contact_id'
      );
    }

    public function followers() {
      return $this->belongsToMany(
        User::class,
        'contacts',
        'contact_id',
        'user_id'
      );
    }
}
