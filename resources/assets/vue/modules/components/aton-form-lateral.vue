<template>
    <div>
        <transition name="slide-fade">
            <div v-show="this.exibir" id="switcher" class="hidden-xs">
                <div class="content-switcher">
                    <h4 class="text-center">Olá, Tudo bem?!</h4>

                    <section class="callout-dark heading-title heading-arrow-bottom">
                        <!--<div class="container">-->

                            <div class="text-center">
                                <h3 class="fs-30">Canal Exclusivo</h3>
                                <p>Sua marca exposta para mais de 1 milhão de pessoas.</p>
                            </div>

                        <!--</div>-->
                    </section>
                    <div class="margin-top-10 text-left">
                        <div class="callout alert alert-danger b-0">
                            <div class="text-center">

                                <h3>Ligue agora mesmo para <strong>(51) 3377-8830</strong></h3>
                                <p class="font-lato fs-13">
                                    Ganhe um vídeo animado ao anunciar!
                                </p>

                                <a href="/contato" rel="nofollow" target="_blank" class="btn btn-danger btn-lg mt-10">Entre em contato</a>

                            </div>

                        </div>
                    </div>
                    <section class="callout-dark heading-title heading-arrow-top">
                        <div class="container">

                            <div class="text-center">
                                <h3 class="fs-14">Obrigado por escolher</h3>
                                <p>Akhena</p>
                            </div>

                        </div>
                    </section>

                    <h4></h4>

                    <label class="switch switch switch-round">
                        <span class="fs-11"> Continuar exibindo esta mensagem?</span>
                        <input v-model="exibirMsg" type="checkbox" checked="">
                        <span class="switch-label" data-on="Sim" data-off="Não"></span>
                    </label>

                    <div @click="setShow(false)" id="hideSwitcher">&times;</div>
                </div>
            </div>
        </transition>
        <transition name="slide-fade-out">
            <div id="showSwitcher" v-show="!exibir" @click="setShow(true)" class="styleSecondColor hide hidden-xs"><i
                    class="fa fa-comments-o styleColor"></i></div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'aton-form-lateral',
                loading: false,

                dados: {},

                exibir: false,

                mostrouMsg: false,

                exibirMsg: true,
            }
        },
        mounted() {
//            this.getDados();

//            $(window).on('beforeunload', function() {
//                return "You should keep this page open.";
//            });
//            window.onbeforeunload = this.leaving;
//            window.onblur = this.leaving;
//            window.onmouseout = this.leaving;

            this.exibirMsg = !this.$cookie.get('exibirMsg') ||this.$cookie.get('exibirMsg') == 'true';
            let self = this;
            setTimeout(function(){
                self.exibir = self.exibirMsg;
            }, 7000);
        },

        components: {},
        methods: {
            leaving: function(){
                if (this.mostrouMsg) {
                    return false;
                }
                this.mostrouMsg = true;
                console.log('apagando cookie');
                alert('retira o cookie');
//                return false;
            },
            setShow: function (val) {
                console.log(val);
                this.exibir = val;


                if (!val){
                    this.$cookie.set('exibirMsg', this.exibirMsg, 1);
                }
            },
            getDados: function () {
                if (this.loading) return false;

                let self = this;

                this.loading = true;
                this.$http.get('/artigos/listar/ultimos')
                    .then((response) => {
                        self.loading = false;
//
//                        console.log(response);
                        self.dados = response.data.data;
                    })
                    .catch(error => {
                        self.postError = true;

                        self.loading = false;
                        console.log(error.response.data);
                    });
            },
            formatarData: function (val) {
                return moment(val).format('MMMM DD[,] YYYY');
            },
        }
    }
</script>


<style scoped>
    .slide-fade-enter-active {
        transition: all .6s ease;
    }

    .slide-fade-leave-active {
        transition: all .6s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */
    {
        transform: translateX(-500px);
        opacity: 0;
    }

    .slide-fade-out-enter-active {
        transition: all .6s ease;
    }

    .slide-fade-out-leave-active {
        transition: all .6s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-out-enter, .slide-fade-out-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */
    {
        transform: translateX(-100px);
        opacity: 0;
    }

    section{
        padding: 15px;
    }

    #switcher {
        background: #f3f3f3;
        position: fixed;
        display: block;
        top: 30px;
        z-index: 1001;
        width: 300px;
        margin-left: 0;
        border-radius: 0;
        font-family: 'Open Sans', Arial, sans-serif;
        -webkit-box-shadow: 0px 0px 4px 0px rgba(51, 51, 51, 0.2);
        box-shadow: 0px 0px 4px 0px rgba(51, 51, 51, 0.2);
    }

    /*#switcher label {*/
        /*padding-right: 20px;*/
        /*font-weight: normal;*/
        /*cursor: pointer;*/
        /*color: #333;*/
    /*}*/

    #switcher hr {
        border: 0;
        border-bottom: #ccc 1px solid;
        margin: 10px 0;
    }

    #switcher h4 {
        padding: 5px 0;
        border-bottom: #ccc 1px solid;
        /*text-transform: uppercase;*/
        /*font-size: 15px;*/
        font-weight: bold;
        color: #333;
    }

    #switcher ul {
        padding: 0 !important;
        margin: 0 !important;
    }

    #switcher ul li {
        text-transform: uppercase;
        margin-bottom: 0;
        font-size: 12px;
        display: inline-block;
    }

    #showSwitcher {
        z-index: 1001;
        margin-left: 0px;
        position: fixed;
        left: 0;
        top: 100px;
        color: #fff;
        background: #333;
        border: #666 1px solid;
        box-shadow: #ccc 0 0 2px;
        border-left: 0;
        font-size: 18px;
        display: block;

        -webkit-border-bottom-right-radius: 0;
        -webkit-border-top-right-radius: 0;
        -moz-border-radius-bottomright: 0;
        -moz-border-radius-topright: 0;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;

        padding: 10px 16px 10px 14px;
        cursor: pointer;
    }

    #hideSwitcher {
        cursor: pointer;
        line-height: 43px;
        font-size: 38px;
        margin-bottom: 0px;
        color: #999;
        position: absolute;
        background-color: #f3f3f3;
        width: 40px;
        height: 40px;
        top: 7px;
        right: 16px;
        text-align: right;
        -webkit-border-bottom-right-radius: 3px;
        -webkit-border-top-right-radius: 4px;
        -moz-border-radius-bottomright: 3px;
        -moz-border-radius-topright: 4px;
        border-bottom-right-radius: 3px;
        border-top-right-radius: 4px;
    }

    #switcher .content-switcher {
        padding: 16px;
        overflow: hidden;
    }

    #switcher .content-switcher label {
        /*max-width: 100px;*/
        /*float: left;*/
    }

    #switcher .content-switcher hr {
        border: 0;
        background: 0;
        border-bottom: #eee 1px solid;
    }

    #switcher a.color {
        border-radius: 2px;
        cursor: pointer;
        display: inline-block;
        margin: 4px 2px;
        width: 30px;
        height: 30px;
    }

    #switcher p small {
        font-size: 10px;
    }

    #switcher p {
        margin: 15px 0 10px 0;
        font-size: 12px;
        font-weight: 400;
        color: #2E363F;
    }

    #switcher .styled-select select {
        background: #f5f5f5;
        width: 100%;
        font-size: 13px;
        line-height: 13px;
        outline: none;

        -webkit-appearance: none;
        cursor: pointer;
    }

    /** ============ **/
    #switcher .switcher_thumb {
        display: inline-block;
        margin: 4px 3px;
    }

    #switcher .switcher_thumb.selected {
        box-shadow: #666 0 0 5px;;
    }

    @media only screen and (max-width: 479px) {
        #switcher {
            top: 6px;
            z-index: 1000;
        }

        #showSwitcher {
            top: 65px;
            z-index: 1000;
            width: 25px;
            height: 30px;
            padding: 2px;
            z-index: 1000;
        }
    }
</style>