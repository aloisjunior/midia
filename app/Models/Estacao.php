<?php

namespace ARsig\models;

use Illuminate\Database\Eloquent\Model;

class Estacao extends Model
{
    protected $table = 'estacao';

    protected $fillable = array(
        'nome',
        'host',
        'porta',
        'key',
        'tags',
        'ativo',
        'ftp_pastas_offline',
        'ftp_senha'
    );

    protected $appends = ['list_tags', 'list_ftp_pastas_offline'];

    public function getlisttagsAttribute() {
        if ($this->attributes['tags'] != ''){
            return collect(explode(",", $this->attributes['tags']))->values();
        }else{
            return [];
        }

    }

    public function getlistftppastasofflineAttribute() {
        if ($this->attributes['ftp_pastas_offline'] != ''){
            return collect(explode(",", $this->attributes['ftp_pastas_offline']))->values();
        }

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'estacao_users');
    }
}
