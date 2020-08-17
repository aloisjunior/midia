<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClientesArquivos extends Model
{
    protected $table = 'clientes_arquivos';

    protected $fillable = array(
        'id',
        'filename',
        'mime',
        'link',
        'size',
        'clientes_id',
    );

    protected $appends = ['link_externo'];

    public function getlinkexternoAttribute()
    {
        return Storage::disk('public')->url($this->link);
    }
}
