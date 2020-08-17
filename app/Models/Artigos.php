<?php

namespace ARsig\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Artigos extends Model
{
    protected $table = 'artigos';

    protected $fillable = array(
        'id',
        'titulo',
        'slug',
        'apresentacao',
        'corpo',
        'ativo',
        'published',
        'user_id',
        'tags',
        'categorias',
        'tipo',
        'views',
        'likes',
        'url_video',
        'created_at',
    );

    protected $casts = [
        'ativo' => 'boolean',
    ];

    protected $appends = ['list_categorias', 'list_tags'];

    protected $dates = ['created_at'];

//    protected $dateFormat = 'd/m/Y H:i:s';

//    public function getCreatedAtAttribute(){
//        return Carbon::createFromTimestamp($this->attributes['created_at'])->format('d/m/Y H:i:s');
//    }

//    public function setCreatedAtAttribute($value){
//        $this->attributes['created_at'] = Carbon::createFromFormat('DD/MM/YYYY HH:mm:ss', $value )->format('YYYY-MM-DD HH:mm:ss');
//    }

    public function getlistcategoriasAttribute() {
        if ($this->attributes['categorias'] != ''){
            return collect(explode(",", $this->attributes['categorias']))->values();
        }else{
            return [];
        }
    }

    public function getlisttagsAttribute() {
        if ($this->attributes['tags'] != ''){
            return collect(explode(",", $this->attributes['tags']))->values();
        }else{
            return [];
        }

    }

//    public function categorias()
//    {
//        return explode(",", $this->attributes['categorias']);
////        $this->belongsToMany(ArtigosCategoria::class, 'pivot_artigos_categoria');
//    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function arquivos()
    {
        return $this->hasMany(ArtigosArquivos::class);
    }
}
