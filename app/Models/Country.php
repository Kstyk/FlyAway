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

    protected $fillable = ['id', 'nazwa', 'iso3166', 'waluta', 'powierzchnia_calkowita', 'jezyk_urzedowy'];

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
