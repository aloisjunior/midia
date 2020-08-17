<template>
    <transition name="slide-fade" mode="out-in">
        <div v-show="pronto">
            <section id="clientes">
                <div class="container">
                    <div class="heading-title heading-border">
                        <h3>Nossos <span>Clientes</span></h3>
                        <p class="font-lato fs-14">Tem um espaço aqui esperando você.</p>
                    </div>

                    <div class="text-center">
                        <slick ref="slick" :options="slickOptions">
                            <div class="item-box" v-for="cliente in clientesComLogo">
                                <a :href="cliente.url_perfil" target="_blank"
                                v-if="cliente.url_perfil">
                                    <figure>
                                        <img class="img-fluid"
                                             :src="'//cdn.rothermel.com.br/thumbnail/clientes/'+cliente.arquivos[0].filename"
                                             width="200" height="200"
                                             alt="">
                                    </figure>

                                    <div class="item-box-desc text-center">
                                        <h3>{{cliente.nome}}</h3>
                                        <ul class="list-inline categories m-0 fs-10">
                                            <li v-for="tag in cliente.list_tags">
                                                {{ tag}}
                                            </li>

                                        </ul>
                                    </div>
                                </a>
                                <div
                                   v-else>
                                    <figure>
                                        <img class="img-fluid"
                                             :src="'//cdn.rothermel.com.br/thumbnail/clientes/'+cliente.arquivos[0].filename"
                                             width="200" height="200"
                                             alt="">
                                    </figure>

                                    <div class="item-box-desc text-center">
                                        <h3>{{cliente.nome}}</h3>
                                        <ul class="list-inline categories m-0 fs-10">
                                            <li v-for="tag in cliente.list_tags">
                                                {{ tag}}
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </slick>
                    </div>
                </div>
            </section>

            <section id="depoimentos">
                <div class="container">
                    <div class="heading-title heading-border">
                        <h3><span>Depoimentos</span> de Clientes</h3>
                        <p class="font-lato fs-14">Veja o que diz quem já anuncia conosco.</p>
                    </div>


                    <slick class="owl-mini-testimonial" ref="slick2" :options="slickOptions2">
                        <div class="testimonial" v-for="cli in clientesComDepoimento">
                            <div class="testimonial-content p-0">

                                <cite>
                                    <blockquote class="quote ml-5">
                                        <p class="ml-25 fs-17 font-style-italic">{{cli.depoimento_texto}}</p>
                                        <cite>{{cli.depoimento_autor}}</cite>
                                        <span class="fs-15 font-style-italic">{{cli.nome}}</span>
                                    </blockquote>
                                </cite>
                            </div>

                        </div>

                    </slick>

                </div>

            </section>
            <div id="c1"></div>
        </div>
    </transition>
</template>

<script>
    import Slick from 'vue-slick';

    export default {
        components: {
            Slick,
        },
        name: 'aton-clientes-info',
        data() {
            return {

                loading: false,

                pronto: false,

                dados: [],
                slickOptions: {
                    arrows: false,
                    dots: false,
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    autoplay: true,
                    autoplaySpeed: 4000,

                },
                slickOptions2: {
                    arrows: false,
                    dots: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 4000,

                },

            }
        },
        created() {

        },

        mounted() {
            let self = this;
//            setTimeout(function () {
            self.getDados();
//            }, 500);
        },

        methods: {
            openLink: function(url){
                console.log(url);
                window.open(url,"_blank");
            },
            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                let currIndex = this.$refs.slick.currentSlide()
                this.$refs.slick.destroy()
                this.$nextTick(() => {
                    this.$refs.slick.create()
                    this.$refs.slick.goTo(currIndex, true)
                });

                let currIndex2 = this.$refs.slick2.currentSlide()
                this.$refs.slick2.destroy()
                this.$nextTick(() => {
                    this.$refs.slick2.create()
                    this.$refs.slick2.goTo(currIndex2, true)
                })
            },
            getDados: function () {
                if (this.loading) return false;

                let self = this;

                this.loading = true;
                this.$http.get('/clientes/info')
                    .then((response) => {
                        self.loading = false;
//
//                        console.log(response);
//                        self.dados = [];
                        self.dados = response.data;

                        self.pronto = true;
                    })
                    .catch(error => {
                        self.postError = true;

                        self.loading = false;
                        console.log(error.response.data);
                    });

            },
        },
        computed: {
            clientesComLogo() {
                return this.dados.filter(item => {
                    return item.arquivos.length > 0;
                })
            },
            clientesComDepoimento() {
                return this.dados.filter(item => {
                    return item.depoimento_texto != '' && item.depoimento_texto != null;
                })
            }
        },
        watch: {
            dados: function (newWords) {
                this.reInit();
            }
        },
    }

</script>


<style scoped>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active for <2.1.8 */
    {
        transform: translateX(7px);
        opacity: 0;
    }
</style>