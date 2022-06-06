<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Country;
use App\Models\UserFlight;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'date_of_birth',
        'email',
        'bank_balance',
        'password',
        'avatar',
        'country_id',
        'role_id'
    ];

    protected $attributes = [
        'role_id' => 2,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function userflights() {
        return $this->hasMany(UserFlight::class);
    }

    public function isAdmin() {
        return $this->role_id == 1;
    }

    public function isLogged() {
        return $this->id == auth()->user()->id;
    }
}
