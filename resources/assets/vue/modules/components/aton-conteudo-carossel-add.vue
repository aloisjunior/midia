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
                    :title="tagSelected == '' ? 'Selecione os conteúdos por tag' : 'Conteúdos do carrossel ' + tagSelected"
                    :dark="!isModeDarkForms"
                    :light="isModeDarkForms"

                    :fullWidth="true"

                    @keyup.esc.prevent="setCancel()"
            >
                <template slot="option">

                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                v-show="filteredListConteudo.length && (pesquisa.tags != '') && (tagSelected == '') && (quantidade > 0)"
                                icon
                                class="my-0 mx-1"
                                color="primary"
                                slot="activator"

                                @click.prevent.stop="setOK()"
                        >
                            <v-icon >add</v-icon>
                        </v-btn>
                        <span>Incluir</span>
                    </v-tooltip>

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
                        <span>Fechar inclusão</span>
                    </v-tooltip>
                </template>

                <template slot="extra">
                    <material-search-box
                            v-show="tagSelected == ''"
                            @keyup.enter.stop="loadConteudos()"
                            @keyup.esc.prevent="setCancel()"
                            color="tertiary"
                            class="mx-3 my-2"
                    >
                        <template slot="actions">
                            <v-layout row wrap align-center>
                                <v-flex xs12 sm10>
                                    <v-layout row wrap align-end>
                                        <v-flex xs12 sm6 class="px-3">
                                            <v-slider
                                                    label="Quantidade"
                                                    always-dirty
                                                    :min="1"
                                                    :max="30"
                                                    :thumb-size="24"
                                                    thumb-label="always"
                                                    v-model="quantidade"
                                            ></v-slider>
                                        </v-flex>
                                        <v-flex xs12 sm6>
                                            <v-select
                                                    label="Tag"
                                                    required
                                                    :items="tags"
                                                    v-model="pesquisa.tags"
                                                    chips
                                                    color="primary"

                                                    class="mt-0"

                                                    no-data-text="Nenhum histórico encontrado"
                                                    ref="tags"

                                                    @keyup.enter.stop=""
                                                    @change="this.conteudos=[]"
                                            >
                                            </v-select>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>


                                <v-spacer></v-spacer>
                                <v-flex sm2 xs12 text-xs-right>
                                    <v-btn
                                            depressed
                                            :loading="loading"
                                            @click="loadConteudos()"
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


                    <v-card-text style="height: 300px;" class="ma-0 pa-1">
                        <v-container fluid grid-list-md class="pa-0">
                            <v-layout row wrap justify-center>
                                <v-flex d-flex style="width: 140px; max-width: 140px;"
                                        v-for="(element, key) in filteredListConteudo" :key="element.id"
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
                        <div>Tempo total para a TAG selecionada: {{ this.duracao }}</div>
                    </v-footer>
                </template>


            </material-card>

        </v-dialog>
    </v-layout>
</template>

<script>
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
            tagSelected: {
                default: '',
                type: String,
            }
        },
        name: 'aton-conteudo-carossel-add',
        data() {
            return {
                conteudos: [],

                selecao: {
                    nome: '',
                },
                searchconteudo: '',
                quantidade: 1,

                loading_extras: false,

                pesquisa: {
                    tags: '',
                },

                tags: [],
                duracao: '00:00',

            }
        },
        methods: {
            getThumbConteudo: function (element) {
                switch (element.tipo_conteudo) {
                    // case 'carrossel':
                    //     return '/img/atonmidia/icone_carrossel.png'
                    //     break;
                    // case 'rss':
                    //     return '/img/atonmidia/icone_rss.png'
                    //     break;
                    case 'url':
                        return '/img/atonmidia/icone_url.png';
                        break;
                    case 'streaming':
                        return '/img/atonmidia/icone_url.png';
                        break;
                    // case 'subplaylist':
                    //     return '/img/atonmidia/icone_playlist.png';
                    //     break;
                    // case 'layout':
                    //     return '/img/atonmidia/icone_layout.png';
                    //     break;
                    default:
                        return element.link_thumbnail;
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
                this.$emit('setOK', this.pesquisa.tags, this.quantidade, this.duracao, this.conteudos);
            },

            loadTags: function () {
                let self = this;
                self.loading = true;
                this.$http.get('/admin/playlist_conteudo/tags/listar')
                    .then(response => {
                        self.loading = false;
                        self.tags = response.data;

                        if (self.tagSelected != '') {
                            self.loadConteudos();
                        }
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },

            loadConteudos: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/playlist_conteudo/listar', {
                    filtro: '*',
                    tag: self.pesquisa.tags,
                },)
                    .then(response => {
//                        console.log(response);
                        self.loading = false;
                        self.conteudos = response.data.data;
                        self.duracao = response.data.duracao;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
            // filteredListConteudo: function (conteudos) {
            //     var self = this;
            //     return conteudos.filter(function (conteudo) {
            //
            //         return  (
            //             conteudo.nome.toLowerCase().indexOf(self.searchconteudo.toLowerCase()) >= 0 ||
            //             conteudo.mime.toLowerCase().indexOf(self.searchconteudo.toLowerCase()) >= 0
            //         )
            //     })
            // }
        },
        mounted() {
            // alert('oi');
            this.searchconteudo = '';

        },
        computed: {
            filteredListConteudo() {
                var self = this;

                var busca = this.searchconteudo || '';
                return _.filter(
                    this.conteudos, filtro =>
                        (
                            filtro.nome.toLowerCase().indexOf(busca.toLowerCase()) >= 0 ||
                            filtro.tags.toLowerCase().indexOf(busca.toLowerCase()) >= 0
                        )
                );
            },
        },
        watch: {
            openDialog: function (val) {
                if (val) {
                    this.duracao = '00:00';
                    this.loadTags();
                    this.pesquisa.tags = this.tagSelected;
                    // this.loadConteudos();
                } else {
                    this.pesquisa.tags = '';
                    this.conteudos = [];
                    this.duracao = '00:00';
                }
            },
        },


    }
</script>

<style>
    .v-sheet--offset {
        top: -12px;
        position: relative;
    }
</style>