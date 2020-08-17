<template>
    <v-card
    >
        <v-toolbar dark color="secondary" class=" white--text">
            <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Campanha') }}</v-toolbar-title>
        </v-toolbar>
        <div class="div-progress">
            <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                               :indeterminate="true"></v-progress-linear>
        </div>
        <v-divider black></v-divider>

        <v-stepper v-model="stepper" vertical>
            <v-stepper-step step="1" :editable="this.isEdit" :complete="stepper > 1">
                Configuração da Campanha
            </v-stepper-step>
            <v-stepper-content step="1">
                <v-card dark>
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

                                    <v-flex xs12 md2>

                                        <v-text-field
                                                v-model="dadosDB.intervalo_dias_envio"
                                                label="Dias entre emails"
                                                type="number"></v-text-field>

                                    </v-flex>
                                    <v-flex xs12 md2>

                                        <v-text-field
                                                v-model="dadosDB.dias_reenvio"
                                                label="Renviar em quantos dias?"
                                                type="number"></v-text-field>

                                    </v-flex>

                                    <v-flex xs12 md2 pt-4>
                                        <v-checkbox green
                                                    label="Iniciar imediatamente?"
                                                    v-model="dadosDB.inicio_imediato"></v-checkbox>
                                    </v-flex>
                                    <v-flex xs12 md2>
                                        <v-menu
                                                ref="menu"
                                                lazy
                                                :close-on-content-click="true"
                                                v-model="menu_data_inicio"
                                                transition="scale-transition"
                                                offset-y
                                                full-width
                                                :nudge-right="40"
                                                max-width="290px"
                                                min-width="290px"
                                        >
                                            <v-text-field v-show="!dadosDB.inicio_imediato"
                                                          transition="fade-transition"
                                                          slot="activator"
                                                          label="Data de Início"
                                                          v-model="dadosDB.data_inicio_envio"
                                                          readonly

                                            ></v-text-field>
                                            <v-date-picker
                                                    ref="picker"
                                                    @change="saveDate"
                                                    v-model="dadosDB._data_inicio_envio" scrollable
                                                    locale="pt-br"
                                                    reactive
                                                    @input="dadosDB.data_inicio_envio = formatDate($event)"
                                            >
                                            </v-date-picker>
                                        </v-menu>
                                    </v-flex>
                                </v-layout>

                                <v-flex xs12 md6>
                                    <v-combobox
                                            label="Tags"
                                            required
                                            :items="tags"
                                            v-model="dadosDB.list_tags"
                                            chips
                                            tags
                                            multiple
                                            deletable-chips
                                            hint="Você pode indicar mais de uma tag"
                                            persistent-hint
                                            no-data-text="Nenhum histórico encontrado"
                                            ref="tags"
                                            @keyup.enter.stop=""
                                            @input="(val) => dadosDB.tags = val"
                                            :error-messages="errors.tags"
                                            :error="inError"
                                            :rules="rules.required"
                                    >
                                    </v-combobox>

                                </v-flex>

                                <v-flex xs12 md2 pt-4>
                                    <v-checkbox pt-4 green
                                                label="Ativo"
                                                v-model="dadosDB.ativo"></v-checkbox>
                                </v-flex>
                            </v-container>
                        </v-card-text>

                    </v-form>
                    <v-btn color="primary"
                           :loading="loading"
                           @click="callPost()"
                           :disabled="loading">
                        Salvar e Continuar

                    </v-btn>
                    <v-btn class="blue--text darken-1" @click="voltaView()">Cancelar inclusão</v-btn>
                </v-card>
            </v-stepper-content>


            <v-stepper-step step="2" :complete="stepper > 2">Emails para envio</v-stepper-step>
            <v-stepper-content step="2">
                <v-card dark flat tile>
                    <v-toolbar dense>
                        <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Emails da campanha')}}</v-toolbar-title>

                        <v-spacer></v-spacer>
                        <v-btn  icon small
                               v-show="$can('campanha-index')"
                               @click="openView()">
                            <v-icon>apps</v-icon>
                        </v-btn>
                        <v-btn  icon small
                               color="primary"
                               v-show="$can('campanha-store')"
                               @click.prevent.stop="openViewAdd()"
                        >
                            <v-icon small left>mdi-database-plus</v-icon>
                        </v-btn>
                    </v-toolbar>


                    <keep-alive include="aton-admin-campanhas-emails-view">
                        <transition name="slide-fade" mode="out-in">
                            <component :is="viewDetail"></component>
                        </transition>
                    </keep-alive>


                    <v-btn color="primary" @click.native="stepper = 3"
                           :loading="loading"
                           :disabled="loading">
                        Salvar e Continuar
                    </v-btn>
                    <v-btn class="blue--text darken-1" @click="voltaView()">Cancelar inclusão</v-btn>

                </v-card>


            </v-stepper-content>
            <v-stepper-step step="3" :rules="[() => false]">
                Leads
                <small>Alert message</small>
            </v-stepper-step>
            <v-stepper-content step="3">
                <v-card dark>
                    <v-card >
                        <v-tabs left >
                            <v-tab href="#tab-1" class="green--text">
                                Adicionar dos Contatos
                            </v-tab>
                            <v-tab href="#tab-2" class="green--text">
                                Incluir manualmente
                            </v-tab>

                            <v-tab-item
                                    id="tab-1"
                            >
                                <v-card dark flat>
                                    <v-card-text>

                                    </v-card-text>
                                </v-card>
                            </v-tab-item>
                            <v-tab-item
                                    id="tab-2"
                            >
                                <v-card dark flat
                                        @keyup.enter.prevent=""
                                        @keyup.esc.prevent=""
                                >
                                    <v-card-text>
                                        <v-container fluid grid-list-md>
                                            <v-layout row wrap>
                                                <v-flex xs12 md4>
                                                    <v-text-field v-model="dadosDB.nome_lead" label="Nome"
                                                                  ref="nome_lead"
                                                                  autofocus
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md4>
                                                    <v-text-field v-model="dadosDB.email_lead" label="Email" required
                                                                  ref="email_lead"
                                                                  :error-messages="errors.email_lead"
                                                                  :rules="rules.email_required"
                                                                  :error="inError"
                                                                  @update:error="(payload) => setPodeAdicionar(payload)"

                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md4>
                                                    <v-btn  color="green"
                                                            :disabled="!podeAdicionar"
                                                    @click.native="adicionarEmailLead(dadosDB.nome_lead, dadosDB.email_lead)">
                                                        Adicionar
                                                    </v-btn>

                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </v-card-text>
                                    <v-card-text >
                                    <v-alert transition="fade" type="success" :value="msg_duplicado">
                                        Email já cadastrado para recebimento
                                    </v-alert>
                                    </v-card-text>

                                </v-card>
                            </v-tab-item>

                        </v-tabs>


                        <v-card-text>
                            <v-divider></v-divider>
                            <v-subheader>Leads para envio da campanha</v-subheader>
                            <v-data-table
                                    :headers="headers_emails"
                                    :items="lista_leads"
                                    v-model="selected"
                                    item-key="email"
                                    no-data-text="Adicione emails de destino para o envio da campanha"
                                    rows-per-page-text="Registros p/ página:"
                                    select-all
                                    class="elevation-1"
                                    :rows-per-page-items="[5,10,25,{'text':'Todos','value':-1}]"
                                :hide-headers="!items.length"
                                    :hide-actions="!items.length"
                            >
                                <template slot="items" slot-scope="props">
                                    <td>
                                        <v-checkbox
                                                primary
                                                hide-details
                                                v-model="props.selected"
                                        ></v-checkbox>
                                    </td>
                                    <td class="text-xs-left hidden-sm-and-down">{{ props.item.nome }}</td>
                                    <td class="text-xs-left">{{ props.item.email }}</td>
                                </template>
                            <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>

                        </v-card-text>


                    </v-card>

                    <v-btn color="primary" @click.native="stepper = 4"
                           :loading="loading"
                           :disabled="loading">
                        Salvar e Continuar
                    </v-btn>
                    <v-btn class="blue--text darken-1" @click="voltaView()">Cancelar inclusão</v-btn>
                </v-card>

            </v-stepper-content>
            <v-stepper-step step="4">View setup instructions</v-stepper-step>
            <v-stepper-content step="4">
                <v-card color="grey lighten-1" class="mb-5" height="200px"></v-card>
                <v-btn color="primary" @click.native="stepper = 1">Continue</v-btn>
                <v-btn flat>Cancel</v-btn>
            </v-stepper-content>
        </v-stepper>
    </v-card>
</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    import AtonAdminCampanhasEmailsView from '../../../modules/backend/campanhas/aton-admin-campanhas-emails-view.vue';
    import AtonAdminCampanhasEmailsAddEdit from '../../../modules/backend/campanhas/aton-admin-campanhas-emails-add-edit.vue';


    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        name: 'aton-admin-campanhas-add-edit',
        data() {
            return {


                headers_emails: [
                    {
                        text: 'Nome',
                        align: 'left',
                        value: 'Nome',
                        width: '45%',
                        class: 'hidden-sm-and-down'
                    },
                    {
                        text: 'Email',
                        align: 'left',
                        value: 'email',
                        width: '45%',
                    },
                ],

                selected: [],


                dadosDB: {
                    intervalo_dias_envio: 1,
                    dias_reenvio: 0,
                    atraso_inicio_envio: 0,
                    ativo: true,
                    inicio_imediato: true,
                    _data_inicio_envio: null,
                    nome_lead: '',
                    email_lead: '',

                    list_tags: [],

                },

                tags: [],

                lista_leads: [],

                dateFormatted: null,

                menu_data_inicio: false,

                stepper: 1,

                msg_duplicado: false,

                temErrorEmail: false,

                viewDetail: 'aton-admin-campanhas-emails-view',
            }
        },
        mounted() {
            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.ativo = true;
                this.dadosDB.inicio_imediato = false;
                this.dadosDB.intervalo_dias_envio = 1;
                this.dadosDB.dias_reenvio = 0;
                this.dadosDB.atraso_inicio_envio = 0;


                var now = new moment() + 1;
                var datetime = moment(now).format('DD/MM/YYYY');

                this.dadosDB.data_inicio_envio = datetime;
                this.stepper = 1;
            }


            this.loadTags();
        },

        components: {
            AtonAdminCampanhasEmailsView,
            AtonAdminCampanhasEmailsAddEdit
        },
        methods: {
            setPodeAdicionar: function (payload) {
                this.temErrorEmail = payload;
            },
            adicionarEmailLead: function(nome, email){
                if (!this.lista_leads.find(item => item.email === email)){
                    this.lista_leads.push({
                        nome: nome ? nome : email,
                        email: email
                    });
                }else{
                    this.msg_duplicado = true;

                    let self = this;

                    setTimeout(function(){
                        self.msg_duplicado = false;

                        }, 5000);

                }

                this.dadosDB.nome_lead = '';
                this.dadosDB.email_lead = '';

                this.$refs.email_lead.focus();

            },
            removerListaManual(item) {
                this.lista_leads.splice(this.lista_leads.indexOf(item), 1)
                this.lista_leads = [...this.lista_leads]
            },
            openViewAdd: function (item) {
                this.viewDetail = 'aton-admin-campanhas-emails-add-edit';

            },
            openView: function (item) {
                this.viewDetail = 'aton-admin-campanhas-emails-view';

            },
            openViewEdit: function (item) {
                this.$router.push({name: 'campanhas-edit', params: {id: item.id}});
            },
            saveDate(date) {
                this.$refs.menu.save(date)
            },

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

                        if (self.isAdd) {
                            var msg = response.data.result;
                        } else {
                            var msg = response.data;
                        }


                        bus.$emit('atonmsg', 'success', msg);

                        self.stepper = 2;

                        // self.voltaView();
                        bus.$emit('campanha:updated');

                        if (self.isAdd) {
                            var idNew = response.data.id;

                            // self.$router.push({name: 'campanhas-edit-emails-view', params: {id: idNew}});
                        } else {
                            var msg = response.data;
                        }
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
        },
        computed: {
            podeAdicionar: function () {
                return this.dadosDB.email_lead && !this.temErrorEmail;
            }
        },
    }
</script>

<style>
</style>