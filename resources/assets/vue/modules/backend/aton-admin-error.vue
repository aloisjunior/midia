<template>

    <v-layout justify-center>
        <v-flex xs12 sm6 xl4>
            <v-flex xs12 text-xs-center>

                <v-alert transition="slide-x-transition" v-if="status === 0" mode="out-in" :key="0" color="warning" icon="warning" :value="status === 0">
                    Suas permissões estão expiradas, estamos atualizando para você.
                </v-alert>
                <v-alert transition="slide-x-transition" v-else-if="status === 1" mode="out-in" :key="1" color="success" icon="warning" :value="status === 1">
                    Seu acesso foi concedido, estamos redirecionando você.
                </v-alert>
                <v-alert transition="slide-x-transition" v-else mode="out-in" :key="2" color="error" icon="warning" :value="status === 2">
                    Você não tem permissão para acessar este recurso.
                </v-alert>


            </v-flex>
        </v-flex>
    </v-layout>

</template>

<script>
    import bus from '../../modules/events/bus';
    import AtonBaseForm from '../components/aton-base-form.vue';

    export default {
        mixins: [AtonBaseForm],

        name: 'aton-admin-error',
        data() {
            return {

                status: 0, // 0 analise, 1- ok, 2 erro
            }
        },
        mounted() {
            // bus.$on('app-load', () => this.atualizaLayout());

            let self = this;
            bus.$on('user:refresh', self.verificaAcessoAtualizado);
        },
        methods: {
            // atualizaLayout: function () {
            //     bus.$emit('set-menu-active', 'dashboard');
            // },

            verificaAcessoAtualizado: function () {
                let self = this;
                this.$nextTick(function () {
                    var nav = localStorage.getItem('nav-artech');
                    console.log('nav ', nav);
                    if (nav) {
                        nav = JSON.parse(nav);
                        console.log('nav ', nav);
                        if(this.$can(nav.permission)){
                            this.status = 1;
                            setTimeout(function () {
                                self.$router.push({path: nav.path});
                            }, 3000)

                        }else{
                            this.status = 2;
                        }
                    }
                });

            },
        },

        watch: {
            // status: function (newV, oldV) {
            //     if (newV === 1) {
            //         let self = this;
            //
            //     }
            // }
            // monitorar: function () {
            //     if (monitorar){
            //         this.loadDados();
            //         set
            //     }
            // }
        },

        components: {}
    }
</script>

<style>

    /*!*=================to do list=======================*!*/

    /*!* to do *!*/

    /*.todolist_list {*/
    /*display: inline-block;*/
    /*width: 100%;*/
    /*padding-top: 4px;*/
    /*background: #fff;*/
    /*float: left;*/
    /*}*/

    /*.todolist_list:hover {*/
    /*background: #fafafa;*/
    /*}*/

    /*.showbtnschk {*/
    /*display: none;*/
    /*}*/

    /*#todoedit {*/
    /*color: #00c0ef;*/
    /*padding-right: 3px;*/
    /*}*/

    /*.todoedit,*/
    /*.todoedit:hover {*/
    /*color: #00c0ef !important;*/
    /*text-decoration: none;*/
    /*}*/

    /*.showactions .fa {*/
    /*font-size: 14px;*/
    /*padding-top:10px;*/
    /*}*/

    /*.showbtns {*/
    /*float: right;*/
    /*}*/

    /*.to_do_section input[type='checkbox'] {*/
    /*margin: 11px 10px 0;*/
    /*}*/

    /*.todoitem input[type='text'] {*/
    /*width: 80%;*/
    /*margin-left: 9px;*/
    /*margin-top: -19px;*/
    /*height: 22px;*/
    /*}*/

    /*#tododelete {*/
    /*color: #ff8080;*/
    /*padding-left: 3px;*/
    /*}*/

    /*.tododelete,*/
    /*.tododelete:hover {*/
    /*color: #ff8080 !important;*/
    /*text-decoration: none;*/
    /*}*/

    /*.todolist_list > form {*/
    /*background: #fff;*/
    /*margin: 0 !important;*/
    /*padding-top: 3px;*/
    /*}*/

    /*.strikethrough {*/
    /*text-decoration: line-through;*/
    /*color: #ff8080;*/
    /*}*/

    /*.todoitemcheck {*/
    /*float: left;*/
    /*margin-left: 5px;*/
    /*margin-right: 8px;*/
    /*}*/

    /*.seperator {*/
    /*width: 95%;*/
    /*float: left;*/
    /*border-top: 1px solid #eee;*/
    /*margin-left: 2%;*/
    /*padding: 0 15px 0  100px;*/
    /*}*/

    /*.todoitem {*/
    /*padding: 5px 0 8px 50px;*/
    /*}*/

    /*.todoitembtns {*/
    /*margin-top: -3px;*/
    /*margin-bottom: 11px;*/
    /*text-align: right;*/
    /*}*/

    /*.todo_primarybadge {*/
    /*padding: 20px 0 8px 0;*/
    /*margin: 0;*/
    /*border: 2px solid #00c0ef;*/
    /*float: left;*/
    /*background-color: #00c0ef;*/
    /*}*/

    /*.todo_infobadge {*/
    /*padding: 20px 0 8px 0;*/
    /*margin: 0;*/
    /*border: 2px solid #668cff;*/
    /*float: left;*/
    /*}*/

    /*.todo_warningbadge {*/
    /*padding: 20px 0 8px 0;*/
    /*margin: 0;*/
    /*border: 2px solid #0fb0c0;*/
    /*float: left;*/
    /*}*/

    /*.todo_dangerbadge {*/
    /*padding: 20px 0 8px 0;*/
    /*margin: 0;*/
    /*border: 2px solid #ff8080;*/
    /*float: left;*/
    /*}*/

    /*.todo_successbadge {*/
    /*padding: 20px 0 8px 0;*/
    /*margin: 0;*/
    /*border: 2px solid #668cff;*/
    /*float: left;*/
    /*}*/

    /*.todo_mintbadge {*/
    /*padding: 20px 0 8px 0;*/
    /*margin: 0;*/
    /*border: 2px solid transparent;*/
    /*float: left;*/
    /*background-color: #00c0ef;*/
    /*}*/
    /*.btn-secondary{*/
    /*color:#5a5a5a !important;*/
    /*}*/
    /*#main_input_box {*/
    /*margin-top: 20px;*/
    /*padding: 0 12px;*/
    /*}*/

</style>