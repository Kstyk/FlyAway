<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flight;
use App\Models\Country;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'country_id', 'city'];

    public function flights() {
        return $this->hasMany(Flight::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
