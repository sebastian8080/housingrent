<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'filename',
        'mime_type',
        'description',
    ];

    // Relación con el modelo Property
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

}
