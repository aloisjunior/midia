<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class Layouts extends Model
{
    protected $table = 'layouts';

    protected $fillable = [
        'id',
        'nome',
        'padrao',
        'altura',
        'largura',
        'areas',
        'ativo',
    ];

    protected $casts = [
        'areas' => 'array'
        ];

//    public function getareasAttribute() {
//        if ($this->attributes['areas'] == ''){
//            return [];
//        }
//
////        return json_decode($this->attributes['areas']);
////        return collect(json_decode($this->attributes['areas']));
//    }
}
