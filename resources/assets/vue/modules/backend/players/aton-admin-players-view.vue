<template>
    <material-card
            :title="getTitulo('Cadastro de Players')"
    >
        <template slot="option">
            <v-tooltip left
                       content-class="left">

                <v-btn
                        slot="activator"
                        small

                        class="ma-0"
                        color="blue darken-4"

                        v-show="$can('player-store')"
                        @click.prevent.stop="openDialogAddInGroup()"
                >
                    <v-icon small left>mdi-youtube-creator-studio</v-icon>
                    Playlist para grupo
                </v-btn>
                <span>Incluir playlist para <br>grupo de players</span>
            </v-tooltip>

            <v-tooltip left
                       content-class="left">
                <v-btn

                        class="ma-0"
                        color="primary darken-1"
                        slot="activator"
                        small
                        v-show="$can('player-store')"
                        @click.prevent.stop="openViewAdd()"
                >
                    <v-icon small left>mdi-database-plus</v-icon>
                    Incluir
                </v-btn>
                <span>Incluir</span>
            </v-tooltip>
        </template>

        <material-search-box
                @keyup.enter.stop="loadDados()"
                color="tertiary"
        >
            <v-layout row wrap>
                <v-flex md9 sm12>
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

            <template slot="actions">
                <v-layout row wrap>
                    <v-flex sm6 xs12 text-xs-left>
                        <v-checkbox
                                hide-details
                                class="ma-0 pa-0"

                                label="Atualizar consulta a cada 30s"
                                v-model="monitorar"></v-checkbox>
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex sm6 xs12 text-xs-right>
                        <v-btn
                                :block="$vuetify.breakpoint.xsOnly"

                                :loading="loading"
                                @click="loadDados()"
                                :disabled="loading"
                                small
                        >
                            <v-icon small left>mdi-update</v-icon>
                            Procurar

                        </v-btn>
                    </v-flex>
                </v-layout>
            </template>

        </material-search-box>


        <v-container fluid mt-0 pa-1>
            <v-divider class="mt-2"></v-divider>
            <v-layout row align-center justify-space-between>
                <v-fade-transition mode="out-in">
                    <v-flex xs12
                            py-2
                            v-if="!items.length"
                            :key="1">
                        <v-alert
                                :value="true"
                                color="red lighten-1"
                                style="height:180px; border: 0;"
                                class="layout align-center justify-center row fill-height wrap white--text"
                        >
                            <v-flex xs12 text-xs-center>
                                <span class="font-weight-light title ma-1">
                                    Informe acima o que deseja localizar e atualize a consulta.
                                </span>
                                <div class="font-weight-light subheading pt-1">{{$can('player-store')? 'Para novo registro clique abaixo.' : ''}}</div>


                                <v-tooltip left
                                           content-class="left">
                                    <v-btn

                                            class="ma-2"
                                            color="primary darken-1"
                                            slot="activator"
                                            small
                                            v-show="$can('player-store')"
                                            @click.prevent.stop="openViewAdd()"
                                    >
                                        <v-icon small left>mdi-database-plus</v-icon>
                                        Incluir novo registro
                                    </v-btn>
                                    <span>Incluir</span>
                                </v-tooltip>
                            </v-flex>
                        </v-alert>
                    </v-flex>
                    <v-flex xs12
                            v-else
                            :key="2">

                            <v-layout align-center justify-space-around row fill-height pb-1>
                                <v-flex xs6 >
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                              >
                                           <v-chip
                                                   class="white--text ml-0"
                                                   color="purple darken-1"
                                                   label
                                                   small
                                           >
                                              Resultado
                                            </v-chip>
                                      </h4>
                                    </span>
                                </v-flex>
                                <v-spacer></v-spacer>
                                <v-flex class="align-center text-xs-right">
                                    <v-text-field
                                            prepend-inner-icon="search"
                                            clearable
                                            label="Filtrar resultados"
                                            single-line
                                            hide-details
                                            v-model="search"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-data-table
                                    v-bind:headers="headers"
                                    v-bind:items="items"
                                    v-bind:search="search"
                                    v-bind:pagination.sync="pagination"
                                    no-data-text="Sem dados para exibir"
                                    rows-per-page-text="Registros p/ página:"
                                    :loading="loading"
                                    :rows-per-page-items="[5,10,25,{'text':'Todos','value':-1}]"
                                :hide-headers="!items.length"
                                    :hide-actions="!items.length"
                            >


                                <template slot="items" slot-scope="props">
                                    <tr @click="props.expanded = !props.expanded">
                                        <td class=" text-xs-center">{{ props.item.id }}</td>
                                        <td class="text-xs-left fs-10">{{ props.item.nome }}<br>{{'Token: ' +
                                            props.item.token_id }}
                                        </td>
                                        <td class=" text-xs-center">
                                            <v-chip v-if="!props.item.ultimo_sinal" color="grey" text-color="white">
                                                <v-avatar>
                                                    <v-icon>error</v-icon>
                                                </v-avatar>
                                                Ainda sem contato
                                            </v-chip>
                                            <v-chip v-else
                                                    :color="selecionaCor(props.item.ultimo_sinal, data_servidor)"
                                                    text-color="white">
                                                <v-avatar>
                                                    <v-icon v-if="diferencaMinutos(props.item.ultimo_sinal, data_servidor) > 5">
                                                        error
                                                    </v-icon>
                                                    <v-icon v-else>check_circle</v-icon>
                                                </v-avatar>
                                                {{ ultimoSinal(props.item.ultimo_sinal) }}
                                            </v-chip>

                                        </td>
                                        <td class=" text-xs-center">
                                            <v-chip v-if="!props.item.ultimo_reinicio" color="grey"
                                                    text-color="white">
                                                <v-avatar>
                                                    <v-icon>error</v-icon>
                                                </v-avatar>
                                                Ainda sem informação
                                            </v-chip>
                                            <v-chip v-else
                                                    :color="selecionaCorR(props.item.ultimo_sinal, props.item.ultimo_reinicio, data_servidor)"
                                                    text-color="white">
                                                <v-avatar>
                                                    <v-icon v-if="diferencaMinutos(props.item.ultimo_reinicio, data_servidor) < 180">
                                                        error
                                                    </v-icon>
                                                    <v-icon v-else>check_circle</v-icon>
                                                </v-avatar>
                                                {{ultimoReinicio(props.item.ultimo_reinicio)}}
                                            </v-chip>
                                        </td>
                                        <td class=" text-xs-center">
                                            <v-icon color="green">android</v-icon>
                                            / {{props.item.app_version}}
                                        </td>
                                        <td class=" text-xs-center">
                                            <v-icon small v-if="props.item.ativo">check_box</v-icon>
                                            <v-icon v-else small>check_box_outline_blank</v-icon>
                                        </td>

                                        <td class="text-xs-right">
                                            <v-layout row fill-height justify-end align-center>
                                                <v-tooltip top
                                                           content-class="top">
                                                    <v-btn icon small
                                                           class="mx-0 v-btn--simple"
                                                           @click.native.stop="callResetUse(props.item)"
                                                           slot="activator"
                                                           v-show="$can('player-index')"
                                                    >
                                                        <v-icon color="warning">refresh</v-icon>
                                                    </v-btn>
                                                    <span>Reutilizar token</span>
                                                </v-tooltip>
                                                <v-tooltip top
                                                           content-class="top">
                                                    <v-btn icon small
                                                           class="mx-0 v-btn--simple"
                                                           @click.native.stop="openMonitor(props.item)"
                                                           slot="activator"
                                                           v-show="$can('player-index')"
                                                    >
                                                        <v-icon color="warning">pageview</v-icon>

                                                    </v-btn>
                                                    <span>Monitor</span>
                                                </v-tooltip>
                                                <v-tooltip top
                                                           content-class="top">
                                                    <v-btn icon small class="mx-0"
                                                           @click.native.stop="openViewEdit(props.item)"
                                                           slot="activator"
                                                           v-show="$can('player-update')"
                                                    >
                                                        <v-icon color="teal">edit</v-icon>
                                                    </v-btn>
                                                    <span>Editar</span>
                                                </v-tooltip>
                                                <v-tooltip left
                                                           content-class="left">
                                                    <v-btn icon small class="mx-0"
                                                           @click.native.stop="abreConfirma(props.item)"
                                                           slot="activator"
                                                           v-show="$can('player-destroy')"
                                                    >
                                                        <v-icon color="pink">delete</v-icon>
                                                    </v-btn>
                                                    <span>Excluir</span>
                                                </v-tooltip>
                                            </v-layout>

                                        </td>
                                    </tr>
                                </template>
                                <template slot="expand" slot-scope="props">
                                    <v-card flat>
                                        <v-card-text class="purple lighten-1">
                                            <v-card dark>
                                                <v-card-text>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md3>
                                                            <h4> Ultimo Sinal do APP: {{props.item.ultimo_sinal |
                                                                formatDate}}<br>
                                                                Ultimo Sinal do Service:
                                                                {{props.item.ultimo_sinal_service |
                                                                formatDate}}<br>
                                                                Último reinicio: {{props.item.ultimo_reinicio |
                                                                formatDate}}<br>
                                                                Versão do APP: {{props.item.app_version}}</h4>
                                                        </v-flex>
                                                        <v-flex xs12 md3>
                                                            Playlist:
                                                            <v-chip light color="secundary">
                                                                <a target="_blank"
                                                                   :href='"/admin/playlists/" + props.item.playlistatual.id + "/edit"'>
                                                                    {{props.item.playlistatual.nome}}
                                                                </a>
                                                            </v-chip>

                                                        </v-flex>
                                                    </v-layout>
                                                </v-card-text>
                                            </v-card>
                                        </v-card-text>
                                    </v-card>
                                </template>

                            <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>

                    </v-flex>
                </v-fade-transition>
            </v-layout>
        </v-container>


        <aton-msg-excluir
                @setOk="excluirRegistro()"
                @setCancel="val => openDialogExcluir = val"
                :openDialog="openDialogExcluir"
        ></aton-msg-excluir>


        <aton-player-monitor
                @setCancel="val => openDialogMonitor = val"
                :openDialog="openDialogMonitor"
                :playerId="playerId"
                :playerNome="playerNome"
                :tokenId="tokenId"
        ></aton-player-monitor>

        <aton-admin-players-setplaylistgroup
                @setOk="(dados) => atualizaPlaylists(dados)"
                @setCancel="val => openDialogSetPlaylist = val"
                :openDialog="openDialogSetPlaylist"
        ></aton-admin-players-setplaylistgroup>

    </material-card>
</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonMsgExcluir from '../../components/aton-dialog.vue';
    import AtonPlayerMonitor from '../../components/backend/aton-player-monitor.vue';
    import AtonAdminPlayersSetplaylistgroup from './aton-admin-players-setplaylistgroup.vue';
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins: [
            // AtonCssLoader,
            AtonBaseForm,
        ],
        name: 'aton-admin-players-view',
        data() {
            return {
                loading: false,

                itemSelected: null,

                monitorar: false,

                data_servidor: '',


                pesquisa: {
                    filtro: '*',
                },

                openDialogExcluir: false,
                openDialogMonitor: false,
                openDialogSetPlaylist: false,
                playerId: 0,
                playerNome: '',

                tokenId: '',

                search: '',
                pagination: {'rowsPerPage': -1, 'sortBy': 'ultimo_sinal', 'descending': true},
                headers: [
                    {text: 'Id', value: 'id', align: 'center'},
                    {text: 'Nome', value: 'nome', align: 'left'},
                    {text: 'Status', value: 'ultimo_sinal', align: 'center'},
                    {text: 'Último Reinicio', value: 'ultimo_reinicio', align: 'center'},
                    {text: 'S.O. / Versão App', value: 'app_version', align: 'center'},
                    {text: 'Ativo', value: 'ativo', align: 'center'},
                    {text: 'Ações', value: '', align: 'right', sortable: false},
                ],
                items: []
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
            atualizaPlaylists: function(dados){
                this.openDialogSetPlaylist = false;

                let self = this;

                this.loading = true;
                this.$http.post('/admin/player/playlist/update/group', dados)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('atonmsg', 'success', msg);
                        self.loadDados();

                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.errors = error.response.data;
                    });

              // this.$nextTick(function () {
              //     this.loadDados();
              // });
            },
            callResetUse: function (item) {
                let self = this;
                if (this.loading) return false;

                this.loading = true;
                this.$http.get('/admin/player/' + item.id + '/reutilizar')
                    .then(response => {
                        self.loading = false;

                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'success', 'Token pronto para reutilização');
                    })
                    .catch(error => {
                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'error', 'Não foi possível atualizar o token');

                        self.loading = false;
                    });

            },
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

            selecionaCorR: function (ultimosinal, datareinicio, data_servidor) {
                let dif = this.diferencaMinutos(datareinicio, data_servidor);
                let difSinal = this.diferencaMinutos(ultimosinal, data_servidor);

                let offline = (difSinal > 60);


                if ((dif > 120) && (!offline)) {
                    return "green";
                } else {
                    if ((dif > 60) && (!offline)) {
                        return "yellow"
                    }
                }

                return "red";

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
            ultimoSinal: function (data) {
                return 'Último contato a ' + moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]).from(this.data_servidor, true);
            },
            ultimoReinicio: function (data) {
                return 'Reiniciou a ' + moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]).from(this.data_servidor, true);
            },

            openMonitor: function (item) {
                this.playerId = item.id;
                this.playerNome = item.nome;
                this.tokenId = item.token_id;
                this.openDialogMonitor = true;
            },

            openDialogAddInGroup: function () {
                this.openDialogSetPlaylist = true;
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
            AtonMsgExcluir,
            AtonPlayerMonitor,
            AtonAdminPlayersSetplaylistgroup
        }
    }
</script>

<style>

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

    /*:light="this.$userAtivo.config.tema_formularios != 'Escuro'"*/
</style>

<!--<v-tooltip left-->
<!--content-class="left">-->
<!--<v-btn-->
<!--class="ma-0"-->
<!--color="primary"-->
<!--:dark="!this.isModeDarkForms"-->
<!--:light="this.isModeDarkForms"-->
<!--slot="activator"-->
<!--icon-->
<!--small-->
<!--v-show="$can('player-store')"-->
<!--@click.prevent.stop="openViewAdd()"-->
<!--&gt;-->
<!--<v-icon small left>mdi-database-plus</v-icon>-->
<!--</v-btn>-->
<!--<span>Incluir</span>-->
<!--</v-tooltip>-->