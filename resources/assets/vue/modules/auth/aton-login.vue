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
                            :title="getTitulo('Login de acesso')"
                            @keyup.enter.prevent="sendLogin()"
                            hover
                            raised
                    >
                        <v-fab-transition slot="optionLeft">
                            <v-btn icon
                                   class="ma-0"
                                   href="/">
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
                                    prepend-icon="mail"
                                    ref='email'
                                    name="login"
                                    label="Entre com seu E-mail"
                                    v-model="dados.email"
                                    type="email"

                                    :error-messages="errors.email"
                                    @input="errors.email = []"
                                    :rules="rules.email_required"



                                    autofocus
                            ></v-text-field>
                            <v-text-field
                                    class="mt-2"
                                    prepend-icon="lock"
                                    :append-icon="e1 ? 'visibility_off' : 'visibility'"
                                    name="password"
                                    id="password"
                                    label="Entre com sua senha"
                                    hint="Minimo de 6 caracteres"
                                    min="6"
                                    @click:append="e1 = !e1"
                                    v-model="dados.password"

                                    :error-messages="errors.password"
                                    @input="errors.password = []"
                                    :rules="rules.required"

                                    :type="e1 ? 'password' : 'text'"

                            ></v-text-field>
                            <v-checkbox
                                    label="Permanecer conectado"
                                    v-model="dados.remember"></v-checkbox>
                        </v-form>

                        <template slot="actions">
                            <v-layout row wrap>
                                <v-flex sm12 md6>
                                    <v-btn v-show="!exibeValida"
                                           class="green--text darken-1"
                                           @click="sendResetPassword()"
                                           flat="flat">Esqueceu a senha?
                                    </v-btn>
                                    <v-btn color="error"
                                           @click="sendValidaView()"
                                           v-show="exibeValida"
                                    >
                                        <v-icon left>mdi-link-plus</v-icon>
                                        Reenviar link

                                    </v-btn>
                                </v-flex>


                                <v-flex sm12 lg6 md6>
                                    <v-layout align-start justify-end row fill-height>
                                        <v-btn color="primary"
                                               :loading="loading"
                                               :disabled="loading || exibeValida || !validForm"
                                               v-show="!exibeValida"
                                               @click="sendLogin()"
                                        >
                                            <v-icon left>mdi-send</v-icon>
                                            Entrar
                                        </v-btn>


                                    </v-layout>
                                </v-flex>

                            </v-layout>
                        </template>

                    </material-card>
                    <v-hover>
                        <v-card
                                slot-scope="{ hover }"
                                :class="`mt-4 elevation-${hover ? 12 : 0}`"
                                flat
                                dark
                                v-show="!exibeValida">
                            <v-card-text>
                                <v-flex xs12 text-xs-center>
                                    <span class="title">
                                    Ainda não tem cadastro?
                                    </span>
                                </v-flex>


                                <v-flex xs12 text-xs-center>
                                    <v-btn color="success"
                                           :loading="loading_register"
                                           @click="sendRegister()"
                                           :disabled="loading_register"

                                    >
                                        Fazer meu cadastro

                                    </v-btn>
                                </v-flex>
                            </v-card-text>

                        </v-card>
                    </v-hover>
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
        name: 'aton-login',
        data() {
            return {


                e1: true,

                iniciar: false,

                loading_register: false,

                dados: {
                    password: '',
                    email: '',
                    remember: false,
                },
                exibeValida: false,
                errors: {
                    password: '',
                    email: ''
                },
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
            sendRegister: function () {
                this.loading = true;
                this.loading_register = true;
                this.iniciar = false;
                window.location = '/register';
            },
            sendResetPassword: function () {
                this.iniciar = false;
                window.location = '/password/reset';
            },
            sendLogin: function () {
                var self = this;

                this.loading = true;
                this.inError = false;
                this.errors = [];

                this.$http.post('/login', this.dados)
                    .then(response => {
                        console.log(response);
                        self.iniciar = false;
                        window.location = '/admin';

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.iniciar = true;

                        if ((error.response.status == '422') || (error.response.status == '419')) {
                            self.inError = true;
                            self.errors = error.response.data.errors;
                        } else if (error.response.status == '403') {
                            self.sendValidaView();
                        }
                    });
            }
        },
        components: {}
    }
</script>

<style>
</style>