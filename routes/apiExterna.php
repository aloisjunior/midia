<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API de rotas externas, NÃO precisam de autenticação
|--------------------------------------------------------------------------
|
|
*/
// resize imagens
Route::group(['prefix'=>'imagem'], function(){
//    Route::get('/{nome}', ['as' => 'imagem.show', 'uses' => 'imagem\ImagemController@show']);
    Route::get('/{dir}/{nome}/{largura?}/{altura?}', ['as' => 'imagem.resize', 'uses' => 'imagem\ImagemController@resize']);
    Route::get('/thumbnail/{dir}/{nome}/{largura?}/{altura?}', ['as' => 'imagem.thumbnail.resize', 'uses' => 'imagem\ImagemController@resize_thumbnail']);
//    Route::get('/parceiro/{id}/{largura?}/{altura?}', ['as' => 'imagem.parceiros.resize', 'uses' => 'imagem\ImagemController@parceiros_resize']);
});

Route::group(['prefix'=>'mail'], function(){
    Route::get('/show/{id}', ['as' => 'api.mail.show', 'uses' => 'Api\MailController@show']);
    Route::get('/descadastrar/{id}', ['as' => 'api.mail.descadastro', 'uses' => 'Api\MailController@descadastro']);
    Route::get('/click/{id}/{tag}', ['as' => 'api.mail.click', 'uses' => 'Api\MailController@click']);
    Route::get('/click/url/{id}/{tag}/{url}', ['as' => 'api.mail.click', 'uses' => 'Api\MailController@click_url']);

    Route::get('/image/opened/{dir}/{filename}/{largura?}/{altura?}', ['as' => 'api.mail.imagem.show', 'uses' => 'Api\MailController@opened_imagem']);
});


Route::group(['prefix'=>'radio'], function(){
    Route::get('/{id}/pularmusica', ['as'=>'api.radio.pularmusica', 'uses'=>'Api\RadioController@pularmusica']);
//    Route::get('/image/opened/{id}/{dir}/{filename}/{largura?}/{altura?}', ['as' => 'api.mail.imagem.show', 'uses' => 'Api\MailController@opened_imagem']);
});

Route::group(['prefix'=>'arquivos'], function(){
    Route::get('/listar', ['as' => 'api.arquivos.listar', 'uses' => 'Api\ArquivosController@listar']);
    Route::get('/tags', ['as' => 'api.arquivos.tags', 'uses' => 'Api\ArquivosController@tags']);

});


// realiza login para radio offline
Route::group(['prefix'=>'user'], function(){
    Route::get('/{nome}/{key}/{player_version?}', ['as'=>'api.usuario.valida', 'uses'=>'Api\RadioController@validausuario']);
});

// lista estacoes para radio offline
Route::group(['prefix'=>'estacao', 'where'=>['id'=>'[0-9]+', 'nome'=>'[0-9, a-z, -, ., @, _]+']], function(){
    Route::get('/{id}/listar', ['as'=>'api.usuario.estacoes', 'uses'=>'Api\RadioController@listaestacoes']);
    Route::get('/{nome}/listar', ['as'=>'api.usuario.estacoes', 'uses'=>'Api\RadioController@listaestacoes']);

    //comando novo para pular musica em https
    Route::get('/{id}/pularmusica', ['as'=>'api.estacao.pularmusica', 'uses'=>'Api\RadioController@pularmusica']);
});

/**********************************************************
 *  rotas para sistema de signage - players
 *
 * - limit de 20 chamadas para mesma rota por minuto
 *
 * *********************************************************
 * */

// login player
Route::group(['prefix'=>'signage', 'middleware' => 'throttle:2500', 'where'=>['id'=>'[0-9]+', 'nome'=>'[0-9, a-z, -, ., @, _]+']], function(){
    Route::get('/{token}/login/{token_auth?}', ['as'=>'api.signage.player.login', 'uses'=>'Api\SignageController@login']);
    Route::get('/{token}/playlist', ['as'=>'api.signage.player.playlist', 'uses'=>'Api\SignageController@playlist']);
    Route::get('/{token}/playlist_v2', ['as'=>'api.signage.player.playlist', 'uses'=>'Api\SignageController@playlist_v2']);
    Route::get('/{token}/playlist_v3', ['as'=>'api.signage.player.playlist', 'uses'=>'Api\SignageController@playlist_v3']);
    Route::get('/{token}/playlist_x/{version?}', ['as'=>'api.signage.player.playlistx', 'uses'=>'Api\SignageController@playlist_x']);
//    Route::get('/{token}/playlist/tempo', ['as'=>'api.signage.player.playlist.tempo', 'uses'=>'Api\SignageController@playlist_tempo']);
    Route::post('/playlist/tempo/{playlist_id?}', ['as'=>'api.signage.player.playlist.tempo', 'uses'=>'Api\SignageController@playlist_tempo']);
    Route::get('/{token}/layouts', ['as'=>'api.signage.player.layouts', 'uses'=>'Api\SignageController@layouts']);
    Route::get('/{token}/layouts_v2', ['as'=>'api.signage.player.layouts', 'uses'=>'Api\SignageController@layouts_v2']);

    Route::get('/{token}/sinal/{token_push?}', ['as'=>'api.signage.player.sinal', 'uses'=>'Api\SignageController@atualiza_sinal_app']);
    Route::post('/{token}/sinal/{token_push?}', ['as'=>'api.signage.player.sinal2', 'uses'=>'Api\SignageController@atualiza_sinal_app_post']);
    Route::post('/{token}/sinal/v2/{version}/{token_push?}', ['as'=>'api.signage.player.sinal.v2', 'uses'=>'Api\SignageController@atualiza_sinal_app_post_v2']);

    Route::post('/{token}/sendlog', ['as'=>'api.signage.player.sendlog', 'uses'=>'Api\SignageController@sendLog']);
    Route::post('/{token}/sendlog_v2', ['as'=>'api.signage.player.sendlog_v2', 'uses'=>'Api\SignageController@sendLog_v2']);
    Route::post('/{token}/screenshot', ['as'=>'api.signage.player.screenshot', 'uses'=>'Api\SignageController@screenshot']);
    Route::get('/{token}/send/{cmd}', ['as'=>'api.signage.player.push_send_reinicia_app', 'uses'=>'Api\SignageController@push_send']);
    Route::get('/{token}/captura/destroy', ['as'=>'api.signage.player.push_send_reinicia_app', 'uses'=>'Api\SignageController@destroyCaptura']);

    Route::get('/download/conteudo/{conteudo_id}', ['as'=>'api.signage.player.push_send_reinicia_app', 'uses'=>'Api\SignageController@download_conteudo']);
    Route::get('/download/conteudo/{conteudo_id}/{token_id?}', ['as'=>'api.signage.player.push_send_reinicia_app', 'uses'=>'Api\SignageController@download_conteudo']);

    Route::get('/cloudconverter/callback/playlist_conteudo/{id}', ['as'=>'api.signage.cloudconverter.callback', 'uses'=>'Api\SignageController@callback_cloud']);
    Route::get('/cloudconverter/callback/thumbnail/playlist_conteudo/{id}', ['as'=>'api.signage.cloudconverter.callback.thumbnail', 'uses'=>'Api\SignageController@callback_cloud_thumbnail']);
//    Route::get('/cloudconverter/callback/thumbnail/playlist_conteudo', ['as'=>'api.signage.cloudconverter.callback.thumbnail', 'uses'=>'Api\SignageController@callback_cloud_thumbnail']);

});


