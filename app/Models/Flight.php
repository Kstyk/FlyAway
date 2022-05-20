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

    protected $fillable =['id', 'trip_id', 'airline_name', 'places', 'airport_id', 'airport_id_2', 'departure_date'];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function airport() {
        return $this->belongsTo(Airport::class, 'airport_id');
    }

    public function airport2() {
        return $this->belongsTo(Airport::class, 'airport_id_2');
    }

    public function userflights() {
        return $this->hasMany(UserFlight::class);
    }
}
