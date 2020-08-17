<?php

namespace ARsig\models;

use Illuminate\Database\Eloquent\Model;

class FonteDados extends Model
{
    protected $table = 'fonte_dados';

    protected $fillable = array(
        'nome',
        'tipo',
        'dados_conexao'
    );


//    protected $casts = [
//        'dados_conexao' => 'array',
//    ];

//    public function getDadosConexaoAttribute($value) {
//        return json_decode($value);
//
//        // you could always make sure you get an array returned also
//        // return json_decode($value, true);
//    }
}
