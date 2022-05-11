<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Flight;

class UserFlight extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'flight_id', 'data_zakupu'];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function flights() {
        return $this->belongsTo(Flight::class);
    }
}
