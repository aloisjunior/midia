<?php

namespace ARsig\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'tipo_pessoa',
        'nome',
        'razao_social',
        'cnpj_cpf',
        'inscricao_estadual',
        'inscricao_municipal',
        'email',
        'contato',
        'telefone',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'cep',
        'estado',
        'pais',
        'valor_credito',
        'classificacao',
        'dia_pagto',
        'observacao',
        'receber_mailing',
        'tags',
        'ativo',
        'user_id',
        'tipo_cadastro',
        'depoimento_texto',
        'depoimento_autor',
        'depoimento_cargo',
        'url_perfil',
    ];

    protected $appends = ['list_tags', 'telefone_mask', 'cnpj_cpf_mask'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getlisttagsAttribute() {
        if ($this->attributes['tags'] != ''){
            return collect(explode(",", $this->attributes['tags']))->values();
        }else{
            return [];
        }

    }

    public function gettelefonemaskAttribute() {
        if ($this->attributes['telefone'] != ''){
//            $data = $this->attributes['telefone'];
            return "(".substr($this->attributes['telefone'], 0, 2).") ".substr($this->attributes['telefone'], 2, 4)."-".substr($this->attributes['telefone'],6);
        }

    }

    public function getcnpjcpfmaskAttribute() {
        if ($this->attributes['cnpj_cpf'] != ''){
            if ($this->attributes['tipo_pessoa'] == 'PJ'){
                return mask($this->attributes['cnpj_cpf'], '##.###.###/####-##');
            }else{
                return mask($this->attributes['cnpj_cpf'], '###.###.###-##');
            }
        }

    }


    public function arquivos()
    {
        return $this->hasMany(ClientesArquivos::class);
    }

}
