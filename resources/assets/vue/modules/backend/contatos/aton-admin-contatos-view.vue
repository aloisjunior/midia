<template>
    <material-card

            :title="getTitulo('Cadastro de Contatos')"
    >
        <template slot="option">
            <v-tooltip left
                       content-class="left">
                <v-btn

                        class="ma-0"
                        color="primary darken-1"
                        slot="activator"
                        small
                        v-show="$can('contato-store')"
                        @click.prevent.stop="openViewAdd()"
                >
                    <v-icon small left>mdi-database-plus</v-icon>
                    Incluir
                </v-btn>
                <span>Incluir</span>
            </v-tooltip>
        </template>

        <material-search-box
                @keyup.enter.stop="loadDados()"
                color="tertiary"
        >
            <v-layout row wrap>
                <v-flex md9 sm12>
                    <v-text-field
                            ref='edtPesquisa'
                            label="Insira o que deseja procurar no banco"
                            value=""
                            hint="Exemplo, nome ou email"
                            v-model="pesquisa.filtro"
                            persistent-hint
                            autofocus
                    ></v-text-field>
                </v-flex>
            </v-layout>

            <template slot="actions">
                <v-layout row wrap>
                    <v-spacer></v-spacer>
                    <v-flex sm6 xs12 text-xs-right>
                        <v-btn
                                :block="$vuetify.breakpoint.xsOnly"
                                depressed
                                :loading="loading"
                                @click="loadDados()"
                                :disabled="loading"
                                small
                        >
                            <v-icon small left>mdi-update</v-icon>
                            Procurar

                        </v-btn>
                    </v-flex>
                </v-layout>
            </template>

        </material-search-box>

        <v-container fluid mt-0 pa-1>
            <v-divider class="mt-2"></v-divider>
            <v-layout row align-center justify-space-between>
                <v-fade-transition mode="out-in">
                    <v-flex xs12
                            py-2
                            v-if="!items.length"
                            :key="1">
                        <v-alert
                                :value="true"
                                color="red lighten-1"
                                style="height:180px; border: 0;"
                                class="layout align-center justify-center row fill-height wrap white--text"
                        >
                            <v-flex xs12 text-xs-center>
                                <span class="font-weight-light title ma-1">
                                    Informe acima o que deseja localizar e atualize a consulta.
                                </span>
<div class="font-weight-light subheading pt-1">{{$can('contato-store')? 'Para novo registro clique abaixo.' : ''}}</div>


                                <v-tooltip left
                                           content-class="left">
                                    <v-btn

                                            class="ma-2"
                                            color="primary darken-1"
                                            slot="activator"
                                            small
                                            v-show="$can('contato-store')"
                                            @click.prevent.stop="openViewAdd()"
                                    >
                                        <v-icon small left>mdi-database-plus</v-icon>
                                        Incluir novo registro
                                    </v-btn>
                                    <span>Incluir</span>
                                </v-tooltip>
                            </v-flex>
                        </v-alert>
                    </v-flex>
                    <v-flex xs12
                            v-else
                            :key="2">

                        <v-layout align-center justify-space-around row fill-height pb-1>
                            <v-flex xs6 >
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                              v-text="'Resultados'"
                                      />
                                    </span>
                            </v-flex>
                            <v-spacer></v-spacer>
                            <v-flex class="align-center text-xs-right">
                                <v-text-field
                                        prepend-inner-icon="search"
                                        clearable
                                        label="Filtrar resultados"
                                        single-line
                                        hide-details
                                        v-model="search"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>


                        <v-data-table
                                v-bind:headers="headers"
                                v-bind:items="items"
                                v-bind:search="search"
                                no-data-text="Sem dados para exibir"
                                rows-per-page-text="Registros p/ página:"
                                :loading="loading"
                                :rows-per-page-items="[5,10,25,{'text':'Todos','value':-1}]"
                                :hide-headers="!items.length"
                                :hide-actions="!items.length"
                        >
                            <template slot="items" slot-scope="props">
                                <tr @click="props.expanded = !props.expanded">
                                    <td class=" text-xs-center">{{ props.item.id }}</td>
                                    <td class=" text-xs-left">
                                        {{ props.item.nome }}
                                    </td>
                                    <td class=" text-xs-left">
                                        {{ props.item.empresa }} <br>
                                        <div class="caption">
                                            {{ props.item.cargo }}
                                        </div>
                                    </td>
                                    <td class=" text-xs-left">
                                        <ul>
                                            <li>
                                                {{props.item.telefone | formateFone}}
                                            </li>
                                        </ul>
                                    </td>
                                    <td class=" text-xs-left">
                                        <ul>
                                            <li>
                                                {{ props.item.email }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td class=" text-xs-center">
                                        <v-icon  small  v-if="props.item.data_confirmacao">check_box
                                        </v-icon>
                                        <v-icon v-else  small  >check_box_outline_blank</v-icon>
                                    </td>
                                    <td class=" text-xs-center">
                                        <v-icon  small  v-if="props.item.ativo">check_box</v-icon>
                                        <v-icon v-else  small  >check_box_outline_blank</v-icon>
                                    </td>
                                    <td class=" text-xs-center">
                                        <v-icon  small  v-if="props.item.receber_mailing">check_box
                                        </v-icon>
                                        <v-icon v-else  small  >check_box_outline_blank</v-icon>
                                    </td>
                                    <td class="text-xs-right">
                                        <v-layout row fill-height justify-end align-center>
                                            <v-tooltip content-class="top" top  >
                                                <v-btn  icon small  class="mx-0"
                                                        @click.native.stop="openViewEdit(props.item)"
                                                        slot="activator"
                                                        v-show="$can('contato-update')"
                                                >
                                                    <v-icon color="teal">edit</v-icon>
                                                </v-btn>
                                                <span>Editar</span>
                                            </v-tooltip>
                                            <v-tooltip content-class="top" top  >
                                                <v-btn  icon small  class="mx-0"
                                                        @click.native.stop="abreConfirma(props.item)"
                                                        slot="activator"
                                                        v-show="$can('contato-destroy')"
                                                >
                                                    <v-icon color="pink">delete</v-icon>
                                                </v-btn>
                                                <span>Excluir</span>
                                            </v-tooltip>
                                            <v-tooltip content-class="left" left  >
                                                <v-btn  icon small  class="mx-0"
                                                        @click.native.stop="openOcorrencias(props.item)"
                                                        slot="activator"
                                                        v-show="$can('contato-index')"
                                                >
                                                    <v-icon color="gree">toc</v-icon>
                                                </v-btn>
                                                <span>Ocorrências</span>
                                            </v-tooltip>
                                        </v-layout>
                                    </td>
                                </tr>

                            </template>
                            <template slot="expand" slot-scope="props">
                                <v-card flat>
                                    <v-card-text class="purple lighten-1">
                                        <v-card dark>
                                            <v-card-text>
                                                <v-layout row wrap>
                                                    <v-flex xs12 md3>
                                                        Tags:
                                                        <v-chip v-for="tag in props.item.list_tags" :key="tag">{{ tag }}</v-chip>
                                                    </v-flex>
                                                    <v-flex xs12 md3>
                                                        Bounce:
                                                        <v-chip v-for="bounce in props.item.list_bounce" :key="bounce">{{ bounce }}
                                                        </v-chip>
                                                    </v-flex>

                                                </v-layout>
                                                <v-layout row wrap v-show="props.item.data_confirmacao != null">
                                                    <v-flex xs12 md3>
                                                        Confirmação de email em: {{ props.item.data_confirmacao | formatDate}}
                                                    </v-flex>


                                                </v-layout>
                                            </v-card-text>
                                        </v-card>
                                    </v-card-text>
                                </v-card>
                            </template>

                        <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>



                    </v-flex>
                </v-fade-transition>
            </v-layout>
        </v-container>

        <aton-msg-excluir
                @setOk="excluirRegistro()"
                @setCancel="val => openDialogExcluir = val"
                :openDialog="openDialogExcluir"
        ></aton-msg-excluir>

    </material-card>
</template>

<script>
    import bus from '../../../modules/events/bus';
    // import AtonPermissions from '../../components/aton-permissions.vue';
    import AtonMsgExcluir from '../../components/aton-dialog.vue';
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins: [
            // AtonCssLoader,
            AtonBaseForm,
        ],
        name: 'aton-admin-contatos-view',
        data() {
            return {


                loading: false,

                itemSelected: null,

                openDialogExcluir: false,

                selected: null,

                pesquisa: {
                    filtro: '',
                },

                search: '',
                pagination: {},
                headers: [
                    {text: 'Id', value: 'id', align: 'center'},
                    {text: 'Nome', value: 'nome', align: 'left'},
                    {text: 'Empresa | Cargo', value: 'link_externo', align: 'left'},
                    {text: 'Telefones', value: 'mime', align: 'center'},
                    {text: 'Email', value: 'mime', align: 'center'},
                    {text: 'Email confirmado', value: 'mime', align: 'center'},
                    {text: 'Ativo', value: 'ativo', align: 'center'},
                    {text: 'Receber Emails', value: 'receber_mailing', align: 'center'},
                    {text: 'Ações', value: '', align: 'right', sortable: false},
                ],
                items: [],
                tags: [],

                show: false,
            }
        },
        mounted() {
            var self = this;

            bus.$on('contato:updated', (novo) => self.loadDados(novo));

//            this.loadDados();
//            this.loadTags();

            this.$refs.edtPesquisa.focus();
        },
        methods: {
            openOcorrencias: function (item) {

            },
            loadTags: function () {
                let self = this;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/contato/tags/listar')

                    .then(response => {
                        self.loading = false;
                        self.tags = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            openViewAdd: function (item) {
                this.$router.push({name: 'contatos-add'});
            },
            openViewEdit: function (item) {
                this.$router.push({name: 'contatos-edit', params: {id: item.id}});
            },
            loadDados: function (novo) {
                if (this.loading) return false;
                let self = this;
                this.loading = true;

//                console.log(novo);
                if (novo && (novo != '')) {
                    this.pesquisa.filtro = novo;
                }

                this.$http.post('/admin/contato/listar', this.pesquisa)
                    .then(response => {
//                        console.log(response);
                        self.loading = false;
                        self.items = response.data;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
            abreConfirma: function (item) {
                this.itemSelected = item;
                this.openDialogExcluir = true;
            },
            excluirRegistro: function () {
                let self = this;
                if (this.loading) return false;

                self.openDialogExcluir = false;
                bus.$emit('atonprogress:on');
                this.loading = true;
                this.$http.get('/admin/contato/' + self.itemSelected.id + '/destroy')
                    .then(response => {
                        self.loading = false;

                        let index = self.items.indexOf(self.itemSelected);
                        self.items.splice(index, 1);

                        let msg = response.data;

                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'success', 'Registro excluido');

                        self.itemSelected = null;
                    })
                    .catch(error => {
                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'error', 'Não foi possível excluir o registro');

                        self.loading = false;
                    });

            }
        },
        components: {
            AtonMsgExcluir
        }
    }
</script>

<style scoped>
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


</style>