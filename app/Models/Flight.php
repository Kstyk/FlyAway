<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Trip;
use App\Model\Airport;
use App\Model\UserFlight;

class Flight extends Model
{
    use HasFactory;

    protected $fillable =['id', 'trip_id', 'nazwa_linii', 'airport_id', 'airport_id_2', 'data_wylotu'];

    public function trips() {
        return $this->belongsTo(Trip::class);
    }

    public function airports() {
        return $this->belongsTo(Airport::class);
    }

    public function userflights() {
        return $this->hasMany(UserFlight::class);
    }
}
