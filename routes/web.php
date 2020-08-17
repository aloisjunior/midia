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


// rotas originais laravel
//Route::get('/', function () {
//    return view('welcome'); // retirado welcome
//});




// declaração de subdominio deve ser feita antes das demais
// Rotas que pertencem a um subdominio deverão ser registradas dentro do grupo
// Rotas para subdominio devem sempre ser declaradas antes das outras
//Route::group(['domain' => '{account}.' . env('APP_DOMAIN')], function () {
//    Route::get('/', function ($account) {
//        return 'Nada aqui' . $account;
//    });
////    Route::get('do-something', function ($account) {
////        //
////    });
//});

Route::group(['domain' => '{account}.'.env('APP_URL')], function () {

    if ($account = 'pages'){
        Route::get('/midiaindoor', function () {
            return view('landing.midiaindoor');
        })->name('landing.midiaindoor');

        Route::get('/obrigado', function () {
            return view('landing.obrigado');
        })->name('landing.obrigado');

    }
    if ($account = 'cliente'){
        Route::get('/cliente', function () {
            return 'Aqui tela de login de cliente';
        });
    }
    // senão login in dominio

    // senão direciona para tela inicial
    Route::get('/{noexist?}', function () {
        return redirect()->to(env('APP_URL'));
    });
});

\Illuminate\Support\Facades\Auth::routes(['verify' => true]);
// recriada rota para logout permitir get
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// **************************
// rotas criadas AtonMidia
// **************************

// FrontEnd
Route::get('/', 'Frontend\FrontendController@index')->name('inicio');
Route::get('/sobre', 'Frontend\FrontendController@sobre')->name('sobre');
Route::get('/contato', 'Frontend\FrontendController@contato')->name('contato');
Route::get('/midiaindoor', 'Frontend\FrontendController@midiaindoor')->name('midiaindoor');//->middleware('auth');// teste de autenticação no frontend
Route::get('/tvcorporativa', 'Frontend\FrontendController@tvcorporativa')->name('tvcorporativa');//->middleware('auth');// teste de autenticação no frontend
Route::get('/vitrinedigital', 'Frontend\FrontendController@vitrinedigital')->name('vitrinedigital');//->middleware('auth');// teste de autenticação no frontend
Route::get('/radioindoor', 'Frontend\FrontendController@radioindoor')->name('radioindoor');//->middleware('auth');// teste de autenticação no frontend
Route::get('/criacaovideos', 'Frontend\FrontendController@criacaovideos')->name('criacaovideos');//->middleware('auth');// teste de autenticação no frontend
Route::get('/desenvolvimento', 'Frontend\FrontendController@desenvolvimento')->name('desenvolvimento');//->middleware('auth');// teste de autenticação no frontend
Route::get('/downloads', 'Frontend\FrontendController@downloads')->name('downloads');//->middleware('auth');// teste de autenticação no frontend
Route::post('/downloads', 'Frontend\FrontendController@downloads_store')->name('downloads.store');//->middleware('auth');// teste de autenticação no frontend
Route::get('/pontosdeveiculacao', 'Frontend\FrontendController@pontos')->name('pontos');//->middleware('auth');// teste de autenticação no frontend

// status serviços site
Route::get('/status', function () {
    return 'ok';
})->name('status');


Route::get('/artigos', 'Frontend\ArtigoController@index')->name('artigos');
Route::get('/blog', 'Frontend\ArtigoController@index')->name('blog');// manter compatibilidade com site antigo
Route::get('/artigo/{nome}', 'Frontend\ArtigoController@show')->name('artigos.detalhe'); // manter compatibilidade com site antigo
Route::get('/artigos/{nome}', 'Frontend\ArtigoController@show')->name('artigos.detalhe');
Route::get('/artigos/listar/ultimos', 'Frontend\ArtigoController@listar')->name('artigos.listar');

//rota de informações de clientes
Route::get('/clientes/info', 'Frontend\ClienteController@info')->name('clientes.info');

Route::group(['prefix'=>'categoria'], function(){
    Route::get('/{nome}', 'Frontend\ArtigoController@showcategoria')->name('categoria.detalhe');
});
Route::group(['prefix'=>'tag'], function(){
    Route::get('/{nome}', ['as'=>'tag.detalhe', 'uses'=>'Frontend\ArtigoController@showtag']);
});




Route::get('/contato', 'Frontend\FrontendController@contato')->name('contato');
Route::post('/contato', 'Frontend\FrontendController@contato_store')->name('contato.store');


//Route::redirect('/atonsig/public', '/', 301);

//Route::get('/landing', function () {
//   return view('landing.midiaindoor', ['account'=>'pages']);
//});

Route::get('/db2', function () {
    /*
     * Exemplo funconando de como conectar em outro banco para pegar informações
     * para signage
     * */



    $nameKey = 'AtonOriginal';

    $fonte_dados = \ARsig\models\FonteDados::find(1);

    $config_fonte = collect(json_decode($fonte_dados->dados_conexao))->toArray();

//    dd($config_fonte);

//    \Illuminate\Support\Facades\Config::set('database.connections.' . $nameKey, array(
//        'driver'    => 'mysql',
//        'host'      => 'rothermel.com.br',
//        'database'  => 'atonmidi_web',
//        'username'  => 'atonmidi_site',
//        'password'  => '4t0ns1t3',
//        'charset'   => 'utf8',
//        'collation' => 'utf8_general_ci',
//        'prefix'    => '',
//    ));
    \Illuminate\Support\Facades\Config::set('database.connections.' . $nameKey, $config_fonte);
# And set the new connection to my models

    \Illuminate\Support\Facades\DB::purge('AtonOriginal');

    $database = \Illuminate\Support\Facades\DB::connection('AtonOriginal');

//    \Illuminate\Support\Facades\Artisan::call('migrate', ['--database' => $nameKey]);

    $dados = $database->table('users')->get();

    dd($dados);




});

Route::get('/teste2', function () {
//   return urlencode('?{"texto":"Barra v1","link":"https:\/\/atonmidia.local\/storage\/templates\/1\/1.zip"}');

    $responseCloud = \RobbieP\CloudConvertLaravel\Facades\CloudConvert::file(url('storage/playlistconteudo/beaa773fbf16eb5ad17cf34d69ca477d387cf58f.mp4'))
        ->withOptions([
        "thumbnail_format" => "png",
        "thumbnail_size" => "300x168"])
//        ->wait(false)
        ->callback(url('api/e/signage/cloudconverter/callback/thumbnail/playlist_conteudo/182'))
//
//        ->setOutput( url('storage/thumbnail/_apagar.png'))
        ->info()
        ->response();


    dd($responseCloud);
//
//    $responseCloud = \RobbieP\CloudConvertLaravel\Facades\CloudConvert::file('https://rothermel.com.br/storage/playlistconteudo/beaa773fbf16eb5ad17cf34d69ca477d387cf58f.mp4')
//        ->callback('https://rothermel.com.br/api/e/signage/cloudconverter/callback/thumbnail/playlist_conteudo/182')
//        ->withOptions([
////            'thumbnail_format' => 'png',
////            'thumbnail_size' => '300x168',
//
//            'video_resolution' => '1920x1080',
//            'video_codec' => 'H264',
//            'video_crf' => 18,
//            'video_qscale' => -1,
////                    'video_bitrate' => 1024,
////                    'video_bitrate_max' => null,
//
//            'faststart' => true,
//
//            'audio_codec' => 'AAC',
//            'audio_qscale' => -1,
//            'audio_bitrate' => 128,
////                    'audio_channels' => null,
//            'audio_frequency' => 44100,
////                    'audio_normalize' => null,
//
//        ])
//        ->convert('mp4')
////        ->download()
//        ->response()
//    ;

    dd($responseCloud);


    return collect($responseCloud)->toArray();
});

Route::get('/teste3/{userid}', function ($userId) {
//   return urlencode('?{"texto":"Barra v1","link":"https:\/\/atonmidia.local\/storage\/templates\/1\/1.zip"}');

//    $conteudo = \ARsig\Models\PlaylistConteudo::find(183);
//    $user = \ARsig\Models\User::find($userId);
//    event(new \ARsig\Events\VideoConverterFinish($conteudo, $user));


//    $users = \ARsig\Models\Permission::find(14);
//    $roles = $users->roles()->get();
//    $usersR = Array();
//    foreach ($roles as $role) {
//        dd($roles);
//        $tmpUsers = $role->users()->get();
//
//        foreach ($tmpUsers as $user){
//            $usersR[] = $user;
//        }
//    }
//    $usersR = collect($usersR)->unique('id')->values();
//    foreach ($usersR as $userSend) {
//        echo $userSend->email.' ';
//        event(new \ARsig\Events\UserPermissionsChange($userSend));
//    }



    $roles = \ARsig\Models\Role::with('users')->find(3);
    $usersR = Array();
    $tmpUsers = $roles->users()->get();
    foreach ($tmpUsers as $user){
        $usersR[] = $user;
    }
    $usersR = collect($usersR)->unique('id')->values();
    foreach ($usersR as $userSend) {
        echo $userSend->email.' ';
        event(new \ARsig\Events\UserPermissionsChange($userSend));
    }


//    dispatch($env);

//    $user->notify(new \ARsig\Notifications\VideoConverter_finish($conteudo));

    return 'Ok';

    $processes = \RobbieP\CloudConvertLaravel\Facades\CloudConvert::processes();

    echo $processes;

    $atual = \RobbieP\CloudConvertLaravel\Facades\CloudConvert::getProcess('5geiMBaSkIQVy06RZufp');

    dd($processes,$atual);

    $responseCloud = \RobbieP\CloudConvertLaravel\Facades\CloudConvert::file('https://rothermel.com.br/storage/playlistconteudo/ca2822fa5c613c14e3e8718d6d876ca646b873fd.mp4')->withOptions([
        'thumbnail_format' => 'png',
        'thumbnail_size' => '300x168',
    ])
        ->info()
        ->save('storage/thumbnail/playlistconteudo/' . 'thumb.png')
       ->response()
       ;
////    dd($responseCloud);


    dd($responseCloud);


    return collect($responseCloud)->toArray();
});

Route::get('/readrss', function () {

    /*
     * rotina de leitura de feeds rss  funcionando
     *
     * */

//    $feed = \willvincent\Feeds\Facades\FeedsFacade::make('https://www.terra.com.br/rss/Controller?channelid=20e07ef2795b2310VgnVCM3000009af154d0RCRD&ctName=atomo-noticia');
    $feed = \willvincent\Feeds\Facades\FeedsFacade::make('http://www.infomoney.com.br/minhas-financas/economize-dinheiro/rss');
//    $feed = \willvincent\Feeds\Facades\FeedsFacade::make('https://www.horoscopovirtual.com.br/horoscopo/uol.xml');

//    dd($feed);

    $data = array(
        'title'       => $feed->get_title(),
        'description' => $feed->get_description(),
        'permalink'   => $feed->get_permalink(),
        'items'       => $feed->get_items(),

    );

    $limitador = 1;

    foreach ($data['items'] as $key=>$item) {

        if ($limitador > 10){
            break;
        }

//        dd($item);

        $linkartigo = $item->get_link();

        if (isset($linkartigo)) {
            $page_content = file_get_contents($item->get_link());

            $dom_obj = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom_obj->loadHTML($page_content);
            libxml_clear_errors();
            $meta_val = null;

            foreach ($dom_obj->getElementsByTagName('meta') as $meta) {

                if ($meta->getAttribute('property') == 'og:image') {
                    $limitador++;
                    $meta_val = $meta->getAttribute('content');
                    echo('Titulo: ' . $item->get_title() . '<br>');
                    echo('Descrição: ' . $item->get_description() . '<br>');
                    echo('Data: ' . $item->get_date() . '<br>');
                    //                echo('Titulo: '.$item->get_link().'<br>');
                    echo('Image: ' . $meta_val . '<br>');
                    echo('<br>');
                }
            }
        } else{
            echo('Titulo: ' . $item->get_title() . '<br>');
            echo('Descrição: ' . $item->get_description() . '<br>');
            echo('Data: ' . $item->get_date() . '<br>');
            //                echo('Titulo: '.$item->get_link().'<br>');
        }



        };



//    echo 'Versão Atual do PHP: ' . phpversion();

//    $content = [
//        'body'=> 'Contato realizado via site, enviamos as informações para acompanhamento deste contato.',
//        'id'=> '2',
//        'title'=> 'Dados do contato cadastrado',
//        'nome'=>'teste de nome',
//        'assunto'=>'assunto da vez',
//        'mensagem'=>'vamos ver se funcoina',
//        'email'=>'alois@rothermel.com.br',
//        'button' => 'Sobre nós'
//    ];
//
//
//    \Illuminate\Support\Facades\Mail::to('alois@naoexiste.com.br')
//        ->send(new \ARsig\Mail\NovoContatoSite_BoasVindas($content));
});

Route::get('/static_cache', 'Api\LayoutController@static_cache')->name('static_cache');

Route::get('/teste', function () {
//The username or email address of the account.
    define('PORTA', '8826');

//The password of the account.
    define('SENHA', '4t0n');
    define('SUBMIT', 'Acessar');

//Set a user agent. This basically tells the server that we are using Chrome ;)
    define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

//Where our cookie information will be stored (needed for authentication).
    define('COOKIE_FILE', 'cookie.txt');

//URL of the login form.
    define('LOGIN_FORM_URL', 'http://webradio.rothermel.com.br/login');

//Login action URL. Sometimes, this is the same URL as the login form.
    define('LOGIN_ACTION_URL', 'http://webradio.rothermel.com.br/login-autentica');


//An associative array that represents the required form fields.
//You will need to change the keys / index names to match the name of the form
//fields.
    $postValues = array(
        'porta' => PORTA,
        'senha' => SENHA,
        'submit' => SUBMIT
    );

//Initiate cURL.
    $curl = curl_init();

//Set the URL that we want to send our POST request to. In this
//case, it's the action URL of the login form.
    curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);

//Tell cURL that we want to carry out a POST request.
    curl_setopt($curl, CURLOPT_POST, true);

//Set our post fields / date (from the array above).
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));

//We don't want any HTTPS errors.
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Where our cookie details are saved. This is typically required
//for authentication, as the session ID is usually saved in the cookie file.
    curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Sets the user agent. Some websites will attempt to block bot user agents.
//Hence the reason I gave it a Chrome user agent.
    curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

//Tells cURL to return the output once the request has been executed.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Allows us to set the referer header. In this particular case, we are
//fooling the server into thinking that we were referred by the login form.
    curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);

//Do we want to follow any redirects?
//    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

//Execute the login request.
    curl_exec($curl);

//Check for errors!
    if(curl_errno($curl)){
        throw new Exception(curl_error($curl));
    }

//We should be logged in by now. Let's attempt to access a password protected page
    curl_setopt($curl, CURLOPT_URL, 'http://webradio.rothermel.com.br/streaming');

//Use the same cookie file.
    curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Use the same user agent, just in case it is used by the server for session validation.
    curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

//We don't want any HTTPS / SSL errors.
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);


//Execute the GET request and print out the result.
    return curl_exec($curl);
//    return '<iframe style="border: 0;" src="http://143.208.11.102/streaming" width="100%" height="100%" frameborder="0" ></iframe>';



//    $user = \Illuminate\Support\Facades\Auth::user();
//
//    $user->notify(new \ARsig\Notifications\AcessoTeste());
////    $content = [
//        'title'=> 'Teste de email',
//        'body'=> 'Aqui fica a mensagem de boas vindas.',
//        'button' => 'Saiba mais'
//    ];
//
//    $receiverAddress = 'alois@rothermel.com.br';
//
//
//    \Illuminate\Support\Facades\Mail::to($receiverAddress)->send(new \ARsig\Mail\NovoContato($content));
//
//    dd('mail send successfully');



//    if (!session_id()) {
//        session_start();
//    }
//    // Send an array of permissions to request
//    $login_url = $fb->getLoginUrl(['email']);
//
//    // Obviously you'd do this in blade :)
//    echo '<a href="' . $login_url . '">Login with Facebook</a>';
});

Route::get('/facebook/callback', function (SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (!$token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (!$helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (!$token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string)$token);

    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,name,email');
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();

//    $dadospage = $fb->get('/ARsig/insights?metric=page_engaged_users');
//    $detalhes = $dadospage->getGraphPage();
//    $dadospage = $fb->get('/AtonMidia?fields=fan_count');
    $dadospage = $fb->get('/ARsig/insights/page_impressions');
    $detalhes = $dadospage->getGraphEdge();

//    dd($dadospage);

    // Create the user if it does not exist or update the existing entry.
    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
//    $user = atonsig\Models\User::createOrUpdateGraphNode($facebook_user);

    // Log the user into Laravel
//    Auth::login($user);

    return redirect('/')->with('message', 'Successfully logged in with Facebook');
});
// rotas para admin / BackEnd

//Route::get('/teste2', function (SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
////    $fb = new Facebook\Facebook([
////        'app_id' => env('FACEBOOK_APP_ID'),
////        'app_secret' => env('FACEBOOK_APP_SECRET'),
////        'default_graph_version' => 'v2.5',
////    ]);
////
////    $helper = $fb->getCanvasHelper();
////
////    try {
////        $accessToken = $helper->getAccessToken();
////    } catch(Facebook\Exceptions\FacebookResponseException $e) {
////        // When Graph returns an error
////        echo 'Graph returned an error: ' . $e->getMessage();
////        exit;
////    } catch(Facebook\Exceptions\FacebookSDKException $e) {
////        // When validation fails or other local issues
////        echo 'Facebook SDK returned an error: ' . $e->getMessage();
////        exit;
////    }
////
////    if (! isset($accessToken)) {
////        echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
////        exit;
////    }
////
////    $requestPageImpression = $fb->request('GET', '/ARsig/insights/page_impressions/day?size='.\Carbon\Carbon::now()->timestamp.'&until='.\Carbon\Carbon::now()->subDay(7)->timestamp);
////
////    $batch = [
////        'page-impression' => $requestPageImpression,
//////        'page-impression-organic' => $requestPageImpressionOrganic,
////        // add more for your list
////    ];
////
////    $responses = $fb->sendBatchRequest($batch);
//
//
//
//    $fb->setDefaultAccessToken('EAAB2vZBKyw3EBAFxZCatINgkyUrPbCNhS7BRBQEJvR2ughlhciYjLlKqF9ZBZAp7Y8ZCBfCRRSfbZB0gK4qZBqeClj1JIiLcK8B3rSybBClqKf94utCfpyxHNFAWLl3R22gSUZBZAMyzDH0jH8QOOSwhr0Sk4ViaEeXVoZBmI36U3SdwZDZD');
//    $dadospage = $fb->get('/ARsig/insights/page_impressions/day?size='.\Carbon\Carbon::now()->timestamp.'&until='.\Carbon\Carbon::now()->subDay(7)->timestamp);
//
//
//    $responses = $dadospage->getGraphEdge();
//
//    $dadosfinal = [];
//
//
//    $dataArray = array();
//
//    foreach ($responses as $page) {
//        $arrtmp = $page->asArray()['values'];
//        $dadosfinal[] = $arrtmp[0];
//    }
//
//
//
////    dd($dadosfinal);
//
//    while (true) {
//        $nextPage = $fb->next($responses);
//        $responses = $nextPage;
//
//        echo dump($nextPage);
//        if (empty($nextPage)) {
//            break;
//        }
//
//        foreach ($responses as $page) {
//            $arrtmp = $page->asArray()['values'];
//            $dadosfinal[] = $arrtmp[0];
//        }
//    }
//
//    $dias = [];
//    $valores = [];
//    foreach ($dadosfinal as $linha){
//        $dias[] = $linha['end_time']->format('d/m');
//        $valores[] = $linha['value'];
//    }
//
//    return $dias;
//
//
//
//
//
//
//
//
//// Example : Get page impression
//    $requestPageImpression = $fb->request('GET', '/ARsig/insights/page_impressions?size='.\Carbon\Carbon::now()->timestamp.'&until='.\Carbon\Carbon::now()->subDay(7)->timestamp);
////    dd($requestPageImpression);
//
//// Example : Get Organic page impressions
////    $requestPageImpressionOrganic = $fb->request('GET', '/ARsig/insights/page_impressions_organic/day');
//
//// Add more variable and API req, according to your list
//// $requestPageStories = $fb->request('GET','....');
//// etc...
//
//    $batch = [
//        'page-impression' => $requestPageImpression,
////        'page-impression-organic' => $requestPageImpressionOrganic,
//        // add more for your list
//    ];
//
//    echo '<h1>Make a batch request</h1>' . "\n\n";
//    echo 'data:'.\Carbon\Carbon::now()->timestamp;
//
//    try {
//        $responses = $fb->sendBatchRequest($batch);
//    } catch (Facebook\Exceptions\FacebookResponseException $e) {
//        // When Graph returns an error
//        echo 'Graph returned an error: ' . $e->getMessage();
//        exit;
//    } catch (Facebook\Exceptions\FacebookSDKException $e) {
//        // When validation fails or other local issues
//        echo 'Facebook SDK returned an error: ' . $e->getMessage();
//        exit;
//    }
//
//    foreach ($responses as $key => $response) {
//        if ($response->isError()) {
//            $e = $response->getThrownException();
//            echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
//            echo '<p>Graph Said: ' . "\n\n";
//            var_dump($e->getResponse());
//        } else {
//            echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
//            echo "Response: " . $response->getBody() . "</p>\n\n";
//            echo "<hr />\n\n";
//
//            dd($response);
//        }
//    }
//
//
//});


//Route::group(['prefix' => 'admin'], function () {
//    Route::get('/', 'Backend\BackendController@index')
//        ->name('admin');
//
//    Route::get('/usuario', 'Backend\UsuarioController@index')
//        ->name('admin.usuario.index')
//        ->middleware('can:b-usuario-index');
//    ;
//});

// rota quebra galho para home
//Route::get('/api/teste', function () {
//    return 'ok';
//})->name('api.teste');

