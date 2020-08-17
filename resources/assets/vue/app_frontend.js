
window.Vue = require('vue');

// window.BootstrapVue = require('bootstrap-vue')
// window.Vue.use(window.BootstrapVue);

// seta axios como padrão de chamadas ajax/http
window.Vue.prototype.$http = window.axios;

// dependencia vue-cookie
window.VueCookie = require('vue-cookie');
// Tell Vue to use the plugin
Vue.use(window.VueCookie);


// criação de filtro para data
Vue.filter('formatDate', function (value, format = 'DD/MM/YYYY HH:mm') {
    if (value) {
        // console.log(value+' '+format);
        // let formato = (format != null)? format : 'DD/MM/YYYY HH:mm';
        return moment(String(value)).format(format);
    }
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.config.devtools = process.env.NODE_ENV !== 'production';

import AppFrontend from './modules/frontend/frontend.vue';
import AtonContato from './modules/frontend/aton-contato.vue';
import AtonContatoLanding from './modules/landing/aton-contato-landing.vue';

import AtonPostsFooter from './modules/frontend/aton-posts-footer.vue';
import AtonFormLateral from './modules/components/aton-form-lateral.vue';
import AtonFormCaptura1 from './modules/components/aton-form-captura1.vue';
import AtonClientesInfo from './modules/frontend/aton-clientes-info.vue';
// import AtonNotificationFcm from './components/frontend/aton-notification-fcm.vue';
import AtonDownloads from './modules/frontend/aton-downloads.vue';
import AtonPontosVeiculacao from './modules/frontend/aton-pontos-veiculacao.vue';


/* import AtonBodymovin from './components/aton-bodymovin.vue';
*/
new Vue({
    el: '#app-core',
    name: 'AtonAppFrontend',
    data() {
        return {
            mensagem: 'Olá mensagem Vue'
        }

    },
    components: {
        AppFrontend,
        AtonContato,
        AtonContatoLanding,
        AtonPostsFooter,
        AtonFormLateral,
        AtonFormCaptura1,
        AtonClientesInfo,
        // AtonNotificationFcm,
        AtonDownloads,
        AtonPontosVeiculacao,
        // AtonBodymovin,
    }

});
