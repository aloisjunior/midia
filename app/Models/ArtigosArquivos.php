<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ArtigosArquivos extends Model
{
    protected $table = 'artigos_arquivos';

    protected $fillable = array(
        'id',
        'filename',
        'mime',
        'link',
        'size',
        'artigos_id',
    );

    protected $appends = ['link_externo'];

    public function getlinkexternoAttribute() {
        return Storage::disk('public')->url($this->link);
    }
}
