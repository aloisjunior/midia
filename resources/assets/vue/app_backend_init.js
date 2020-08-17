window.Vue = require('vue');

import './components';

import './plugins/vuetify';

import store from './store/store'

// window.Vuetify = require('vuetify');
// window.Vue.use(window.Vuetify);

// seta axios como padrão de chamadas ajax/http******
window.Vue.prototype.$http = window.axios;
//***************************************************

Vue.config.devtools = process.env.NODE_ENV !== 'production';

var conf = null;
let storeLocal = null;

let storeTmp = localStorage.getItem('acl-artech');
if (storeTmp) {
    storeLocal = JSON.parse(atob(storeTmp) || '[]');
}


if (storeLocal) {
    var confTmp = _.find((storeLocal), _.property('usuario'));

    if (confTmp) {
        // console.log('carregando dados locais: usuario');
        // console.log(confTmp);

        conf = confTmp.usuario;

        // // if (_.isString(conf.config)){
        //     conf.config = JSON.parse(JSON.stringify(conf.config));
        // // }

        // console.log(conf);
    }
}


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

    plugins: ['players-status', 'players-downloads'],
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



// import AtonBaseTheme from './components/aton-base-theme.vue';
import AtonLogin from './modules/auth/aton-login.vue';
import AtonVerifyEmail from './modules/auth/aton-verify-email.vue';
import AtonPasswordEmail from './modules/auth/aton-password-email.vue';
import AtonPasswordRedefinir from './modules/auth/aton-password-redefinir.vue';
import AtonRegisterUser from './modules/auth/aton-register-user.vue';

const appInit = new Vue({
    store,
    el: '#AtonInit',
    name: 'AtonInit',
    // mixins:[AtonBaseTheme],
    data() {
        return {
        }
    },
    components: {
        AtonLogin,
        AtonVerifyEmail,
        AtonPasswordEmail,
        AtonPasswordRedefinir,
        AtonRegisterUser,
    },
    created() {
        var tmpUser = this.$store.state.auth.userAtivo;


        if (!_.isNull(tmpUser)) {
            let config = tmpUser.config;
            this.$vuetify.theme.primary = config.primaryColorModel != null ? config.primaryColorModel.value: this.$vuetify.theme.primary;
            this.$vuetify.theme.secondary = config.secundaryColorModel != null ? config.secundaryColorModel.value :this.$vuetify.theme.secondary;
        }
    },

    // beforeCreate(){
    //     this.$vuetify.theme.primary = "#4caf50";
    //     this.$vuetify.theme.secondary = "#146b68";
    //     this.$vuetify.theme.tertiary= '#495057';
    //     this.$vuetify.theme.accent= '#82B1FF';
    //     this.$vuetify.theme.error= '#f55a4e';
    //     this.$vuetify.theme.info= '#00d3ee';
    //     this.$vuetify.theme.success= '#5cb860';
    //     this.$vuetify.theme.warning= '#ffa21a';
    //     this.$vuetify.theme.accent = "#9c27b0";
    // },

    methods: {
    }
}).$mount('#AtonInit');

