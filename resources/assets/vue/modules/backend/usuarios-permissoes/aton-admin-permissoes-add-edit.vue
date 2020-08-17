<template>

    <material-card

            :title="getTitulo('Permissão')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >
        <v-form v-model="formCtrl" ref="form" lazy-validation>
            <div class="div-progress">
                <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                                   :indeterminate="true"></v-progress-linear>
            </div>

            <v-layout row>
                <v-text-field v-model="dadosDB.permission_title" label="Nome" required
                              :error-messages="errors.permission_title"
                              :error="inError"
                              ref="name"
                              :rules="rules.required"
                              autofocus
                ></v-text-field>
            </v-layout>
            <v-layout row>
                <v-text-field v-model="dadosDB.permission_slug" label="Slug" required
                              :error-messages="errors.permission_slug"
                              :error="inError"
                              :rules="rules.required"
                ></v-text-field>
            </v-layout>
            <v-layout row>
                <v-text-field v-model="dadosDB.permission_description" label="Descrição" required
                              :error-messages="errors.permission_description"
                              :error="inError"
                              :rules="rules.required"
                ></v-text-field>
            </v-layout>
            <v-layout row>
                <v-text-field v-model="dadosDB.permission_group" label="Grupo" required
                              :error-messages="errors.permission_group"
                              :error="inError"
                              :rules="rules.required"
                ></v-text-field>
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
        name: 'aton-admin-permissoes-add',
        data() {
            return {


                dadosDB: {
                    permission_title: '',
                    permission_slug: '',
                    permission_description: '',
                    permission_group: '',
                    ativo: true,
                },
            }
        },
        mounted() {
            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.ativo = true;
            }

        },
        methods: {
            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                self.loading = true;
                this.$http.get('/admin/permissao/' + self.$route.params.id + '/update')
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

            atualizaLayout: function () {
                bus.$emit('set-menu-active', 'usuarios');
            },
            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/permissao';

                if (this.isEdit) {
                    _url = '/admin/permissao/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('permissao:updated');
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