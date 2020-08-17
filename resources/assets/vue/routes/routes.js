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
import AtonAdminPlaylistConteudoAddEdit
    from '../modules/backend/playlist_conteudo/aton-admin-playlist_conteudo-add-edit.vue';

import AtonAdminPlaylistView from '../modules/backend/playlists/aton-admin-playlist-view.vue';
import AtonAdminPlaylistAddEdit from '../modules/backend/playlists/aton-admin-playlist-add-edit.vue';


import AtonAdminMidiaEditor from '../modules/backend/midia-editor/aton-admin-midia-editor-view.vue';


import AtonAdminVersoesCore from '../modules/backend/app/aton-admin-versoes-core.vue';


import AtonAdminRadioPlayerView from '../modules/backend/radio/aton-admin-radioplayer-view.vue';


export default [
    {
        name: 'admin',
        path: '/admin',
        component: AtonAdminDashboard,
        meta: {
            permission: 'dash',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'config',
        path: '/admin/config',
        component: AtonAdminConfig,
        meta: {
            permission: 'dash',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: true,
            hasReturnRoute: false,
            rootRoutePath: '/admin',
        },

    },
    {
        name: 'error',
        path: '/admin/error',
        component: AtonAdminError,
        meta: {
            permission: 'public',
            isRoot: false,
            hasReturnRoute: false,
            rootRoutePath: '/admin',
        },

    },

    {
        name: 'versoes',
        path: '/admin/versoes',
        component: AtonAdminVersoesCore,
        meta: {
            permission: 'dash',
            keepAlive: false,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },

    {
        name: 'clientes',
        path: '/admin/clientes',
        component: AtonAdminClientesView,
        meta: {
            permission: 'cliente-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'clientes-add',
        path: '/admin/clientes/add',
        component: AtonAdminClientesAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'cliente-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/clientes',
        },
    },
    {
        name: 'clientes-edit',
        path: '/admin/clientes/:id/edit',
        component: AtonAdminClientesAddEdit,
        meta: {
            permission: 'cliente-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/clientes',
        },
        props: {mode: 'edit', fromRoute: ''},
    },

    {
        name: 'midia-editor',
        path: '/admin/midia/editor',
        component: AtonAdminMidiaEditor,
        meta: {
            permission: 'dash',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },

    {
        name: 'usuarios',
        path: '/admin/usuarios',
        component: AtonAdminUsuariosView,
        meta: {
            permission: 'usuario-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
        props: (route) => ({query: route.query.q}),
    },
    {
        name: 'usuarios-add',
        path: '/admin/usuarios/add',
        component: AtonAdminUsuariosAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'usuario-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/usuarios',
        },
    },
    {
        name: 'usuarios-edit',
        path: '/admin/usuarios/:id/edit',
        component: AtonAdminUsuariosAddEdit,
        meta: {
            permission: 'usuario-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/usuarios',
        },
        props: {mode: 'edit', fromRoute: ''},
    },

    {
        name: 'perfis',
        path: '/admin/perfis',
        component: AtonAdminPerfilView,
        meta: {
            permission: 'perfil-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'perfis-add',
        path: '/admin/perfis/add',
        component: AtonAdminPerfilAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'perfil-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/perfis',
        },
    },
    {
        name: 'perfis-edit',
        path: '/admin/perfis/:id/edit',
        component: AtonAdminPerfilAddEdit,
        meta: {
            permission: 'perfil-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/perfis',
        },
        props: {mode: 'edit', fromRoute: ''},
    },
    {
        name: 'perfis-permissoes',
        path: '/admin/perfis/:id/permissoes',
        component: AtonAdminPerfilPermissoes,
        meta: {
            permission: 'perfil-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin/perfis',
        },
        props: {mode: 'edit', fromRoute: ''},
    },

    {
        name: 'permissoes',
        path: '/admin/permissoes',
        component: AtonAdminPermissoesView,
        meta: {
            permission: 'permissao-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'permissoes-add',
        path: '/admin/permissoes/add',
        component: AtonAdminPermissoesAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'permissao-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/permissoes',
        },
    },
    {
        name: 'permissoes-edit',
        path: '/admin/permissoes/:id/edit',
        component: AtonAdminPermissoesAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'permissao-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/permissoes',
        },
    },

    {
        name: 'arquivos',
        path: '/admin/arquivos',
        component: AtonAdminArquivosView,
        meta: {
            permission: 'arquivo-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'arquivos-add',
        path: '/admin/arquivos/add',
        component: AtonAdminArquivosAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'arquivo-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/arquivos',
        },
    },
    {
        name: 'arquivos-edit',
        path: '/admin/arquivos/:id/edit',
        component: AtonAdminArquivosAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'arquivo-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/arquivos',
        },
    },


    {
        name: 'contatos',
        path: '/admin/contatos',
        component: AtonAdminContatosView,
        meta: {
            permission: 'contato-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'contatos-add',
        path: '/admin/contatos/add',
        component: AtonAdminContatosAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'contato-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/contatos',
        },
    },
    {
        name: 'contatos-edit',
        path: '/admin/contatos/:id/edit',
        component: AtonAdminContatosAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'contato-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/contatos',
        },
    },

    {
        name: 'artigos',
        path: '/admin/artigos',
        component: AtonAdminArtigosView,
        meta: {
            permission: 'artigo-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'artigos-add',
        path: '/admin/artigos/add',
        component: AtonAdminArtigosAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'artigo-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/artigos',
        },
    },
    {
        name: 'artigos-edit',
        path: '/admin/artigos/:id/edit',
        component: AtonAdminArtigosAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'artigo-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/artigos',
        },
    },

    {
        name: 'estacoes',
        path: '/admin/estacoes',
        component: AtonAdminEstacoesView,
        meta: {
            permission: 'estacao-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'estacoes-add',
        path: '/admin/estacoes/add',
        component: AtonAdminEstacoesAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'estacao-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/estacoes',
        },
    },
    {
        name: 'estacoes-edit',
        path: '/admin/estacoes/:id/edit',
        component: AtonAdminEstacoesAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'estacao-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/estacoes',
        },
    },

    {
        name: 'campanhas',
        path: '/admin/campanhas',
        component: AtonAdminCampanhasView,
        meta: {
            permission: 'campanha-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'campanhas-add',
        path: '/admin/campanhas/add',
        component: AtonAdminCampanhasAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'campanha-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/campanhas',
        },
    },
    {
        name: 'campanhas-edit',
        path: '/admin/campanhas/:id/edit',
        component: AtonAdminCampanhasAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'campanha-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/campanhas',
        },
    },

    {
        name: 'players-monitor',
        path: '/admin/players/monitor',
        component: AtonAdminPlayersMonitor,
        meta: {
            permission: 'player-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin/players',
        },
    },

    {
        name: 'players-report',
        path: '/admin/players/report',
        component: AtonAdminPlayersReport,
        meta: {
            permission: 'report-player-veiculacao',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },

    {
        name: 'players',
        path: '/admin/players',
        component: AtonAdminPlayersView,
        meta: {
            permission: 'player-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },

    },
    {
        name: 'players-add',
        path: '/admin/players/add',
        component: AtonAdminPlayersAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'player-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/players',
        },
    },
    {
        name: 'players-edit',
        path: '/admin/players/:id/edit',
        component: AtonAdminPlayersAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'player-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/players',
        },
    },

    {
        name: 'playlist_conteudo',
        path: '/admin/playlist/conteudo',
        component: AtonAdminPlaylistConteudoView,
        meta: {
            permission: 'playlist_conteudo-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
        props: true,

    },
    {
        name: 'playlist_conteudo-add',
        path: '/admin/playlist/conteudo/add',
        component: AtonAdminPlaylistConteudoAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'playlist_conteudo-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/playlist/conteudo',
        },
    },
    {
        name: 'playlist_conteudo-edit',
        path: '/admin/playlist/conteudo/:id/edit',
        component: AtonAdminPlaylistConteudoAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'playlist_conteudo-update',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/playlist/conteudo',
        },
    },


    {
        name: 'playlists',
        path: '/admin/playlists',
        component: AtonAdminPlaylistView,
        meta: {
            permission: 'playlist-index',
            fail: '/admin/error',
            keepAlive: true,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },
    {
        name: 'playlists-add',
        path: '/admin/playlists/add',
        component: AtonAdminPlaylistAddEdit,
        props: {mode: 'add', fromRoute: ''},
        meta: {
            permission: 'playlist-store',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/playlists',
        },
    },
    {
        name: 'playlists-edit',
        path: '/admin/playlists/:id/edit',
        component: AtonAdminPlaylistAddEdit,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'playlist-index',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: false,
            hasReturnRoute: true,
            rootRoutePath: '/admin/playlists',
        },
    },


    {
        name: 'radio',
        path: '/admin/radio/',
        component: AtonAdminRadioPlayerView,
        props: {mode: 'edit', fromRoute: ''},
        meta: {
            permission: 'public',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },

    // casos de rotas não existentes
    {
        path: '*',
        component: AtonAdminError,
        meta: {
            permission: 'public',
            fail: '/admin/error',
            keepAlive: false,
            isRoot: true,
            hasReturnRoute: true,
            rootRoutePath: '/admin',
        },
    },


];
