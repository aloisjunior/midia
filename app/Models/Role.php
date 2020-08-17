<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];


//    protected $casts = [
//        'permissions' => 'array',
//    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id', '');
    }

//    public function hasAccess(array $permissions) : bool
//    {
//        foreach ($permissions as $permission) {
//            if ($this->hasPermission($permission))
//                return true;
//        }
//        return false;
//    }
//
//    private function hasPermission(string $permission) : bool
//    {
//        return $this->permissions[$permission] ?? false;
//    }
}
