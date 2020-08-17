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
                            :title="getTitulo('Valide seu email')"
                            @keyup.enter.prevent="(resend) ? sendLoginView() : resendLink()"
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
                                :value="resend"
                                type="success"
                        >
                            Um novo link de verificação foi enviado para seu email.
                        </v-alert>

                        <v-card-text>

                                <v-card
                                        color="green lighten-1"
                                        v-show="!resend"
                                        dark
                                >
                                    <v-card-title class="title">Notamos que ainda não validou seu email.</v-card-title>
                                    <v-card-text class="subheading white text--primary">
                                        <p>Verifique seu email e clique no link de verificação existente lá, caso ainda não tenha recebido clique abaixo para receber um novo.</p>
                                    </v-card-text>

                                </v-card>

                        </v-card-text>


                        <template slot="actions">
                            <v-layout row wrap>
                                <v-flex sm12 lg12 md12>
                                    <v-layout align-start justify-end row>
                                        <v-btn color="error"
                                               @click="resendLink()"
                                               :loading="loading"
                                               :disabled="loading"
                                               v-show="!resend"
                                               autofocus
                                        >
                                            Reenviar link
                                        </v-btn>

                                        <v-btn color="primary"
                                               @click="sendLoginView()"
                                               v-show="resend"
                                               autofocus
                                        >
                                            Ir para login
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
        name: 'aton-verify-email',
        data() {
            return {


                e1: true,

                resend: false,

                iniciar: false,

                dados: {
                    password: '',
                    email: '',
                    remember: false,
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
            sendLoginView: function(){
                this.iniciar = false;
                window.location = '/login';
            },
            resendLink: function () {
                var self = this;

                this.loading = true;
                this.inError = false;

                this.$http.get('/email/resend')
                    .then(response => {
                       console.log(response);
                        self.loading = false;
                        self.resend  = true;
                        // window.location = '/admin';

                    })
                    .catch(error => {
                       console.log(error.response);
                        self.iniciar = true;
                        self.loading = false;
                        // self.errors = error.response.data.errors;
                    });
            }
        },
        components: {}
    }
</script>

<style>
</style>