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
                    title="Selecione a playlist"
                    :dark="!isModeDarkForms"
                    :light="isModeDarkForms"

                    :fullWidth="true"

                    @keyup.esc.prevent="setCancel()"
            >
                <template slot="option">

                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                v-show="subplaylist_id && (quantidade > 0)"
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

                            @keyup.esc.prevent="setCancel()"
                            color="tertiary"
                            class="mx-3 my-2"
                    >
                        <template slot="actions">

                                    <v-layout row>
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
                                                    label="Playlist"
                                                    required
                                                    :items="playlists"
                                                    v-model="subplaylist_id"
                                                    chips
                                                    color="primary"
                                                    item-value="id"
                                                    item-text="nome"


                                                    class="mt-0"
                                                    hide-details


                                                    return-object
                                                    no-data-text="Nenhum histórico encontrado"
                                                    ref="playlists"
                                                    @keyup.enter.stop=""
                                            >
                                            </v-select>
                                        </v-flex>
                                    </v-layout>

                        </template>

                    </material-search-box>
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
                default: 0,
                type: Number,
            },
        },
        name: 'aton-conteudo-subplaylist-add',
        data() {
            return {

                selecao:{
                    nome: '',
                },
                quantidade: 1,

                loading_extras: false,

                subplaylist_id: null,

                playlists: [],

                duracao: '00:00',
            }
        },
        methods: {
            setCancel: function () {
                this.duracao = '00:00';
                this.$emit('setCancel', false);
            },
            setOK: function (val) {
                // this.selecao = val;
                this.duracao = '00:00';
                this.$emit('setOK', this.subplaylist_id, this.quantidade);
            },

            loadPlaylists: function () {
                let self = this;

                // bus.$emit('atonprogress:on', 'Carregando Playlists');
                self.loading = true;
                this.$http.get('/api/i/playlist/listar/' + self.playlist_id)
                    .then(response => {
                        self.loading = false;
                        self.playlists = response.data;

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
//                        bus.$emit('atonprogress:off');
                    });

            },

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
                    this.loadPlaylists();
                }else{
                    this.subplaylist_id = null;
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