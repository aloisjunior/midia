<?php

namespace ARsig\Models;

use ARsig\Http\Controllers\Api\SignageController;
use ARsig\Scopes\OnlyUserAuthScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Playlist extends Model
{
    protected $table = 'playlist';

    protected $fillable = [
        'id',
        'nome',
        'user_id',
        'ativo',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['duracao'];
//
//    public function getlisttagsAttribute() {
//        if ($this->attributes['tags'] != ''){
//            return collect(explode(",", $this->attributes['tags']))->values();
//        }else{
//            return [];
//        }
//
//    }

//    protected $hidden = ['duracao'];


    public function getduracaoAttribute()
    {
        $conteudos = $this->conteudos()->get();

        if (count($conteudos) > 0){
            $signageInstance = new SignageController();

            $playlistTmp = $signageInstance->ProcessaPlaylist('', false, $conteudos);

            $tempos = [];

            $tempos['total'] = Carbon::createFromFormat('H:i:s', '00:00:00');
            $tempos['subplaylist'] = Carbon::createFromFormat('H:i:s', '00:00:00');
            $tempos['carrossel'] = Carbon::createFromFormat('H:i:s', '00:00:00');
            $tempos['rss'] = Carbon::createFromFormat('H:i:s', '00:00:00');
            $tempos['conteudo'] = Carbon::createFromFormat('H:i:s', '00:00:00');

//        $tempoTotal = Carbon::createFromFormat('H:i:s', '00:00:00');

            foreach ($playlistTmp as $tmpCont ){
                $tempoTmp = explode(':', $tmpCont['tempo']);

                switch ($tmpCont['tipo']) {
                    case 'subplaylist':
                        $tempos['subplaylist']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                        break;
                    case 'carrossel':
                        $tempos['carrossel']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                        break;
                    case 'rss':
                        $tempos['rss']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                        break;
                    case 'conteudo':
                        $tempos['conteudo']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                        break;
                }

                $tempos['total']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
            }

            foreach ($tempos as $key => $value){
                $tempos[$key] = $value->toTimeString();
            }

            $resultado = $tempos['total'];
        }else{
            $resultado = '00:00';
        }

//        dd($tempoTotal->toTimeString());

        return $resultado;

    }



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
        return $this->belongsTo(User::class);
    }

    public function conteudos()
    {
//        return $this->hasMany(PlaylistPlaylistConteudo::class)->with(['conteudos', 'layout', 'subplaylist']);
        return $this->hasMany(PlaylistPlaylistConteudo::class)->with([
            'conteudos' => function ($query) {
                $query
                    ->where('ativo', 1)
                    ->where('processado', 1);
            }
                , 'layout', 'subplaylist']);
    }

//    public function players()
//    {
//        return $this->hasMany(Players::class);
//    }

}
