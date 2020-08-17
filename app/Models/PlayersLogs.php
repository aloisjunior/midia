<?php

namespace ARsig\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlayersLogs extends Model
{
    protected $table = 'players_logs';

    protected $fillable = [
        'id',
        'horario',
        'player_id',
        'local_id', // id do log do app
        'descricao',
        'tipo_conteudo',
        'tipo_log',
        'conteudo_id',
        'conteudo_nome',
        'conteudo_arquivo',
        'ativo',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['horario'];

    protected $casts = [
        'horario' => 'datetime:d/m/Y H:i:s', // Change your format
        ];

}
