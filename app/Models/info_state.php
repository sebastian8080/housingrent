<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info_state extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(info_city::class, 'state_id');
    }
}
