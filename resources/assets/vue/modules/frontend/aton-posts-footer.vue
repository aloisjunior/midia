<template>

        <div class="col-md-5 hidden-sm hidden-xs-down">
            <h4 class="letter-spacing-1">NOVIDADES</h4>
            <ul class="list-unstyled footer-list half-paddings">
                <li v-for="post in dados">
                    <a class="block" :href="'/artigos/'+ post.slug">{{ post.titulo }}</a>
                    <small> {{ formatarData(post.created_at) }}</small>
                    <!--<small>Julho 23, 2017</small>-->

                </li>
            </ul>
        </div>


</template>

<script>
    export default {
        name: 'aton-posts-footer',
        data() {
            return {

                loading: false,

                dados: {
                },

            }
        },
        mounted() {
            this.getDados();
        },
        components: {
        },
        methods: {
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
            formatarData: function(val){
                return moment(val).format('MMMM DD[,] YYYY');
            },
        }
    }
</script>

<style>


</style>