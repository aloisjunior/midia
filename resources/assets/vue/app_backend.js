window.Vue = require('vue');
// window.Vuetify = require('vuetify');
// window.Vue.use(window.Vuetify);

// /***************************************************************
//  * Agrupamento : VueFrola
//  * Alterações:
//  *   [ 16/12/2018 ] [v.: 1.0.0] - Criação inicial
//  ****************************************************************/
// require('froala-editor/js/froala_editor.pkgd.min');
// // Require Froala Editor css files.
// require('froala-editor/css/froala_editor.pkgd.min.css');
// require('font-awesome/css/font-awesome.min.css');
// require('froala-editor/css/froala_style.min.css');
// import VueFroala from 'vue-froala-wysiwyg';
//
// window.Vue.use(VueFroala);
// /**-> FIM VueFrola */


// Components
import './components'


// Plugins
import './plugins';


import store from './store/store';


/***************************************************************
 * Agrupamento : VueRouter
 * Alterações:
 *   [ 16/12/2018 ] [v.: 1.0.0] - Criação inicial
 ****************************************************************/
import VueRouter from 'vue-router';
import routes from './routes/routes';

Vue.use(VueRouter);

const router = new VueRouter({
    routes, // short for routes: routes
    mode: 'history',
    // canReuse: false,
});
/**-> FIM VueRouter */


router.beforeEach((to, from, next) => {
    if (to.name !== 'error') {
        let tmpR = {
            path: to.path,
            permission: to.meta.permission,

        };

        localStorage.setItem('nav-artech', JSON.stringify(tmpR));
    }

    to.params.componentName = to.matched[0].components.default.name;
    // console.log('beforeEach from: ' + from.fullPath);
    // console.log('beforeEach to: ' + to.fullPath);
    next();
});

router.beforeResolve((to, from, next) => {
    // console.log('beforeResolve from: ', from);
    // console.log('beforeResolve to: ', to);

    if ((to.path !== from.path) && from.meta.hasReturnRoute ){
        to.params.fromRoute = from.path == '/'? '/admin' : from.path;
    } else{
        to.params.fromRoute = '';
    }



    if (to.name !== 'error') {
        localStorage.removeItem('nav-artech');
    }

    next();
});


/***************************************************************
 * Agrupamento : ACL - Controle de Acessos
 * Alterações:
 *   [ 16/12/2018 ] [v.: 1.0.0] - Criação inicial
 ****************************************************************/
import Acl from 'vue-acl'

var perm = 'dash';
var conf = null;
let storeLocal = null;

let storeTmp = localStorage.getItem('acl-artech');
if (storeTmp) {
    storeLocal = JSON.parse(atob(storeTmp) || '[]');
}


if (storeLocal) {
    // console.log('carregando dados locais');
    // console.log(storeLocal);
    var acc = _.find((storeLocal), _.property('acessos'));

    if (acc) {
        perm = acc.acessos;
        // console.log(perm);
    }

    var confTmp = _.find((storeLocal), _.property('usuario'));


    if (confTmp) {
        // console.log('carregando dados locais: usuario');
        // console.log(confTmp);

        conf = confTmp.usuario;

    }
}


// configrações padrão
var configDefault = {
    players_tempo_notifica: 15,
    tema_formularios: 'Escuro',
    tema_fundo: 'Claro',

    primaryColorModel: {
        text: "green",
        value: "#4caf50",
    },
    secundaryColorModel: {
        text: "blue-grey darken-1",
        value: "#546E7A",
    },

    plugins: [
        {
            text: "Status dos players",
            value: "players-status",
        },
        {
            text: "Status dos Downloads nos players",
            value: "players-downloads",
        },
        {
            text: "Status dos processamentos dos conteúdos",
            value: "conteudos-processamento",
        },
        ],
};


window.Vue.prototype.$configPadraoManager = configDefault;
if (!conf) {
    conf = {
        ativo: 1,
        config: Object.assign({}, this.config, configDefault),
        created_at: "",
        email: "",
        email_verified_at: "",
        first_name: "",
        id: 1,
        name: "",
        password_md5: "",
        updated_at: "",
    }
}
store.dispatch('SetUser', conf);

Vue.use(Acl, {router: router, init: perm, save: true});
/**-> FIM ACL - Controle de Acessos */


// vue konva
window.Konva = require('konva');

// seta axios como padrão de chamadas ajax/http******
window.Vue.prototype.$http = window.axios;
//***************************************************

// criação de filtro para data
Vue.filter('formatDate', function (value, format = 'DD/MM/YYYY HH:mm') {
    if (value) {
        // console.log(value+' '+format);
        // let formato = (format != null)? format : 'DD/MM/YYYY HH:mm';
        return moment(String(value), ['DD/MM/YYYY HH:mm', "YYYY/MM/DD HH:mm"]).format(format);
    }
});

Vue.filter('formateFone', function (value) {
    if (value) {
        value = value.replace(/\D/g, "");             //Removaluee tudo o que não é dígito
        value = value.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em valueolta dos dois primeiros dígitos
        value = value.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    }
    return value;
});

Vue.filter('prettyBytes', function (num) {
    // jacked from: https://github.com/sindresorhus/pretty-bytes
    if (typeof num !== 'number' || isNaN(num)) {
        throw new TypeError('Expected a number');
    }

    var exponent;
    var unit;
    var neg = num < 0;
    var units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    if (neg) {
        num = -num;
    }

    if (num < 1) {
        return (neg ? '-' : '') + num + ' B';
    }

    exponent = Math.min(Math.floor(Math.log(num) / Math.log(1000)), units.length - 1);
    num = (num / Math.pow(1000, exponent)).toFixed(2) * 1;
    unit = units[exponent];

    return (neg ? '-' : '') + num + ' ' + unit;
});


Vue.config.devtools = (process.env.NODE_ENV !== 'production');
window.Vue.prototype.$debug = (process.env.NODE_ENV !== 'production');

Vue.prototype.$logDebug = function (param, param2 = '') {
    if (this.$debug) {
        console.log('.:: Log DEBUG ::. -> ', param, param2);
    }
};

// função que retorna valores unicos para array
Array.prototype.unique = function () {
    let a = this.concat();
    for (let i = 0; i < a.length; ++i) {
        for (let j = i + 1; j < a.length; ++j) {
            if (a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
};

import AppBackend from './modules/backend/backend.vue';
import AtonMenuDir from './modules/layout/backend/menu-dir.vue';
import AtonMenuNavegacao from './modules/layout/backend/menu-navegacao.vue';

import bus from './modules/events/bus';

const app = new Vue({
    // mixins: [AtonPermissions],

    router,
    store,
    el: '#app-core',
    name: 'AtonApp',

    data() {
        return {
            mensagem: 'Olá mensagem Vue',
            show_plugin_facebook: true,
            configs: {
                menuAtual: 'dashboard',
            },

        }
    },
    components: {
        AppBackend,
        AtonMenuDir,

        AtonMenuNavegacao,
    },

    mounted() {
        let self = this;
        bus.$on('menu-load', () => self.propagaMenuLoad())
    },
    methods: {
        propagaMenuLoad: function () {
            bus.$emit('app-load');
        },

    },
}).$mount('#app-core');


/***************************************************************
 * Rotina    : CheckExpireToken
 * Descrição : Responsável por verificar se o token expirou, e
 *              reconecta ao server
 * Criado por: Alóis Rothermel Júnior
 * Alterações:
 *   [ 15/12/2018 ] [v.: 1.0.0] - Criação inicial
 ****************************************************************/
window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    const originalRequest = error.config;

    // atualiza token e reenvia solicitação caso token esteja vencido
    if (error.response.status === 419 && !originalRequest._retry) {
        originalRequest._retry = true;

        return app.$http.get('/api/i/usuario/token')
            .then(response => {
                app.$http.defaults.headers.common['X-CSRF-TOKEN'] = response.data;
                bus.$emit('atonmsg', 'success', 'Conexão foi restabelecida!');
                // return app.$http(originalRequest);

                app.$logDebug(originalRequest);
                originalRequest.headers['X-CSRF-TOKEN'] = response.data;

                app.$logDebug('Chamando request original após status 419.');
                return app.$http.request(originalRequest);
            })
            .catch((err) => {
                bus.$emit('atonmsg', 'error', 'Não foi possível restabelecer conexão, iremos recarregar a página');
            });
    }

    // // reenvia solicitação caso erro de conexão 500
    if (error.response.status === 500 && !originalRequest._retry) {
        originalRequest._retry = true;
        app.$logDebug('Chamando request original após status 500.');
        return app.$http.request(originalRequest);
    }


    return Promise.reject(error);
});
