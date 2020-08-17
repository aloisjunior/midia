<template>

        <material-card

                :title="getTitulo('Player')"
                @keyup.enter.prevent="callPost()"
                @keyup.esc.prevent="voltaView()"
        >
            <v-form v-model="formCtrl" ref="form" lazy-validation>
            <div class="div-progress">
                <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                                   :indeterminate="true"></v-progress-linear>
            </div>
                <v-text-field v-model="dadosDB.nome" label="Nome" required
                              ref="nome"
                              :error-messages="errors.nome"
                              :rules="rules.required"
                              autofocus
                ></v-text-field>

                <v-layout row>
                    <v-combobox
                            label="Grupos"
                            required
                            :items="grupos"
                            v-model="dadosDB.grupos"
                            chips
                            deletable-chips
                            tags
                            multiple
                            :error-messages="errors.grupos"
                            hint="Você pode indicar mais de um grupo"
                            persistent-hint
                            no-data-text="Nenhum histórico encontrado"
                            ref="grupos"
                            @keyup.enter.stop=""
                    >
                    </v-combobox>

                </v-layout>
                <v-layout row>
                    <v-combobox
                            label="Tags"
                            required
                            :items="tags"
                            v-model="dadosDB.tags"
                            chips
                            deletable-chips
                            tags
                            multiple
                            :error-messages="errors.tags"
                            hint="Você pode indicar mais de uma tag"
                            persistent-hint
                            no-data-text="Nenhum histórico encontrado"
                            ref="tags"
                            @keyup.enter.stop=""
                    >
                    </v-combobox>

                </v-layout>
                <v-layout row>
                    <v-autocomplete
                            label="Playlist"
                            required
                            :items="playlists"
                            v-model="dadosDB.playlist_id"
                            item-value="id"
                            item-text="nome"
                            chips
                            deletable-chips
                            hint="Playlist que rodará no player"
                            persistent-hint
                            no-data-text="Nenhum histórico encontrado"
                            ref="playlists"
                            @keyup.enter.stop=""
                    >
                    </v-autocomplete>

                </v-layout>

            </v-form>
            <template slot="actions">
                <v-layout row wrap>
                    <v-flex sm12 md2>
                        <v-checkbox
                                hide-details
                                class="mt-1"
                                height="20px"
                                label="Ativo"
                                v-model="dadosDB.ativo"
                        ></v-checkbox>
                    </v-flex>


                    <v-flex sm12 lg10 md10>
                        <v-layout align-start justify-end row fill-height>
                            <ar-btn-voltar v-if="false" text="Fechar">
                            </ar-btn-voltar>

                            <v-btn v-if="false"
                                    color="primary darken-2"
                                    :loading="loading"
                                    @click="callPost()"
                                    :disabled="loading"
                            >
                                <v-icon left>mdi-check</v-icon>
                            Salvar
                            </v-btn>
                        </v-layout>
                    </v-flex>

                </v-layout>
            </template>

            <v-fab-transition>
                <v-speed-dial
                        v-show="fabAddEditShow"
                        v-model="fabAddEdit"
                        fixed
                        top
                        right

                        :direction="$vuetify.breakpoint.smAndDown ? 'bottom': 'left'"

                        transition="scale-transition"
                >
                    <v-btn

                            slot="activator"
                            v-model="fabAddEdit"
                            color="blue-grey darken-1"

                            dark

                            fab
                            small

                            class="no-print mx-0"
                    >
                        <v-icon>create</v-icon>
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-tooltip left content-class="left">
                        <v-btn
                                slot="activator"
                                fab
                                small
                                class="ma-1"

                                :dark="this.isModeDarkForms"
                                :light="!this.isModeDarkForms"

                                color="primary"
                                @click="callPost()"

                                :loading="loading"
                                :disabled="loading || isReadOnly"

                        >
                            <v-icon>mdi-content-save</v-icon>
                        </v-btn>
                        <span>Salvar</span>
                    </v-tooltip>

                    <v-tooltip left content-class="left">
                        <v-btn
                                slot="activator"
                                fab
                                small

                                dark

                                class="ma-1 blue--text darken-1"

                                color="secondary darken-2"
                                @click="voltaView()"
                        >
                            <v-icon>arrow_back</v-icon>
                        </v-btn>
                        <span>Fechar</span>
                    </v-tooltip>
                </v-speed-dial>
            </v-fab-transition>


        </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],

        name: 'aton-admin-players-add-edit',
        data() {
            return {
                dadosDB: {
                    nome: '',
                    tags: [],
                    grupos: [],
                    playlist: [],
                    playlist_id: null,
                    ativo: true,
                },

                tags: [],
                playlists: [],
                grupos: [],


            }
        },
        mounted() {
            let self = this;

            // bus.$emit('atonprogress:on');

            this.$nextTick(function () {
                if (self.isEdit) {
                    self.loadItemEdit();
                } else {
                    self.$refs.form.reset();
                    self.dadosDB.ativo = true;
                }

                self.loadTags();
                self.loadGrupos();
                self.loadPlaylists();
            });

            // bus.$emit('atonprogress:off');
        },

        methods: {
            loadItemEdit: function () {
                let self = this;
                // self.activesAjax++;
                bus.$emit('atonprogress:on');
                this.loading = true;
                this.$http.get('/admin/player/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        // bus.$emit('atonprogress:off'); // colocado no mounted
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        // bus.$emit('atonprogress:off');
                    }).finally(() => {
                    bus.$emit('atonprogress:off');
                });
            },
            loadTags: function () {
                let self = this;
                // self.activesAjax++;
                bus.$emit('atonprogress:on', 'Carregando Tags');
                self.loading_extras = true;
                this.$http.get('/admin/player/tags/listar')
                    .then(response => {
                        self.loading_extras = false;
                        self.tags = response.data;
                        // bus.$emit('atonprogress:off');

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                    }).finally(() => {
                    bus.$emit('atonprogress:off');
                });


            },
            loadPlaylists: function () {
                let self = this;

//                bus.$emit('atonprogress:on');
//                 self.activesAjax++;
                bus.$emit('atonprogress:on', 'Carregando Playlists');
                self.loading_extras = true;
                this.$http.get('/api/i/playlist/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.playlists = response.data;
//                        bus.$emit('atonprogress:off');

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;

                        // bus.$emit('atonprogress:off');
                    }).finally(()=>{
                    bus.$emit('atonprogress:off');
                });

            },
            loadGrupos: function () {
                let self = this;
                // self.activesAjax++;
                bus.$emit('atonprogress:on', 'Carregando Grupos');
                self.loading_extras = true;
                this.$http.get('/admin/player/grupos/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.grupos = response.data;

                        // bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;

                        // bus.$emit('atonprogress:off');
                    }).finally(()=>{
                    bus.$emit('atonprogress:off');
                });


            },

            // voltaView: function (atualizaConsulta) {
            //     bus.$emit('atonprogress:off');
            //
            //     this.voltaViewFrom('/admin/players');
            //
            //     // if ((this.$route.params.fromRoute) && this.$route.params.fromRoute != ''){
            //     //     this.$router.push({path: this.$route.params.fromRoute});
            //     // } else{
            //     //     this.$router.push({path: '/admin/players'});
            //     // }
            // },

            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/player';

                if (this.isEdit) {
                    _url = '/admin/player/' + self.dadosDB.id + '/update';
                }

                // self.activesAjax++;
                bus.$emit('atonprogress:on', 'Atualizando dados');

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('player:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });
            },
        }
    }
</script>

<style>
</style>

<!--<v-btn class="blue&#45;&#45;text darken-1" @click="voltaView"><v-icon>mdi-close</v-icon>Fechar</v-btn>-->