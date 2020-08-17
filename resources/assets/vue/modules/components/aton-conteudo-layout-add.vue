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
                    title="Selecione o layout"
                    :dark="!isModeDarkForms"
                    :light="isModeDarkForms"

                    :fullWidth="true"

                    @keyup.esc.prevent="setCancel()"
            >
                <template slot="option">

                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                v-show="layout_id && (quantidade > 0)"
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
                                            label="Layout"
                                            required
                                            :items="layouts"
                                            v-model="layout_id"
                                            chips
                                            color="primary"
                                            item-value="id"
                                            item-text="nome"

                                            class="mt-0"
                                            hide-details

                                            return-object
                                            no-data-text="Nenhum histórico encontrado"
                                            ref="layouts"
                                            @keyup.enter.stop=""
                                    >
                                    </v-select>

                                </v-flex>
                            </v-layout>


                        </template>

                    </material-search-box>
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
        name: 'aton-conteudo-layout-add',
        data() {
            return {


                selecao:{
                    nome: '',
                },
                quantidade: 1,

                loading_extras: false,

                layout_id: null,

                layouts: [],

            }
        },
        methods: {
            setCancel: function () {
                this.$emit('setCancel', false);
            },
            setOK: function (val) {
                // this.selecao = val;
                this.$emit('setOK', this.layout_id, this.quantidade);
            },

            loadLayouts: function () {
                let self = this;

                // bus.$emit('atonprogress:on', 'Carregando Playlists');
                self.loading = true;
                this.$http.get('/api/i/layout/listar')
                    .then(response => {
                        self.loading = false;
                        self.layouts = response.data.data;

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
                    this.loadLayouts();
                }
            },
        },



    }
</script>

<style scoped="">

</style>