<template>
    <v-container fluid fill-height>
        <transition name="slide-fade">

            <v-layout justify-center v-show="iniciar">
                <v-flex xs12 sm6 xl4>
                    <v-flex xs12 text-xs-center v-show="false">
                        <img src="/img/ayro.png" alt="" style="width:250px">
                    </v-flex>

                    <material-card
                            color="primary"
                            :title="getTitulo('Alterar senha')"
                            @keyup.enter.prevent="(!exibeValida && (!errors.email)) ? sendLogin() : sendLinkReset()"
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
                                Pronto! Você receberá em seu email um link para redefinir sua senha.
                            </v-alert>

                            <v-form v-show="!exibeValida" lazy-validation>
                                <input type="hidden" name="token" v-model="dados.token"/>
                                <v-text-field
                                        class="mt-2 mb-2"
                                        prepend-icon="mail"
                                        box
                                        success
                                        name="email"
                                        id="email"
                                        label="Email"
                                        v-model="dados.email"
                                        readonly
                                        :error-messages="errors.email"
                                ></v-text-field>

                                <v-text-field
                                        class="mt-2"
                                        prepend-icon="lock"
                                        :append-icon="e1 ? 'visibility_off' : 'visibility'"
                                        name="password"
                                        id="password"
                                        ref="password"
                                        label="Entre com nova senha"
                                        hint="Minimo de 6 caracteres"
                                        min="6"
                                        @click:append="e1 = !e1"
                                        v-model="dados.password"
                                        @input="errors.password = []"
                                        :error-messages="errors.password"
                                        :type="e1 ? 'password' : 'text'"
                                        :rules="rules.required"
                                        autofocus
                                ></v-text-field>
                                <v-text-field
                                        class="mt-2"
                                        prepend-icon="lock"
                                        :append-icon="e2 ? 'visibility_off' : 'visibility'"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        label="Confirme a nova senha"
                                        hint="Minimo de 6 caracteres"
                                        min="6"
                                        @click:append="e2 = !e2"
                                        v-model="dados.password_confirmation"
                                        @input="errors.password_confirmation = []"
                                        :error-messages="errors.password_confirmation"
                                        :type="e2 ? 'password' : 'text'"
                                        :rules="rules.required"
                                ></v-text-field>

                            </v-form>

                        <template slot="actions">
                            <v-layout row wrap>
                                <v-flex sm12 lg12 md12>
                                    <v-layout align-start justify-end row fill-height>
                                        <v-btn color="primary"
                                               :loading="loading"

                                               :disabled="loading || exibeValida"
                                               v-show="!exibeValida && (!errors.email)"
                                               @click="sendLogin()"
                                        >
                                            <v-icon left>mdi-send</v-icon>
                                            Redefinir

                                        </v-btn>
                                        <v-btn color="success"
                                               :loading="loading"

                                               :disabled="loading"
                                               v-show="!exibeValida && (errors.email)"
                                               @click="sendLinkReset()"
                                        >
                                            <v-icon left>mdi-link-plus</v-icon>
                                            reenviar link para reset

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
        props: ['email', 'token', 'status'],
        name: 'aton-password-redefinir',
        data() {
            return {


                e1: true,
                e2: true,

                iniciar: false,

                dados: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                    token: '',
                },
                exibeValida: false,
            }
        },
        mounted() {


            let self = this;
            setTimeout(function () {
                self.iniciar = true;
                self.dados.email = self.email;
            }, 500)
            self.dados.email = this.email;
            self.dados.token = this.token;
        },

        methods: {
            sendValidaView: function () {
                this.iniciar = false;
                window.location = '/email/verify';
            },

            sendLinkReset: function () {
                var self = this;

                this.loading = true;
                this.inError = false;
                this.errors = {};

                this.$http.post('/password/email', this.dados)
                    .then(response => {
                        console.log(response);
                        self.loading = false;
                        // window.location = '/admin';
                        if (response.status == '200') {
                            self.exibeValida = true;
                        }

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.iniciar = true;
                        if ((error.response.status == '422') || (error.response.status == '419')) {
                            self.inError = true;
                            self.errors = error.response.data.errors;
                        } else if (error.response.status == '403') {
                            self.exibeValida = true;
                        }
                    });
            },

            sendLogin: function () {
                var self = this;

                this.loading = true;
                this.inError = false;
                this.errors = {};

                this.$http.post('/password/reset', this.dados)
                    .then(response => {
                        console.log(response);


                        if (response.status == '200') {
                            // self.exibeValida = true;
                            self.iniciar = false;
                            window.location = '/admin';
                        } else {
                            self.loading = false;
                        }

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;

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