<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = array(
        'permission_title',
        'permission_slug',
        'permission_description',
        'permission_group',
    );


    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role')->with('users');
    }
}
