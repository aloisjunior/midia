<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class ContatosOcorrencias extends Model
{
    protected $table = 'contatos_ocorrencias';

    protected $fillable = [
        'data', 'descricao', 'link'
    ];

}
