<template>
    <v-navigation-drawer
            @keyup.esc="drawer = !drawer"
            fixed
            :mini-variant.sync="mini"
            v-model="drawer"
            id="app-drawer"
            app
            dark
            class="no-print v-card v-card--tile"

    >
        <v-img
                :src="image"
                height="100%"
                @keyup.esc="drawer = !drawer"
        >
            <v-layout
                    class="fill-height v-list--dense"
                    tag="v-list"
                    column
                    @keyup.esc="drawer = !drawer"
            >
                <v-list-tile avatar>
                    <v-list-tile-avatar
                            color="white"
                    >
                        <v-img
                                src="/img/ayro.png"
                                height="50"
                                contain
                        />
                    </v-list-tile-avatar>
                    <v-list-tile-title class="headline green--text font-weight-medium font-italic text-xs-center">
                        <strong>Ayro</strong> Manager
                    </v-list-tile-title>

                    <v-spacer></v-spacer>

                    <v-list-tile-action>
                        <v-btn  icon  @click.native.stop="mini = !mini">
                            <v-icon>chevron_left</v-icon>
                        </v-btn>
                    </v-list-tile-action>

                </v-list-tile>


                <v-divider></v-divider>

                <template v-for="item in itens"
                >
                    <v-list-group
                            :prepend-icon="item.icone"
                            no-action
                            v-if="item.filhos != null"
                            v-model="item.ativo"
                            :value="temFilhoAtivo(item)"
                            active-class="green--text"
                            v-show="!item.permission  || $can(item.permission ? item.permission : 'public')"
                    >
                        <v-list-tile slot="activator"
                                     v-show="!item.permission  || $can(item.permission ? item.permission : 'public')"
                                     active-class="green--text"
                                     :value="temFilhoAtivo(item)"

                        >


                            <v-tooltip right v-if="mini">
                                <v-list-tile-content slot="activator" active-class="green--text">
                                    <v-list-tile-title v-if="item.ativo" active-class="green--text">
                                        <strong>{{ item.nome }}</strong>
                                    </v-list-tile-title>
                                    <v-list-tile-title v-else active-class="green--text">
                                        {{ item.nome }}
                                    </v-list-tile-title>
                                </v-list-tile-content>

                                <span> {{ item.nome }} </span>
                            </v-tooltip>

                            <v-list-tile-content v-else active-class="green--text">
                                <v-list-tile-title v-if="item.ativo" active-class="green--text">
                                    <strong>{{ item.nome }}</strong>
                                </v-list-tile-title>
                                <v-list-tile-title v-else active-class="green--text">
                                    {{ item.nome }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>




                        <v-list-tile
                                v-if="!mini"
                                v-show="!subItem.permission  || $can(subItem.permission ? subItem.permission : 'public')"
                                v-for="subItem in item.filhos" :key="subItem.nome" @click=""
                                :to="subItem.rota" :exact="true"
                                active-class="green"
                                class="v-list-item"
                                v-model="subItem.ativo"
                                :value="isRouteActive(subItem)"
                        >
                            <v-list-tile-content>
                                <v-list-tile-title>{{ subItem.nome }}</v-list-tile-title>
                            </v-list-tile-content>
                            <v-list-tile-action v-if="subItem.icone">
                                <v-icon>{{ subItem.icone }}</v-icon>
                            </v-list-tile-action>
                        </v-list-tile>
                    </v-list-group>


                    <v-list-tile v-else :to="item.rota" :exact="true"
                                 v-show="!item.permission  || $can(item.permission ? item.permission : 'public')"
                                 active-class="green"
                                 class="v-list-item"
                                 v-model="item.ativo"
                                 :value="isRouteActive(item)"
                    >
                        <v-list-tile-action v-if="item.icone">
                            <v-tooltip right>
                                <v-icon slot="activator">{{ item.icone }}</v-icon>
                                <span> {{ item.nome }} </span>
                            </v-tooltip>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ item.nome }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

            </v-layout>
        </v-img>
    </v-navigation-drawer>
</template>
<script>
    import bus from '../../../modules/events/bus';

    //    import AtonBodymovin from '../components/aton-bodymovin.vue';
    //    import * as animationData from '../../../animations/logo.json';

    export default {
//        mixins:[AtonPermissions],
        name: 'aton-menu-esq',
        data() {
            return {

                show: true,
                ulAdd: false,

                loading: true,
                menuatual: 'Dashboard',

                itens: {},
                mini: false,
                drawer: true,
                left: null,

//                defaultOptions: {animationData: animationData},

//                 image: 'https://demos.creative-tim.com/vue-material-dashboard/img/sidebar-2.32103624.jpg',
                image: '/img/atonmidia/walle.jpg',
            }
        },
        mounted() {
            var self = this;

            //fica escutando troca de menu
//            bus.$on('set-menu-active', (value) => self.ajustaMenuAtual(value));
            bus.$on('update:menuesq', () => this.mudaEstadoMenuEsq());
            this.busca();
        },
        components: {},
        methods: {
            isRouteActive: function (itemAtual) {
                itemAtual.ativo = (itemAtual.componente.includes(this.$route.name) && (!this.$route.meta.isRoot)) ||
                    (itemAtual.rota === this.$route.fullPath && (this.$route.meta.isRoot));
            },
            temFilhoAtivo: function (itemAtual, incluiCheckMini = false) {
                var self = this;

                itemAtual.ativo = (_.filter(
                                    itemAtual.filhos, filtro =>
                                        (
                                            filtro.ativo == true
                                        )
                                    ).length > 0
                                  );
                if (incluiCheckMini){
                    itemAtual.ativo = itemAtual.ativo && (!self.mini);
                }

                return itemAtual.ativo;
            },

            handleAnimation: function (anim) {
                this.anim = anim;
            },
            busca: function () {
                var self = this;
                this.loading = true;
                this.$http.get('/api/i/menu/listar')
                    .then(function (response) {
                        self.itens = response.data;
                        self.loading = false;
                    })
                    .catch(function (error) {
                        self.loading = false;
                        bus.$emit('atonmsg', 'error', 'Houve um erro ao montar o menu, por favor atualize a página(F5)', 0);
                        console.log(error);
                    });
            },
            ajustaMenuAtual: function (value) {
                var tmp = value;
                // desabilita todos
                for (let k in this.dataReturn) {
                    this.dataReturn[k].ativo = false;
                }
                for (let j in this.dataReturn) {
                    // atualiza o menu ativo
                    if (this.dataReturn[j].slug == tmp) {
                        this.dataReturn[j].ativo = true;
                    }
                }
            },
            sendMudaView: function (value) {
                bus.$emit('muda-view', value);
            },
            mudaEstadoMenuEsq: function () {
                this.drawer = !this.drawer;
            },
//             abreLink: function (item) {
//                 if (item.componente != '') {
//                     for (var k in this.itens) {
//                         this.itens[k].ativo = false;
//                         if (this.itens[k].filhos != undefined) {
//                             for (var l in this.itens[k].filhos) {
//                                 this.itens[k].filhos[l].ativo = false;
//                             }
//                         }
//                     }
//                     this.$parent.viewAtual = item.componente;
//                     this.$router.push(item.rota);
//                     item.ativo = true;
//                 }
// //                console.log(item);
//             }
        },
    }
</script>

<style lang="scss">
    #app-drawer {
        .v-list__tile {
            border-radius: 4px;

            &--buy {
                margin-top: auto;
                margin-bottom: 17px;
            }
        }

        .v-image__image--contain {
            top: 9px;
            height: 60%;
        }

        .search-input {
            margin-bottom: 30px !important;
            padding-left: 15px;
            padding-right: 15px;
        }
        /*.v-responsive__content {*/
        /*background-color: #000000c2;*/
        /*}*/
    }

    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<!--<style>-->
<!--@media print-->
<!--{-->
<!--.no-print, .no-print *-->
<!--{-->
<!--display: none !important;-->
<!--}-->
<!--}-->
<!--/*.list__tile{*/-->
<!--/*cursor: pointer;*/-->
<!--/*}*/-->
<!--</style>-->
