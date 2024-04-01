<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // Relación con usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    // Método para añadir un permiso a un rol
    public function givePermissionTo(Permission $permission)
    {
        $this->permissions()->save($permission);
    }

    // Método para verificar si el rol tiene un permiso específico
    public function hasPermission($permissionSlug) {
        return (bool) $this->permissions->where('slug', $permissionSlug)->count();
    }
}
