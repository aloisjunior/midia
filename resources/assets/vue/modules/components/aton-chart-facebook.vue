<script>
    import bus from '../../modules/events/bus';

    export default {
        props:{
            canvasname: '',
        },
        data () {
            return {
                name: 'aton-chart-facebook',
                showfilter: false,

                show:true,
                dataReturn: [],
                descricaoconsulta: 'page_fans/lifetime',
                loading: true,
                chart: null,
                selecaoConsulta: null,
                select: { name: 'Overview', group: 'Performance', tipo: 'page_fans/lifetime' },
                items: [
                    { header: 'Performance'},
                    { name: 'Overview', group: 'Performance', tipo: 'page_fans/lifetime' },
                    { name: 'Pessoas Engajadas', group: 'Performance', tipo: 'post_consumptions_unique/lifetime' },
                    { name: 'Alcance por quem curtiu', group: 'Performance', tipo: 'post_fan_reach' },
                    { header: 'Histórias'},
                    { name: 'Geral histórias', group: 'Histórias', tipo: 'page_stories' },
                    { header: 'Impressions'},
                    { name: 'Impressões', group: 'Impressions', tipo: 'page_posts_impressions_unique' },
                    { header: 'Clicks'},
                    { name: 'Clicks gerais', group: 'Clicks', tipo: 'page_total_actions' },
                    { header: 'Reações'},
                    { name: 'Likes', group: 'Reações', tipo: 'page_actions_post_reactions_like_total' },
                    { name: 'Amei', group: 'Reações', tipo: 'page_actions_post_reactions_love_total' },
                    { name: 'Uau!', group: 'Reações', tipo: 'page_actions_post_reactions_wow_total' },
                    { name: 'Risada', group: 'Reações', tipo: 'page_actions_post_reactions_haha_total' },
                    { name: 'Triste', group: 'Reações', tipo: 'page_actions_post_reactions_sorry_total' },
                    { name: 'Bravo', group: 'Reações', tipo: 'page_actions_post_reactions_anger_total' },
                    { header: 'Views'},
                    { name: 'Views', group: 'Views', tipo: 'page_views_total' },
                    { name: 'Views de perfil logado', group: 'Views', tipo: 'page_views_logged_in_total' },
                    { header: 'Videos'},
                    { name: 'Total de exibições até 3 segundos', group: 'Videos', tipo: 'page_video_views_unique' },
                    { name: 'Total de exibições mais de 3 segundos', group: 'Videos', tipo: 'page_video_repeat_views' },
                    { name: 'Total visto até o fim ou mais de 30 segundos', group: 'Videos', tipo: 'page_video_complete_views_30s_organic' },
                ],
            }
        },
        created: function () {

        },
        mounted() {
            self = this;
            if (this.show) {
                this.selecaoConsulta = this.descricaoconsulta;
//                this.busca();
            }
//           cria evento para capturar se deve exibir componente
            bus.$on('mudarshowface', (value) => self.mudarshowface(value));

            this.$on('change', (ev) => self.cliqueSelecao());
        },
        methods: {
            cliqueselecao: function () {
                this.descricaoconsulta = this.selecaoConsulta;
                console.log(this.descricaoconsulta);
                this.busca();
            },
            busca: function () {
                var self = this;

                this.loading = true;
                this.$http.get('/api/i/facebook/metrics/' + self.descricaoconsulta)
                    .then(function (response) {
                        self.dataReturn = response.data;
                        self.loading = false;
                        self.atualizarGrafico();
                    })
                    .catch(function (error) {
                        self.loading = false;
                        console.log('Erro processando consulta de informações do Facebook');
                    });
            },
            atualizarGrafico: function () {
                var self = this;
                require('chart.js');

//                console.log(Object.keys(self.dataReturn));

                var vals = Object.values(self.dataReturn);
                var keys = Object.keys(self.dataReturn);
                'use strict';

                var randomScalingFactor = function () {
                    return Math.round(Math.random() * 100)
                };
                var lineChartData = {
                    labels: keys,
                    datasets: [
                        {
                            label: $('#consulta option:selected').text(),
                            backgroundColor: 'rgba(220,220,220,0.2)',
                            borderColor: 'rgba(220,220,220,1)',
                            pointBackgroundColor: 'rgba(220,220,220,1)',
                            pointBorderColor: '#fff',
//                            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                            data: vals
                        },
//                        {
//                            label: 'Alcance',
//                            backgroundColor: 'rgba(151,187,205,0.2)',
//                            borderColor: 'rgba(151,187,205,1)',
//                            pointBackgroundColor: 'rgba(151,187,205,1)',
//                            pointBorderColor: '#fff',
//                            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
//                        }
                    ]
                }

                var ctx = document.getElementById(self.canvasname);
                if (self.chart) {
                    self.chart.destroy();
                }


                self.chart = new Chart(ctx, {
                    type: 'line',
                    data: lineChartData,
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                    }
                });
//                chart.update();
            },
            showme: function () {
                this.show = !this.show;
            },
            mudarshowface: function (value) {
                this.show = value;
            }
        },
    }
</script>

<template>

        <v-card>
            <div class="aton-preloader" v-show="loading" style="
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 10000;
  backface-visibility: hidden;
  background: #ffffff;">
                <div class="aton-preloader-img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 99999">
                    <img src="img/atonmidia/loader.gif" style=" width: 40px;" alt="loading...">
                </div>
            </div>
            <v-card-text
                    height="150px">
                <v-layout row wrap>
                    <v-flex xs6>
                        <h5>Facebook Análise</h5>
                    </v-flex>
                    <v-flex xs6>
                        <v-select
                                label="Selecione o tipo de consulta"
                                v-bind:items="items"
                                v-model="selecaoConsulta"
                                item-text="name"
                                item-value="tipo"
                                single-line
                                bottom
                                @input="cliqueselecao()"
                        >
                            <template  slot="item" slot-scope="data">
                                <v-list-tile-content>
                                    <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                                </v-list-tile-content>
                            </template>
                        </v-select>
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-card-text>
                <canvas :id="this.canvasname">

                </canvas>
            </v-card-text>
        </v-card>

</template>

<style >

</style>