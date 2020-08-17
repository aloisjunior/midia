<?php

namespace ARsig\Models;

use ARsig\Scopes\OnlyUserAuthScope;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $table = 'players';

    protected $fillable = [
        'id',
        'nome',
        'ultimo_sinal',
        'ultimo_sinal_service',
        'token_id',
        'token_auth',
        'token_push_android',
        'playlist',
        'tipo_cliente',
        'playlist_id',
        'ativo',
        'tags',
        'grupos',
        'user_id',
        'validade_de',
        'validade_ate',
        'agendamenteo',
        'app_version',
        'app_last_init',
    ];

    protected $conteudos;

    protected $dates = ['ultimo_reinicio', 'app_last_init'];

    protected $casts = [
        'download_total' => 'array',
        'download_concluido' => 'array',
        'tags' => 'array',
        'grupos' => 'array',
//        'ultimo_sinal' => 'date:d/m/Y H:m',
//        'ultimo_reinicio' => 'datetime:d/m/Y H:i:s', // Change your format
    ];
    protected $appends = ['status', 'download_total', 'download_concluido', 'ultimo_reinicio'];


    protected $hidden = ['playlist'];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OnlyUserAuthScope);
    }




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function playlistatual()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }

//    public function playlist()
//    {
//        return $this->belongsTo(Playlist::class, 'playlist_id');
//    }

    public function getstatusAttribute()
    {
        if ($this->attributes['ultimo_sinal'] == '') {
            return 'Nunca Iniciado';
        } else {
            return [];
        }

    }


    public function gettagsAttribute() {
        if ((!isset($this->attributes['tags'])) || ($this->attributes['tags'] == '')) {
            return [];
        }

        $tmpTags = $this->attributes['tags'];

        if (!is_array(json_decode($tmpTags))){
            $tmpTags = json_encode([$tmpTags]);
        }

//        return json_decode($tmpTags, true);
        return json_decode($tmpTags);

    }

    public function settagsAttribute($value) {
        $this->attributes['tags'] = json_encode($value);
    }



    public function getgruposAttribute() {
        if ((!isset($this->attributes['grupos'])) || ($this->attributes['grupos'] == '')) {
            return [];
        }

        $tmpTags = $this->attributes['grupos'];

        if (!is_array(json_decode($tmpTags))){
            $tmpTags = json_encode([$tmpTags]);
        }

//        return json_decode($tmpTags, true);
        return json_decode($tmpTags);

    }

    public function setgruposAttribute($value) {
        $this->attributes['grupos'] = json_encode($value);
    }


    public function getdownloadtotalAttribute()
    {
        if ($this->attributes['playlist'] == '') {
            return '0';
        }

        $this->conteudos = json_decode($this->attributes['playlist']);

        return collect($this->conteudos)->groupBy('id')->count();
    }

    public function getdownloadconcluidoAttribute()
    {
        if ($this->attributes['playlist'] == '') {
            return '0';
        }

        $this->conteudos = json_decode($this->attributes['playlist']);

        return collect($this->conteudos)
            ->where('data_download', '<>', '')
            ->groupBy('id')
            ->count() +
            collect($this->conteudos)
            ->whereIn('tipo_conteudo', ['url', 'streaming'])
            ->groupBy('id')
            ->count();
    }


    public function getultimoreinicioAttribute()
    {
        if (!is_null($this->attributes['app_last_init'])){
            return $this->attributes['app_last_init'];
        } else {
            return '';



//            realizado via trigger no banco

        }
    }


    /*
     * select p.nome, p.app_version, pl2.reinicio as 'Ultimo REINICIO', max(pl.horario) as 'Ultimo contato' from players_logs pl inner join players p on (pl.player_id = p.id)
left join (select p.id, max(pl.horario) as 'reinicio' from players_logs pl inner join players p on (pl.player_id = p.id)
           where pl.tipo_conteudo = 'player'
            and pl.tipo_log = 'player'
           group by player_id
           order by max(pl.horario) desc) pl2 on (pl2.id = pl.player_id)
group by player_id
order by max(pl.horario) desc

     *
     */


}
