<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class PlaylistPlaylistConteudo extends Model
{
    protected $table = 'playlist_playlist_conteudo';

    protected $fillable = [
        'id',
        'playlist_id',
        'subplaylist_id',
        'layout_id',
        'playlist_conteudo_id',
        'tag_carrossel',
        'tipo',
        'tempo',
    ];


    public function conteudos()
    {

            return $this->hasOne(PlaylistConteudo::class, 'id', 'playlist_conteudo_id');
    }

    public function layout()
    {
        return $this->hasOne(Layouts::class, 'id', 'layout_id');
    }

    public function subplaylist()
    {
        return $this->hasOne(Playlist::class, 'id', 'subplaylist_id');
    }

    public function playlist()
    {
        return $this->hasOne(Playlist::class);

    }
}