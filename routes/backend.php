<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::domain('{account}'.env('APP_URL'))->group(function () {
//    Route::get('/{vue?}', function ($account, $vue) { return view('backend.index'); })
//        ->middleware('auth')
//        ->middleware('verified') // não funciona aqui e sim no RouteServiceProvider, senão não pega rota inicial /admin, primeira neste arquivo
//        ->where('vue', '[\/\w\.-]*');
//});


Route::get('/', 'Backend\BackendController@index')->name('admin')->middleware('verified');
Route::get('/teste/{perm}', 'Backend\BackendController@permissionTeste')->name('permissionTeste');

Route::post('/usuario/listar', 'Backend\UsuarioController@listar')
    ->name('admin.usuario.listar')->middleware('can:usuario-index');
Route::get('/usuario/listar', 'Backend\UsuarioController@index')
    ->name('admin.usuario.index')->middleware('can:usuario-index');
Route::post('/usuario', 'Backend\UsuarioController@store')
    ->name('admin.usuario.store')->middleware('can:usuario-store');
Route::post('/usuario/{id}/update', 'Backend\UsuarioController@update')
    ->name('admin.usuario.update')->middleware('can:usuario-update');
Route::get('/usuario/{id}/update', 'Backend\UsuarioController@edit') // load de registro para atualizar
->name('admin.usuario.edit')->middleware('can:usuario-update');

Route::get('/usuario/config', 'Backend\UsuarioController@getConfig') // load de registro para atualizar
->name('admin.usuario.config.get');//->middleware('can:usuario-update');
Route::post('/usuario/config', 'Backend\UsuarioController@postConfig') // load de registro para atualizar
->name('admin.usuario.config.post');//->middleware('can:usuario-update');



Route::get('/usuario/{id}/destroy', 'Backend\UsuarioController@destroy')
    ->name('admin.usuario.destroy')->middleware('can:usuario-destroy');

Route::post('/perfil/listar', 'Backend\RoleController@index')
    ->name('admin.perfil.listar')->middleware('can:perfil-index');
Route::get('/perfil/listar', 'Backend\RoleController@index')
    ->name('admin.perfil.index')->middleware('can:perfil-index');
Route::post('/perfil', 'Backend\RoleController@store')
    ->name('admin.perfil.store')->middleware('can:perfil-store');
Route::post('/perfil/{id}/update', 'Backend\RoleController@update')
    ->name('admin.perfil.update')->middleware('can:perfil-update');
Route::get('/perfil/{id}/update', 'Backend\RoleController@edit') // load de registro para atualizar
->name('admin.perfil.edit')->middleware('can:perfil-update');

Route::get('/perfil/{id}/destroy', 'Backend\RoleController@destroy')
    ->name('admin.perfil.destroy')->middleware('can:perfil-destroy');

Route::post('/permissao/listar', 'Backend\PermissionController@index')
    ->name('admin.permissoes.listar')->middleware('can:permissao-index');
Route::get('/permissao/listar', 'Backend\PermissionController@index')
    ->name('admin.permissao.index')->middleware('can:permissao-index');
Route::post('/permissao', 'Backend\PermissionController@store')
    ->name('admin.permissao.store')->middleware('can:permissao-store');
Route::post('/permissao/{id}/update', 'Backend\PermissionController@update')
    ->name('admin.permissao.update')->middleware('can:permissao-update');
Route::get('/permissao/{id}/update', 'Backend\PermissionController@edit') // load de registro para atualizar
->name('admin.permissao.edit')->middleware('can:permissao-update');

Route::get('/permissao/{id}/destroy', 'Backend\PermissionController@destroy')
    ->name('admin.permissao.destroy')->middleware('can:permissao-destroy');


// arquivos
Route::post('/arquivo/listar', 'Backend\ArquivoController@index') // chamada do view
    ->name('admin.arquivo.listar')->middleware('can:arquivo-index');
Route::get('/arquivo', 'Backend\ArquivoController@index')
    ->name('admin.arquivo.index')->middleware('can:arquivo-index');
Route::post('/arquivo', 'Backend\ArquivoController@store')
    ->name('admin.arquivo.store')->middleware('can:arquivo-store');
Route::post('/arquivo/{id}/update', 'Backend\ArquivoController@update')
    ->name('admin.arquivo.update')->middleware('can:arquivo-update');
Route::get('/arquivo/{id}/update', 'Backend\ArquivoController@edit') // load de registro para atualizar
->name('admin.arquivo.edit')->middleware('can:arquivo-update');
Route::get('/arquivo/{id}/destroy', 'Backend\ArquivoController@destroy')
    ->name('admin.arquivo.destroy')->middleware('can:arquivo-destroy');

Route::get('/arquivo/tags/listar', 'Backend\ArquivoController@tags')
    ->name('admin.arquivo.tags')->middleware('can:arquivo-index');

// contatos
Route::post('/contato/listar', 'Backend\ContatoController@index') // chamada do view
->name('admin.contato.listar')->middleware('can:contato-index');
Route::get('/contato', 'Backend\ContatoController@index')
    ->name('admin.contato.index')->middleware('can:contato-index');
Route::post('/contato', 'Backend\ContatoController@store')
    ->name('admin.contato.store')->middleware('can:contato-store');
Route::post('/contato/{id}/update', 'Backend\ContatoController@update')
    ->name('admin.contato.update')->middleware('can:contato-update');
Route::get('/contato/{id}/update', 'Backend\ContatoController@edit') // load de registro para atualizar
->name('admin.contato.edit')->middleware('can:contato-update');
Route::get('/contato/{id}/destroy', 'Backend\ContatoController@destroy')
    ->name('admin.contato.destroy')->middleware('can:contato-destroy');

Route::get('/contato/tags/listar', 'Backend\ContatoController@tags')
    ->name('admin.contato.tags')->middleware('can:contato-index');

// artigos
Route::post('/artigo/listar', 'Backend\ArtigoController@index') // chamada do view
->name('admin.artigo.listar')->middleware('can:artigo-index');
Route::get('/artigo', 'Backend\ArtigoController@index')
    ->name('admin.artigo.index')->middleware('can:artigo-index');
Route::post('/artigo', 'Backend\ArtigoController@store')
    ->name('admin.artigo.store')->middleware('can:artigo-store');
Route::post('/artigo/{id}/update', 'Backend\ArtigoController@update')
    ->name('admin.artigo.update')->middleware('can:artigo-update');
Route::get('/artigo/{id}/update', 'Backend\ArtigoController@edit') // load de registro para atualizar
->name('admin.artigo.edit')->middleware('can:artigo-update');

Route::get('/artigo/{id}/destroy', 'Backend\ArtigoController@destroy')
    ->name('admin.artigo.destroy')->middleware('can:artigo-destroy');

Route::get('/artigo/tags/listar', 'Backend\ArtigoController@tags')
    ->name('admin.artigo.tags')->middleware('can:artigo-index');
Route::get('/artigo/categorias/listar', 'Backend\ArtigoController@categorias')
    ->name('admin.artigo.categorias')->middleware('can:artigo-index');

// clientes
Route::post('/cliente/listar', 'Backend\ClienteController@index') // chamada do view
->name('admin.cliente.listar')->middleware('can:cliente-index');
Route::get('/cliente', 'Backend\ClienteController@index')
    ->name('admin.cliente.index')->middleware('can:cliente-index');
Route::post('/cliente', 'Backend\ClienteController@store')
    ->name('admin.cliente.store')->middleware('can:cliente-store');
Route::get('/cliente/{id}/update', 'Backend\ClienteController@edit') // load de registro para atualizar
    ->name('admin.cliente.edit')->middleware('can:cliente-update');
Route::post('/cliente/{id}/update', 'Backend\ClienteController@update')
    ->name('admin.cliente.update')->middleware('can:cliente-update');
Route::get('/cliente/{id}/destroy', 'Backend\ClienteController@destroy')
    ->name('admin.cliente.destroy')->middleware('can:cliente-destroy');

Route::get('/cliente/tags/listar', 'Backend\ClienteController@tags')
    ->name('admin.cliente.tags')->middleware('can:cliente-index');
//Route::get('/cliente/categorias/listar', 'Backend\ClienteController@categorias')
//    ->name('admin.cliente.categorias')->middleware('can:cliente-index');


// estacoes
Route::post('/estacao/listar', 'Backend\EstacaoController@index') // chamada do view
->name('admin.estacao.listar')->middleware('can:estacao-index');
Route::get('/estacao', 'Backend\EstacaoController@index')
    ->name('admin.estacao.index')->middleware('can:estacao-index');
Route::post('/estacao', 'Backend\EstacaoController@store')
    ->name('admin.estacao.store')->middleware('can:estacao-store');
Route::get('/estacao/{id}/update', 'Backend\EstacaoController@edit') // load de registro para atualizar
->name('admin.estacao.edit')->middleware('can:estacao-update');
Route::post('/estacao/{id}/update', 'Backend\EstacaoController@update')
    ->name('admin.estacao.update')->middleware('can:estacao-update');
Route::get('/estacao/{id}/destroy', 'Backend\EstacaoController@destroy')
    ->name('admin.estacao.destroy')->middleware('can:estacao-destroy');

Route::get('/estacao/tags/listar', 'Backend\EstacaoController@tags')
    ->name('admin.estacao.tags')->middleware('can:estacao-index');
Route::get('/estacao/ftp_pastas_offline/listar', 'Backend\EstacaoController@ftp_pastas_offline')
    ->name('admin.estacao.ftp_pastas_offline')->middleware('can:estacao-index');


// campanhas
Route::post('/campanha/listar', 'Backend\CampanhaController@index') // chamada do view
->name('admin.campanha.listar')->middleware('can:campanha-index');
Route::get('/campanha', 'Backend\CampanhaController@index')
    ->name('admin.campanha.index')->middleware('can:campanha-index');
Route::post('/campanha', 'Backend\CampanhaController@store')
    ->name('admin.campanha.store')->middleware('can:campanha-store');
Route::get('/campanha/{id}/update', 'Backend\CampanhaController@edit') // load de registro para atualizar
->name('admin.campanha.edit')->middleware('can:campanha-update');
Route::post('/campanha/{id}/update', 'Backend\CampanhaController@update')
    ->name('admin.campanha.update')->middleware('can:campanha-update');
Route::get('/campanha/{id}/destroy', 'Backend\CampanhaController@destroy')
    ->name('admin.campanha.destroy')->middleware('can:campanha-destroy');

Route::get('/campanha/tags/listar', 'Backend\CampanhaController@tags')
    ->name('admin.campanha.tags')->middleware('can:campanha-index');

/*
 * rotas para signage
 * */

// players
Route::post('/player/listar', 'Backend\PlayerController@index') // chamada do view
->name('admin.player.listar')->middleware('can:player-index');
Route::get('/player', 'Backend\PlayerController@index')
    ->name('admin.player.index')->middleware('can:player-index');
Route::post('/player', 'Backend\PlayerController@store')
    ->name('admin.player.store')->middleware('can:player-store');
Route::get('/player/{id}/update', 'Backend\PlayerController@edit') // load de registro para atualizar
->name('admin.player.edit')->middleware('can:player-update');
Route::post('/player/{id}/update', 'Backend\PlayerController@update')
    ->name('admin.player.update')->middleware('can:player-update');
Route::get('/player/{id}/destroy', 'Backend\PlayerController@destroy')
    ->name('admin.player.destroy')->middleware('can:player-destroy');

Route::get('/player/{id}/reutilizar', 'Backend\PlayerController@reutilizar')
    ->name('admin.player.update.reutilizar')->middleware('can:player-update');


Route::get('/player/tags/listar', 'Backend\PlayerController@tags')
    ->name('admin.player.tags')->middleware('can:player-index');
Route::get('/player/grupos/listar', 'Backend\PlayerController@grupos')
    ->name('admin.player.grupos')->middleware('can:player-index');

Route::get('/player/tags_grupos/listar', 'Backend\PlayerController@tags_grupos')
    ->name('admin.player.tags_grupos')->middleware('can:player-index');

Route::post('/player/playlist/update/group', 'Backend\PlayerController@playlist_update_group')
    ->name('admin.player.playlist_update_group')->middleware('can:player-update');

Route::post('/player/{id}/logs/listar', 'Backend\PlayerController@logs')
    ->name('admin.player.logs')->middleware('can:player-index');

// reports
Route::post('/player/report', 'Backend\PlayerReportController@index')
    ->name('admin.player.report.veiculacao')->middleware('can:report-player-veiculacao');


// playlist_conteudo
Route::post('/playlist_conteudo/listar', 'Backend\PlaylistConteudoController@index') // chamada do view
->name('admin.playlist_conteudo.listar')->middleware('can:playlist_conteudo-index');
Route::get('/playlist_conteudo', 'Backend\PlaylistConteudoController@index')
    ->name('admin.playlist_conteudo.index')->middleware('can:playlist_conteudo-index');
Route::post('/playlist_conteudo', 'Backend\PlaylistConteudoController@store')
    ->name('admin.playlist_conteudo.store')->middleware('can:playlist_conteudo-store');
Route::get('/playlist_conteudo/{id}/update', 'Backend\PlaylistConteudoController@edit') // load de registro para atualizar
->name('admin.playlist_conteudo.edit')->middleware('can:playlist_conteudo-update');
Route::post('/playlist_conteudo/{id}/update', 'Backend\PlaylistConteudoController@update')
    ->name('admin.playlist_conteudo.update')->middleware('can:playlist_conteudo-update');
Route::get('/playlist_conteudo/{id}/destroy', 'Backend\PlaylistConteudoController@destroy')
    ->name('admin.playlist_conteudo.destroy')->middleware('can:playlist_conteudo-destroy');

Route::get('/playlist_conteudo/tags/listar', 'Backend\PlaylistConteudoController@tags')
    ->name('admin.playlist_conteudo.tags')->middleware('can:playlist_conteudo-index');

Route::post('/playlist_conteudo/upload/dir/{dir?}', 'Backend\PlaylistConteudoController@upload')
    ->name('admin.playlist_conteudo.upload.store');

Route::post('/playlist_conteudo/uploadthumbnail/dir/{dir?}', 'Backend\PlaylistConteudoController@uploadThumbnail')
    ->name('admin.playlist_conteudo.uploadthumbnail.store');

Route::post('/playlist_conteudo/upload/destroy', 'Backend\PlaylistConteudoController@removerimagens')
    ->name('admin.playlist_conteudo.upload.destroy');



// playlist
Route::post('/playlist/listar', 'Backend\PlaylistController@index') // chamada do view
->name('admin.playlist.listar')->middleware('can:playlist-index');
Route::get('/playlist', 'Backend\PlaylistController@index')
    ->name('admin.playlist.index')->middleware('can:playlist-index');
Route::post('/playlist', 'Backend\PlaylistController@store')
    ->name('admin.playlist.store')->middleware('can:playlist-store');
Route::get('/playlist/{id}/update', 'Backend\PlaylistController@edit') // load de registro para atualizar
->name('admin.playlist.edit')->middleware('can:playlist-update');
Route::post('/playlist/{id}/update', 'Backend\PlaylistController@update')
    ->name('admin.playlist.update')->middleware('can:playlist-update');
Route::get('/playlist/{id}/destroy', 'Backend\PlaylistController@destroy')
    ->name('admin.playlist.destroy')->middleware('can:playlist-destroy');

Route::get('/playlist/tags/listar', 'Backend\PlaylistController@tags')
    ->name('admin.playlist.tags')->middleware('can:playlist-index');





Route::get('/{vue?}', function () { return view('backend.index'); })
    ->middleware('auth')
    ->middleware('verified') // não funciona aqui e sim no RouteServiceProvider, senão não pega rota inicial /admin, primeira neste arquivo
    ->where('vue', '[\/\w\.-]*');