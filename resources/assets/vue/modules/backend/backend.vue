<template>
    <v-app id="AppCore"
           :dark="isModeDarkBackground"
           :light="!isModeDarkBackground"
    >
        <aton-menu-esq>
        </aton-menu-esq>


        <v-content v-scroll="onScroll">
            <v-layout justify-space-between align-center row wrap>
                <v-hover>
                    <v-toolbar
                            dense
                            slot-scope="{ hover }"
                            :class="`elevation-${hover ? 4 : 0}`"
                            :dark="!isModeDarkBackground"
                            :light="isModeDarkBackground"

                            height="50"

                            app
                            color="primary"
                            class="white--text customToolBarFixed "
                            :scroll-off-screen="true"
                            :scroll-threshold="75"
                            id="app-toolbar"
                    >
                        <v-toolbar-side-icon
                                @click.stop="mudaEstadoMenuEsq()"
                        ></v-toolbar-side-icon>
                        <v-toolbar-title class="subheading font-weight-light">
                            <span> Ayro </span> - Manager
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-flex
                                    align-center
                                    layout
                                    py-2
                            >
                                <router-link
                                        v-ripple
                                        class="toolbar-items"
                                        to="/admin"
                                >
                                    <v-btn icon>
                                        <v-icon >mdi-view-dashboard</v-icon>
                                    </v-btn>

                                </router-link>

                                <v-menu
                                        bottom
                                        left
                                        content-class="dropdown-menu"
                                        offset-y
                                        transition="slide-y-transition">
                                    <router-link
                                            v-ripple
                                            slot="activator"
                                            class="toolbar-items"
                                            to="/admin/versoes"
                                    >
                                        <v-badge
                                                color="error"
                                                overlap
                                        >
                                            <template slot="badge">
                                                {{ notificationsData.length }}
                                            </template>
                                            <v-btn icon>
                                                <v-icon >mdi-bell</v-icon>
                                            </v-btn>
                                        </v-badge>
                                    </router-link>
                                    <v-card
                                            :dark="isModeDarkBackground"
                                            :light="!isModeDarkBackground"
                                    >
                                        <v-list dense>
                                            <v-list-tile
                                                    v-for="notification in notificationsData"
                                                    :key="notification"
                                            >
                                                <v-list-tile-title
                                                        v-text="notification"
                                                />
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-menu>

                                <v-menu
                                        bottom
                                        left

                                        offset-y

                                        v-model="menu"
                                        :close-on-content-click="true"
                                        transition="slide-x-transition">

                                    <v-btn icon  slot="activator">
                                        <v-icon >person</v-icon>
                                    </v-btn>

                                    <v-card>
                                        <v-list>
                                            <v-list-tile avatar>
                                                <v-list-tile-avatar >
                                                    <v-icon avatar>person</v-icon>
                                                </v-list-tile-avatar>

                                                <v-list-tile-content>
                                                    <v-list-tile-title>{{ UsuarioAtivo.name }}</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ UsuarioAtivo.email }}</v-list-tile-sub-title>
                                                </v-list-tile-content>

                                                <v-list-tile-action>
                                                    <v-btn
                                                            :class="fav ? 'red--text' : ''"
                                                            icon
                                                            @click="fav = !fav"
                                                    >
                                                        <v-icon>settings</v-icon>
                                                    </v-btn>
                                                </v-list-tile-action>
                                            </v-list-tile>
                                        </v-list>

                                        <v-divider></v-divider>

                                        <v-list>
                                            <v-list-tile
                                                    to='/admin/config'
                                                    :exact="true"
                                                    active-class="green--text"
                                            >
                                                <v-list-tile-action>
                                                    <v-icon>settings</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Configurações</v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                        </v-list>

                                        <v-divider></v-divider>

                                        <v-list>
                                            <v-list-tile
                                                    @click=""
                                                    href="/logout"
                                            >
                                                <v-list-tile-action>
                                                    <v-icon>exit_to_app</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-title>Logout</v-list-tile-title>
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-menu>
                            </v-flex>
                        </v-toolbar-items>
                    </v-toolbar>

                </v-hover>

                <v-container

                        fluid
                        grid-list-sm
                        class="pa-2 mt-2"
                >
                    <v-layout
                            justify-center
                            wrap
                            id="scroll-target"
                            class="scroll-y"
                    >
                        <v-flex
                                md12
                                class="hide-overflow"
                        >
                            <transition name="slide-fade"
                                        mode="out-in"
                            >
                                <keep-alive :include="rotasMantidas($route)">
                                    <router-view :key="$route.path">
                                    </router-view>
                                </keep-alive>
                            </transition>

                        </v-flex>
                    </v-layout>
                </v-container>

            </v-layout>
        </v-content>
        <v-footer
                dark
                height="auto"
                absolute
                app
        >
            <v-card
                    class="flex ma-0"
                    flat
                    tile
            >
                <v-card-actions class="grey darken-3 justify-end ma-0 pr-2">
                    &copy;2019 — <strong>Ayro</strong>
                </v-card-actions>
            </v-card>
        </v-footer>

        <v-fab-transition>
            <v-btn
                    color="red"
                    v-show="btnToTop"
                    dark
                    fab
                    fixed
                    bottom
                    right
                    small
                    @click="toTop()"
                    class="no-print"
            >
                <v-icon>expand_less</v-icon>
            </v-btn>
        </v-fab-transition>

        <div class="text-xs-center">
            <v-bottom-sheet inset v-model="exibeBarra">

                <v-card tile>
                    <v-progress-linear
                            :value="100"
                            class="my-0"
                            height="3"
                    ></v-progress-linear>

                    <v-list>
                        <v-list-tile>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ tituloBarra }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ msgBarra }}</v-list-tile-sub-title>
                            </v-list-tile-content>

                            <v-spacer></v-spacer>

                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-bottom-sheet>
        </div>
        <aton-msg></aton-msg>
        <aton-progress></aton-progress>
    </v-app>


</template>

<script>
    import AtonMenuEsq from '../layout/backend/menu-esq.vue';

    import AtonMsg from '../components/_atonmsg.vue';
    import AtonProgress from '../components/_atonprogress.vue';

    import bus from '../../modules/events/bus';

    import storageLocal from '../../mixins/storageLocal';
    import AtonBaseForm from '../components/aton-base-form.vue';

    export default {
        mixins: [storageLocal,
            // AtonPermissions,
            AtonBaseForm],
        name: 'app-backend',
        data() {
            return {
                icons: [
                    'fab fa-facebook',
                    'fab fa-twitter',
                    'fab fa-google-plus',
                    'fab fa-linkedin',
                    'fab fa-instagram'
                ],

                mini: false,
                drawer: true,
                drawerRight: false,
                right: null,
                left: null,

                notifications: false,
                sound: true,
                widgets: false,

                exibeBarra: false,
                msgBarra: '',

                tituloBarra: '',

                fav: true,
                menu: false,
                message: false,
                hints: true,

                channelEcho: '',

                btnToTop: false,

                rotasKeepAlive: [],

                rotasKeepAliveExclude: [],

                notificationsData: [
                    'Sem novas notificações',
                ],
            }
        },

        created() {
            const self = this;
            // this.$logDebug('mounted backend');

            var tmpUser = this.$store.state.auth.userAtivo;

            // this.$logDebug('user');
            this.$logDebug(tmpUser);

            if (this.ValisNotEmptyNull(tmpUser)) {
                // this.$logDebug('mounted tem userAtivo');
                this.updateConfig(tmpUser.config);
                this.listenForChanges(0)
                // this.$nextTick( function () {
                //     }
            }
            // );


        },

        mounted() {
            bus.$on('userId-update', (userId) => this.listenForChanges(userId));
            bus.$on('update:config', (config) => this.updateConfig(config)); // atualiza dados de referencia para validar no form base alterações de dados
            bus.$on('UserPermissionsChange', () => this.loadPermissions2(true));

            this.loadPermissions2(true);
        },

        computed: {

        },
        methods: {
            rotasExcluidas: function () {
                return this.rotasKeepAliveExclude;
            },
            rotasMantidas: function (route) {
                if (route.meta && route.meta.keepAlive && !this.rotasKeepAlive.includes(route.params.componentName)) {
                    this.rotasKeepAlive.push(route.params.componentName)
                } else{
                    if (route.meta && !route.meta.keepAlive && !this.rotasKeepAliveExclude.includes(route.params.componentName)){
                        this.rotasKeepAliveExclude.push(route.params.componentName)
                    }
                }
                return this.rotasKeepAlive;
            },

            logar: function (payload) {
                console.log('outro ', payload);
            },
            updateConfig: function (config) {
                // this.$logDebug('atualizando config');
                // this.$logDebug(config);

                this.$vuetify.theme.primary = config.primaryColorModel != null ? config.primaryColorModel.value : this.$vuetify.theme.primary;
                this.$vuetify.theme.secondary = config.secundaryColorModel != null ? config.secundaryColorModel.value : this.$vuetify.theme.secondary;
                this.addStorageLocal('usuario', this.UsuarioAtivo);

            },

            toTop: function () {
                this.$vuetify.goTo(0);
            },
            onScroll(e) {
                if (typeof window === 'undefined') {
                    return false;
                }
                const top = window.pageYOffset || e.target.scrollTop || 0;
                this.btnToTop = top > 75
            },

            exibeMsgBarra: function (titulo, msg) {
                this.tituloBarra = titulo;
                this.msgBarra = msg;
                this.exibeBarra = true;

                let self = this;

                setTimeout(function () {
                    self.exibeBarra = false;
                }, 12000);
            },

            listenForChanges(userId = 0) {
                let self = this;

                let UserIdAtivo = this.UsuarioAtivo.id;

                if (userId === UserIdAtivo) {
                    return false;
                }

                Echo.leave(this.channelEcho);

                this.channelEcho = 'user.' + UserIdAtivo;

                Echo.channel(this.channelEcho)
                    .listen('.ARsig\\Events\\VideoConverterFinish', (data) => {
                        // .listen('video.conversao.finish', data => {
                        if (!('Notification' in window)) {
                            alert('Web Notification is not supported');
                            return;
                        }

                        // let tmpData = data;

                        Notification.requestPermission(permission => {


                            // bus.$emit('msgBarra-view', 'success', 'Vídeo convertido');

                            // self.exibeMsgBarra('Status de conteúdo: [ ' + data.conteudo_nome + ' ]', 'Seu conteúdo já está disponível para utilização');
                            bus.$emit('atonmsg', 'success', 'Conteúdo: [ ' + data.conteudo_nome + ' ] está disponível para utilização', 0);

                            let notification = new Notification('Conversão de conteúdo finalizado', {
                                body: data.title,
                                icon: "https://pusher.com/static_logos/320x320.png" // optional image url
                            });

                            // link to page on clicking the notification
                            notification.onclick = () => {
                                window.open(window.location.href);
                            };

                        });
                    })

                    .listen('.ARsig\\Events\\UserPermissionsChange', (data) => {
                        if (!('Notification' in window)) {
                            alert('Web Notification is not supported');
                            return;
                        }

                        // let tmpData = data;

                        Notification.requestPermission(permission => {

                            // self.loadPermissions2(true);
                            bus.$emit('UserPermissionsChange');
                            return true;


                        });
                    });

            },

            mudaView: function (value) {
                if (value == null) {
                    return false
                }
                this.viewAtual = value;
            },
            mudaEstadoMenuEsq: function () {
                this.drawer = !this.drawer;
                bus.$emit('update:menuesq', this.drawer);
            },


        },
        components: {
            AtonMenuEsq,
            AtonMsg,
            AtonProgress,
        },

    }
</script>


<style>

    /*.v-toolbar {*/
    /*&.customToolBarFixed {*/
    /*background: transparent !important;*/
    /*.v-toolbar__content {*/
    /*!*background-color: primary;*!*/
    /*}*/
    /*position: fixed !important;*/
    /*z-index: 3;*/
    /*padding: 5px !important;*/
    /*}*/
    /*}*/

    /*#app-toolbar .v-toolbar__items .v-btn {*/
    /*text-transform: capitalize;*/
    /*font-size: 16px;*/
    /*font-weight: 300;*/
    /*}*/

    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }

    /*.container {*/
    /*padding: 12px;*/
    /*}*/

    .v-progress-linear {
        margin: 0px;
    }

    /*.fade-enter-active, .fade-leave-active {*/
    /*transition: opacity .5s;*/
    /*}*/

    /*.fade-enter, .fade-leave-to !* .fade-leave-active below version 2.1.8 *!*/
    /*{*/
    /*opacity: 0;*/
    /*}*/

    /*.slide-fade-enter-active {*/
    /*transition: all .3s ease;*/
    /*}*/

    /*.slide-fade-leave-active {*/
    /*transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);*/
    /*}*/

    /*.slide-fade-enter, .slide-fade-leave-to*/
    /*!* .slide-fade-leave-active below version 2.1.8 *!*/
    /*{*/
    /*transform: translateX(10px);*/
    /*opacity: 0;*/
    /*}*/

    /*v-scroll:#scroll-target="onScroll"*/
</style>