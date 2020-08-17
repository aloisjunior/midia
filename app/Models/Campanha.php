<?php

namespace ARsig\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    protected $table = 'campanha';

    protected $fillable = array(
        'nome',
        'descricao',
        'tags_incluir',
        'tags_excluir',
        'data_inicio_envio',
        'intervalo_dias_envio',
        'dias_reenvio',
        'ativo',
        'inicio_imediato',
        'atraso_inicio_envio',
    );


//    protected $dates = ['data_inicio_envio'];

//    protected $dateFormat = 'd/m/Y';

    //Make it available in the json response
    protected $appends = [
        'list_tags',
//        'taxaEnviados',
//        'taxaReenviados',
//        'taxaAbertos',
//        'taxaClicados',
//        'taxaDescadastrados',
//        'totalEnviados',
//        'totalReenviados',
//        'totalAbertos',
//        'totalClicados',
//        'totalDescadastrados',
//        'totalProgramados'
    ];

    protected $casts = [
        'data_inicio_envio' => 'date:d/m/Y',
    ];

    public function getlisttagsAttribute() {
        if ($this->attributes['tags'] != ''){
            return collect(explode(",", $this->attributes['tags']))->values();
        }else{
            return [];
        }

    }

//    public function getDataInicioEnvioAttribute($value) {
//
//        return Carbon::parse($value)->format('d/m/Y');
//
//    }
//    public function setDataInicioEnvioAttribute($value)
//    {
//        $this->attributes['data_inicio_envio'] = Carbon::createFromFormat('d/m/Y', trim($value))->toDateString();
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//
//    public function disparos()
//    {
//        return $this->hasMany(CampanhaDisparos::class);
//    }

}
