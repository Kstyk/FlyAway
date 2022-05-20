<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\User;
use App\Models\Airport;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'iso3166', 'currency', 'total_surface', 'language'];

    public function trips() {
        return $this->hasMany(Trip::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function airports() {
        return $this->hasMany(Airport::class);
    }
}
