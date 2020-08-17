<template>
    <v-card>
        <v-toolbar
                   prominent
                   dark color="secondary" class=" white--text">
            <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Monitoramento de Players')}}</v-toolbar-title>
            <v-fab-transition>
                <v-btn
                        class="blue"
                        fab
                        dark
                        small
                        absolute
                        bottom
                        right
                        v-show="$can('player-store')"
                        @click.prevent.stop="openViewAdd()"
                >
                    <v-icon small left>mdi-database-plus</v-icon>
                </v-btn>
            </v-fab-transition>
        </v-toolbar>


            <v-card-text @keyup.enter.stop="loadDados()"  class="elevation-1">
                <v-layout row wrap>
                    <v-flex xs9 sm8>
                        <v-text-field
                                ref='edtPesquisa'
                                label="Insira o que deseja procurar no banco"
                                value=""
                                hint="Exemplo, nome ou email"
                                v-model="pesquisa.filtro"
                                persistent-hint
                                autofocus
                        ></v-text-field>
                    </v-flex>

                </v-layout>
                <v-flex xs12 sm12>
                    <v-btn
                            round
                            color="primary"
                            :loading="loading"
                            @click="loadDados()"
                            :disabled="loading"
                    >
                        Procurar

                    </v-btn>
                </v-flex>
                <v-flex xs12 sm12>
                    <v-checkbox green
                                label="Atualizar automaticamente (30s)"
                                v-model="monitorar"   ></v-checkbox>
                </v-flex>
            </v-card-text>

        <v-card-title>
            Resultados
            <v-spacer></v-spacer>
            <v-text-field
                    append-icon="search"
                    label="Filtrar resultados"
                    single-line
                    hide-details
                    v-model="search"
            ></v-text-field>
        </v-card-title>
        <v-card-text>

            <v-container fluid grid-list-md>
                <v-data-iterator
                        :items="items"
                        :rows-per-page-items="rowsPerPageItems"
                        :pagination.sync="pagination"
                        v-bind:search="search"
                        content-tag="v-layout"
                        row
                        wrap
                >
                    <v-flex
                            slot="item"
                            slot-scope="props"
                            xs6
                            sm6
                            md2
                            lg2
                    >
                        <v-card>
                            <v-card-media
                                    src="/img/atonmidia/tela_monitor.png"
                                    contain
                            >
                                <v-container fluid >
                                    <v-layout heigth="180px">
                                        <v-flex sm12 xs12 align-end flexbox>
                                            <span>{{ props.item.nome }}</span>
                                        </v-flex>
                                    </v-layout>
                                </v-container>

                            </v-card-media>
                            <v-card-actions >
                                <v-flex xs12 sm12>
                                    <v-chip v-if="!props.item.ultimo_sinal" color="grey" text-color="white">
                                        <v-avatar>
                                            <v-icon>error</v-icon>
                                        </v-avatar>
                                        Ainda sem contato
                                    </v-chip>

                                    <v-chip v-else :color="selecionaCor(props.item.ultimo_sinal, data_servidor)"
                                            text-color="white">
                                        <v-avatar>
                                            <v-icon v-if="diferencaMinutos(props.item.ultimo_sinal, data_servidor) > 5">
                                                error
                                            </v-icon>
                                            <v-icon v-else>check_circle</v-icon>
                                        </v-avatar>
                                        {{ ultimoSinal(props.item.ultimo_sinal, true) }}
                                    </v-chip>
                                </v-flex>
                            </v-card-actions>

                        </v-card>
                    </v-flex>

                    <v-toolbar
                            slot="footer"
                            class="mt-2"
                            color="indigo"
                            dark
                            dense
                            flat
                    >
                        <v-toolbar-title class="subheading">This is a footer </v-toolbar-title>
                    </v-toolbar>
                </v-data-iterator>
            </v-container>
        </v-card-text>

        <aton-msg-excluir
                @setOk="excluirRegistro()"
                @setCancel="val => openDialogExcluir = val"
                :openDialog="openDialogExcluir"
        ></aton-msg-excluir>

    </v-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonMsgExcluir from '../../components/aton-dialog.vue';

    export default {
        data() {
            return {
                name: 'aton-admin-players-monitor',

                loading: false,

                itemSelected: null,

                monitorar: false,

                pesquisa: {
                    filtro: '',
                },

                openDialogExcluir: false,

                data_servidor: '',

                search: '',

                headers: [
                    {text: 'Id', value: 'id', align: 'center'},
                    {text: 'Nome', value: 'nome', align: 'left'},
                    {text: 'Status', value: 'ultimo_sinal', align: 'center'},
                    {text: 'S.O.', value: 'tipo_cliente', align: 'center'},
                    {text: 'Ativo', value: 'ativo', align: 'center'},
                    {text: 'Ações', value: '', align: 'right', sortable: false},
                ],
                items: [],

                rowsPerPageItems: [8, 16, 20],
                pagination: {
                    rowsPerPage: 20
                },
            }
        },
        mounted() {
            var self = this;

            bus.$on('player:updated', () => self.loadDados());

//            this.loadDados();
            setTimeout(function () {
                self.atualizaAuto();
            }, 30000);

        },
        watch: {
            // monitorar: function () {
            //     if (monitorar){
            //         this.loadDados();
            //         set
            //     }
            // }
        },
        methods: {
            selecionaIcone: function (data, data_servidor) {
                var dif = this.diferencaMinutos(data, data_servidor);

                if (dif > 60) {
                    return error;
                }

                return check_circle;
            },
            selecionaCor: function (data, data_servidor) {
                var dif = this.diferencaMinutos(data, data_servidor);

                if (dif > 1440) {
                    return "red";
                } else {
                    if (dif > 60) {
                        return "blue";
                    } else {
                        if (dif > 5) {
                            return "yellow"
                        }
                    }
                }
                return "green";

            },
            diferencaMinutos: function (data, data_servidor) {
                var startTime = moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var endTime = moment(data_servidor, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var difference = endTime - startTime; // This will give difference in milliseconds
                return Math.round(difference / 60000);
            },
            atualizaAuto: function () {
                if (this.monitorar) {
                    this.loadDados();
                }
                ;
                var self = this;
                setTimeout(function () {
                    self.atualizaAuto();
                }, 30000);

            },
            ultimoSinal: function (data, compact = false) {
                if (compact) {
                    return moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]).from(this.data_servidor, true);
                } else {
                    return 'Último contato a ' + moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]).from(this.data_servidor, true);
                }
            },

            openViewAdd: function (item) {
                this.$router.push({name: 'players-add'});
            },
            openViewEdit: function (item) {
                this.$router.push({name: 'players-edit', params: {id: item.id}});
            },
            loadDados: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/player/listar', this.pesquisa)
                    .then(response => {
                        // console.log(response);
                        self.loading = false;
                        self.items = response.data.data;
                        self.data_servidor = response.data.hora_servidor;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
            abreConfirma: function (item) {
                this.itemSelected = item;
                this.openDialogExcluir = true;
            },
            excluirRegistro: function () {
                let self = this;
                if (this.loading) return false;

                this.loading = true;
                this.$http.get('/admin/player/' + self.itemSelected.id + '/destroy')
                    .then(response => {
                        self.loading = false;

                        let index = self.items.indexOf(self.itemSelected);
                        self.items.splice(index, 1);

                        let msg = response.data;

                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'success', 'Registro excluido');

                        self.itemSelected = null;
                    })
                    .catch(error => {
                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'error', 'Não foi possível excluir o registro');

                        self.loading = false;
                    });

            }
        },
        components: {
            AtonMsgExcluir
        }
    }
</script>

<style>

    /*<img class="img-fluid"*/
    /*src="/img/atonmidia/tela_monitor.png"*/
    /*width="100%"*/
    /*alt="">*/
    .atonBack {
        background-image: url(/img/atonmidia/tela_monitor.png);
        background-size: cover;
    }

    .fontAton9 {
        font-size: 9;
    }

    .card--flex-toolbar {
        margin-top: -64px;
    }

    .custom-loader {
        animation: loader 1s infinite;
        display: flex;
    }

    @-moz-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @-o-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }


</style>