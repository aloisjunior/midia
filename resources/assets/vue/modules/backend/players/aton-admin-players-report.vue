<template>
    <material-card
            color="secondary"
            :title="getTitulo('Relatório de veiculação')"

    >
        <div class="grey lighten-3 ocultar">
            <v-layout row wrap>
                <v-flex xs4 lg4>
                    <v-card-text>
                        <img width="150px" src="//cdn2.rothermel.com.br/img/atonmidia/LogoAtonMidiaPq.png">
                    </v-card-text>
                </v-flex>
                <v-flex xs8 lg8>
                    <v-card-text>
                        <v-flex xs12 lg12>
                            <h4 class="pa-1">Player: {{ this.playerNome }}</h4>
                        </v-flex>
                        <v-flex xs12 lg12>
                            <h4 class="pa-1">Conteudo: {{ this.conteudoNome }}</h4>
                        </v-flex>
                        <v-flex xs12 lg12>
                            <h4 class="pa-1">Datas: {{ this.pesquisa._dataInicialFormatted + ' a ' +
                                this.pesquisa._dataFinalFormatted}}</h4>
                        </v-flex>
                    </v-card-text>
                </v-flex>
            </v-layout>
        </div>



        <material-search-box
                @keyup.enter.stop="loadDados()"
                color="tertiary"
        >

                <v-layout  fluid grid-list-md row wrap align-end >
                    <v-flex xs12 md3>
                        <v-menu
                                ref="menuDataInicial"
                                :close-on-content-click="false"
                                v-model="menuDataInicial"
                                :nudge-right="40"
                                lazy
                                transition="scale-transition"
                                offset-y
                                full-width
                                max-width="290px"
                                min-width="290px"
                                autofocus
                        >
                            <v-text-field
                                    class="px-1"
                                    slot="activator"
                                    v-model="dataInicialFormatted"
                                    label="Data Inicial"
                                    persistent-hint
                                    color="blue-grey lighten-2"
                                    @blur="dataInicial = parseDate(dataInicialFormatted)"
                            ></v-text-field>
                            <v-date-picker v-model="dataInicial" no-title
                                           @input="menuDataInicial = false"></v-date-picker>
                        </v-menu>
                    </v-flex>
                    <v-flex xs12 md3>
                        <v-menu
                                ref="menuDataFinal"
                                :close-on-content-click="false"
                                v-model="menuDataFinal"
                                :nudge-right="40"
                                lazy
                                transition="scale-transition"
                                offset-y
                                full-width
                                max-width="290px"
                                min-width="290px"
                        >
                            <v-text-field
                                    class="px-1"
                                    slot="activator"
                                    v-model="dataFinalFormatted"
                                    label="Data Final"
                                    persistent-hint
                                    color="blue-grey lighten-2"
                                    @blur="dataFinal = parseDate(dataFinalFormatted)"
                            ></v-text-field>
                            <v-date-picker v-model="dataFinal" no-title
                                           @input="menuDataFinal = false"></v-date-picker>
                        </v-menu>
                    </v-flex>

                    <v-flex xs12 md3>
                        <v-autocomplete
                                label="Player"
                                required
                                :items="players"
                                v-model="pesquisa.player"
                                item-value="id"
                                item-text="nome"
                                chips
                                deletable-chips
                                class="px-1"

                                no-data-text="Nenhum histórico encontrado"
                                ref="players"
                                @keyup.enter.stop=""
                                color="blue-grey lighten-2"
                                return-object
                                @change="(payload) => updatePlayerNome(payload)"
                        >
                        </v-autocomplete>
                    </v-flex>
                    <v-flex xs12 md3>
                        <v-autocomplete
                                label="Conteúdo"
                                required
                                :items="conteudos"
                                v-model="pesquisa.conteudo"
                                item-value="id"
                                item-text="nome"
                                chips
                                deletable-chips
                                class="px-1"

                                no-data-text="Nenhum histórico encontrado"
                                ref="conteudos"
                                @keyup.enter.stop=""
                                color="blue-grey lighten-2"
                                return-object
                                @change="(payload) => updateConteudoNome(payload)"
                        >
                        </v-autocomplete>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>

                    <v-flex xs12 md3>
                        <v-select
                                class="px-1"
                                label="Tipo Relatório"
                                required
                                :items="tiposRel"
                                v-model="pesquisa.tipo_relatorio"
                                chips
                                item-value="value"
                                item-text="text"
                                :loading="loading_extras"
                                hint=""
                                persistent-hint
                                no-data-text="Nenhum histórico encontrado"
                                ref="tiposRel"
                                @keyup.enter.stop=""
                                color="blue-grey lighten-2"
                        >
                        </v-select>
                    </v-flex>
                </v-layout>

            <template slot="actions">

                <v-spacer></v-spacer>
                <v-btn

                        color="blue-grey darken-1"
                        depressed


                        :disabled="loading"
                        small

                        @click="openPrint()"
                >
                    <v-icon left>mdi-printer</v-icon>
                    Imprimir
                </v-btn>

                <v-btn
                        depressed
                        :loading="loading"
                        @click="loadDados()"
                        :disabled="loading"
                        small
                >
                    <v-icon small left>mdi-update</v-icon>
                    Procurar

                </v-btn>
            </template>

        </material-search-box>


        <v-card-text>
            <v-data-table
                    :headers="headers"
                    :items="items"
                    hide-actions
                    v-bind:pagination.sync="pagination"
                    no-data-text="Nenhuma informação ainda."
                    no-results-text="Nenhum dado para os parâmetros informados."
                    pa-3
                    :rows-per-page-items="[5,10,25,{'text':'Todos','value':-1}]"
                                :hide-headers="!items.length"
                    :hide-actions="!items.length"
            >
                <template slot="items" slot-scope="props">
                    <td v-for="(value, key) in props.item">
                        {{ value }}
                    </td>
                </template>
            <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>
        </v-card-text>
    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonMsgExcluir from '../../components/aton-dialog.vue';
    import AtonPlayerMonitor from '../../components/backend/aton-player-monitor.vue';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [
            atonBaseFormEdit
        ],
        name: 'aton-admin-players-report',
        data() {
            return {


                loading: false,

                itemSelected: null,

                monitorar: false,

                menuDataInicial: null,
                menuDataFinal: null,
                dataInicial: null,
                dataInicialFormatted: null,
                dataFinal: null,
                dataFinalFormatted: null,
                pesquisa: {
                    filtro: '',
                    _dataInicial: null,
                    _dataInicialFormatted: null,
                    _dataFinal: null,
                    _dataFinalFormatted: null,
                    player: null,
                    conteudo: null,
                    tipo_relatorio: 'detalhado',
                },

                playerNome: '',
                conteudoNome: '',

                data_inicio: 0,

                search: '',
                pagination: {'rowsPerPage': -1},
                // pagination: {'sortBy': 'horario', 'descending': true, 'rowsPerPage': -1},
                headers: [
                    // {text: 'Horario', value: 'horario'},
                    // {text: 'Descrição', value: 'descricao'},
                    // {text: 'Conteúdo', value: 'conteudo_nome'},
                    // {text: 'Tipo', value: 'tipo_conteudo'},
                    // {text: 'Categoria', value: 'tipo_log', class: 'no-print'},
                ],

                items: [],
                players: [],
                conteudos: [],
                tiposRel: [
                    {text: 'Detalhado', value: 'detalhado'},
                    {text: 'Agrupado por player', value: 'group_player'},
                    {text: 'Agrupado por conteúdo', value: 'group_conteudo'}
                ],

            }
        },
        mounted() {
            var self = this;

            bus.$on('player:updated', () => self.loadDados());

            this.loadPlayers();
            this.loadConteudos();
//             setTimeout(function () {
//                 self.atualizaAuto();
//             }, 30000);

        },
        watch: {
            dataInicial(val) {
                this.dataInicialFormatted = this.formatDate(this.dataInicial)
                this.pesquisa._dataInicialFormatted = this.formatDate(this.dataInicial)
            },
            dataFinal(val) {
                this.dataFinalFormatted = this.formatDate(this.dataFinal)
                this.pesquisa._dataFinalFormatted = this.formatDate(this.dataFinal)
            }
        },
        methods: {
            updatePlayerNome: function (payload) {
                this.playerNome = payload.nome;
            },
            updateConteudoNome: function (payload) {
                this.conteudoNome = payload.nome;
            },
            openPrint: function () {
                bus.$emit('update:menuesq', false);
                this.$nextTick(function () {
                    window.print();
                });

            },

            loadPlayers: function () {
                let self = this;
                bus.$emit('atonprogress:on', 'Carregando Players');
                self.loading_extras = true;
                this.$http.post('/admin/player/listar', {filtro: '*'})
                    .then(response => {
                        self.loading_extras = false;
                        self.players = response.data.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });


            },
            loadConteudos: function () {
                let self = this;
                bus.$emit('atonprogress:on', 'Carregando Players');
                self.loading_extras = true;
                this.$http.post('/admin/playlist_conteudo/listar', {filtro: '*'})
                    .then(response => {
                        self.loading_extras = false;
                        self.conteudos = response.data.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });


            },
            formatDate(date) {
                if (!date) return null

                const [year, month, day] = date.split('-')
                return `${day}/${month}/${year}`
            },
            parseDate(date) {
                if (!date) return null

                const [day, month, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
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

            loadDados: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/player/report', this.pesquisa)
                    .then(response => {
//                        console.log(response);
                        self.loading = false;
                        self.items = response.data.logs;
                        self.headers = response.data.headers;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
        },
        components: {
            AtonMsgExcluir,
            AtonPlayerMonitor
        }
    }
</script>

<style>
    .rowMargin{
        margin: -14px -4px !important;
    }


    @media only {
        .ocultar {
            display: none !important;
        }
    }

    @media print {
        .no-print, .no-print * {
            display: none !important;
        }

        .ocultar {
            display: flex !important;
        }

        .headerAjuste {
            margin-top: -60px !important;
        }
    }

    @page {
        size: 21cm 29.7cm;
        margin: 5mm 5mm 5mm 5mm; /* change the margins as you want them to be. */
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
