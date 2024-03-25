<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info_city extends Model
{
    use HasFactory;
    protected $fillable = ['state_id', 'name'];

    public function state()
    {
        return $this->belongsTo(info_state::class, 'state_id');
    }

    public function parishes()
    {
        return $this->hasMany(info_parishes::class, 'city_id');
    }
}
