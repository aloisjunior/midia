<template>
    <v-layout row justify-center class="hide-overflow">
        <v-dialog v-model="openDialog" fullscreen hide-overlay transition="dialog-bottom-transition" class="hide-overflow">

            <v-card :dark="this.isModeDarkForms"
                    :light="!this.isModeDarkForms" class="hide-overflow">

                <v-toolbar dark color="teal">
                    <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Monitoramento de Ponto')}}
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click.stop="setCancel()">
                            <v-icon left>mdi-close</v-icon>
                            Fechar
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>

                <v-card-text>

                    <v-expansion-panel
                            :dark="!this.isModeDarkForms"
                            :light="this.isModeDarkForms"
                            expand v-model="sessionCaptura">
                        <v-expansion-panel-content class="customHeaderExpansionDense">
                            <div slot="header">Player: <span>{{playerNome}}  -  </span>
                                <v-chip v-if="!ultimo_sinal" color="grey" text-color="white">
                                    <v-avatar>
                                        <v-icon>error</v-icon>
                                    </v-avatar>
                                    Player offline
                                </v-chip>
                                <v-chip v-else :color="selecionaCor(ultimo_sinal, data_servidor)"
                                        text-color="white">
                                    <v-avatar>
                                        <v-icon v-if="diferencaMinutos(ultimo_sinal, data_servidor) > 5">
                                            error
                                        </v-icon>
                                        <v-icon v-else>check_circle</v-icon>
                                    </v-avatar>
                                    {{ ultimoSinal(ultimo_sinal) }}
                                </v-chip>
                            </div>
                            <v-layout row wrap>
                                <v-flex d-flex lg2 md3 sm4 xs12>
                                    <v-card class="ma-2 pa-2" color="black" heigth="150px">

                                        <div>
                                            <img width="100%" :src="urlImagem"
                                                 onerror="this.src='//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg'">

                                        </div>

                                    </v-card>
                                </v-flex>
                                <v-flex d-flex lg10 md9 sm8 xs12>
                                    <v-layout row wrap>
                                        <v-flex d-flex>

                                            <v-card-text>
                                                    <span>
                                                      <h4
                                                              class="title font-weight-light"
                                                              v-text="downloads"
                                                      />
                                                        <h4
                                                                class="category font-weight-thin">
                                                           Versão do APP: {{ player && player.app_version}}
                                                        </h4>
                                                        <h4 class="category font-weight-thin">
                                                        Último reinicio: {{player && (player.ultimo_reinicio ||'Aguardando' | formatDate) }}
                                                        </h4>
                                                    </span>
                                            </v-card-text>

                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>

                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-card-text>
                <v-card-text>


                    <v-tabs
                            v-model="tabs"
                            color="purple"
                            slider-color="white"
                            dark


                    >
                        <v-tab
                                href="#tab1"

                        >
                            Logs
                        </v-tab>
                        <v-tab
                                href="#tab2"

                        >
                            Downloads
                        </v-tab>
                    </v-tabs>
                    <v-divider></v-divider>
                    <v-tabs-items v-model="tabs">
                        <v-tab-item
                                value="tab1"
                        >
                            <div
                                    class="hide-overflow"
                                    style="position: relative;"
                            >
                                <v-toolbar dense
                                           color="purple"
                                           absolute
                                           dark
                                           scroll-off-screen
                                           scroll-target="#scrolling-techniques"
                                >
                                    <v-toolbar-title class="font-weight-light ">Ações</v-toolbar-title>

                                    <v-spacer></v-spacer>
                                    <v-text-field
                                            hide-details
                                            prepend-inner-icon="search"
                                            v-model="search"
                                            single-line
                                    ></v-text-field>
                                    <v-tooltip content-class="left" left>
                                        <v-btn
                                                icon
                                                slot="activator"
                                                @click.stop="resetApp()">
                                            <v-icon>exit_to_app</v-icon>
                                        </v-btn>
                                        <span>Reiniciar player</span>
                                    </v-tooltip>
                                    <v-tooltip content-class="left" left>
                                        <v-btn
                                                icon
                                                slot="activator"
                                                @click.stop="excluirLogsAtuais()">
                                            <v-icon>delete</v-icon>
                                        </v-btn>
                                        <span>Excluir logs atuais</span>
                                    </v-tooltip>
                                </v-toolbar>

                                <v-divider></v-divider>

                                <div
                                        id="scrolling-techniques"
                                        class="scroll-y"
                                        style="max-height: 500px;"

                                >
                                    <v-container style="height: 500px; padding-top: 50px">
                                        <v-data-table
                                                :headers="headers"
                                                :items="items"
                                                item-key="id"
                                                hide-actions
                                                v-bind:search="search"
                                                no-data-text="Aguardando envio de novos logs."
                                                v-bind:pagination.sync="pagination"
                                                pa-3
                                                :hide-headers="!items.length"

                                        >
                                            <template slot="items" slot-scope="props">
                                                <td>{{ props.item.horario }}</td>
                                                <td class="hidden-sm-and-down">{{ props.item.descricao }}</td>
                                                <td>{{ props.item.conteudo_nome }}</td>
                                                <td class="hidden-sm-and-down">{{ props.item.tipo_conteudo }}
                                                </td>
                                                <td class="hidden-sm-and-down">{{ props.item.tipo_log }}</td>
                                            </template>
                                        <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>
                                    </v-container>
                                </div>

                            </div>
                        </v-tab-item>
                        <v-tab-item
                                value="tab2"
                        >
                            <div
                                    class="hide-overflow"
                                    style="position: relative;"
                            >
                                <v-toolbar dense
                                           absolute
                                           scroll-off-screen
                                           color="purple"
                                           dark
                                           scroll-target="#scrolling-techniques2">
                                    <v-toolbar-title class="font-weight-light ">Downloads</v-toolbar-title>

                                    <v-spacer></v-spacer>
                                    <v-tooltip content-class="left" left>
                                        <v-btn v-show="false"
                                               icon
                                               slot="activator"
                                               @click.stop="reloadDownloads()">
                                            <v-icon>refresh</v-icon>
                                        </v-btn>
                                        <span>Forçar download</span>
                                    </v-tooltip>

                                </v-toolbar>

                                <v-divider></v-divider>
                                <div
                                        id="scrolling-techniques2"
                                        class="scroll-y"
                                        style="max-height: 500px;"

                                >
                                    <v-container style="height: 500px; padding-top: 50px">
                                        <v-data-table
                                                v-model="selected"
                                                :headers="headersDownload"
                                                :items="itemsDownloads"
                                                item-key="id"
                                                hide-actions
                                                select-all
                                                no-data-text="Aguardando dados."
                                                pa-3
                                                :hide-headers="!items.length"
                                        >

                                            <template slot="items" slot-scope="props">

                                                <td>
                                                    <v-checkbox
                                                            v-model="props.selected"
                                                            primary
                                                            hide-details
                                                    ></v-checkbox>
                                                </td>
                                                <td class="text-xs-left">{{ props.item.nome }}</td>


                                                <td class="text-xs-center">
                                                            <span v-if="(getValueProgress(props.item) > 0) && (getValueProgress(props.item) < 100)">
                                                                    {{'Em andamento: ' + Number(getValueProgress(props.item)).toFixed(1) + '% realizado'}}
                                                                </span>
                                                    <span v-else>
                                                                {{props.item.data_download ? 'Concluído em: ' + props.item.data_download: ((props.item.tipo_conteudo == 'url')||(props.item.tipo_conteudo == 'streaming')) ? 'Links não requerem download' : 'Aguardando início de download'}}
                                                            </span>

                                                    <v-progress-linear
                                                            v-if="(((getValueProgress(props.item) > 0) && (getValueProgress(props.item) < 100)) &&((props.item.tipo_conteudo !='url')||(props.item.tipo_conteudo != 'streaming')))"
                                                            color='info'
                                                            height="5"
                                                            :value="getValueProgress(props.item)"
                                                    ></v-progress-linear>
                                                    <v-progress-linear v-else
                                                                       :color='((getValueProgress(props.item) == 0) && ((props.item.tipo_conteudo !="url")&&(props.item.tipo_conteudo != "streaming")))  ? "red" : "success"'
                                                                       height="5"
                                                                       :value="getValueProgress(props.item)"
                                                    ></v-progress-linear>
                                                </td>

                                                <td class="text-xs-left hidden-sm-and-down">
                                                    <span v-show="props.item.validade_de">
                                                        Vencimento: {{props.item.validade_de}}
                                                    </span>
                                                    <span v-show="props.item.validade_ate">
                                                        {{' <-> ' + props.item.validade_ate}}
                                                    </span>

                                                    <br v-show="props.item.validade_de || props.item.validade_ate">

                                                    <span v-for="agenda in props.item.agendamento">
                                                        {{agenda.dias}} : {{agenda.hora_inicio + ' <-> ' + agenda.hora_fim}}<br>
                                                    </span>
                                                </td>

                                            </template>
                                        <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>
                                    </v-container>
                                </div>
                            </div>
                        </v-tab-item>
                    </v-tabs-items>


                </v-card-text>

            </v-card>


        </v-dialog>
    </v-layout>
</template>

<!--<td class="text-xs-center">-->
<!--<v-icon color="green" v-if="props.item.data_download">lens</v-icon>-->

<!--<v-icon color="red" v-else>lens</v-icon>-->
<!--</td>-->
<script>
    import AtonBaseForm from '../aton-base-form.vue';

    export default {
        mixins: [
            // AtonCssLoader,
            AtonBaseForm,
        ],
        props: {
            openDialog: {
                default: false,
                type: Boolean,
            },
            playerNome: {
                default: '',
                type: String
            },
            playerId: {
                default: 0,
                type: Number
            },
            tokenId: {
                default: '',
                type: String
            },
        },
        name: 'aton-player-monitor',
        data() {
            return {

                headers: [
                    {text: 'Horario', value: 'horario'},
                    {text: 'Descrição', value: 'descricao', class: 'hidden-sm-and-down'},
                    {text: 'Conteúdo', value: 'conteudo_nome'},
                    {text: 'Tipo', value: 'tipo_conteudo', class: 'hidden-sm-and-down'},
                    {text: 'Categoria', value: 'tipo_log', class: 'hidden-sm-and-down'},
                ],

                headersDownload: [
                    {text: 'Arquivo', value: 'nome', align: 'left', width: '30%'},
                    {text: 'Status', value: 'status', align: 'center'},
                    {text: 'Agendamentos', value: '', align: 'left', class: 'hidden-sm-and-down', width: '30%'},
                ],

                progressoDownload: 0,

                selected: [],

                items: [],
                itemsDownloads: [],
                urlImagem: '',

                search: '',

                sessionCaptura: [true],

                ultimo_sinal: 0,
                data_servidor: 0,

                data_inicio: 0,
                pagination: {'sortBy': 'horario', 'descending': true, 'rowsPerPage': -1},

                varTimerDados: null,
                varTimerImagem: null,
                varTimerCapturaTela: null,

                downloads: 'Downloads: 0 / ?',

                tabs: null,

                player: {
                    app_version: 'Aguardando'
                },
            }
        },
        mounted() {

        },
        methods: {
            startCapturaTela: function () {
                if (!this.openDialog) {
                    return false;
                }

                let self = this;
                // this.loading = true;
                this.$http.get('/api/e/signage/' + this.tokenId + '/send/captura_tela')
                    .then(response => {
                        // console.log(response);
                        clearTimeout(self.varTimerCapturaTela);

                        if (!this.openDialog) {
                            return false;
                        }

                        self.varTimerCapturaTela = setTimeout(function () {
                            self.startCapturaTela();
                        }, 15000);
                    })
                    .catch(error => {
                        console.log(error.response);
                        clearTimeout(self.varTimerCapturaTela);
                        self.varTimerCapturaTela = setTimeout(function () {
                            self.startCapturaTela();
                        }, 15000);
                    });
            },
            resetApp: function () {
                let self = this;
                // this.loading = true;
                this.$http.get('/api/e/signage/' + this.tokenId + '/send/reset_app')
                    .then(response => {
                        // console.log(response);
                        // self.loading = false;

                        // self.data_servidor = response.data.hora_servidor;
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            },
            deleteCaptura: function () {
                let self = this;
                // this.loading = true;
                this.$http.get('/api/e/signage/' + this.playerId + '/captura/destroy')
                    .then(response => {
                        // console.log(response);
                        // self.loading = false;

                        // self.data_servidor = response.data.hora_servidor;
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            },
            excluirLogsAtuais: function () {
                clearTimeout(this.varTimerDados);
                clearTimeout(this.varTimerImagem);
                this.data_inicio = 0;
                this.items = [];
                this.itemsDownloads = [];
                this.$nextTick(function () {
                    this.loadImage();
                    this.loadDados();
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
            diferencaMinutos: function (data, data_servidor) {
                var startTime = moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var endTime = moment(data_servidor, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var difference = endTime - startTime; // This will give difference in milliseconds
                return Math.round(difference / 60000);
            },
            ultimoSinal: function (data) {
                if (this.diferencaMinutos(this.ultimo_sinal, this.data_servidor) > 10) {
                    return 'Player offline';
                } else {
                    return 'Último contato a ' + moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]).from(this.data_servidor, true);
                }
            },

            setOk: function () {
                this.$emit('setOk');
                this.setCancel();
            },
            setCancel: function () {
                this.data_inicio = 0;
                this.ultimo_sinal = 0;
                this.downloads = 'Downloads: 0 / ?';
                this.items = [];
                this.player = null;

                clearTimeout(this.varTimerDados);
                clearTimeout(this.varTimerImagem);
                clearTimeout(this.varTimerCapturaTela);
                this.$emit('setCancel', false);
            },
            loadDados: function () {
                if (!this.openDialog) {
                    return false;
                }
                let self = this;
                // this.loading = true;
                // let tmpData = this.data_inicio;

                this.$http.post('/admin/player/' + this.playerId + '/logs/listar', {'data_inicio': this.latestDateSave})
                    .then(response => {
                        // console.log(response);
                        // self.loading = false;
                        if (!this.openDialog) {
                            return false;
                        }

                        let newData = response.data.data;

                        if ((this.items.length) && (newData)) {
                            let novosItens = this.items.concat(newData);

                            // this.$nextTick(function () {

                            this.$nextTick(function () {
                                this.items = novosItens.unique();
                                // this.data_inicio = this.getLatestDateSave(this.items, this.data_inicio);
                                var self = this;
                                clearTimeout(this.varTimerDados);
                                this.varTimerDados = setTimeout(function () {
                                    self.loadDados();
                                }, 9000);
                            });

                            // });
                        } else {
                            // this.$nextTick(function () {
                            this.$nextTick(function () {
                                this.items = response.data.data;
                                // this.data_inicio = this.getLatestDateSave(this.items, this.data_inicio);
                                var self = this;
                                clearTimeout(this.varTimerDados);
                                this.varTimerDados = setTimeout(function () {
                                    self.loadDados();
                                }, 9000);
                            });
                            // });
                        }


                        this.player = response.data.player;


                        if (response.data.player.playlist) {
                            this.itemsDownloads = response.data.player.playlist;
                        } else {
                            this.itemsDownloads = [];
                        }


                        this.ultimo_sinal = response.data.player.ultimo_sinal;
                        this.data_servidor = response.data.hora_servidor;

                        // this.data_inicio = this.getLatestDateSave(this.items);

                        // if (this.data_inicio == 0) {
                        //     this.data_inicio = response.data.data_inicio;
                        // }

                        this.downloads = 'Downloads: ' + response.data.player.download_concluido + ' / ' + response.data.player.download_total;


                        // this.data_servidor = response.data.hora_servidor;
                    })
                    .catch(error => {
                        console.log(error.response);
                        clearTimeout(this.varTimerDados);
                        this.varTimerDados = setTimeout(function () {
                            this.loadDados();
                        }, 15000);
                    })
                    .finally(() => {
                        // var self = this;
                        // // clearTimeout(this.varTimerDados);
                        // this.varTimerDados = setTimeout(function () {
                        //     self.loadDados();
                        // }, 9000);


                        // let tmp = self.data_inicio;
                        // this.$nextTick(function () {
                        //     var self = this;
                        //     clearTimeout(this.varTimerDados);
                        //     this.varTimerDados = setTimeout(function () {
                        //         self.loadDados();
                        //     }, 9000);
                        // });


                    });
            },


            loadImage: function () {
                if (!this.openDialog) {
                    return false;
                }
                // if (this.diferencaMinutos(this.ultimo_sinal, this.data_servidor) > 10) {
                if ((this.ultimo_sinal == 0) || (this.diferencaMinutos(this.ultimo_sinal, this.data_servidor) > 10)) {
                    this.urlImagem = '//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg';
                } else {
                    this.urlImagem = '//cdn.rothermel.com.br/players/screenshot/' + this.tokenId + '.jpg?' + new Date().getTime();
                }

                let self = this;
                clearTimeout(self.varTimerImagem);
                self.varTimerImagem = setTimeout(function () {
                    self.loadImage();
                }, 10000);
            },
            getValueProgress: function (item) {
                let tmpVar = 0;
                // console.log(item);
                if ((item.fileSizeLocalTmp > 0) || (item.fileSizeLocal > 0)) {
                    tmpVar = ((item.fileSizeLocalTmp > 0 ? item.fileSizeLocalTmp : item.fileSizeLocal) / item.size) * 100;
                }
                // console.log(tmpVar);
                return tmpVar;
            },
        },
        watch: {

            openDialog: function (val, old) {
                if (val !== old) {
                    if (val) {
                        if (this.diferencaMinutos(this.ultimo_sinal, this.data_servidor) > 10) {
                            this.urlImagem = '//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg';
                        }

                        this.deleteCaptura();
                        this.loadImage();
                        this.loadDados();
                        this.startCapturaTela();
                    } else {
                        clearTimeout(this.varTimerDados);
                        clearTimeout(this.varTimerImagem);
                        clearTimeout(this.varTimerCapturaTela);


                        this.data_inicio = 0;
                        this.ultimo_sinal = 0;
                        this.downloads = 'Downloads: 0 / ?';
                        this.player = null;


                        this.items = [];
                        this.itemsDownloads = [];
                        this.urlImagem = '//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg';

                    }
                }
            }
        },
        computed: {
            latestDateSave: function () {
                var xs = this.items;
                var result = 0;
                if (xs.length && (xs.length > 0)) {
                    let logsRegs = xs.map(function (registro) {
                        return moment(registro.horario, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                    });
                    result = moment.max(logsRegs).format('YYYY-MM-DD HH:mm:ss');  // '11.01.1993'
                } else {
                    result = ((this.data_servidor !== 0) && (this.data_inicio === 0)) ? this.data_servidor : (this.data_inicio === 0) ? moment().format('YYYY-MM-DD HH:mm:ss') : this.data_inicio;  // '11.01.1993'

                    if (this.data_inicio === 0) {
                        this.data_inicio = result;
                    }

                }

                return result;
            },
        }
    }
</script>

<style scoped="scoped">
    /*@keyframes anim {*/
    /*0% {*/
    /*background-color: yellow;*/
    /*}*/
    /*100% {*/
    /*background-color: #fff;*/
    /*}*/
    /*}*/

    /*tr {*/
    /*animation: anim 5s ease;*/
    /*}*/

    @media print {
        .app-core.v-dialog {
            overflow: auto;
            height: auto;
        }

        body,
        .scroll-y {
            overflow: visible !important;
            height: auto !important;
        }
    }

    .v-progress-linear {
        /*background: transparent;*/
        margin: 0.3rem 0;
        /*overflow: hidden;*/
        /*width: 100%;*/
        /*position: relative;*/
    }

    /*
    <v-img :src="urlImagem" aspect-ratio="1.7"
    @error="urlImagem='//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg'"></v-img>

    <v-img :src="urlImagem" aspect-ratio="1.7"
                                                           lazy-src="//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg"
                                                           @error="urlImagem='//cdn2.rothermel.com.br/img/atonmidia/no-print-screen.jpg'"></v-img>

    */
</style>