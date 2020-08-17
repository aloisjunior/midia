<template>
    <material-card

            :title="getTitulo('Player AtonMidia')"
    >
        <v-speed-dial
                v-model="fabAddEdit"
                small
                absolute
                slot="option"
                bottom
                right
                fab
                direction="left"
                transition="slide-y-reverse-transition"
                v-show="temRadioSelecionada"

        >
            <v-btn
                    slot="activator"
                    color="blue darken-2"
                    dark
                    fab
                    hover
                    icon
                    v-model="fabAddEdit"

            >
                <v-icon class="d-inline-flex" v-if="!playing">play_arrow</v-icon>
                <v-icon class="d-inline-flex" v-else>equalizer</v-icon>
                <v-icon class="d-inline-flex">close</v-icon>
            </v-btn>
            <v-tooltip bottom>
                <v-btn
                        fab
                        dark
                        small
                        color="green"
                        @click="playRadio(null, false)"
                        v-show="temRadioSelecionada"
                        slot="activator"
                >
                    <v-icon v-if="!playing">play_arrow</v-icon>
                    <v-icon v-else>pause</v-icon>
                </v-btn>
                <span v-if="!playing">Play</span>
                <span v-else>Pausar</span>
            </v-tooltip>
            <v-tooltip bottom>
                <v-btn
                        fab
                        dark
                        small
                        color="indigo"
                        @click="pularMusica()"
                        v-show="temRadioSelecionada&&playing"
                        slot="activator"

                >
                    <v-icon>skip_next</v-icon>
                </v-btn>
                <span>Pular música</span>
            </v-tooltip>

        </v-speed-dial>

        <div class="div-progress"><v-progress-linear v-show="loading" height="3" color="success" :indeterminate="true"></v-progress-linear></div>
        <v-card-text>
            <v-layout row>
                <v-autocomplete
                        label="Selecione a estação desejada"
                        required
                        :items="estacoes"
                        item-value="id"
                        item-text="nome"
                        v-model="dadosDB.estacao"
                        chips
                        hint="Após selecionar basta clicar no play"
                        persistent-hint
                        no-data-text="Nenhum histórico encontrado"
                        ref="estacao"
                        @keyup.enter.stop=""
                        @change="(payload)=>playRadio(payload, true)">
                </v-autocomplete>

            </v-layout>
            <v-layout row>
                <audio ref="player">
                    <source :src="'http://'+dadosDB.host+':'+dadosDB.porta+'/stream'"/>
                </audio>
            </v-layout>
            <v-card-text>
                <v-slider v-model="volume" :max="10" prepend-icon="volume_up"></v-slider>
            </v-card-text>
            <v-layout row>

            </v-layout>

        </v-card-text>
    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonRules from '../../components/aton-rules';
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins: [
            AtonRules,
            AtonBaseForm,
        ],
        name: 'aton-admin-radioplayer-view',
        data() {
            return {

                loading: false,

                dadosDB: {
                    estacao: null,
                    ativo: true,
                    porta: 0,
                    host: 'a',
                },
                estacoes: [],
                fab: true,
                playing: false,
                volume: 5,
            }
        },
        mounted() {
            this.loadEstacoes();
            this.volume = 10;
        },

        activated(){
            this.loadEstacoes();
        },
        deactivated(){
            this.$refs.player.pause();
            this.playing = false;
            this.dadosDB.estacao = null;
        },

        methods: {
            loadEstacoes: function () {
                let self = this;
                bus.$emit('atonprogress:on');
                this.$http.get('/api/i/usuario/estacoes')

                    .then(response => {
                        self.loading = false;
                        self.estacoes = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            playRadio: function (payload, force) {
                if (payload) {
                    this.estacao = payload;
                }
                for (var i = 0, len = this.estacoes.length; i < len; i++) {
                    if (this.estacoes[i].id == this.estacao) {
                        this.dadosDB.host = this.estacoes[i].host;
                        this.dadosDB.porta = this.estacoes[i].porta;

                        if (!this.playing || force) {
                            this.$refs.player.load();
                            this.$refs.player.play();
                            this.playing = true;
                        } else {
                            this.$refs.player.pause();
                            this.playing = false;
                        }

                    }

                }

            },
            voltaView: function (atualizaConsulta) {

                this.$router.push({path: '/admin/radio'});
                this.$router.push({path: '/admin'});
            },
            pularMusica: function () {
                let self = this;

                self.loading =true;

//                bus.$emit('atonprogress:on');
                this.$http.get('/api/e/radio/' + self.dadosDB.estacao + '/pularmusica')
                    .then(response => {
                        self.loading = false;
                        bus.$emit('atonmsg', 'success', 'Musica alterada com sucesso, já começará a tocar!');
//                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        bus.$emit('atonmsg', 'success', 'Houve um erro ao processar seu comando!');
                        self.errors = error.response.data;
//                        bus.$emit('atonprogress:off');
                    });
            },

        },
        computed: {
            temRadioSelecionada: function () {
                return (this.dadosDB.estacao) ? true : false;
            },
//            playing: function () {
//                if (this.$refs.player!='undefined' &&
//                    this.$refs.player.currentTime > 0 &&
//                    !this.$refs.player.paused) {
//                    return true
//                } else {
//                    return false
//                    //Not playing...maybe paused, stopped or never played.
//                }
//            }

        },
        watch: {
            volume: function (val) {
                this.$refs.player.volume = val / 10;
            },
        }
    }
</script>

<style>
    .div-progress{
        height: 3px;
    }
    .progress-linear {
        margin: 0px;
    }
    .icon:before {
        font-family: sans-serif;
    }

    .button:before {
        font-family: sans-serif;
    }

</style>