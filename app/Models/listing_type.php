<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listing_type extends Model
{
    use HasFactory;
    protected $table = 'listing_type';
    protected $fillable = [
        'name'  
    ];
}
