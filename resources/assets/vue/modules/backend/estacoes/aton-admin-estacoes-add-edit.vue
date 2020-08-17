<template>

    <material-card

            :title="getTitulo('Estação')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >

        <div class="div-progress">
            <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                               :indeterminate="true"></v-progress-linear>
        </div>

        <v-form v-model="formCtrl" ref="form" lazy-validation>
            <v-text-field v-model="dadosDB.nome" label="Nome" required
                          ref="nome"
                          :error-messages="errors.nome"
                          :error="inError"
                          :rules="rules.required"
                          autofocus
            ></v-text-field>
            <v-text-field v-model="dadosDB.host" label="host" required
                          :error-messages="errors.host"
                          :rules="rules.required"
                          :error="inError"
            ></v-text-field>
            <v-text-field v-model="dadosDB.porta" label="Porta" required
                          :error-messages="errors.porta"
                          :rules="rules.required"
                          :error="inError"
            ></v-text-field>
            <v-text-field v-model="dadosDB.key" label="Key" required
                          :error-messages="errors.key"
                          :error="inError"
            ></v-text-field>
            <v-text-field v-model="dadosDB.ftp_senha" label="Senha do FTP" required
                          :error-messages="errors.ftp_senha"
                          :error="inError"
            ></v-text-field>

            <v-layout row>
                <v-combobox
                        label="Tags"
                        required
                        :items="tags"
                        v-model="dadosDB.list_tags"
                        chips
                        deletable-chips
                        multiple
                        tags
                        hint="Você pode indicar mais de uma tag"
                        persistent-hint
                        no-data-text="Nenhum histórico encontrado"
                        ref="tags"
                        @keyup.enter.stop=""
                >
                </v-combobox>

            </v-layout>
            <v-layout row>
                <v-combobox
                        label="Pastas OFFLine"
                        required
                        :items="ftp_pastas_offline"
                        v-model="dadosDB.list_ftp_pastas_offline"
                        chips
                        deletable-chips
                        multiple
                        tags
                        hint="Você pode indicar mais de uma pasta"
                        persistent-hint
                        no-data-text="Nenhum histórico encontrado"
                        ref="ftp_pastas_offline"
                        @keyup.enter.stop=""
                >
                </v-combobox>

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
                        <v-btn class="blue--text darken-1" @click="voltaView"><v-icon left>mdi-close</v-icon>Fechar</v-btn>

                        <v-btn
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
        name: 'aton-admin-estacoes-add-edit',
        data() {
            return {


                dadosDB: {
                    ativo: true,
                },

                tags: [],
                ftp_pastas_offline: [],
            }
        },
        mounted() {
            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.ativo = true;
            }

            this.loadTags();
            this.loadFtpPastasOffline();
        },

        methods: {
            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/estacao/' + self.$route.params.id + '/update')
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
                this.$http.get('/admin/estacao/tags/listar')

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
            loadFtpPastasOffline: function () {
                let self = this;
                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/admin/estacao/ftp_pastas_offline/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.ftp_pastas_offline = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });


            },

            voltaView: function (atualizaConsulta) {


                this.$router.push({path: '/admin/estacoes'});
            },

            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/estacao';

                if (this.isEdit) {
                    _url = '/admin/estacao/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('estacao:updated');
                    })
                    .catch(error => {
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