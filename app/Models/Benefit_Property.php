<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Benefit_Property extends Pivot
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'property_benefit';

    // If you want the pivot table to have automatically maintained timestamp fields
    public $timestamps = true;

    // If you have additional fields on the pivot table you want to be fillable
    protected $fillable = ['property_id', 'benefit_id'];
    
    // Define the inverse relationship with the Property model
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Define the inverse relationship with the Benefit model
    public function benefit()
    {
        return $this->belongsTo(Benefit::class);
    }
}
