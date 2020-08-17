<template>
    <section>
        <div class="container">

            <!--<b-alert show >-->
                <!--<h4 class="alert-heading">Well done!</h4>-->
                <!--<p>-->
                    <!--Aww yeah, you successfully read this important alert message.-->
                    <!--This example text is going to run a bit longer so that you can see-->
                    <!--how spacing within an alert works with this kind of content.-->
                <!--</p>-->
                <!--<hr>-->
                <!--<p class="mb-0">-->
                    <!--Whenever you need to, be sure to use margin utilities to keep things nice and tidy.-->
                <!--</p>-->
            <!--</b-alert>-->


            <div class="callout callout-theme-color">
                <div class=""><!-- add here .container if needed for fullwidth -->
                    <div class="row">

                        <div class="col-md-9"><!-- title + shortdesc -->
                            <h3>Quer anunciar com mínima concorrência também?</h3>
                            <p>Basta clicar ao lado e entraremos em contato com você, <strong>valorize</strong> seu negócio!</p>
                        </div>

                        <div class="col-md-3 text-right"><!-- button -->
                            <a href="#c1">
                            <div v-if="this.exibir == false" @click="setShow()" class="btn btn-primary btn-lg">Sim, quero!
                            </div>
                            <div v-else="this.exibir == true" @click="setShow()" class="btn btn-primary btn-lg">Cancelar
                            </div>
                            </a>
                        </div>
                    </div>


                    <transition name="slide-fade" mode="out-in">

                        <div class="col-md-12" v-show="this.exibir">
                            <!--<div class="divider double-line">&lt;!&ndash; divider &ndash;&gt;</div>-->

                            <div class="alert alert-dark mb-30 mt-20"><!-- SUCCESS -->
                                <span class="fs-16 txt-success">Quase lá, <strong>indique seus dados para contato.</strong></span>
                            </div>

                            <!--<h4><strong>Quase lá,</strong> indique seus dados para contato</h4>-->
                            <form ref="form" id="form" class="sky-form clearfix" @submit.prevent="formSubmit">

                                <label class="input">
                                    <i class="ico-prepend fa fa-user"></i>
                                    <input ref="nome" type="text" placeholder="Nome" required>
                                </label>

                                <label class="input">
                                    <i class="ico-prepend fa fa-envelope"></i>
                                    <input type="email" placeholder="Email" required>
                                </label>

                                <label class="input">
                                    <i class="ico-prepend fa fa-phone"></i>
                                    <masked-input mask="(11) 1111-11111"
                                    id="telefone"
                                    class="form-control"
                                    placeholder-char=" "
                                    required
                                    @input="dadosDB.telefone = arguments[1]"/>
                                </label>

                                <label class="textarea">
                                    <i class="ico-prepend fa fa-comment"></i>
                                    <textarea rows="3" placeholder="Sua mensagem" required></textarea>
                                </label>

                                <button type="submit" class="btn-3d btn-teal btn-xlg btn-block mt-30">
                                    ENVIAR
                                    <span class="block font-lato">Retornaremos contato em até 48 horas</span>
                                </button>
                            </form>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import MaskedInput from 'vue-masked-input';

    export default {
        data() {
            return {
                el: '#form',
                name: 'aton-form-captura1',
                loading: false,

                dadosDB: {
                    telefone:'',
                },

                exibir: false,
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
        },

        components: {
            MaskedInput,
        },

        methods: {
            formReset: function (){
                this.$refs.form.reset();
            },
            formSubmit: function(event) {
                event.target.reset();
            },
            setShow: function (val) {
//                console.log(val);
                this.exibir = !this.exibir;

                if (this.exibir) {
                    this.$refs.nome.focus();
                }else{
                    this.formReset();
                }
//                if (!val){
//                    this.$cookie.set('exibirMsg', this.exibirMsg, 1);
//                }
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
        /*transform: translateY(-300px);*/
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
        /*transform: translateY(-200px);*/
        opacity: 0;
    }

    section {
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
            top: 8px;
            z-index: 1000;
        }
    }
</style>