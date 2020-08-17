<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    protected $fillable = array(
        'nome',
        'descricao',
        'link',
        'mime',
        'ativo',
        'exibe_site',
        'filename',
        'user_id',
        'tags',
        'size',
    );


    protected $appends = ['list_tags','link_externo', 'icone'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getlisttagsAttribute() {
        if ($this->attributes['tags'] != ''){
            return collect(explode(",", $this->attributes['tags']))->values();
        }else{
            return [];
        }

    }

    public function getlinkexternoAttribute() {
        return Storage::disk('public')->url($this->link);
    }

    public function geticoneAttribute() {
        return identifica_icone($this->filename);
    }

}
