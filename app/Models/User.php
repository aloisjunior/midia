<?php

namespace ARsig\Models;

use ARsig\Mail\PasswordResetMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $cashroles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'password_md5', 'ativo', 'config'
    ];

    protected $appends = ['first_name'];

    protected $casts = [
//        'config' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token'

    ];


    public function getconfigAttribute()
    {
        if (($this->attributes['config'] == '') || ($this->attributes['config'] == '[]')) {
            return [
                'players_tempo_notifica' => 20,
                'tema_formularios' => 'Escuro',
                'tema_fundo' => 'Claro',
                'primaryColorModel' => [
                    'text' => 'green',
                    'value' => '#4caf50',
                ],
                'secundaryColorModel' => [
                    'text' => 'blue-grey darken-1',
                    'value' => '#546E7A',
                ],
                'plugins' => [
                    [
                        'text' => 'Status dos players',
                        'value' => 'players-status',
                    ],
                    [
                        'text' => 'Status dos Downloads nos players',
                        'value' => 'players-downloads',
                    ],
                    [
                        'text' => 'Status dos processamentos dos conteúdos',
                        'value' => 'conteudos-processamento',
                    ],
                ],
            ];
        } else {
//            return collect($this->attributes['config'])->values();
            return json_decode($this->attributes['config']);
        }

    }

    public function getfirstnameAttribute()
    {
        if ($this->attributes['name'] != '') {
            return collect(explode(" ", $this->attributes['name']))->first();
        } else {
            return $this->attributes['name'];
        }
    }


    // enviar reset de senha correto para usuario
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \ARsig\Notifications\PasswordResetMail($token, $this));
    }

    public function getRoleRegistered()
    {
        return Role::where('slug', 'registered')->get();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \ARsig\Notifications\PasswordVerificationMail($this));
    }


    /*
     * Broadcast
     */
//    public function receivesBroadcastNotificationsOn()
//    {
//        return 'users.'.$this->id;
//    }
//

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */
    public function estacoes()
    {
        return $this->belongsToMany(Estacao::class, 'estacao_users');
    }

    public function roles()
    {
//        return $this->belongsToMany(Role::class, 'role_users')->with('permissions');
        return $this->belongsToMany(Role::class, 'role_users')->with('permissions');
    }

    public function permissions()
    {

        $result = [];

        $roles = $this->roles()->get();

        foreach ($roles as $role) {
            $result[] = $role->permissions()->get();
        }

        return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {

            return array_pluck($permission, 'permission_slug');

        }, $result))));
    }

    /*
    |--------------------------------------------------------------------------
    | ACL Methods
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->inRole('admin');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess($permissions): bool
    {
        // check if the permission is available in any role
        if ($this->isAdmin()) {
            return true;
        }
        $permission = $permissions;

        return !is_null($permission) && $this->checkPermission($permission);
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() >= 1;
    }

    // rotinas importadas sistema antigo
    public function checkPermission($perm): bool
    {

        $permissions = $this->getAllPermissionsFormAllRoles();
//        Log::debug('permissions in  checkpermission '.print_r($permissions));
//        Log::debug('perm in  checkpermission '.$perm);
        $permissionArray = is_array($perm) ? $perm : [$perm];

//        dd($permissions);
//        dd($permissionArray);
        return count(array_intersect($permissions, $permissionArray)) >= 1;
    }

    /**
     * Get all permission slugs from all permissions of all roles
     *
     * @return Array of permission slugs
     */
    public function getAllPermissionsFormAllRoles()
    {
        if (is_null($this->cashroles)) {
            $this->refreshPermissionsAndRoles();
        }
        return is_array($this->cashroles) ? $this->cashroles : [$this->cashroles];
    }

    public function refreshPermissionsAndRoles()
    {
//        return [];
        //error_log('Recarregada lista de acessos.('.$this->id.')');

//        $permissions = Cache::remember('permissoes.usuario.'.$this->id, 1, function() {
//            return $this->roles->load('permissions')->fetch('permissions')->toArray();

        $this->cashroles = $this->permissions();
        return $this->cashroles;
//        });


//        $permissions = array($permissions);
//
//        $this->cashroles = array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {
//
//            return array_pluck($permission, 'permission_slug');
//
//        }, $permissions))));

//        dd($this->cashroles);
    }

    public function isrole($userrole = null)
    {
        return !is_null($userrole) && $this->checkUserRole($userrole);
    }

    /**
     * Check if User Role match the given role_slug...
     *
     * @param String role slug of a role
     *
     * @return Boolean true if role exists, otherwise false
     */
    protected function checkUserRole($givenrole)
    {
        $getrole = $this->roles->toArray();

        $givenrole = strtolower($givenrole);

        foreach ($getrole as $key) {
            if (array_key_exists('slug', $key) && $key['slug'] == $givenrole) {
                return true;
            }
        }
        return false;
    }

}




