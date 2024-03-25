<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'filename',
        'mime_type',
        'description',
    ];

    // Relación con el modelo Property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
