<template>

    <v-layout justify-center>
        <v-flex xs12 sm10 lg9>
            <v-flex xs12 >

                    <material-card
                            color="secondary"
                            :title="getTitulo('Controle de alterações do sistema')"
                            raised
                    >

                        <v-card-text class="py-0">
                            <v-timeline
                                    align-top
                                    dense
                            >
                                <v-timeline-item
                                        color="green"
                                        small
                                >
                                    <v-layout pt-3>
                                        <v-flex xs4 sm3>
                                            <strong>Versão: 0.9-Beta</strong>
                                            <div class="caption">
                                                15/01/2019 5:11 am
                                            </div>

                                        </v-flex>
                                        <v-flex>
                                            <v-card class="elevation-2"
                                                    :dark="this.isModeDarkForms"
                                                    :light="!this.isModeDarkForms"
                                            >
                                                <v-card-title class="headline">Lançamento</v-card-title>
                                                <v-card-text>
                                                    Valeu a pena esperar, foi lançada plataforma em sua versão Beta
                                                </v-card-text>
                                            </v-card>
                                        </v-flex>
                                    </v-layout>
                                </v-timeline-item>


                            </v-timeline>
                        </v-card-text>
                    </material-card>



            </v-flex>
        </v-flex>
    </v-layout>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins: [AtonBaseForm],


        data() {
            return {
                name: 'aton-admin-versoes-core',

                events: [],
                input: null,
                nonce: 0
            }
        },
        mounted() {

        },
        computed: {
            timeline () {
                return this.events.slice().reverse()
            }
        },

        methods: {
            comment () {
                const time = (new Date()).toTimeString()
                this.events.push({
                    id: this.nonce++,
                    text: this.input,
                    time: time.replace(/:\d{2}\sGMT-\d{4}\s\((.*)\)/, (match, contents, offset) => {
                        return ` ${contents.split(' ').map(v => v.charAt(0)).join('')}`
                    })
                })

                this.input = null
            }
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