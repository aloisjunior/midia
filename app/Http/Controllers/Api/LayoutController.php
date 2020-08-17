<?php

namespace ARsig\Http\Controllers\Api;

use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LayoutController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function MenuListar($user = null)
    {

//        sendo enviado em componentes os nomes das rotas para indicação no sidebar


        $rotas = array();

        $rotas[] = ['nome'=>'Dashboard', 'icone'=>'widgets', 'componente'=>'admin', 'slug'=>str_slug('Dashboard') ,'rota'=>'/admin', 'ativo'=>false];
        $rotas[] = ['nome'=>'Acessos', 'icone'=>'lock', 'componente'=>'', 'slug'=>str_slug('Acessos') ,'rota'=>'', 'ativo'=>false, 'permission'=> 'usuario-index|perfil-index|permissao-index', 'filhos'=>
        [
            ['nome'=>'Usuários', 'icone'=>'person', 'componente'=>'usuarios, usuarios-add, usuarios-edit', 'slug'=>str_slug('Usuários') ,'rota'=>'/admin/usuarios', 'ativo'=>false, 'permission'=> 'usuario-index'],
            ['nome'=>'Perfil de Acesso', 'icone'=>'assignment_turned_in', 'componente'=>'perfis, perfis-add, perfis-edit', 'slug'=>str_slug('Perfil') ,'rota'=>'/admin/perfis', 'ativo'=>false, 'permission'=> 'perfil-index'],
            ['nome'=>'Permissões de Perfil', 'icone'=>'lock_open', 'componente'=>'permissoes, permissoes-add, permissoes-edit', 'slug'=>str_slug('Permissoes') ,'rota'=>'/admin/permissoes', 'ativo'=>false, 'permission'=> 'permissao-index'],
        ]];
        $rotas[] = ['nome'=>'Cadastros', 'icone'=>'folder', 'componente'=>'', 'slug'=>str_slug('Cadastros') ,'rota'=>'', 'ativo'=>false, 'permission'=> 'arquivo-index|artigo-index|cliente-index|estacao-index', 'filhos'=>
            [
                ['nome'=>'Arquivos', 'icone'=>'attach_files', 'componente'=>'arquivos, arquivos-add, arquivos-edit', 'slug'=>str_slug('Arquivos') ,'rota'=>'/admin/arquivos', 'ativo'=>false, 'permission'=> 'arquivo-index'],
                ['nome'=>'Artigos', 'icone'=>'font_download', 'componente'=>'artigos, artigos-add, artigos-edit', 'slug'=>str_slug('Artigos') ,'rota'=>'/admin/artigos', 'ativo'=>false, 'permission'=> 'artigo-index'],
                ['nome'=>'Clientes', 'icone'=>'group', 'componente'=>'clientes, clientes-add, clientes-edit', 'slug'=>str_slug('Clientes') ,'rota'=>'/admin/clientes', 'ativo'=>false, 'permission'=> 'cliente-index'],
                ['nome'=>'Estações', 'icone'=>'music_note', 'componente'=>'estacoes, estacoes-add, estacoes-edit', 'slug'=>str_slug('Estações') ,'rota'=>'/admin/estacoes', 'ativo'=>false, 'permission'=> 'estacao-index'],
            ]];
        $rotas[] = ['nome'=>'CRM', 'icone'=>'pie_chart', 'componente'=>'', 'slug'=>str_slug('Cadastros') ,'rota'=>'', 'ativo'=>false, 'permission'=> 'contato-index', 'filhos'=>
            [
                ['nome'=>'Contatos', 'icone'=>'group', 'componente'=>'contatos, contatos-add, contatos-edit', 'slug'=>str_slug('Contatos') ,'rota'=>'/admin/contatos', 'ativo'=>false, 'permission'=> 'contato-index'],
            ]];

        $rotas[] = ['nome'=>'Signage', 'icone'=>'airplay', 'componente'=>'', 'slug'=>str_slug('Signage') ,'rota'=>'', 'ativo'=>false, 'permission'=> 'conteudo-index|playlist-index|player-index', 'filhos'=>
            [
                ['nome'=>'Criar conteúdo', 'icone'=>'', 'componente'=>'midia-editor', 'slug'=>str_slug('Editor conteúdo') ,'rota'=>'/admin/midia/editor', 'ativo'=>false, 'permission'=> 'player-index'],
                ['nome'=>'Conteúdo', 'icone'=>'camera_roll', 'componente'=>'playlist_conteudo, playlist_conteudo-add, playlist_conteudo-edit', 'slug'=>str_slug('Conteúdo') ,'rota'=>'/admin/playlist/conteudo', 'ativo'=>false, 'permission'=> 'playlist_conteudo-index'],
                ['nome'=>'Playlists', 'icone'=>'collections', 'componente'=>'playlists, playlists-add, playlists-edit', 'slug'=>str_slug('Playlists') ,'rota'=>'/admin/playlists', 'ativo'=>false, 'permission'=> 'playlist-index'],
                ['nome'=>'Players', 'icone'=>'devices', 'componente'=>'players, players-add, players-edit', 'slug'=>str_slug('Players') ,'rota'=>'/admin/players', 'ativo'=>false, 'permission'=> 'player-index'],
                ['nome'=>'Templates', 'icone'=>'devices', 'componente'=>'templates, templates-add, templates-edit', 'slug'=>str_slug('Templates') ,'rota'=>'/admin/templates', 'ativo'=>false, 'permission'=> 'template-index'],
                ['nome'=>'Relatório Exibição', 'icone'=>'receipt', 'componente'=>'players-report', 'slug'=>str_slug('Relatório Exibição') ,'rota'=>'/admin/players/report', 'ativo'=>false, 'permission'=> 'report-player-veiculacao'],
            ]];

        $rotas[] = ['nome'=>'Mail Marketing', 'icone'=>'web', 'componente'=>'', 'slug'=>str_slug('Campanhas') ,'rota'=>'', 'ativo'=>false, 'permission'=> 'campanha-index|disparo-index', 'filhos'=>
            [
                ['nome'=>'Campanhas', 'icone'=>'contact_mail', 'componente'=>'campanhas, campanhas-add, campanhas-edit', 'slug'=>str_slug('Campanha') ,'rota'=>'/admin/campanhas', 'ativo'=>false, 'permission'=> 'campanha-index'],
                ['nome'=>'Controle de envios', 'icone'=>'', 'componente'=>'campanha-envio', 'slug'=>str_slug('Envios') ,'rota'=>'/admin/envios', 'ativo'=>false, 'permission'=> 'disparo-index'],
            ]];


        // ajustar permissoes dos itens abaixo
        $rotas[] = ['nome'=>'Tarefas', 'icone'=>'list', 'componente'=>'', 'slug'=>str_slug('Tarefas') ,'rota'=>'', 'ativo'=>false, 'permission'=> 'contato-index', 'filhos'=>
            [
                ['nome'=>'Tarefas', 'icone'=>'', 'componente'=>'aton-tarefas', 'slug'=>str_slug('Tarefas') ,'rota'=>'', 'ativo'=>false],
                ['nome'=>'Agenda', 'icone'=>'', 'componente'=>'aton-agenda', 'slug'=>str_slug('Agenda') ,'rota'=>'', 'ativo'=>false],
            ]];

        return response()->json(collect($rotas)->toArray(), 200, [], JSON_UNESCAPED_UNICODE);
//        return response()->json(collect($rotas)->toArray(), 200, [], JSON_UNESCAPED_UNICODE);
//        return response()->json(['Início'=>route('inicio')], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function static_cache(Request $request){
//        $arquivo = 'thumbnail/clientes/22c040cd98b903faa527253d0bb863fef37ee2c9.PNG';
//        $arquivo = 'thumbnail/clientes/22c040cd98b903faa527253d0bb863fef37ee2c9.PNG';

        $arquivo = Input::get('caminho');

//dd($arquivo);
//        $file = \Illuminate\Support\Facades\Storage::Disk('public')->get($arquivo);

        $tamanho = strlen($arquivo);

        $arquivo = substr($arquivo,1,$tamanho);

        $headers = array(
//            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=86400',
            'Content-Length' => filesize($arquivo),
            'Expires' => date('D, d M Y H:i:s ', time() + 86400).'GMT',
        );


        return \Illuminate\Support\Facades\Response::download($arquivo, null, $headers)->setContentDisposition('inline');

    }

}
