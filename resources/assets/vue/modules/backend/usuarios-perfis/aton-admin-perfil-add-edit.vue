<template>

        <material-card

                :title="getTitulo('Perfil')"
                @keyup.enter.prevent="callPost()"
                @keyup.esc.prevent="voltaView()"
        >
            <v-form v-model="formCtrl" ref="form" lazy-validation>
            <div class="div-progress"><v-progress-linear v-show="loading || loading_extras" height="3" color="success" :indeterminate="true"></v-progress-linear></div>


                <v-text-field v-model="dadosDB.name" label="Nome" required
                              :error-messages="errors.name"
                              :error="inError"
                              :rules="rules.required"
                            ref="name"
                            autofocus
                ></v-text-field>
                <v-text-field v-model="dadosDB.slug" label="Slug" required
                              :error-messages="errors.slug"
                              :error="inError"
                              :rules="rules.required">

                </v-text-field>


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
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';
    import AtonRules from '../../components/aton-rules';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        name: 'aton-admin-perfil-add',
        data() {
            return {


                dadosDB: {
                    name: '',
                    email: '',
                    password: '',
                    roles: null,
                    ativo: true,
                },

                roles: [],


            }
        },
        mounted() {
            if (this.isEdit){
                this.loadItemEdit();
            }else{
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
                this.$http.get('/admin/perfil/' + self.$route.params.id + '/update')
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


            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/perfil';

                if (this.isEdit) {
                    _url = '/admin/perfil/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('perfil:updated');
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