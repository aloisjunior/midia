<template>

    <v-layout wrap class="hide-overflow">
        <aton-plugin-players-status v-show="hasPlugin('players-status')"></aton-plugin-players-status>

        <aton-plugin-players-downloads v-show="hasPlugin('players-downloads')"></aton-plugin-players-downloads>

        <aton-plugin-conteudos-processamento v-show="hasPlugin('conteudos-processamento')"></aton-plugin-conteudos-processamento>







    </v-layout>

</template>

<script>
    // import AtonChartFacebook from '../components/aton-chart-facebook.vue';

    import bus from '../../modules/events/bus';

    import AtonAdminRadioPlayerView from '../../modules/backend/radio/aton-admin-radioplayer-view.vue';
    import AtonPluginPlayersStatus from '../../modules/components/backend/plugins/aton-plugin-players-status.vue';
    import AtonPluginPlayersDownloads from '../../modules/components/backend/plugins/aton-plugin-players-downloads.vue';
    import AtonPluginConteudosProcessamento from '../../modules/components/backend/plugins/aton-plugin-conteudos-processamento.vue';

    // import draggable from 'vuedraggable';

    import AtonBaseForm from '../components/aton-base-form.vue';

    export default {
        mixins: [AtonBaseForm],
        name: 'aton-admin-dashboard',
        data() {
            return {

                dataCompletedTasksChart: {
                    data: {
                        labels: ['12am', '3pm', '6pm', '9pm', '12pm', '3am', '6am', '9am'],
                        series: [
                            [23, 75, 45, 30, 28, 24, 20, 190]
                        ]
                    },
                    options: {
                        lineSmooth: false,
                        // width: 160,
                        height: 160,
                        //     this.$chartist.Interpolation.cardinal({
                        //     tension: 0
                        // })
                        // ,
                        low: 0,
                        high: 500, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        }
                    }
                },



                dailySalesChart: {
                    data: {
                        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                        series: [
                            [12, 17, 7, 17, 23, 18, 38]
                        ]
                    },
                    options: {
                        lineSmooth: this.$chartist.Interpolation.cardinal({
                            tension: 0
                        }),
                        low: 0,
                        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        },
                        height: 160,
                    }
                },
                items: [
                    {id: 1},
                    {id: 2},
                    {id: 3},
                ],

                tabs: 0,
                list: {
                    0: false,
                    1: false,
                    2: false
                },

                labels: [
                    '12am',
                    '3am',
                    '6am',
                    '9am',
                    '12pm',
                    '3pm',
                    '6pm',
                    '9pm'
                ],
                value: [
                    200,
                    675,
                    410,
                    390,
                    310,
                    460,
                    250,
                    240
                ],

            }
        },
        mounted() {
            var self = this;
            bus.$on('app-load', () => self.atualizaLayout());
        },
        methods: {
            atualizaLayout: function () {
                bus.$emit('set-menu-active', 'dashboard');
            },
            options: function () {
                return {
                    dragClass: 'dragClass',
                    group: 'items',

                };
            },

            complete(index) {
                this.list[index] = !this.list[index]
            },

        },



        components: {
            // AtonChartFacebook,
            AtonAdminRadioPlayerView,
            AtonPluginPlayersStatus,
            AtonPluginPlayersDownloads,
            AtonPluginConteudosProcessamento,
            // draggable,


        }
    }
</script>

<style>
    .aton-move {
        cursor: move;
    }

    .v-sheet--offset {
        top: -12px;
        position: relative;
    }
</style>

<!--//exemplos-->
<!--<draggable v-model="items" class="layout row wrap" :options="options()">-->

<!--<v-flex-->
<!--v-for="item in items"-->
<!--md12-->
<!--sm12-->
<!--lg4-->
<!--class="item aton-move pa-1"-->
<!--:key="item.id"-->
<!--&gt;-->
<!--<material-chart-card-->
<!--:data="pieSample.data"-->
<!--:options="pieSample.options"-->
<!--color="green"-->
<!--type="Pie"-->
<!--&gt;-->
<!--<h4 class="title font-weight-light">Players Status: {{ item.id}}</h4>-->
<!--<p class="category d-inline-flex font-weight-light">-->
<!--<v-icon-->
<!--color="error"-->
<!--small-->
<!--&gt;-->
<!--mdi-arrow-down-->
<!--</v-icon>-->
<!--<span class="error&#45;&#45;text">3</span>&nbsp;-->
<!--players precisam ser verificados-->
<!--</p>-->

<!--<template slot="actions">-->
<!--<v-icon-->
<!--class="mr-2"-->
<!--small-->
<!--&gt;-->
<!--mdi-clock-outline-->
<!--</v-icon>-->
<!--<span class="caption grey&#45;&#45;text font-weight-light">atualizado a 4 minutos</span>-->
<!--<v-spacer></v-spacer>-->
<!--<v-btn-->
<!--depressed-->
<!--:to="{name: 'players'}"-->
<!--small-->
<!--&gt;-->
<!--<v-icon small left>mdi-update</v-icon>-->
<!--Verificar-->
<!--</v-btn>-->
<!--</template>-->
<!--</material-chart-card>-->
<!--</v-flex>-->

<!--</draggable>-->

<!--<v-flex-->
        <!--md12-->
        <!--sm12-->
        <!--lg4-->
        <!--class="pa-1"-->
<!--&gt;-->

    <!--<v-card-->
            <!--class="mt-3 mx-auto"-->
            <!--max-width="400"-->
            <!--hover-->
            <!--raised-->
    <!--&gt;-->
        <!--<v-sheet-->
                <!--class="v-sheet&#45;&#45;offset mx-auto"-->
                <!--color="cyan"-->
                <!--elevation="12"-->
                <!--max-width="calc(100% - 32px)"-->
        <!--&gt;-->
            <!--<v-sparkline-->
                    <!--:labels="labels"-->
                    <!--:value="value"-->
                    <!--color="white"-->
                    <!--line-width="2"-->
                    <!--padding="16"-->
            <!--&gt;</v-sparkline>-->
        <!--</v-sheet>-->

        <!--<v-card-text class="pt-0">-->
            <!--<div class="title font-weight-light mb-2">User Registrations</div>-->
            <!--<div class="subheading font-weight-light grey&#45;&#45;text">Last Campaign Performance</div>-->
            <!--<v-divider class="mt-2"></v-divider>-->
            <!--<v-icon-->
                    <!--class="mr-2"-->
                    <!--small-->
            <!--&gt;-->
                <!--mdi-clock-->
            <!--</v-icon>-->
            <!--<span class="caption grey&#45;&#45;text font-weight-light">last registration 26 minutes ago</span>-->
        <!--</v-card-text>-->
    <!--</v-card>-->
<!--</v-flex>-->