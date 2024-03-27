<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Benefit extends Model
{
    use HasFactory;
    protected $table = "type_benefits";

    // Campos que se pueden asignar de manera masiva
    protected $fillable = [
        'name',
    ];

    // Relación con Beneficios: Un TipoBeneficio tiene muchos Beneficios
    public function benefits()
    {
        return $this->hasMany(Benefit::class, 'type_benefit_id');
    }   
}
