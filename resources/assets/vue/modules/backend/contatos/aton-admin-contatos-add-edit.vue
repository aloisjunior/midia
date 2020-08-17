<template>

    <material-card

            :title="getTitulo('Contato')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >
        <v-form v-model="formCtrl" ref="form" lazy-validation>

            <div class="div-progress">
                <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                                   :indeterminate="true"></v-progress-linear>
            </div>


            <v-layout row wrap>

                <v-flex xs12>
                    <v-text-field class="px-1"
                                  v-model="dadosDB.nome" label="Nome" required
                                  ref="nome"
                                  :error-messages="errors.nome"
                                  :error="inError"
                                  :rules="rules.required"
                                  autofocus
                    ></v-text-field>
                </v-flex>
                <v-flex xs6>
                    <v-text-field class="px-1"

                                  v-model="dadosDB.empresa" label="Empresa"
                                  ref="empresa"
                                  :error-messages="errors.empresa"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs6>
                    <v-text-field class="px-1"

                                  v-model="dadosDB.cargo" label="Cargo"
                                  ref="cargo"
                                  :error-messages="errors.cargo"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs6>
                    <v-text-field class="px-1"

                                  v-model="dadosDB.telefone" label="Telefone"
                                  ref="telefone"
                                  :error-messages="errors.telefone"
                                  :error="inError"
                                  :mask="'(##)#####-####'"
                                  hint="Insira somente números com DDD de dois digitos"
                    ></v-text-field>
                </v-flex>
                <v-flex xs6>
                    <v-text-field class="px-1"

                                  v-model="dadosDB.email" label="Email"
                                  ref="email"
                                  :error-messages="errors.email"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs6>
                    <v-text-field class="px-1"
                                  v-model="dadosDB.url" label="Url"
                                  ref="url"
                                  :error-messages="errors.url"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12>
                    <v-textarea v-model="dadosDB.observacao" label="Observacao"
                                ref="observacao"
                                :error-messages="errors.observacao"
                                :error="inError"
                                outline
                    ></v-textarea>
                </v-flex>

                <v-flex xs6>

                    <v-autocomplete
                            class="px-1"
                            label="Tags"
                            required
                            v-bind:items="tags"
                            v-model="dadosDB.list_tags"
                            multiple
                            chips
                            tags
                            deletable-chips
                            hint="Você pode indicar mais de uma tag"
                            persistent-hint
                            no-data-text="Nenhum histórico encontrado"
                            @keyup.enter.stop=""
                    >
                    </v-autocomplete>
                </v-flex>
                <v-flex xs6>
                    <v-combobox
                            class="px-1"
                            label="Status Bounce"
                            required
                            v-model="dadosDB.list_bounce"
                            multiple
                            chips
                            tags
                            deletable-chips
                            disabled
                            hint="Indica situação de bounce do contato"
                            persistent-hint
                            no-data-text="Nenhum histórico encontrado"
                            @keyup.enter.stop=""
                    >
                    </v-combobox>
                </v-flex>

                <v-flex xs6>
                    <v-combobox
                            class="px-1"
                            label="Classificação"
                            required
                            v-model="dadosDB.list_classificacao"
                            multiple
                            chips
                            tags
                            deletable-chips
                            disabled
                            hint="Indica classificação do contato"
                            persistent-hint
                            no-data-text="Nenhum histórico encontrado"
                            @keyup.enter.stop=""
                    >
                    </v-combobox>

                </v-flex>


            </v-layout>

        </v-form>
        <template slot="actions">
            <v-layout row wrap>
                <v-flex sm12 md2>
                    <v-checkbox
                            hide-details
                            class="mt-1"
                            height="20px"
                            label="Receber Mailing?"
                            v-model="dadosDB.receber_mailing"
                    ></v-checkbox>
                </v-flex>
                <v-flex sm12 md2>
                    <v-checkbox
                            class="mt-1"
                            height="20px"
                            label="Ativo"
                            v-model="dadosDB.ativo"
                    ></v-checkbox>
                </v-flex>


                <v-flex sm12 lg8 md8>
                    <v-layout align-start justify-end row fill-height>
                        <v-btn class="blue--text darken-1" @click="voltaView(true)"><v-icon left>mdi-close</v-icon>Fechar</v-btn>
                        <v-btn
                                color="primary"
                                :loading="loading"
                                @click="callPost()"
                                :disabled="loading"
                        >
                            Salvar

                        </v-btn>
                    </v-layout>
                </v-flex>

            </v-layout>
        </template>
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
        name: 'aton-admin-contatos-add-edit',
        data() {
            return {


                dadosDB: {
                    nome: '',
                    empresa: '',
                    cargo: '',
                    url: '',
                    telefone: '',
                    email: '',
                    endereco: '',
                    observacao: '',

                    tags: [],
                    ativo: true,
                    receber_mailing: true,
                },


                tags: [],
            }
        },
        mounted() {
            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.receber_mailing = true;
                this.dadosDB.ativo = true;
            }

            this.loadTags();
        },
        components: {},
        methods: {
            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/contato/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            loadTags: function () {
                let self = this;
                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/admin/contato/tags/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.tags = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            voltaView: function (excluirPendentes) {

                this.$router.push({path: '/admin/contatos'});
            },
            atualizaLayout: function () {
                bus.$emit('set-menu-active', 'usuarios');
            },
            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/contato';

                if (this.isEdit) {
                    _url = '/admin/contato/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        let novo = this.dadosDB.nome;
                        self.voltaView();
                        bus.$emit('contato:updated', novo);
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>

<style scoped>
    #navigation-1 a {
        text-decoration: none;
    }

</style>