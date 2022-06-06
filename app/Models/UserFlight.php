<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Flight;

class UserFlight extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'flight_id', 'date_of_purchase', 'amount_of_tickets', 'price'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function flight() {
        return $this->belongsTo(Flight::class);
    }
}
