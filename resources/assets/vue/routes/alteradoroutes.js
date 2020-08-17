import AtonAdminDashboard from '../modules/backend/aton-admin-dashboard.vue';
import AtonAdminError from '../modules/backend/aton-admin-error.vue';

import AtonAdminConfig from '../modules/backend/profile/aton-admin-config.vue';

import AtonAdminClientesView from '../modules/backend/clientes/aton-admin-clientes-view.vue';
import AtonAdminClientesAddEdit from '../modules/backend/clientes/aton-admin-clientes-add-edit.vue';

import AtonAdminUsuariosView from '../modules/backend/usuarios/aton-admin-usuarios-view.vue';
import AtonAdminUsuariosAddEdit from '../modules/backend/usuarios/aton-admin-usuarios-add-edit.vue';

import AtonAdminPerfilView from '../modules/backend/usuarios-perfis/aton-admin-perfil-view.vue';
import AtonAdminPerfilAddEdit from '../modules/backend/usuarios-perfis/aton-admin-perfil-add-edit.vue';
import AtonAdminPerfilPermissoes from '../modules/backend/usuarios-perfis/aton-admin-perfil-permissoes.vue';

import AtonAdminPermissoesView from '../modules/backend/usuarios-permissoes/aton-admin-permissoes-view.vue';
import AtonAdminPermissoesAddEdit from '../modules/backend/usuarios-permissoes/aton-admin-permissoes-add-edit.vue';

import AtonAdminArquivosView from '../modules/backend/arquivos/aton-admin-arquivos-view.vue';
import AtonAdminArquivosAddEdit from '../modules/backend/arquivos/aton-admin-arquivos-add-edit.vue';

import AtonAdminContatosView from '../modules/backend/contatos/aton-admin-contatos-view.vue';
import AtonAdminContatosAddEdit from '../modules/backend/contatos/aton-admin-contatos-add-edit.vue';

import AtonAdminArtigosView from '../modules/backend/artigos/aton-admin-artigos-view.vue';
import AtonAdminArtigosAddEdit from '../modules/backend/artigos/aton-admin-artigos-add-edit.vue';

import AtonAdminEstacoesView from '../modules/backend/estacoes/aton-admin-estacoes-view.vue';
import AtonAdminEstacoesAddEdit from '../modules/backend/estacoes/aton-admin-estacoes-add-edit.vue';

import AtonAdminCampanhasView from '../modules/backend/campanhas/aton-admin-campanhas-view.vue';
import AtonAdminCampanhasAddEdit from '../modules/backend/campanhas/aton-admin-campanhas-add-edit.vue';

import AtonAdminPlayersReport from '../modules/backend/players/aton-admin-players-report.vue';
import AtonAdminPlayersMonitor from '../modules/backend/players/aton-admin-players-monitor.vue';
import AtonAdminPlayersView from '../modules/backend/players/aton-admin-players-view.vue';
import AtonAdminPlayersAddEdit from '../modules/backend/players/aton-admin-players-add-edit.vue';

import AtonAdminPlaylistConteudoView from '../modules/backend/playlist_conteudo/aton-admin-playlist_conteudo-view.vue';
import AtonAdminPlaylistConteudoAddEdit from '../modules/backend/playlist_conteudo/aton-admin-playlist_conteudo-add-edit.vue';

import AtonAdminPlaylistView from '../modules/backend/playlists/aton-admin-playlist-view.vue';
import AtonAdminPlaylistAddEdit from '../modules/backend/playlists/aton-admin-playlist-add-edit.vue';


import AtonAdminMidiaEditor from '../modules/backend/midia-editor/aton-admin-midia-editor-view.vue';


import AtonAdminRadioPlayerView from '../modules/backend/radio/aton-admin-radioplayer-view.vue';


export default [
    // {
    //     path: '/',
    //     component: AtonAdminSemKeepalive,
    //     children: [
    {
        name: 'admin',
        path: '/admin',
        component: AtonAdminDashboard,
        meta: {
            permission: 'public',
            acesso: 'public',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'config',
        path: '/admin/config',
        component: AtonAdminConfig,
        meta: {
            permission: 'public',
            acesso: 'admin',
            fail: '/admin/error',
            keepAlive: false
        },
        // props: {mode: 'edit'},
    },
    {
        name: 'error',
        path: '/admin/error',
        component: AtonAdminError,
        meta: {
            permission: 'public',
            acesso: 'public',
        },
    },

    {
        name: 'clientes',
        path: '/admin/clientes',
        component: AtonAdminClientesView,
        meta: {
            permission: 'public',
            acesso: 'cliente-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'clientes-add',
        path: '/admin/clientes/add',
        component: AtonAdminClientesAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'cliente-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'clientes-edit',
        path: '/admin/clientes/:id/edit',
        component: AtonAdminClientesAddEdit,
        meta: {
            permission: 'public',
            acesso: 'cliente-update',
            fail: '/admin/error',
            keepAlive: false
        },
        props: {mode: 'edit'},
    },

    {
        name: 'midia-editor',
        path: '/admin/midia/editor',
        component: AtonAdminMidiaEditor,
        meta: {
            permission: 'public',
            acesso: 'admin',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    {
        name: 'usuarios',
        path: '/admin/usuarios',
        component: AtonAdminUsuariosView,
        meta: {
            permission: 'public',
            acesso: 'usuario-index',
            fail: '/admin/error',
            keepAlive: true
        },
        props: (route) => ({query: route.query.q}),
    },
    {
        name: 'usuarios-add',
        path: '/admin/usuarios/add',
        component: AtonAdminUsuariosAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'usuario-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'usuarios-edit',
        path: '/admin/usuarios/:id/edit',
        component: AtonAdminUsuariosAddEdit,
        meta: {
            permission: 'public',
            acesso: 'usuario-update',
            fail: '/admin/error',
            keepAlive: false
        },
        props: {mode: 'edit'},
    },

    {
        name: 'perfis',
        path: '/admin/perfis',
        component: AtonAdminPerfilView,
        meta: {
            permission: 'public',
            acesso: 'perfil-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'perfis-add',
        path: '/admin/perfis/add',
        component: AtonAdminPerfilAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'perfil-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'perfis-edit',
        path: '/admin/perfis/:id/edit',
        component: AtonAdminPerfilAddEdit,
        meta: {
            permission: 'public',
            acesso: 'perfil-update',
            fail: '/admin/error',
            keepAlive: false
        },
        props: {mode: 'edit'},
    },
    {
        name: 'perfis-permissoes',
        path: '/admin/perfis/:id/permissoes',
        component: AtonAdminPerfilPermissoes,
        meta: {
            permission: 'public',
            acesso: 'perfil-update',
            fail: '/admin/error',
            keepAlive: false
        },
        props: {mode: 'edit'},
    },

    {
        name: 'permissoes',
        path: '/admin/permissoes',
        component: AtonAdminPermissoesView,
        meta: {
            permission: 'public',
            acesso: 'permissao-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'permissoes-add',
        path: '/admin/permissoes/add',
        component: AtonAdminPermissoesAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'permissao-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'permissoes-edit',
        path: '/admin/permissoes/:id/edit',
        component: AtonAdminPermissoesAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'permissao-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    {
        name: 'arquivos',
        path: '/admin/arquivos',
        component: AtonAdminArquivosView,
        meta: {
            permission: 'public',
            acesso: 'arquivo-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'arquivos-add',
        path: '/admin/arquivos/add',
        component: AtonAdminArquivosAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'arquivo-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'arquivos-edit',
        path: '/admin/arquivos/:id/edit',
        component: AtonAdminArquivosAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'arquivo-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },


    {
        name: 'contatos',
        path: '/admin/contatos',
        component: AtonAdminContatosView,
        meta: {
            permission: 'public',
            acesso: 'contato-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'contatos-add',
        path: '/admin/contatos/add',
        component: AtonAdminContatosAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'contato-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'contatos-edit',
        path: '/admin/contatos/:id/edit',
        component: AtonAdminContatosAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'contato-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    {
        name: 'artigos',
        path: '/admin/artigos',
        component: AtonAdminArtigosView,
        meta: {
            permission: 'public',
            acesso: 'artigo-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'artigos-add',
        path: '/admin/artigos/add',
        component: AtonAdminArtigosAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'artigo-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'artigos-edit',
        path: '/admin/artigos/:id/edit',
        component: AtonAdminArtigosAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'artigo-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    {
        name: 'estacoes',
        path: '/admin/estacoes',
        component: AtonAdminEstacoesView,
        meta: {
            permission: 'public',
            acesso: 'estacao-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'estacoes-add',
        path: '/admin/estacoes/add',
        component: AtonAdminEstacoesAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'estacao-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'estacoes-edit',
        path: '/admin/estacoes/:id/edit',
        component: AtonAdminEstacoesAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'estacao-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    {
        name: 'campanhas',
        path: '/admin/campanhas',
        component: AtonAdminCampanhasView,
        meta: {
            permission: 'public',
            acesso: 'campanha-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'campanhas-add',
        path: '/admin/campanhas/add',
        component: AtonAdminCampanhasAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'campanha-store',
            fail: '/admin/error',
            keepAlive: false
        },
        // children: [
        //     {
        //         name: 'campanhas-add-emails-view',
        //         path: '/admin/campanhas/add/emails',
        //         component: AtonAdminCampanhasEmailsView,
        //         meta: {
        //     permission: 'public',
        //             acesso: 'campanha-index',
        //             fail: '/admin/error',
        //             keepAlive: false
        //         },
        //     },
        //     {
        //         name: 'campanhas-add-emails-add-edit',
        //         path: '/admin/campanhas/add/emails/add',
        //         component: AtonAdminCampanhasEmailsAddEdit,
        //         meta: {
        //     permission: 'public',
        //             acesso: 'campanha-index',
        //             fail: '/admin/error',
        //             keepAlive: false
        //         },
        //     },
        //
        // ],
    },
    {
        name: 'campanhas-edit',
        path: '/admin/campanhas/:id/edit',
        component: AtonAdminCampanhasAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'campanha-update',
            fail: '/admin/error',
            keepAlive: false
        },
        // children: [
        //     {
        //         name: 'campanhas-edit-emails-view',
        //         path: '/admin/campanhas/:id/edit/emails',
        //         component: AtonAdminCampanhasEmailsView,
        //         meta: {
        //     permission: 'public',
        //             acesso: 'campanha-index',
        //             fail: '/admin/error',
        //             keepAlive: false
        //         },
        //     },
        //     {
        //         name: 'campanhas-edit-emails-add-edit',
        //         path: '/admin/campanhas/:id/edit/emails/:idemail/edit',
        //         component: AtonAdminCampanhasEmailsAddEdit,
        //         meta: {
        //     permission: 'public',
        //             acesso: 'campanha-index',
        //             fail: '/admin/error',
        //             keepAlive: false
        //         },
        //     },
        // ],
    },

    {
        name: 'players-monitor',
        path: '/admin/players/monitor',
        component: AtonAdminPlayersMonitor,
        meta: {
            permission: 'public',
            acesso: 'player-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },

    {
        name: 'players-report',
        path: '/admin/players/report',
        component: AtonAdminPlayersReport,
        meta: {
            permission: 'public',
            acesso: 'report-player-veiculacao',
            fail: '/admin/error',
            keepAlive: true
        },
    },

    {
        name: 'players',
        path: '/admin/players',
        component: AtonAdminPlayersView,
        meta: {
            permission: 'public',
            acesso: 'player-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'players-add',
        path: '/admin/players/add',
        component: AtonAdminPlayersAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'player-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'players-edit',
        path: '/admin/players/:id/edit',
        component: AtonAdminPlayersAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'player-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    {
        name: 'playlist_conteudo',
        path: '/admin/playlist/conteudo',
        component: AtonAdminPlaylistConteudoView,
        meta: {
            permission: 'public',
            acesso: 'playlist_conteudo-index',
            fail: '/admin/error',
            keepAlive: true
        },
        props: true,

    },
    {
        name: 'playlist_conteudo-add',
        path: '/admin/playlist/conteudo/add',
        component: AtonAdminPlaylistConteudoAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'playlist_conteudo-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'playlist_conteudo-edit',
        path: '/admin/playlist/conteudo/:id/edit',
        component: AtonAdminPlaylistConteudoAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'playlist_conteudo-update',
            fail: '/admin/error',
            keepAlive: false
        },
    },


    {
        name: 'playlists',
        path: '/admin/playlists',
        component: AtonAdminPlaylistView,
        meta: {
            permission: 'public',
            acesso: 'playlist-index',
            fail: '/admin/error',
            keepAlive: true
        },
    },
    {
        name: 'playlists-add',
        path: '/admin/playlists/add',
        component: AtonAdminPlaylistAddEdit,
        props: {mode: 'add'},
        meta: {
            permission: 'public',
            acesso: 'playlist-store',
            fail: '/admin/error',
            keepAlive: false
        },
    },
    {
        name: 'playlists-edit',
        path: '/admin/playlists/:id/edit',
        component: AtonAdminPlaylistAddEdit,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'playlist-index',
            fail: '/admin/error',
            keepAlive: false
        },
    },


    {
        name: 'radio',
        path: '/admin/radio/',
        component: AtonAdminRadioPlayerView,
        props: {mode: 'edit'},
        meta: {
            permission: 'public',
            acesso: 'public',
            fail: '/admin/error',
            keepAlive: false
        },
    },

    //     ],
    // },


];
