<template>
    <div v-show="iniciar">
        <div class="heading-title heading-border heading-color mt-0">
            <div class="fs-18 fw-400">FICOU INTERESSADO</div>
            <p class="fs-13">ENVIE SUA SOLICITAÇÃO ABAIXO E RECEBA O ORÇAMENTO GRATUITO</p>
        </div>
        <p>
        <h1 class="fs-16">
            Você está muito próximo de entrar numa rede exclusiva para anunciar seu negócio, parabéns!
        </h1>
        </p>

        <div>
            <transition name="fade">
                <div id="alert_ok" class="alert alert-success mb-30" v-if="postOk">
                    <button type="button" class="close" @click="postOk = !postOk" data-dismiss="alert">&times;</button>
                    <strong>Mensagem enviada!</strong> Obrigado!
                </div>

                <div id="alert_erro" class="alert alert-danger mb-30" v-if="postError">
                    <button type="button" class="close" @click="postError = !postError" data-dismiss="alert">&times;</button>
                    <strong>Erro ao enviar!</strong> Por favor revise suas informações.
                </div>
            </transition>

            <form method="post" enctype="multipart/form-data">
                <fieldset>
                    <input type="hidden" name="action" value="contact_send"/>

                    <div class="row">
                        <div class="col-md-6 mb-20">
                            <label for="nome">Nome Completo *</label>
                            <input required ref="nome" type="text" class="form-control"
                                   v-model="dadosDB.nome" id="nome">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="email">E-mail *</label>
                            <input required type="email" class="form-control"
                                   v-model='dadosDB.email' id="email">
                        </div>
                        <div class="col-md-12 mb-20">
                            <label for="telefone">Telefone *</label>
                            <masked-input mask="(11) 1111-11111"
                                          id="telefone"
                                          class="form-control"
                                          placeholder-char=" "
                                          @input="dadosDB.telefone = arguments[1]"/>

                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="empresa">Empresa *</label>
                            <input required ref="empresa" type="text" class="form-control"
                                   v-model="dadosDB.empresa" id="empresa">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="cargo">Cargo *</label>
                            <input required type="cargo" class="form-control"
                                   v-model='dadosDB.cargo' id="cargo">
                        </div>

                        <div class="col-md-12 mb-20">
                            <label for="assunto">Assunto *</label>
                            <input required type="text" class="form-control"
                                   v-model="dadosDB.assunto" id="assunto">
                        </div>

                        <div class="col-md-12 mb-20">
                            <label for="mensagem">Mensagem *</label>
                            <textarea required maxlength="10000" rows="4" class="form-control aton-text-area"
                                      v-model="dadosDB.mensagem" id="mensagem"></textarea>
                        </div>
                    </div>

                </fieldset>

                <div class="row">
                    <div class="col-md-12">
                        <button @click.prevent="sendPost()" class="btn btn-primary" id="postForm" name="postForm" >
                            <span>

                                <i v-show="this.postOk" class="fa fa-check"></i>
                                <i v-show="this.loading" class="fa fa-spinner fa-spin"></i>


                            </span>
                            SOLICITAR ORÇAMENTO AGORA
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</template>

<script>
    //    import bus from '../../../modules/events/bus';
    import MaskedInput from 'vue-masked-input'

    export default {
        name: 'aton-contato-landing',
        data() {
            return {

                loading: false,

                dadosDB: {
                    nome: '',
                    email: '',
                    telefone: '',
                    empresa: '',
                    assunto: '',
                    mensagem: '',
                },

                postError: false,
                postOk: false,

                iniciar: true,

            }
        },
        mounted() {

        },
        components: {
            MaskedInput,
        },
        methods: {
            sendPost: function () {
                if (this.loading) return false;

                let self = this;

                self.postError = false;
                self.postOk = false;

                this.loading = true;
                this.$http.post('contato', this.dadosDB)
                    .then((response) => {
                        self.loading = false;
                        self.postOk = true;
//
                        location.replace("/obrigado");

                        setTimeout(function () {
                            self.postOk = false;
                        }, 5000);


                        let msg = response.data;

                    })
                    .catch(error => {
                        self.postError = true;

                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
        }
    }
</script>

<style scoped>
    .custom-loader {
        animation: loader 1s infinite;
        display: flex;
    }

    @-moz-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @-o-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .aton-text-area {
        height: auto;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0
    }

</style>