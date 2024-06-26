<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'town',
        'county',
        'postcode',
        'image_url',
        'description',
        'rating',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
