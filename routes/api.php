<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API de rotas internas, usadas somente com autenticação realizada
| -- > Rotas usadas para chamadas Ajax
|--------------------------------------------------------------------------
|
|
*/

// layout
Route::get('/menu/listar/{user?}', 'Api\LayoutController@MenuListar')->name('api.menu.listar');

Route::get('/facebook/metrics/{metrica?}/{periodo?}', 'Api\RedesSociaisController@facebookMetrics')
    ->name('api.facebook.metrics')->middleware('can:api-facebook-metrics');



// Usuarios
Route::get('/usuario/{id}/roles', 'Backend\UsuarioController@rolesforuser')
    ->name('api.admin.usuario.roles')->middleware('can:usuario-index');

Route::get('/usuario/permissions', 'Backend\UsuarioController@permissionsforuser') // todas permissoes do usuario
    ->name('api.admin.usuario.permissions');//->middleware('can:usuario-index');// retirado pois nem sempre usuário tem essa permissão, porem deve atualizar o backend
Route::get('/usuario/permissions_v1', 'Backend\UsuarioController@permissionsforuser_v1') // todas permissoes do usuario
->name('api.admin.usuario.permissions_v1');//->middleware('can:usuario-index');// retirado pois nem sempre usuário tem essa permissão, porem deve atualizar o backend

Route::get('/usuario/estacoes', 'Backend\UsuarioController@estacoesforuser') // todas permissoes do usuario
->name('api.admin.usuario.estacoes')->middleware('can:usuario-index');



// get TOKEN csrf-token session, ajusta no axios do vue
Route::get('/usuario/token', 'Backend\UsuarioController@tokenforuser')
    ->name('api.admin.usuario.token')->middleware('can:usuario-index');


// Usuarios - perfil (Roles)
Route::get('/perfil/listar', 'Backend\RoleController@listar')  // load para componentes select
    ->name('api.admin.perfil.listar')->middleware('can:perfil-index');

Route::get('/perfil/{id}/permissoes', 'Backend\RoleController@permissoes')  // load para componentes select
->name('api.admin.perfil.permissoes')->middleware('can:perfil-index');

Route::post('/perfil/{id}/permissoes/update', 'Backend\RoleController@permissoes_update')  // load para componentes select
->name('api.admin.perfil.permissoes.update')->middleware('can:perfil-index');

// Estacoes
Route::get('/estacoes/listar', 'Backend\EstacaoController@listar')  // load para componentes select
->name('api.admin.estacoes.listar')->middleware('can:estacao-index');


// playlist
Route::get('/playlist/listar/{playlist_id_hidden?}', 'Backend\PlaylistController@listar')  // load para componentes select
->name('api.admin.playlist.listar')->middleware('can:playlist-index');

// layouts
Route::get('/layout/listar', 'Backend\LayoutsController@listar')  // load para componentes select
->name('api.admin.layout.listar')->middleware('can:playlist-index');


/*
 * routes upload
 * */
Route::post('/upload/dir/{dir?}', 'Api\UploadController@store')
    ->name('admin.upload.store');
Route::post('/upload/destroy', 'Api\UploadController@destroy')
    ->name('admin.upload.destroy');

/*
 *
 * rotinas de conuslta de cnpj e cep
 *
 *
 * */

Route::get('/consulta/cnpj/{cnpj}', 'Api\ConsultasExternasController@cnpj')  // load para componentes select
->name('api.admin.consultas.cnpj');
Route::get('/consulta/cep/{cep}', 'Api\ConsultasExternasController@cep')  // load para componentes select
->name('api.admin.consultas.cep');
