<template>
    <v-container fluid>
        <transition name="slide-fade">

            <v-layout justify-center v-show="iniciar">
                <v-flex xs12 sm6 xl4>
                    <v-flex xs12 text-xs-center v-show="false">
                        <img src="/img/ayro.png" alt="" style="width:250px">
                    </v-flex>

                    <material-card
                            color="primary"
                            :title="getTitulo('Enviar redefinição de senha')"
                            @keyup.enter.prevent="sendLogin()"
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
                                class="mt-1"
                                :value="!exibeValida"
                                type="info"
                        >
                            Informe seu e-mail para enviarmos um link para você mesmo definir sua nova senha.
                        </v-alert>
                        <v-alert
                                class="mt-1"
                                :value="exibeValida"
                                type="success"
                        >
                            Você receberá em seu email um link para redefinir sua senha.
                        </v-alert>
                        <v-form v-show="!exibeValida" lazy-validation>

                            <v-text-field
                                    class="ma-2"
                                    prepend-icon="mail"
                                    ref='email'
                                    name="email"
                                    id="email"
                                    label="Entre com seu E-mail"
                                    v-model="dados.email"
                                    type="email"
                                    @input="errors.email = []"
                                    :error-messages="errors.email"
                                    :rules="rules.email_required"
                                    clearable
                                    autofocus
                            ></v-text-field>
                        </v-form>

                        <template slot="actions">
                            <v-layout row wrap>
                                <v-flex sm12 md6>
                                    <v-btn color="primary"
                                           @click="sendValidaView()"
                                           v-show="exibeValida"

                                    >
                                        <v-icon left>mdi-send</v-icon>
                                        Ir para login
                                    </v-btn>
                                </v-flex>


                                <v-flex sm12 lg6 md6>
                                    <v-layout align-start justify-end row>
                                        <v-btn color="primary"
                                               :loading="loading"
                                               :disabled="loading || exibeValida"
                                               v-show="!exibeValida"
                                               @click="sendLogin()"
                                        >
                                            <v-icon left>mdi-link-plus</v-icon>
                                            Enviar link
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
        // props: [
        //     'errors'
        // ],

        name: 'aton-password-email',
        data() {
            return {


                e1: true,

                iniciar: false,

                dados: {
                    email: '',
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

            sendLogin: function () {
                var self = this;

                this.loading = true;
                this.inError = false;
                this.errors = [];

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

                        if ((error.response.status == '422') || (error.response.status == '419')) {
                            self.inError = true;
                            self.errors = error.response.data.errors;
                        } else if (error.response.status == '403') {
                            self.exibeValida = true;
                        }
                    });
            }
        },
        components: {}
    }
</script>

<style>
</style>