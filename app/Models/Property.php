<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "listings";

    protected $fillable = [
        // 'id', 'code', 'title', 'description', 'state', 'city', 'sector', 'bedrooms', 'bathrooms', 'garage', 'aliquot', 'meters', 'min_price', 'max_price', 'status', 'created_at', 'updated_at'
        'id',
        'listing_title',
        'product_code',
        'slug',
        'bedroom',
        'bathroom',
        'garage',
        'property_price',
        'address',
        'sector',
        'city',
        'state',
        'lat',
        'lng',
        'listing_description',
        'construction_area',
        'pet_friendly',
        'images',
        'created_at',
        'updated_at'
    ];
}
