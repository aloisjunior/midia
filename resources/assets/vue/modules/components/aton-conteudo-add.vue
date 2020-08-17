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
                    title="Seleção de conteúdos"
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
                                class="ma-0"
                                color="red"
                                slot="activator"
                                small
                                @click.prevent.stop="setCancel()"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <span>Fechar inclusão</span>
                    </v-tooltip>
                </template>

                <template slot="extra">
                    <material-search-box
                            @keyup.enter.stop="loadConteudos()"
                            @keyup.esc.prevent="setCancel()"
                            color="tertiary"
                            class="mx-3 my-2"
                    >
                        <template slot="actions">
                            <v-layout row wrap align-center>
                                <v-flex xs12>
                                    <v-text-field
                                            ref='edtPesquisa'
                                            label="Nome do conteúdo"
                                            hint="Duplo clique para incluir"
                                            persistent-hint
                                            append-outer-icon="mdi-update"
                                            @click:append-outer="loadConteudos()"
                                            :loading="loading"
                                            value=""

                                            box
                                            clear-icon="mdi-close-circle"
                                            clearable

                                            v-model="searchconteudo"
                                            autofocus
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </template>

                    </material-search-box>

                    <v-card-text style="height: 300px;" class="ma-0 pa-1">
                        <v-container fluid grid-list-md class="pa-0">
                                <v-layout row wrap justify-center>
                                <v-flex d-flex style="width: 140px; max-width: 140px;"
                                        v-for="(element, key) in filteredListConteudo.slice().reverse()"
                                        :key="element.id"
                                        class="item">

                                    <v-card style="width: 140px; max-width: 140px;"
                                            v-on:dblclick.native="setOK(element)">
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
        },
        name: 'aton-conteudo-add',
        data() {
            return {


                conteudos: [],

                selecao: {
                    nome: '',
                },
                searchconteudo: '',
                quantidade: 1,

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
                this.$emit('setCancel', false);
            },
            setOK: function (val) {
                // this.selecao = val;
                this.$emit('setOK', val, this.quantidade);
            },
            loadConteudos: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/playlist_conteudo/listar', {
                    filtro: '*',
                },)
                    .then(response => {
//                        console.log(response);
                        self.loading = false;
                        self.conteudos = response.data.data;
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
            }
        },
        watch: {
            openDialog: function (val) {
                if (val) {
                    this.loadConteudos();

                    this.$nextTick(function () {
                            this.$refs.edtPesquisa.$el.focus();
                        }
                    );

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
<!--shadow para dialog dark-->
<!--box-shadow: 2px 6px 16px 9px rgba(255, 255, 255, 0.2), 1px 5px 7px 0px rgba(255, 255, 255, 0.27), 1px 4px 2px 4px rgba(255, 255, 255, 0.23);-->