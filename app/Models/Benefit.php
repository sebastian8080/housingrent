<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_benefit_id', // Asegúrate de incluir el id del tipo de beneficio
    ];

    /**
     * The properties that belong to the benefit.
     */
    public function domains()
    {
        return $this->belongsToMany(Domain::class, 'property_benefit')
                    ->withTimestamps();
    }
    public function typeBenefit()
    {
        return $this->belongsTo(Type_Benefit::class, 'type_benefit_id');
    }
}
