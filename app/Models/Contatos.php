<?php

namespace ARsig\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contatos extends Model
{
    protected $table = 'contatos';

    protected $fillable = [
        'nome', 'empresa',
        'cargo', 'url',
        'telefone', 'endereco',
        'email', 'observacao',
        'receber_mailing',
        'origem_detalhe',
        'tags',
        'bounce',
        'classificacao',
        'ativo', 'cod_origem',
        'data_confirmacao',
    ];


    protected $casts = [
        'data_confirmacao' => 'date:d/m/Y H:m:s',
    ];

    protected $appends = ['list_tags', 'list_bounce', 'list_classificacao'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function getDataConfirmacaoAttribute($value) {
//
//        return Carbon::parse($value)->format('d/m/Y');
//
//    }
//    public function setDataConfirmacaoAttribute($value)
//    {
//        $this->attributes['data_confirmacao'] = Carbon::createFromFormat('d/m/Y', trim($value))->toDateString();
//    }

    public function ocorrencias()
    {
        return $this->hasMany(ContatosOcorrencias::class);
    }

    public function getlisttagsAttribute() {
        if ($this->attributes['tags'] != ''){
            return collect(explode(",", $this->attributes['tags']))->values();
        }else{
            return [];
        }

    }
    public function getlistbounceAttribute() {
        if ($this->attributes['bounce'] != ''){
            return collect(explode(",", $this->attributes['bounce']))->values();
        }else{
            return [];
        }

    }
    public function getlistclassificacaoAttribute() {
        if ($this->attributes['classificacao'] != ''){
            return collect(explode(",", $this->attributes['classificacao']))->values();
        }else{
            return [];
        }

    }

//    public function getemailsAttribute() {
//        return json_decode($this->attributes['emails'])
//            ;
//    }
//    public function setemailsAttribute($newvalue) {
//        $this->attributes['emails'] = json_encode($newvalue);
//    }

}
