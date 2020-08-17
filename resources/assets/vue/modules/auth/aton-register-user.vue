<template>
    <v-container fluid fill-height>
        <transition name="slide-fade">

            <v-layout justify-center v-show="iniciar">
                <v-flex xs12 sm6 xl4>
                    <v-flex xs12 text-xs-center>
                        <img src="/img/ayro.png" alt="" style="width:250px">
                    </v-flex>

                    <material-card
                            color="primary"
                            :title="getTitulo('Cadastro de novos usuários')"
                            @keyup.enter.prevent="sendRegister()"
                            hover
                            raised
                    >
                        <v-fab-transition slot="optionLeft">
                            <v-btn icon
                                   class="ma-0"
                                   href="/login">
                                <v-icon>arrow_back</v-icon>
                            </v-btn>


                        </v-fab-transition>

                        <v-alert
                                v-model="exibeValida"
                                type="success"
                        >
                            Você precisa validar seu email, verifique seu email de cadastro.
                        </v-alert>

                        <v-form v-show="!exibeValida" lazy-validation v-model="validForm">
                            <v-text-field
                                    prepend-icon="person"
                                    ref='Nome'
                                    name="name"
                                    label="Insira seu Nome"
                                    v-model="dados.name"
                                    @input="errors.name = []"
                                    :error-messages="errors.name"
                                    :rules="rules.required"
                                    autofocus
                            ></v-text-field>
                            <v-text-field
                                    prepend-icon="mail"
                                    ref='email'
                                    name="login"
                                    label="Entre com seu E-mail"
                                    v-model="dados.email"
                                    type="email"
                                    @input="errors.email = []"
                                    :error-messages="errors.email"
                                    :rules="rules.email_required"
                            ></v-text-field>
                            <v-text-field
                                    prepend-icon="lock"
                                    :append-icon="e1 ? 'visibility_off' : 'visibility'"
                                    name="password"
                                    id="password"
                                    label="Entre com sua senha"
                                    hint="Minimo de 6 caracteres"
                                    min="6"
                                    @click:append="e1 = !e1"
                                    v-model="dados.password"
                                    @input="errors.password = []"
                                    :error-messages="errors.password"
                                    :type="e1 ? 'password' : 'text'"
                                    :rules="rules.required"
                            ></v-text-field>
                            <v-text-field
                                    prepend-icon="lock"
                                    :append-icon="e2 ? 'visibility_off' : 'visibility'"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    label="Confirme a sua senha"
                                    hint="Minimo de 6 caracteres"
                                    min="6"
                                    @click:append="e2 = !e2"
                                    v-model="dados.password_confirmation"
                                    @input="errors.password_confirmation = []"
                                    :error-messages="errors.password_confirmation"
                                    :type="e2 ? 'password' : 'text'"
                                    :rules="rules.required"
                            ></v-text-field>
                            <v-text-field
                                    class="mt-2 mb-2"
                                    prepend-icon="playlist_add_check"
                                    box
                                    success
                                    name="produto_add"
                                    id="produto_add"
                                    label="Produto"
                                    v-model="dados.produto_add"
                                    readonly
                            ></v-text-field>
                        </v-form>

                        <template slot="actions">
                            <v-layout row wrap>

                                <v-flex sm12 lg12 md12>
                                    <v-layout align-start justify-end row fill-height>
                                        <v-btn color="primary"
                                               :loading="loading"
                                               @click="sendRegister()"
                                               :disabled="loading || exibeValida || !validForm"
                                               v-show="!exibeValida"
                                        >
                                            <v-icon left>mdi-send</v-icon>
                                            Cadastrar
                                        </v-btn>
                                    </v-layout>
                                </v-flex>

                            </v-layout>
                        </template>


                    </material-card>
                </v-flex>
            </v-layout>

        </transition>
    </v-container>


</template>

<script>
    import AtonRules from '../components/aton-rules';
    import atonBaseFormEdit from '../components/aton-base-form-edit.vue';


    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        data() {
            return {
                name: 'aton-register-user',

                e1: true,
                e2: true,

                iniciar: false,

                dados: {
                    name: '',
                    password: '',
                    email: '',
                    password_confirmation: '',
                    produto_add: 'Plataforma Sinalização Digital'
                },
                exibeValida: false,
            }
        },
        mounted() {
            let self = this;
            setTimeout(function () {
                self.iniciar = true;
            }, 500)
        },

        methods: {
            sendValidaView: function () {
                this.iniciar = false;
                window.location = '/email/verify';
            },
            sendResetPassword: function () {
                this.iniciar = false;
                window.location = '/password/reset';
            },
            sendRegister: function () {
                var self = this;

                this.loading = true;
                this.inError = false;
                this.errors = {};

                this.$http.post('/register', this.dados)
                    .then(response => {
                        console.log(response);
                        // self.loading = false;
                        self.iniciar = false;
                        window.location = '/admin';

                    })
                    .catch(error => {
                        console.log(error.response);

                        if ((error.response.status == '422') || (error.response.status == '419')) {
                            self.iniciar = true;
                            self.loading = false;
                            self.inError = true;
                            self.errors = error.response.data.errors;
                        } else if (error.response.status == '403') {
                            self.sendValidaView();
                        } else {
                            self.iniciar = true;
                            self.loading = false;
                        }
                    });
            }
        },
        components: {}
    }
</script>

<style>
</style>