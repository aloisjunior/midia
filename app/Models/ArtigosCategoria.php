<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class ArtigosCategoria extends Model
{
    protected $table = 'artigos_categoria';

    protected $fillable = array(
        'artigos_id',
        'artigos_categoria_id',
    );

    public function artigos()
    {
        return $this->belongsToMany(Artigo::class, 'pivot_artigos_categoria');
    }
}
