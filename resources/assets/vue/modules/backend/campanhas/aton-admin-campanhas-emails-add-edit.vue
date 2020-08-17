<template>
    <v-card>
        <v-toolbar dense dark color="secondary" class=" green--text">
            <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Novo email')}}</v-toolbar-title>

            <v-spacer></v-spacer>
            <v-btn  icon small
                   color="blue"
                   @click="help=true">
                <v-icon>live_help</v-icon>
            </v-btn>
            <v-btn  icon small
                   color="red"
                   @click="openView()">
                <v-icon>close</v-icon>
            </v-btn>
            <v-btn  icon small
                   color="green"
                   @click.prevent.stop="openViewAdd()">
                <v-icon>save</v-icon>
            </v-btn>
        </v-toolbar>

        <div class="div-progress">
            <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                               :indeterminate="true"></v-progress-linear>
        </div>
        <v-divider black></v-divider>


        <v-form v-model="formCtrl" ref="form" lazy-validation>
            <v-card-text>
                <v-container fluid grid-list-md>
                    <v-layout row wrap>
                        <v-flex xs12 md6>
                            <v-text-field v-model="dadosDB.nome" label="Nome" required
                                          ref="nome"
                                          :error-messages="errors.nome"
                                          :error="inError"
                                          :rules="rules.required"
                                          autofocus
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="dadosDB.descricao" label="Descrição" required
                                          :error-messages="errors.descricao"
                                          :rules="rules.required"
                                          :error="inError"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>

                    <v-layout row wrap>
                        <v-flex xs12 md6>
                            <v-text-field v-model="dadosDB.assunto" label="Assunto" required
                                          ref="assunto"
                                          :error-messages="errors.assunto"
                                          :error="inError"
                                          :rules="rules.required"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="dadosDB.assunto_reenvio" label="Assunto ao reenviar" required
                                          :error-messages="errors.assunto_reenvio"
                                          :rules="rules.required"
                                          :error="inError"
                            ></v-text-field>
                        </v-flex>
                    </v-layout>

                    <v-layout row wrap>
                        <v-flex xs12 md12>
                            <v-text-field v-model="dadosDB.documento" label="Corpo do email (linguagem markdown)" required
                                          :error-messages="errors.documento"
                                          :rules="rules.required"
                                          :error="inError"
                                          textarea
                                          rows="15"

                            ></v-text-field>
                        </v-flex>
                    </v-layout>



                    <v-flex xs12 md2 pt-4>
                        <v-checkbox pt-4 green
                                    label="Ativo"
                                    v-model="dadosDB.ativo"></v-checkbox>
                    </v-flex>
                </v-container>
            </v-card-text>

        </v-form>

        <v-dialog
                v-model="help"
                fullscreen
                transition="dialog-bottom-transition"
                :overlay="false"
                scrollable
        >
            <v-card tile>
                <v-toolbar card dark color="primary">
                    <v-btn  icon  @click.native="help = false" dark>
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Informações para criação de novos emails')}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click.native="help = false">Sair</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-card-text>
                    <v-list three-line subheader>
                        <v-subheader>Linguagem markdown</v-subheader>
                        <v-list-tile avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Content filtering</v-list-tile-title>
                                <v-list-tile-sub-title>Set the content filtering level to restrict apps that can be downloaded</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>


                    </v-list>
                    <v-divider></v-divider>
                    <v-list three-line subheader>
                        <v-subheader>General</v-subheader>
                        <v-list-tile avatar>
                            <v-list-tile-action>
                                <v-checkbox ></v-checkbox>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>Notifications</v-list-tile-title>
                                <v-list-tile-sub-title>Notify me about updates to apps or games that I downloaded</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-action>
                                <v-checkbox></v-checkbox>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>Sound</v-list-tile-title>
                                <v-list-tile-sub-title>Auto-update apps at any time. Data charges may apply</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-action>
                                <v-checkbox ></v-checkbox>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>Auto-add widgets</v-list-tile-title>
                                <v-list-tile-sub-title>Automatically add home screen widgets</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card-text>

                <div style="flex: 1 1 auto;"/>
            </v-card>
        </v-dialog>



    </v-card>
</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        name: 'aton-admin-campanhas-emails-add-edit',
        data() {
            return {


                dadosDB: {
                    intervalo_dias_envio: 1,
                    dias_reenvio: 0,
                    atraso_inicio_envio: 0,
                    ativo: true,
                    inicio_imediato: true,
                    list_tags: [],
                },

                tags: [],

                dateFormatted: null,

                menu_data_inicio: false,

                stepper: 1,

                help: false,

            }
        },
        mounted() {
            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.ativo = true;
            }


            this.loadTags();
        },

        methods: {

            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/campanha/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.setDadosDB(response.data);
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            loadTags: function () {
                let self = this;
//                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/admin/campanha/tags/listar')
                    .then(response => {
                        self.loading_extras = false;

                        if (JSON.stringify(response.data) == '[]') {
                            self.tags = [];
                        } else
                            self.tags = response.data;
//                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
//                        bus.$emit('atonprogress:off');
                    });


            },

            voltaView: function (atualizaConsulta) {

//                this.$router.push({path: '/admin/campanhas/add'});
                this.$router.push({path: '/admin/campanhas'});
            },

            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/campanha';

                if (this.isEdit) {
                    _url = '/admin/campanha/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

//                        self.dadosDBOriginal = self.dadosDB;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        let msg = response.data;

                        bus.$emit('atonmsg', 'success', msg);

                        self.stepper = 2;

                        // self.voltaView();
                        bus.$emit('campanha:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });
            },
            formatDate(date) {
                if (!date) {
                    return null
                }

                const [year, month, day] = date.split('-')
                return `${day}/${month}/${year}`
            },
            parseDate(date) {
                if (!date) {
                    return null
                }

                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            },
        }
    }
</script>

<style>
</style>