<?php

namespace ARsig\Models;

use ARsig\Scopes\OnlyUserAuthScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PlaylistConteudo extends Model
{
    protected $table = 'playlist_conteudo';

    protected $fillable = [
        'id',
        'nome',
        'filename',
        'mime',
        'link',
        'tempo',
        'tags',
        'processado',
        'user_id',
        'cliente_id',
        'thumbnail',
        'size',
        'ativo',
        'validade_de',
        'validade_ate',
        'agendamento',
        'tipo_conteudo',
        'url',
        'force_audio',
    ];

    protected $appends = ['link_externo', 'link_thumbnail', 'icone'];

    protected $casts = [
        'agendamento' => 'array',
        'tags' => 'array',
        'size'=>'integer',
        'nome'=>'string',
//        'ultimo_sinal' => 'date:d/m/Y H:m',
    ];

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


    public function UpdateStatusPlaylistsForConteudo($id = 0)
    {
        if ($id == 0) {
            $id = $this->attributes['id'];
        }

        Log::info( 'Atualizando status das playlista para conteúdo: '.$id);

        $conteudo = PlaylistConteudo::find($id);

        $playlists = collect(
            PlaylistPlaylistConteudo::whereIn('tag_carrossel', $conteudo->tags)
                ->orWhere('playlist_conteudo_id', $id)
                ->get()
        )->unique('playlist_id');

        $subplaylists = collect(
            PlaylistPlaylistConteudo::whereIn('subplaylist_id', $playlists->pluck('playlist_id'))
                ->get()
        )->unique('playlist_id');

        foreach ($playlists as $playlist) {
            Playlist::find($playlist->playlist_id)->touch();
        }

        foreach ($subplaylists as $subplay) {
            Playlist::find($subplay->playlist_id)->touch();
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_playlist_conteudo');
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


//    public function getlisttagsAttribute() {
//        if ($this->attributes['tags'] != ''){
//            return collect(explode(",", $this->attributes['tags']))->values();
//        }else{
//            return [];
//        }
//
//    }

    public function getlinkexternoAttribute() {
        return Storage::disk('public')->url($this->link);
    }

    public function getlinkthumbnailAttribute() {
        return Storage::disk('public')->url($this->thumbnail);
    }

    public function geticoneAttribute() {
        return identifica_icone($this->filename);
    }
}
