<template>
    <v-card>
        <v-card-text>
            <v-data-table
                    v-bind:headers="headers"
                    v-bind:items="items"
                    no-data-text="Inclua um email para a campanha"
                    rows-per-page-text="Registros p/ página:"
                    :loading="loading"
                    :rows-per-page-items="[5,10,25,{'text':'Todos','value':-1}]"
                                :hide-headers="!items.length"
                    :hide-actions="!items.length"
            >
                <template slot="items" slot-scope="props">
                    <td class=" text-xs-center">{{ props.item.id }}</td>
                    <td class=" text-xs-left">{{ props.item.nome }} <br> <div class="caption">{{ props.item.descricao }} </div></td>
                    <td class=" text-xs-center">
                        <v-chip small v-for="(value, key) in props.item.list_tags"
                                :key="key"
                                outline class="primary primary--text">{{ value }}
                        </v-chip>
                    </td>
                    <td class=" text-xs-center">{{ props.item.data_inicio_envio }}</td>


                    <td class=" text-xs-center">
                        <v-icon  small  v-if="props.item.ativo">check_box</v-icon>
                        <v-icon v-else  small  >check_box_outline_blank</v-icon>
                    </td>
                    <td class="text-xs-right">
                            <v-layout row fill-height justify-end align-center>
                        <v-tooltip content-class="top" top  >
                            <v-btn  icon small  class="mx-0"
                                   @click="openViewEdit(props.item)"
                                   slot="activator"
                                   v-show="$can('campanha-update')"
                            >
                                <v-icon color="teal">edit</v-icon>
                            </v-btn>
                            <span>Editar</span>
                        </v-tooltip>
                        <v-tooltip content-class="left" left  >
                            <v-btn  icon small  class="mx-0"
                                   @click="abreConfirma(props.item)"
                                   slot="activator"
                                   v-show="$can('campanha-destroy')"
                            >
                                <v-icon color="pink">delete</v-icon>
                            </v-btn>
                            <span>Excluir</span>
                        </v-tooltip>
                        </v-layout>
                    </td>

                </template>

            <template slot="pageText" slot-scope="props">
                                Linhas {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
                            </template>
                        </v-data-table>
        </v-card-text>

        <aton-msg-excluir
                @setOk="excluirRegistro()"
                @setCancel="val => openDialogExcluir = val"
                :openDialog="openDialogExcluir"
        ></aton-msg-excluir>

    </v-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonMsgExcluir from '../../components/aton-dialog.vue';
    import AtonCssLoader from '../../components/comum/aton-css-loader.vue';

    export default {
        mixins: [
            AtonCssLoader,
        ],
        name: 'aton-admin-campanhas-emails-view',
        data() {
            return {


                loading: false,

                itemSelected: null,

                pesquisa: {
                    filtro: '',
                },

                openDialogExcluir: false,

                search: '',
                pagination: {},
                headers: [
                    {text: 'Id', value: 'id', align: 'center'},
                    {text: 'Nome|Descrição', value: 'nome', align: 'left', width: '30%'},
                    {text: 'Tags', value: 'host', align: 'center'},
                    {text: 'Data Inicio', value: 'posta', align: 'center'},
                    {text: 'Ativo', value: 'ativo', align: 'center'},
                    {text: 'Ações', value: '', align: 'right', sortable: false},
                ],
                items: []
            }
        },
        mounted() {
            var self = this;

            bus.$on('campanha:updated', () => self.loadDados());

//            this.loadDados();

//            this.$refs.edtPesquisa.focus();
        },
        methods: {
            openViewAdd: function (item) {
                this.$router.push({name:'campanhas-add-emails-add-edit'});

            },
            openViewEdit: function (item) {
                this.$router.push({name:'campanhas-edit', params: { id: item.id }});
            },
            loadDados: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/campanha/listar', this.pesquisa)
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

                this.loading = true;
                this.$http.get('/admin/campanha/' + self.itemSelected.id + '/destroy')
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

<style>
    .caption {
        font-size: 11px!important;
    }

</style>