<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class OcorrenciasContatos extends Model
{
    protected $table = 'ocorrencias_contatos';

    protected $fillable = [
        'data', 'descricao'
    ];

}
