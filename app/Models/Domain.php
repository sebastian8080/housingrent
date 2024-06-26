<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'type_property',
        'max_price',
        'min_price',
        'title',
        'description',
        'meta_description',
        'bedroom',
        'bathroom',
        'garage',
        'construction_area',
        'state_province',
        'sector',
        'city',
        'is_negotiable',
        'slug',
        'address',
        'lat',
        'lng',
        'laundry_type',
        'is_active',
        'available',
        'user_id',
        'created_at',
        'updated_at',
        'annotation',
    ];
    protected $casts = [
        'is_negotiable' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function benefits()
    {
        return $this->belongsToMany(Benefit::class, 'property_benefit')
                    ->withTimestamps();
    }
    public function multimedia()
    {
        return $this->hasMany(Multimedia::class);
    }

}
