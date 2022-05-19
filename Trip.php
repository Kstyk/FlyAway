<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Flight;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nazwa', 'kontynent', 'okres_trwania', 'opis', 'cena', 'country_id', 'img_name'];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function flights() {
        return $this->hasMany(Flight::class);
    }
}
