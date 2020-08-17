<template>

    <v-layout
            row
            justify-center
    >
        <v-dialog v-model="openDialog"
                  width="800px"
                  height="500px"
                  scrollable
                  persistent
                  content-class="elevation-0"
                  @keyup.esc.prevent="setCancel()"
        >
            <material-card
                    :title="'Conteúdo da SubPlaylist: ' + (playlist_id? playlist_id.subplaylist.nome : '')"
                    :dark="!isModeDarkForms"
                    :light="isModeDarkForms"

                    :fullWidth="true"

                    @keyup.esc.prevent="setCancel()"
            >
                <template slot="option">

                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                icon
                                class="my-0 mx-1"
                                color="red"
                                slot="activator"

                                @click.prevent.stop="setCancel()"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <span>Fechar</span>
                    </v-tooltip>
                </template>
                <template slot="extra">
                    <v-card-text style="height: 300px;" class="ma-0 pa-1">
                        <v-container fluid grid-list-md class="pa-0">
                            <v-layout row wrap justify-center>
                                <v-flex d-flex style="width: 140px; max-width: 140px;"
                                        v-for="(element, key) in conteudos" :key="element.id"
                                        class="item">

                                    <v-card style="width: 140px; max-width: 140px;"
                                    >
                                        <v-img
                                                :src=" getThumbConteudo(element)"
                                                height="80px"
                                                :aspect-ratio="16/9"

                                        >
                                        </v-img>
                                        <v-card-text class="aton-conteudo">
                                            <div>
                                                <div class="caption">Conteúdo {{ element.nome }}</div>
                                                <span class="grey--text fs-9">Duração: {{ element.tempo }}</span>
                                            </div>
                                        </v-card-text>

                                    </v-card>
                                </v-flex>
                            </v-layout>

                        </v-container>


                    </v-card-text>

                    <v-footer class="pa-3">
                        <v-spacer></v-spacer>
                        <div>Tempo total da PLAYLIST selecionada: {{ this.duracao}}</div>
                    </v-footer>
                </template>

            </material-card>

        </v-dialog>
    </v-layout>
</template>

<script>
    import bus from '../../modules/events/bus';
    import AtonBaseForm from '../components/aton-base-form.vue';

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
            playlist_id: {
                default: {},
                type: Object,
            },
        },
        name: 'aton-conteudo-subplaylist-edit',
        data() {
            return {

                selecao:{
                    nome: '',
                },
                quantidade: 1,

                loading_extras: false,

                subplaylist_id: null,

                conteudos: [],

                duracao: '00:00',
            }
        },
        methods: {
            getThumbConteudo: function (element) {
                switch (element.tipo) {
                    case 'carrossel':
                        return '/img/atonmidia/icone_carrossel.png'
                        break;
                    case 'rss':
                        return '/img/atonmidia/icone_rss.png'
                        break;
                    case 'url':
                        return '/img/atonmidia/icone_url.png'
                        break;
                    case 'streaming':
                        return '/img/atonmidia/icone_url.png'
                        break;
                    case 'subplaylist':
                        return '/img/atonmidia/icone_playlist.png';
                        break;
                    case 'layout':
                        return '/img/atonmidia/icone_layout.png';
                        break;
                    case 'conteudo':
                        return element.conteudos.link_thumbnail;
                        break;
                }
                ;

            },
            setCancel: function () {
                this.duracao = '00:00';
                this.$emit('setCancel', false);
            },
            setOK: function (val) {
                // this.selecao = val;
                this.duracao = '00:00';
                this.$emit('setOK', this.subplaylist_id, this.quantidade);
            },

            loadPlaylist: function () {
                let self = this;
                this.loading = true;

                bus.$emit('atonprogress:on');
                this.$http.get('/admin/playlist/' + self.playlist_id.subplaylist_id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.conteudos = response.data.conteudos;
                        self.duracao = response.data.duracao;
                        // self.dadosDB = response.data;

                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        bus.$emit('atonprogress:off');
                    });
            },
//             loadPlaylists: function () {
//                 let self = this;
//
//                 // bus.$emit('atonprogress:on', 'Carregando Playlists');
//                 self.loading = true;
//                 this.$http.get('/api/i/playlist/listar/' + self.playlist_id.id)
//                     .then(response => {
//                         self.loading = false;
//                         self.playlists = response.data;
//
//                     })
//                     .catch(error => {
//                         console.log(error.response);
//                         self.loading = false;
// //                        bus.$emit('atonprogress:off');
//                     });
//
//             },

        },
        mounted() {
        },
        computed: {
            // filteredListConteudo() {
            //     var self = this;
            //
            //     return _.filter(
            //         this.conteudos, filtro =>
            //             (
            //                 filtro.nome.toLowerCase().indexOf(self.searchconteudo.toLowerCase()) >= 0 ||
            //                 filtro.mime.toLowerCase().indexOf(self.searchconteudo.toLowerCase()) >= 0
            //             )
            //     );
            // }
        },
        watch: {
            openDialog: function (val) {
                if(val) {
                    this.loadPlaylist();
                }else{
                    this.subplaylist_id = null;
                    this.conteudos = [];
                }
            },
            subplaylist_id: function (val) {
                if (this.subplaylist_id && this.subplaylist_id.duracao){
                    this.duracao = this.subplaylist_id.duracao;
                }else{
                    this.duracao = '00:00'
                }
            }
        },



    }
</script>

<style scoped="">

</style>