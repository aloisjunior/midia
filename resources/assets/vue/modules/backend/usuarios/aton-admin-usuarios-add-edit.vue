<template>

        <material-card

                :title="getTitulo('Usuário')"
                @keyup.enter.prevent="postUsuario()"
                @keyup.esc.prevent="voltaView()"
        >
            <v-form v-model="formCtrl" ref="form" lazy-validation>
            <div class="div-progress"><v-progress-linear v-show="loading || loading_extras" height="3" color="success" :indeterminate="true"></v-progress-linear></div>


                <v-text-field v-model="dadosDB.name" label="Nome" required
                              ref="name"
                              :error-messages="errors.name"
                              :error="inError"
                              :rules="rules.required"
                              autofocus
                ></v-text-field>
                <v-text-field v-model="dadosDB.email" label="Email" required
                              :error-messages="errors.email"
                              :rules="rules.email"
                              :error="inError"
                ></v-text-field>

                <v-text-field v-show="isAdd" v-model="dadosDB.password" label="Password" type="password"
                              required
                              hint="Mínimo de 6 caracteres."
                              :error-messages="errors.password"
                              :error="inError"
                >
                </v-text-field>
                <v-select
                        label="Premissões"
                        required
                        :items="roles"
                        item-text="name"
                        item-value="id"
                        v-model="dadosDB.roles"
                        multiple
                        chips
                        return-object
                        deletable-chips
                        :loading="loading_extras"
                        color="primary"
                        hint="Você pode indicar mais de uma regra"
                        persistent-hint
                ></v-select>
                <v-select
                        label="Estações"
                        required
                        :items="estacoes"
                        item-text="nome"
                        item-value="id"
                        v-model="dadosDB.estacoes"
                        multiple
                        chips
                        return-object
                        deletable-chips
                        :loading="loading_extras"
                        color="primary"
                        hint="Você pode indicar mais de uma estação"
                        persistent-hint
                ></v-select>



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
        name: 'aton-admin-usuarios-add-edit',
        data() {
            return {


                dadosDB: {
                    name: '',
                    email: '',
                    password: '',
                    roles: [],
                    estacoes: [],
                    ativo: true,

                },

                roles: [],
                estacoes: [],
            }
        },
        mounted() {
            this.loadRoles();
            this.loadEstacoes();


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

                bus.$emit('atonprogress:on');
                self.loading = true;
                this.$http.get('/admin/usuario/' + self.$route.params.id + '/update')
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
            loadRoles: function () {
                let self = this;
//                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/api/i/perfil/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.roles = response.data;
//                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
//                        bus.$emit('atonprogress:off');
                    });
            },

            loadEstacoes: function () {
                let self = this;
//                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/api/i/estacoes/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.estacoes = response.data;
//                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
//                        bus.$emit('atonprogress:off');
                    });
            },


            // voltaView: function (atualizaConsulta) {
            //
            //
            //     this.$router.push({path: '/admin/usuarios'});
            // },

            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/usuario';

                if (this.isEdit) {
                    _url = '/admin/usuario/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('usuario:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;

                        console.log(error.response.data);
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });
            },
        }
    }
</script>

<style>

</style>