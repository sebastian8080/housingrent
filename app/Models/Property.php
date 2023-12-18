<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "properties";

    protected $fillable = [
        'id', 'code', 'title', 'description', 'state', 'city', 'sector', 'bedrooms', 'bathrooms', 'garage', 'aliquot', 'meters', 'min_price', 'max_price', 'status', 'created_at', 'updated_at'
    ];
}
