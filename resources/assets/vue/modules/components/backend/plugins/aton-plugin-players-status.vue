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
                <h4 class="title font-weight-light pa-2 mx-3">Players Status</h4>
                <v-divider class=""></v-divider>
                <v-expansion-panel :popout="playersRevisar > 0" class="elevation-0 px-2" v-model="panel"
                                   :readonly="(playersRevisar <= 0)">
                    <v-expansion-panel-content class="customHeaderExpansionDense">
                        <v-icon slot="actions"
                                color="primary"
                                v-show="playersRevisar > 0"
                        >{{$vuetify.icons.expand}}</v-icon>
                        <div slot="header">
                            <p class="category d-inline-flex font-weight-light" v-if="playersRevisar > 0">
                                <v-icon
                                        color="error"
                                        small
                                >
                                    mdi-access-point-network-off
                                </v-icon>
                                <span class="error--text px-1">{{playersRevisar}}</span>players precisam ser verificados</p>
                            <p class="category d-inline-flex font-weight-light" v-else>
                                <v-icon
                                        color="success"
                                        small
                                >
                                    mdi-access-point-network
                                </v-icon>
                                <span class="success--text px-1">{{playersOnline}}</span>players online</p>
                        </div>
                        <v-divider v-show="playersRevisar > 0"></v-divider>
                        <v-sheet class="ma-1" v-show="playersRevisar > 0">

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

                        hide-details label="Atualizar em 30 segundos"
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
                name: 'aton-plugin-players-status',

                dadosGrafico: {
                    data: {
                        labels: ['Online', 'Verificar'],
                        series: [
                            {meta: "Total Online", className: "playerOk", name: "players ok", data: [1]},
                            {meta: "Total com problemas", className: "playerOff", name: "não respondem", data: [0]},
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
                autoRefresh: false,
                timerHabilitado: false,
                pesquisa: {
                    filtro: '*',
                },

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
            alturaGrafico() {
                // console.log(this.$vuetify.breakpoint);

                if (this.$vuetify.breakpoint.smAndDown){
                    return '240';
                }else{
                    return '320';
                }
            },
            playersPendentes() {
                return this.listPlayers.filter(item => {
                    return this.diferencaMinutos(item.ultimo_sinal, this.data_servidor) >= 15;
                });
            },
            playersOnline() {
                let self = this;
                return this.listPlayers.filter(item => {
                    return this.diferencaMinutos(item.ultimo_sinal, this.data_servidor) < 15;
                }).length;
            },
            playersRevisar() {
                let self = this;
                return this.listPlayers.filter(item => {
                    return this.diferencaMinutos(item.ultimo_sinal, this.data_servidor) >= 15;
                }).length;
            },
            playersTotal() {
                return this.listPlayers.length;
            },

            isEnabled() {
                return this.hasPlugin('players-status') && this.timerHabilitado;
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
            },

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
                    } else {
                        this.panel = null;
                    }
                }
            },

            diferencaMinutos: function (data, data_servidor) {
                var startTime = moment(data, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var endTime = moment(data_servidor, ['DD/MM/YYYY HH:mm:ss', "YYYY/MM/DD HH:mm:ss"]);
                var difference = endTime - startTime; // This will give difference in milliseconds
                return Math.round(difference / 60000);
            },

            openViewEdit: function (item) {
                this.$router.push({name: 'players-edit', params: {id: item.id, fromRoute: this.$route.path}});
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

                        let pOnline = this.playersOnline;
                        let pRevisar = this.playersRevisar;
                        let pTotal = this.playersTotal;

                        // this.$nextTick(
                        //     function () {
                        this.dadosGrafico.data.series = [
                            {meta: "Total Online", className: "playerOk", name: "players ok", data: [pOnline]},
                            {
                                meta: "Total com problemas",
                                className: "playerOff",
                                name: "não respondem",
                                data: [pRevisar]
                            },
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

