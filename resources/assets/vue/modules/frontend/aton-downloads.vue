<template>

        <div>
            <div class="container">

                <div class="row">

                    <!-- tabs -->
                    <div class="col-md-3 col-sm-3">
                        <ul class="nav nav-tabs nav-stacked flex-column fs-13">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab_mi" data-toggle="tab">
                                    <span class="badge badge-danger float-right">2018</span>
                                    Mídia Indoor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_ri" data-toggle="tab">
                                    <span class="badge badge-danger float-right">Em Breve</span>
                                    Rádio Indoor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_op" data-toggle="tab">
                                    <span class="badge badge-danger float-right">Em Breve</span>
                                    Orientação para Produção
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_tv" data-toggle="tab">
                                    <span class="badge badge-danger float-right">Em Breve</span>
                                    TV Corporativa
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_vt" data-toggle="tab">
                                    <span class="badge badge-danger float-right">Em Breve</span>
                                    Vitrine Digital
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- tabs content -->
                    <div class="col-md-9 col-sm-9">
                        <div class="tab-content tab-stacked nav-alternate">
                            <div id="tab_mi" class="tab-pane active">
                                <h4>Mídia Kit 2018 - Mídia Indoor</h4>
                                <p>Neste documento você encontra tudo sobre a Mídia Indoor Akhena.</p>
                                <a href="#" @click="setArquivo('midia')" class="btn btn-3d btn-reveal btn-red">
                                    <i class="et-download"></i>
                                    <span>Baixar</span>
                                </a>
                            </div>

                            <div id="tab_ri" class="tab-pane">
                                <h4>Mídia Kit 2018 - Rádio Indoor</h4>
                                <p>Neste documento você encontra tudo sobre a Rádio Indoor Akhena.</p>
                                <!--<a href="#" @click="setArquivo('radio')" class="btn btn-3d btn-reveal btn-red">-->
                                    <!--<i class="et-download"></i>-->
                                    <!--<span>Baixar</span>-->
                                <!--</a>-->
                            </div>

                            <div id="tab_op" class="tab-pane">
                                <h4>Orientações para envio de conteúdo para criação</h4>
                                <p>
                                    Neste documento você encontra tudo para que envie corretamente materiais para produção de vídeos para exibição.</p>
                                <!--<a href="#" @click="setArquivo('producao')" class="btn btn-3d btn-reveal btn-red">-->
                                    <!--<i class="et-download"></i>-->
                                    <!--<span>Baixar</span>-->
                                <!--</a>-->
                            </div>
                            <div id="tab_tv" class="tab-pane">
                                <h4>Midia Kit 2018 - TV Corporativa</h4>
                                <p>
                                    Neste documento você encontra tudo sobre a TV Corporativa Akhena.</p>
                                <!--<a href="#" @click="setArquivo('producao')" class="btn btn-3d btn-reveal btn-red">-->
                                <!--<i class="et-download"></i>-->
                                <!--<span>Baixar</span>-->
                                <!--</a>-->
                            </div>
                            <div id="tab_vt" class="tab-pane">
                                <h4>Midia Kit 2018 - Vitrine Digital</h4>
                                <p>
                                    Neste documento você encontra tudo sobre a Vitrine Digital Akhena.</p>
                                <!--<a href="#" @click="setArquivo('producao')" class="btn btn-3d btn-reveal btn-red">-->
                                <!--<i class="et-download"></i>-->
                                <!--<span>Baixar</span>-->
                                <!--</a>-->
                            </div>
                        </div>
                    </div>

                </div>

                <div class="message-aton">
                    <transition name="fade">
                    <div v-show="showConfirmacao" class="alert alert-success "><!-- SUCCESS -->
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Concluído!</strong> Você recebeu em seu email o link para download.
                    </div>
                    </transition>
                </div>

            </div>
            <aton-modal :show="showModal" @close="showModal=false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- header modal -->
                        <div class="modal-header">

                            <h4 class="modal-title text-right" id="myLargeModalLabel">
                                Download de arquivo: <span>{{arquivo}}</span></h4>
                            <button type="button" class="close " @click="showModal=false" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-header">
                            <h5>Informe seus dados para receber o link do arquivo, fique tranquilo, não enviamos spam.
                            </h5>
                        </div>

                        <!-- body modal -->
                        <div class="modal-body">
                            <form ref="form" id="form" class="sky-form clearfix">

                                <label class="input">
                                    <i class="ico-prepend fa fa-user"></i>
                                    <input ref="nome" type="text" placeholder="Nome" required v-model="dadosDB.nome">
                                </label>

                                <label class="input">
                                    <i class="ico-prepend fa fa-envelope"></i>
                                    <input type="email" placeholder="Email" required v-model="dadosDB.email">
                                </label>


                                <masked-input mask="(11) 1111-11111"
                                              id="telefone"
                                              class="form-control"
                                              placeholder-char=" "
                                              placeholder="Telefone"
                                              required="true"
                                              @input="dadosDB.telefone = arguments[1]"/>


                                <button @click="sendPost()" class="btn-3d btn-teal btn-xlg btn-block mt-30">
                                    ENVIAR
                                    <span class="block font-lato">Continuar com download</span>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </aton-modal>
        </div>



</template>

<script>
    //    import bus from '../../../modules/events/bus';
    import AtonModal from '../components/comum/aton-modal.vue';

    import MaskedInput from 'vue-masked-input'

    export default {
        name: 'aton-downloads',
        data() {
            return {

                loading: false,

                arquivos: {},

                dadosDB: {
                    nome: '',
                    email: '',
                    telefone: '',
                    tipo: '',
                },

                tags: {},

                postError: false,
                postOk: false,

                arquivo: '',

                showModal: false,

                showConfirmacao: false,
            }
        },
        mounted() {
            console.log('formulario de contato criado vue');
            let self = this;

//            self.loadTags();
//            self.loadArquivos();
        },
        components: {
            MaskedInput,
            AtonModal,
        },
        methods: {
            close: function () {
                this.showModal = false;
            },
            show: function () {
                this.showModal = true;
            },
            exibeConfirmacao: function () {
                this.showConfirmacao = true;

                let self = this;
                setTimeout(function () {
                        self.showConfirmacao = false;
                    }
                    , 8000);

            },
            setArquivo: function (val) {
                switch (val) {
                    case "midia":
                        this.arquivo = "Mídia Kit - Mídia Indoor";
                        break;
                    case "radio":
                        this.arquivo = "Mídia Kit - Rádio Indoor";
                        break;
                    case "producao":
                        this.arquivo = "Orientação de Produção";
                        break;
                }

                this.dadosDB.tipo = val;
                this.show();

            },
            sendPost: function () {
                let self = this;

                let _url = '/downloads';

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        let msg = response.data;

                        this.close();
                        this.exibeConfirmacao();
//                        console.log(msg);

                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });

            },
//            loadTags: function () {
//                let self = this;
//
//                this.$http.get('/api/e/arquivos/tags')
//                    .then(response => {
//                        self.loading = false;
//                        self.tags = response.data;
//                    })
//                    .catch(error => {
//                        console.log(error.response);
//                        self.loading = false;
//                    });
//            },
//            loadArquivos: function () {
//                let self = this;
//
//                this.$http.get('/api/e/arquivos/listar')
//                    .then(response => {
//                        self.loading = false;
//                        self.arquivos = response.data;
//                    })
//                    .catch(error => {
//                        console.log(error.response);
//                        self.loading = false;
//                    });
//            },

        }
    }
</script>

<style scoped>
    .message-aton{
        height: 100px;
        padding: 20px;
    }
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