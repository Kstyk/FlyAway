<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\Airport;
use App\Models\UserFlight;

class Flight extends Model
{
    use HasFactory;

    protected $fillable =['id', 'trip_id', 'airline_name', 'places', 'departure_airport', 'destination_airport', 'departure_date'];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function departure() {
        return $this->belongsTo(Airport::class, 'departure_airport');
    }

    public function destination() {
        return $this->belongsTo(Airport::class, 'destination_airport');
    }

    public function userflights() {
        return $this->hasMany(UserFlight::class);
    }
}
