<template>

    <v-flex
            v-if="mostrar"
            sm12
            md4
            lg4
            class="pa-1"
    >
        <material-chart-card
                v-if="mostrar"
                :data="dadosGrafico.data"
                :options="dadosGrafico.options"
                color="info"
                type="Pie"
        >
            <template slot="extra" class="mx-1">
                <h4 class="title font-weight-light pa-2 mx-3">Downloads de conteúdos</h4>
                <v-divider class=""></v-divider>
                <v-expansion-panel :popout="downloadsPendentes > 0" class="elevation-0 px-2" v-model="panel"
                                   :readonly="(downloadsPendentes <= 0)">
                    <v-expansion-panel-content class="customHeaderExpansionDense">
                        <v-icon slot="actions"
                                color="primary"
                                v-show="downloadsPendentes > 0"
                        >{{$vuetify.icons.expand}}</v-icon>
                        <div slot="header">
                            <p class="category d-inline-flex font-weight-light" v-if="downloadsPendentes > 0">
                                <v-icon
                                        color="error"
                                        small
                                >
                                    mdi-progress-download
                                </v-icon>
                                <span class="error--text px-1">{{ downloadsPendentes }}</span>downloads pendentes, listando players</p>
                            <p class="category d-inline-flex font-weight-light" v-else>
                                <v-icon
                                        color="success"
                                        small
                                >
                                    mdi-check-circle
                                </v-icon>
                                <span class="success--text px-1">{{ downloadsCompletos }}</span>downloads completos</p>
                        </div>
                        <v-divider v-show="downloadsPendentes > 0"></v-divider>
                        <v-sheet class="ma-1" v-show="downloadsPendentes > 0">

                            <v-layout align-center justify-center row fill-height>

                                <v-flex xs12 sm12>

                                    <v-chip v-if="$can('player-update')"
                                            v-for="item in playersPendentes" :key="item.id"
                                            label
                                            small
                                            class="customMarginChipLabel customCursorPointer"
                                            @click="openViewEdit(item)"
                                    >
                                        {{item.nome}}
                                    </v-chip>

                                    <v-chip v-else
                                            v-for="item in playersPendentes" :key="item.id"
                                            label
                                            small
                                            class="customMarginChipLabel"
                                    >
                                        {{item.nome}}
                                    </v-chip>
                                </v-flex>
                            </v-layout>

                        </v-sheet>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </template>
            <template slot="actions">
                <v-checkbox
                        class="ma-0"
                        hide-details

                        label="Atualizar em 30 segundos"
                        v-model="autoRefresh"
                ></v-checkbox>
                <v-spacer></v-spacer>
                <v-tooltip content-class="top" top>
                    <v-btn
                            slot="activator"
                            @click="loadDados()"

                            icon
                            small
                            :loading="loading"
                    >
                        <v-icon>mdi-update</v-icon>
                    </v-btn>
                    <span>Atualizar informações</span>
                </v-tooltip>
            </template>
        </material-chart-card>
    </v-flex>

</template>

<script>
    import bus from '../../../events/bus';
    import AtonBaseForm from '../../../components/aton-base-form.vue';

    export default {
        mixins: [
            AtonBaseForm,
        ],

        data() {
            return {
                name: 'aton-plugin-players-downloads',

                dadosGrafico: {
                    data: {
                        labels: ['Concluídos', 'Pendentes'],
                        series: [
                            {meta: "Downloads concluídos", className: "playerOk", name: "concluidos", data: [1]},
                            {meta: "Donwloads pendentes", className: "playerOff", name: "pendentes", data: [0]},
                        ]
                    },
                    options: {
                        chartPadding: 3,
                        height: 320,

                        donut: true,
                        donutWidth: 80,
                        // donutSolid: true,
                        startAngle: 270,
                        total: 2,
                        showLabel: true,
                        plugins: [this.$chartist.plugins.tooltip()]
                    }
                },
                varTimerRefresh: null,
                data_servidor: '',

                listPlayers: [],

                pesquisa: {
                    filtro: '*',
                },
                autoRefresh: false,
                timerHabilitado: false,

                mostrar: false,

                panel: null,
            }
        },
        mounted() {
            bus.$on('route:enter', (path) => this.habilitaTimer(path));
            bus.$on('route:leave', (path) => this.habilitaTimer(path, false));
            this.loadDados();
            this.$nextTick(
                function () {
                    this.mostrar = true;
                }
            );
        },

        computed: {
            playersPendentes() {
                return this.listPlayers.filter(item => {
                    return (item.download_total - item.download_concluido) > 0;
                });
            },

            downloadsCompletos() {
                let resultado = _.sumBy(this.listPlayers, 'download_concluido');

                return resultado;

                // let self = this;
                // return this.listPlayers.filter(item => {
                //     return item.download_concluido;
                // }).length;
            },
            downloadsPendentes() {
                let resultado = this.downloadsTotal - this.downloadsCompletos;

                return resultado;

                // let self = this;
                // return this.listPlayers.filter(item => {
                //     return this.diferencaMinutos(item.ultimo_sinal, this.data_servidor) >= 15;
                // }).length;
            },
            downloadsTotal() {
                let resultado = _.sumBy(this.listPlayers, 'download_total');

                return resultado;
            },

            isEnabled() {
                return this.hasPlugin('players-downloads') && this.timerHabilitado;
            },


        },

        watch: {
            autoRefresh: function (val, old) {
                if (val !== old) {
                    if (val) {
                        this.loadDados();
                    } else {
                        clearTimeout(this.varTimerRefresh);
                    }
                }
            }
        },

        methods: {
            habilitaTimer: function (path, habilita = true) {
                // console.log(this.$route.path);
                // console.log(path);
                // console.log(habilita);
                if (path == '/admin') {
                    this.timerHabilitado = habilita;

                    clearTimeout(this.varTimerRefresh);

                    if (habilita) {
                        this.loadDados();
                    }else{
                        this.panel = null;
                    }
                }
            },

            openViewEdit: function (item) {
                this.$router.push({name: 'players-edit', params: {id: item.id, fromRoute: this.$route.path}});
            },
            diferencaMinutos: function (data, data_servidor) {
                var startTime = moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var endTime = moment(data_servidor, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var difference = endTime - startTime; // This will give difference in milliseconds
                return Math.round(difference / 60000);
            },
            loadDados: function () {
                if (this.loading || !this.isEnabled) return false;
                let self = this;
                this.loading = true;

                clearTimeout(this.varTimerRefresh);

                this.$http.post('/admin/player/listar', this.pesquisa)
                    .then(response => {
                        // console.log(response);
                        this.loading = false;
                        this.listPlayers = response.data.data;
                        this.data_servidor = response.data.hora_servidor;

                        let pOnline = this.downloadsCompletos;
                        let pRevisar = this.downloadsPendentes;
                        let pTotal = this.downloadsTotal;

                        // this.$nextTick(
                        //     function () {
                        this.dadosGrafico.data.series = [
                            {meta: "Downloads concluídos", className: "playerOk", name: "concluidos", data: [pOnline]},
                            {meta: "Donwloads pendentes", className: "playerOff", name: "pendentes", data: [pRevisar]},
                        ];

                        this.dadosGrafico.options.total = pTotal * 2;
                        //     }
                        // );

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    })
                    .finally(() => {
                        if (this.autoRefresh && this.isEnabled) {
                            this.varTimerRefresh = setTimeout(function () {
                                self.loadDados();
                            }, 30000);
                        }
                    });
            },
        },

    }
</script>

<style>
</style>

