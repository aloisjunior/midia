<script>
    import bus from '../../modules/events/bus';
    import AtonCssLoader from '../components/comum/aton-css-loader.vue';
    import AtonPermissions from '../components/aton-permissions.vue';

    export default {
        mixins: [
            AtonCssLoader,
            AtonPermissions
        ],
        props: ['mode'],

        name: 'aton-base-form',

        data() {
            return {

                loading: false,

                validForm: false,

                isReadOnlyValue: false,

                backRoutePath: "/admin",

                dadosDB:[],
                dadosDBOriginal:[],

                fabAddEdit: true,
                fabAddEditShow: false,
            }
        },
        mounted() {
            let self = this;
            // bus.$on('userId-update', (val) => this.revisaAcesso(val));
            setTimeout(function () {
                self.fabAddEditShow = true;
            }, 1000);
        },

        watch: {
            permissions: function (newV, oldV) {
                if (newV && (newV !== oldV)) {
                    this.revisaAcesso();
                }
            },
        },

        computed:{
            isModeDarkForms: function () {
                // return ( (this.ValisNotEmptyNull(this.configUser)) &&  (_.includes(this.configUser.tema_formularios, 'Escuro')));
                return this.$store.getters.isDarkForm;
            },

            isModeDarkBackground: function () {
                // return ( (this.ValisNotEmptyNull(this.configUser)) &&  (_.includes(this.configUser.tema_fundo, 'Escuro')));
                return this.$store.getters.isDarkBG;
            },
            UsuarioAtivo: function () {
                return this.$store.state.auth.userAtivo;
            },

            permissions: function () {
                return this.access;
            },

        },

        beforeRouteLeave (to, from, next) {
            // called when the route that renders this component is about to
            // be navigated away from.
            // has access to `this` component instance.
            // this.backRoutePath = this.$route.meta.rootRoutePath;

            bus.$emit('route:leave', from.path);
            // console.log('route leave', from.path);
            next();
        },

        beforeRouteEnter (to, from, next) {
            next(vm => {
                // console.log('route enter', to.path);
                bus.$emit('route:enter', to.path);
            })
        },

        methods: {
            afterPost: function () {
                this.dadosDBOriginal = JSON.parse(JSON.stringify(this.dadosDB));
            },

            voltaViewFrom(altRoute = '/admin') {

                if ((this.$route.params.fromRoute) && this.$route.params.fromRoute !== ''){
                    this.$router.push({path: this.$route.params.fromRoute});
                } else if ((this.$route.meta.rootRoutePath) && this.$route.meta.rootRoutePath !== ''){
                    // this.$router.push({path: altRoute});
                    this.$router.push({path: this.$route.meta.rootRoutePath});
                } else{
                    this.$router.push({path: altRoute});
                }
            },

            voltaView(altRoute = '/admin') {
                // this.fabAddEdit = false;
                this.fabAddEditShow = false;

                let self = this;
                setTimeout(function () {
                    self.voltaViewFrom(altRoute);
                }, 300);
            },

            colorDynamic () {
                const colorSelected = Object.keys(this.color).some(type => this.color[type])
                if (colorSelected) { return this.current.color }
                else { return '' }
            },

            revisaAcesso: function () {
                if (!this.access) {
                    console.log('sem permissoes salvas');
                    return false;
                }

                // let self = this;
                if ((this.$route.meta.permission !== 'public') && (!this.$can(this.$route.meta.permission))) {
                    console.log('usuario perdeu acesso');
                    this.afterPost(); // evita mensagem de pendencia na inclusão
                    this.voltaView();
                    // self.$router.push({path: '/admin'});
                }
            },

            /**
             * @return {boolean}
             */
            ValisEmptyNull: function (val) {
                if (_.isNull(val) ||_.isUndefined(val)) {
                    return true;
                } else if (_.isObject(val)) {
                    return _.isEmpty(val);
                } else if (_.isArray(val)) {
                    return _.isEmpty(val);
                } else if (_.isString(val)) {
                    return _.isEqual(val, '');
                }
            },
            /**
             * @return {boolean}
             */
            ValisNotEmptyNull: function (val) {
                return !(this.ValisEmptyNull(val));
            },

            getTitulo: function (titulo) {
                if (this.mode == 'add') {
                    return '.:: ' + titulo + ' - Inclusão' + ' ::.'
                } else if (this.mode == 'edit') {
                    return '.:: ' + titulo + ' - Alteração' + ' ::.'
                } else {
                    return '.:: ' + titulo + ' ::.'
                }
            },
            formatDate(date) {
                if (!date) {
                    return null
                }

                const [year, month, day] = date.split('-')
                return `${day}/${month}/${year}`
            },
            parseDate(date) {
                if (!date) {
                    return null
                }

                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            },
            hasPlugin: function (name) {
                let conf = this.UsuarioAtivo.config;

                if (conf) {
                    let idx = _.findIndex(conf.plugins, {'value': name}); // this.$logDebug('idx= ' + idx);

                    return idx !== -1;
                }

                return false;
            },

            capitalize: function() {
                return this.charAt(0).toUpperCase() + this.slice(1);
            },

        },

    }
</script>

<template>
</template>

<style>
</style>

