<template>
    <div>


        <div class="row">

            <!-- tabs -->
            <div class="col-md-3 col-sm-3">
                <ul class="nav nav-tabs nav-stacked flex-column fs-13">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_mi" data-toggle="tab">
                            <span class="badge badge-danger float-right">Rede Própria</span>
                            AtonMidia
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_ri" data-toggle="tab">
                            <span class="badge badge-danger float-right">Rede Parceiros</span>
                            Parceiros Akhena
                        </a>
                    </li>
                </ul>
            </div>

            <!-- tabs content -->
            <div class="col-md-9 col-sm-9">
                <div class="tab-content tab-stacked nav-alternate">
                    <div id="tab_mi" class="tab-pane active">
                        <h3>Pontos Rede Akhena</h3>
                        <p>Relação de pontos de veiculação de nossa rede própria</p>
                        <a href="https://shoppingtotal.com.br">
                            <h4>
                                <span>
                                    Shopping Total Porto Alegre
                                </span>
                            </h4>
                        </a>
                        <div class="col-md-6 col-sm-6">
                            <div class="thumbnail mb-8 radius-0">
                                <!--
                                    IMAGE ZOOM

                                    data-mode="mouseover|grab|click|toggle"
                                -->
                                <figure id="zoom-primary" class="zoom" data-mode="mouseover">
                                    <!--
                                        zoom buttton

                                        positions available:
                                            .bottom-right
                                            .bottom-left
                                            .top-right
                                            .top-left
                                    -->
                                    <a class="lightbox bottom-right"
                                       href="img/atonmidia/pontosveiculacao1.jpg"
                                       data-plugin-options='{"type":"image", "gallery": {"enabled": true}}'>
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <!--
                                        image

                                        Extra: add .image-bw class to force black and white!
                                    -->
                                    <img class="img-fluid"
                                         src="img/atonmidia/pontosveiculacao1.jpg" width="568" alt=""/>
                                </figure>

                            </div>

                            <!--
                                Thumbnails (required height:100px)

                                data-for = figure image id match

                                NOTE: 	loop wil cause an issue to zoom plugin!
                                        DO NOT use loop!
                            -->

                            <div data-for="zoom-primary" class="owl-carousel-2 zoom-more" data-plugin-options='{
                                                                                "responsiveBaseElement":	"#wrapper",
                                                                                "loop":						false,
                                                                                "margin":					8,

                                                                                "nav":						true,
                                                                                "dots":						false,

                                                                                "center":					false,
                                                                                "slideBy":					"1",
                                                                                "autoplay":					false,
                                                                                "autoplayTimeout":			4500,
                                                                                "autoWidth":				false,
                                                                                "merge":					true,
                                                                                "rtl":						false,

                                                                                "animateIn":				"",
                                                                                "animateOut":				"",

                                                                                "responsive": {
                                                                                    "0":	{"items":3},
                                                                                    "960":	{"items":5}
                                                                                }

                                                                            }'>
                                <a class="thumbnail radius-0 active"
                                   href="img/atonmidia/pontosveiculacao1.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao1.jpg"
                                         height="100" alt=""/>
                                </a>
                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao2.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao2.jpg"
                                         height="100" alt=""/>
                                </a>
                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao3.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao3.jpg"
                                         height="100" alt=""/>
                                </a>
                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao4.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao4.jpg"
                                         height="100" alt=""/>
                                </a>
                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao5.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao5.jpg"
                                         height="100" alt=""/>
                                </a>
                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao6.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao6.jpg"
                                         height="100" alt=""/>
                                </a>
                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao7.jpg">
                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao7.jpg"
                                         height="100" alt=""/>
                                </a>
                            </div>
                            <!-- /Thumbnails -->

                        </div>
                    </div>

                    <div id="tab_ri" class="tab-pane">
                        <h3>Pontos na Rede de Parceiros</h3>
                        <p>
                            Relação de pontos de veiculação da nossa rede de parceiros comerciais, mais capilaridade para seu anúncio</p>

                        <p><span style="font-size:14px"><strong>PORTO ALEGRE - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">ACADEMIA STORM FIT&nbsp;- Boa Vista</span></li>
                            <li><span style="font-size:14px">ACADEMIA BODYBASE - Menino Deus</span></li>
                            <li><span style="font-size:14px">ACADEMIA ESPORTA - Tristeza</span></li>
                            <li><span style="font-size:14px">ACADEMIA ESTA&Ccedil;&Atilde;O FITNESS - Floresta</span>
                            </li>
                            <li><span style="font-size:14px">ACADEMIA FITS BELA VISTA - Bela Vista</span></li>
                            <li><span style="font-size:14px">ACADEMIA MASTER - Menino Deus</span></li>
                            <li><span style="font-size:14px">ACADEMIA MR. PERSONAL - Bela Vista</span></li>
                            <li><span style="font-size:14px">ACADEMIA SAL DA TERRA - Menino Deus</span></li>
                            <li><span style="font-size:14px">ACADEMIA TR&Ecirc;S FIGUEIRAS - Tr&ecirc;s Figueiras</span>
                            </li>
                            <li><span style="font-size:14px">ACADEMIA SUA ACADEMIA - Jardim It&uacute;</span></li>
                            <li><span
                                    style="font-size:14px">EST&Eacute;TICA MIRAGE PADRE CHAGAS - Moinhos de Vento</span>
                            </li>
                            <li><span style="font-size:14px">EST&Eacute;TICA MIRAGE ZONA SUL - Tristeza</span></li>
                            <li><span style="font-size:14px">EST&Eacute;TICA NEW BORDEAUX MOINHOS DE VENTO - Moinhos de Vento</span>
                            </li>
                            <li><span style="font-size:14px">EST&Eacute;TICA NEW BORDEAUX TR&Ecirc;S FIGUEIRAS - Tr&ecirc;s Figueiras</span>
                            </li>
                            <li><span style="font-size:14px">EST&Eacute;TICA RADAM&Eacute;S - Floresta</span></li>
                            <li><span style="font-size:14px">EST&Eacute;TICA TOP HAIR - Auxiliadora</span></li>
                            <li><span style="font-size:14px">BOOKCAF&Eacute; - Moinhos de Vento</span></li>
                            <li><span style="font-size:14px">SHOPPING BOURBON WALLIG (Lot&eacute;rica N&uacute;meros da Sorte) - Cristo Redentor </span>
                            </li>
                            <li><span style="font-size:14px">SHOPPING BOURBON CENTER LAR (Lot&eacute;rica Moinho da Sorte) - Sarandi </span>
                            </li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA ESPORTIVA A99 - Partenon</span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA V&Iacute;RUS DA SORTE - Partenon</span>
                            </li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA CRISTO REDENTOR - Cristo Redentor </span>
                            </li>
                            <li><span
                                    style="font-size:14px">LOT&Eacute;RICA TRI&Acirc;NGULO - It&uacute; Sabar&aacute; </span>
                            </li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA KAVER - Leroy Merlin - Sarandi </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA PLACAR 13 - S&atilde;o Geraldo </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA LG - Rubem Berta </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA PAULISTA - Rubem Berta </span></li>
                            <li><span
                                    style="font-size:14px">LOT&Eacute;RICA MONTE CARLO - S&atilde;o Sebasti&atilde;o </span>
                            </li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA ASSIS BRASIL - Sarandi </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RI</span>CA MATTOS - Prot&aacute;sio Alves </li>
                            <li>LOT&Eacute;RICA A2 - Jardim Carvalho </li>
                            <li>LOT&Eacute;RICA TRI&Acirc;NGULO - It&uacute; Sabar&aacute; </li>
                        </ul>

                        <p><span style="font-size:14px"><strong>CANOAS - RS</strong></span></p>

                        <ul>
                            <li><span
                                    style="font-size:14px">CHURRASCARIA E PIZZARIA JARDIM DO LAGO I - Jardim do Lago</span>
                            </li>
                            <li><span
                                    style="font-size:14px">CHURRASCARIA E PIZZARIA JARDIM DO LAGO II - Jardim do Lago</span>
                            </li>
                            <li><span style="font-size:14px">RESTAURANTE MARQU&Ecirc;S BIER - Centro</span></li>
                            <li><span style="font-size:14px">RESTAURANTE TOMMATTIS - Centro </span></li>
                            <li><span style="font-size:14px">RESTAURANTE PANEVINO - Centro </span></li>
                            <li><span style="font-size:14px">RESTAURANTE TEMPERO &amp; CIA - Centro</span></li>
                            <li><span style="font-size:14px">RESTAURANTE SPAZIO NATURALE - Centro</span></li>
                            <li><span style="font-size:14px">PIT STOP LANCHES - Igara </span></li>
                            <li><span
                                    style="font-size:14px">SHOPPING CANOAS&nbsp;- Centro (Lot&eacute;rica Megalomania)</span>
                            </li>
                            <li><span style="font-size:14px">SHOPPING BOURBON - Centro (Lot&eacute;rica Mega Milh&otilde;es)</span>
                            </li>
                            <li><span
                                    style="font-size:14px">SUPERMERCADO UNISUPER - Harmonia (Lot&eacute;rica Fortuna)</span>
                            </li>
                            <li><span style="font-size:14px">POSTO METROPOLITANO - Centro (Lot&eacute;rica Metropolitana)</span>
                            </li>
                            <li><span style="font-size:14px">UNIVERSIDADE UNILASALLE - Centro</span></li>
                            <li><span style="font-size:14px">ACERTMED - Centro</span></li>
                            <li><span style="font-size:14px">ACADEMIA MAPI - Niter&oacute;i</span></li>
                            <li><span style="font-size:14px">ACADEMIA USINA&nbsp;DO CORPO - Centro </span></li>
                            <li><span style="font-size:14px">ACADEMIA USINA&nbsp;DO CORPO - Igara </span></li>
                            <li><span style="font-size:14px">ACADEMIA CANOAS FITNESS - Centro </span></li>
                            <li><span style="font-size:14px">ACADEMIA MOINHOS&nbsp;- Igara (Parceira)</span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA TEIMOSINHA XIII - Santos Ferreira</span>
                            </li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA SAT&Eacute;LITE - Igara</span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA SORTE CERTA - Centro </span></li>
                        </ul>

                        <p><span style="font-size:14px"><strong>ESTEIO - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">PIZZARIA PR&Aacute;TIKA I - Centro </span></li>
                            <li><span style="font-size:14px">PIZZARIA PR&Aacute;TIKA II - Centro </span></li>
                            <li><span style="font-size:14px">ACADEMIA AQUA CENTER - Centro </span></li>
                            <li><span style="font-size:14px">ACADEMIA TEAM BOEDE - Centro </span></li>
                            <li><span style="font-size:14px">SHOPPING VIDA BELLA - Centro </span></li>
                            <li><span style="font-size:14px">POSTO MENDES CONVENI&Ecirc;NCIA - Centro </span></li>
                            <li><span style="font-size:14px">CL&Iacute;NICA SESMAT - Centro </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA ESTEIO - Centro </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA TREVO - Centro </span></li>
                        </ul>

                        <p><strong><span style="font-size:14px">SAPUCAIA DO SUL - RS</span></strong></p>

                        <ul>
                            <li><span style="font-size:14px">LOT&Eacute;RICA SORTCHE - Primor </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA FEDERAL - Centro </span></li>
                            <li><span style="font-size:14px">ACERTMED - Centro</span></li>
                        </ul>

                        <p><span style="font-size:14px"><strong>CACHOEIRINHA - RS</strong></span></p>

                        <ul>
                            <li>LOT&Eacute;RICA TREVO DA SORTE </li>
                            <li>LOT&Eacute;RICA TEIMOSINHA </li>
                        </ul>

                        <p><span style="font-size:14px"><strong>VIAM&Atilde;O - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">LOT&Eacute;RICA AZULZINHA DA SORTE</span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA ESTRELA DA SORTE I </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA ESTRELA DA SORTE II </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA TEIMOSINHA I </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA TEIMOSINHA IV </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA PORTAL DA SORTE </span></li>
                        </ul>

                        <p><span style="font-size:14px"><strong>GRAVATA&Iacute; - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">LOT&Eacute;RICA SEGREDO </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA MONTE BELO </span></li>
                        </ul>

                        <p><span style="font-size:14px"><strong>TORRES - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">LOT&Eacute;RICA ITAPEVA&nbsp;- Centro </span></li>
                        </ul>

                        <p><span style="font-size:14px"><strong>OS&Oacute;RIO - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">LOT&Eacute;RICA LINHARES - Centro </span></li>
                            <li><span style="font-size:14px">LOT&Eacute;RICA LINHARES II - Centro </span></li>
                        </ul>

                        <ul>
                        </ul>

                        <p><span style="font-size:14px"><strong>SARANDI - RS</strong></span></p>

                        <ul>
                            <li><span style="font-size:14px">LOT&Eacute;RICA SARANDI - Centro&nbsp;</span></li>
                        </ul>


                    </div>


                </div>
            </div>

        </div>
        <!-- / -->


    </div>

</template>

<script>
    //    import bus from '../../../modules/events/bus';
    import MaskedInput from 'vue-masked-input'

    export default {
        name: 'aton-pontos_veiculacao',
        data() {
            return {

                loading: false,

                arquivos: {},

                dadosDB: {},

                tags: {},

                postError: false,
                postOk: false,

                arquivo: '',
            }
        },
        mounted() {
            console.log('formulario de contato criado vue');
            let self = this;

            // self.loadTags();
            // self.loadArquivos();
        },
        components: {
            MaskedInput,
        },
        methods: {

            setArquivo: function (val) {
                this.Arquivo = val;

            },
            // loadTags: function () {
            //     let self = this;
            //
            //     this.$http.get('/api/e/arquivos/tags')
            //         .then(response => {
            //             self.loading = false;
            //             self.tags = response.data;
            //         })
            //         .catch(error => {
            //             console.log(error.response);
            //             self.loading = false;
            //         });
            // },
            // loadArquivos: function () {
            //     let self = this;
            //
            //     this.$http.get('/api/e/arquivos/listar')
            //         .then(response => {
            //             self.loading = false;
            //             self.arquivos = response.data;
            //         })
            //         .catch(error => {
            //             console.log(error.response);
            //             self.loading = false;
            //         });
            // },

        }
    }
</script>

<style scoped>
    .owl-carousel-2 .owl-nav > .owl-prev, .owl-carousel-2 .owl-nav > .owl-next {
        color: #fff;
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