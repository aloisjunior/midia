<?php

namespace ARsig\Providers;

//use ARsig\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

//use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{

    protected $permissoes_liberar = [
        'admin',
        'api-facebook-metrics',
        'arquivo-destroy',
        'arquivo-index',
        'arquivo-store',
        'arquivo-update',
        'artigo-destroy',
        'artigo-index',
        'artigo-store',
        'artigo-update',
        'campanha-destroy',
        'campanha-index',
        'campanha-store',
        'campanha-update',
        'cliente-destroy',
        'cliente-index',
        'cliente-store',
        'cliente-update',
        'contato-destroy',
        'contato-index',
        'contato-store',
        'contato-update',
        'estacao-destroy',
        'estacao-index',
        'estacao-store',
        'estacao-update',
        'perfil-destroy',
        'perfil-index',
        'perfil-store',
        'perfil-update',
        'permissao-destroy',
        'permissao-index',
        'permissao-store',
        'permissao-update',
        'player-destroy',
        'player-index',
        'player-store',
        'player-update',
        'playlist_conteudo-destroy',
        'playlist_conteudo-index',
        'playlist_conteudo-store',
        'playlist_conteudo-update',
        'playlist-destroy',
        'playlist-index',
        'playlist-store',
        'playlist-update',
        'report-player-veiculacao',
        'usuario-destroy',
        'usuario-index',
        'usuario-store',
        'usuario-update',
    ];


    /**
     * The policy mappings for the application.
     *
     * @var array
     */
//    protected $policies = [
//        'ARsig\Model' => 'ARsig\Policies\ModelPolicy',
//    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerApiPolicies();
        $this->registerBackendPolicies();


//        Auth::viaRequest('custom-token', function ($request) {
//            return User::where('token', $request->token)->first();
//        });
    }

    protected function defineAutorizacao($ability)
    {
        Gate::define($ability, function ($user) use ($ability) {
            return $user->hasAccess($ability) || str_contains($ability, '-index'); // permite fazer consultas de combobox e afins, e não libera os menus
        });
    }

    public function registerApiPolicies()
    {
//        Gate::define('api-facebook-metrics', function ($user) {
//            return $user->hasAccess('api-facebook-metrics');
//        });
        $this->defineAutorizacao('api-facebook-metrics');
    }

    public function registerBackendPolicies()
    {
        $permissoes = $this->permissoes_liberar;

        foreach ($permissoes as $permissao) {
            $this->defineAutorizacao($permissao);
        };

    }
}
