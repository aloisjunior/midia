<template>
    <material-card

            :title="getTitulo('Conteúdos para Playlist')"
    >
        <template slot="option">
            <v-tooltip left
                       content-class="left">
                <v-btn

                        class="ma-0"
                        color="primary darken-1"
                        slot="activator"
                        small
                        v-show="$can('playlist_conteudo-store')"
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
                <v-spacer></v-spacer>
                <v-btn
                        depressed
                        :loading="loading"
                        @click="loadDados()"
                        :disabled="loading"
                        small
                >
                    <v-icon small left>mdi-update</v-icon>
                    Procurar

                </v-btn>
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
<div class="font-weight-light subheading pt-1">{{$can('playlist_conteudo-store')? 'Para novo registro clique abaixo.' : ''}}</div>


                                <v-tooltip left
                                           content-class="left">
                                    <v-btn

                                            class="ma-2"
                                            color="primary darken-1"
                                            slot="activator"
                                            small
                                            v-show="$can('playlist_conteudo-store')"
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
                                :rows-per-page-items="[10,25,50,{'text':'Todos','value':-1}]"
                                :hide-headers="!items.length"
                                :hide-actions="!items.length"
                        >
                            <template slot="items" slot-scope="props">
                                <tr @click="props.expanded = !props.expanded">
                                    <td class=" text-xs-center">{{ props.item.id }}</td>
                                    <td class=" text-xs-center hidden-sm-and-down">
                                        <img class="" v-if="props.item.tipo_conteudo=='arquivo'" width="106px" height="60px"
                                             :src="props.item.link_thumbnail">
                                        <img class="" v-else width="106px" height="60px" :src="'/img/atonmidia/icone_url.png'">

                                    </td>
                                    <td class=" text-xs-left caption">
                                        {{ props.item.nome }}
                                        <br v-if="props.item.force_audio" >
                                        <v-tooltip top
                                                   content-class="top">
                                            <v-icon slot="activator" small class="mr-1" v-if="props.item.force_audio" color="blue">volume_up</v-icon>
                                            <span>Som habilitado para <br>este conteúdo</span>
                                        </v-tooltip>
                                    </td>
                                    <td id="tagColumn" class="tagColumn text-xs-left hidden-sm-and-down">
                                        <v-chip
                                                v-for="tag in props.item.tags"
                                                :key="tag"
                                                color="pink lighten-1"
                                                text-color="white"
                                                label
                                                small
                                        >
                                            {{ tag }}
                                        </v-chip>
                                    </td>

                                    <td class=" text-xs-center hidden-md-and-down">Duração: {{ props.item.tempo }} <br>
                                        Tipo: {{ props.item.tipo_conteudo }} {{ props.item.mime ? '['+props.item.mime+']':'' }}
                                    </td>


                                    <td class=" text-xs-center" v-if="$vuetify.breakpoint.mdAndUp">
                                        <v-chip v-if="!props.item.processado" color="grey" text-color="white">
                                            <v-avatar>
                                                <v-icon>timelapse</v-icon>
                                            </v-avatar>
                                            Em processamento
                                        </v-chip>
                                        <v-chip v-else :color="selecionaCor(props.item.processado, props.item.ativo)"
                                                text-color="white">
                                            <v-avatar>
                                                <v-icon v-if="!props.item.ativo">
                                                    not_interested
                                                </v-icon>
                                                <v-icon v-else>check_circle</v-icon>
                                            </v-avatar>
                                            <div v-if="!props.item.ativo" >
                                                Desativado
                                            </div>
                                            <div v-else >
                                                Disponível
                                            </div>
                                        </v-chip>
                                    </td>
                                    <td class=" text-xs-center" v-else>
                                        <v-tooltip content-class="top" top @click.native.stop="">
                                            <v-icon slot="activator" v-if="!props.item.processado" color="grey">timelapse</v-icon>

                                            <v-icon slot="activator" v-else :color="selecionaCor(props.item.processado, props.item.ativo)">
                                                {{ !props.item.ativo ? 'not_interested':  'check_circle'}}
                                            </v-icon>
                                            <span>{{ !props.item.processado ? 'Em processamento' : props.item.ativo ? 'Disponível' : 'Desativado' }}</span>
                                        </v-tooltip>
                                    </td>



                                    <td v-show="$vuetify.breakpoint.mdAndUp"
                                        class="justify-end atonPaddingZero hidden-sm-and-down">
                                        <v-container pa-0>
                                            <v-layout row fill-height justify-end >
                                                <v-tooltip content-class="top" top>
                                                    <v-btn  icon small  class="mx-0"
                                                            @click.native.stop="callDownload(props.item)"
                                                            slot="activator"
                                                            v-show="$can('playlist_conteudo-update')"
                                                            :disabled="!props.item.processado"
                                                    >
                                                        <v-icon color="indigo">cloud_download</v-icon>
                                                    </v-btn>
                                                    <span>Download</span>
                                                </v-tooltip>

                                                <v-tooltip content-class="top" top>
                                                    <v-btn  icon small  class="mx-0"
                                                            @click.native.stop="callPreview(props.item)"
                                                            slot="activator"
                                                            v-show="$can('playlist_conteudo-update')"
                                                            :disabled="!props.item.processado"
                                                    >
                                                        <v-icon color="indigo">video_label</v-icon>
                                                    </v-btn>
                                                    <span>Preview</span>
                                                </v-tooltip>
                                                <v-tooltip content-class="top" top>
                                                    <v-btn  icon small  class="mx-0"
                                                            @click.native.stop="openViewEdit(props.item)"
                                                            slot="activator"
                                                            v-show="$can('playlist_conteudo-update')"
                                                            :disabled="!props.item.processado"
                                                    >
                                                        <v-icon color="teal">edit</v-icon>
                                                    </v-btn>
                                                    <span>Editar</span>
                                                </v-tooltip>
                                                <v-tooltip content-class="left" left >
                                                    <v-btn  icon small  class="mx-0"
                                                            @click.native.stop="abreConfirma(props.item)"
                                                            slot="activator"
                                                            v-show="$can('playlist_conteudo-destroy')"
                                                    >
                                                        <v-icon color="pink">delete</v-icon>
                                                    </v-btn>
                                                    <span>Excluir</span>
                                                </v-tooltip>
                                            </v-layout>
                                        </v-container>
                                    </td>

                                    <td @click.prevent.stop="" v-show="$vuetify.breakpoint.smAndDown"
                                        class="fill-height atonPadding hidden-md-and-up layout justify-end">
                                        <v-menu bottom left
                                                close-on-content-click>
                                            <v-btn
                                                    slot="activator"
                                                    icon
                                            >
                                                <v-icon>more_vert</v-icon>
                                            </v-btn>

                                            <v-list dense >
                                                <v-list-tile
                                                        @click.native.stop="abreConfirma(props.item)"
                                                        v-show="$can('playlist_conteudo-destroy')"
                                                >
                                                    <v-list-tile-action>
                                                        <v-icon small color="pink">delete</v-icon>
                                                    </v-list-tile-action>
                                                    <v-list-tile-title>Excluir</v-list-tile-title>
                                                </v-list-tile>

                                                <v-list-tile
                                                        @click.native.stop="openViewEdit(props.item)"

                                                        v-show="$can('playlist_conteudo-update')"
                                                        :disabled="!props.item.processado"
                                                >
                                                    <v-list-tile-action>
                                                        <v-icon small color="teal">edit</v-icon>
                                                    </v-list-tile-action>
                                                    <v-list-tile-title>Editar</v-list-tile-title>
                                                </v-list-tile>

                                                <v-list-tile
                                                        @click.native.stop="callPreview(props.item)"

                                                        v-show="$can('playlist_conteudo-update')"
                                                        :disabled="!props.item.processado"
                                                >
                                                    <v-list-tile-action>
                                                        <v-icon small color="indigo">video_label</v-icon>
                                                    </v-list-tile-action>
                                                    <v-list-tile-title>Preview</v-list-tile-title>
                                                </v-list-tile>

                                                <v-list-tile
                                                        @click.native.stop="callDownload(props.item)"

                                                        v-show="$can('playlist_conteudo-update')"
                                                        :disabled="!props.item.processado"
                                                >
                                                    <v-list-tile-action>
                                                        <v-icon small color="indigo">cloud_download</v-icon>
                                                    </v-list-tile-action>
                                                    <v-list-tile-title>Download</v-list-tile-title>
                                                </v-list-tile>



                                            </v-list>
                                        </v-menu>
                                    </td>

                                </tr>
                            </template>
                            <template slot="expand" slot-scope="props">
                                <v-card flat>
                                    <v-card-text class="purple lighten-1">
                                        <v-card dark>
                                            <v-card-text>
                                                <v-layout row wrap>
                                                    <v-expansion-panel popout>
                                                        <v-expansion-panel-content
                                                                :key="0"
                                                        >
                                                            <div slot="header">Playlists</div>
                                                            <v-card>
                                                                <v-card-text>
                                                                    <v-chip v-for="item in props.item.playlists" :key="item.id">
                                                                        <a target="_blank"
                                                                           :href='"/admin/playlists/" + item.id + "/edit"'>
                                                                            {{item.nome}}
                                                                        </a>
                                                                    </v-chip>
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-expansion-panel-content>
                                                        <v-expansion-panel-content
                                                                :key="1"
                                                                v-show="props.item.validade_de || props.item.validade_ate || (props.item.agendamento.lenght > 0)"
                                                        >
                                                            <div slot="header">Agendamentos</div>
                                                            <v-card>
                                                                <v-card-text>
                                                            <span v-show="props.item.validade_de">
                                                                Vencimento: {{props.item.validade_de}}
                                                            </span>
                                                                    <span v-show="props.item.validade_ate">
                                                                {{' <-> ' + props.item.validade_ate}}
                                                            </span>

                                                                    <br v-show="props.item.validade_de || props.item.validade_ate">

                                                                    <span v-for="agenda in props.item.agendamento">
                                                            {{agenda.dias}} : {{agenda.hora_inicio + ' <-> ' + agenda.hora_fim}}<br>
                                                        </span>
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-expansion-panel-content>
                                                    </v-expansion-panel>
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

        <aton-preview
                @setCancel="val => openDialogPreview = val"
                :openDialog="openDialogPreview"
                :linkPreview="link_preview"
                :mime="mime_preview"
        ></aton-preview>

    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonMsgExcluir from '../../components/aton-dialog.vue';
    import AtonPreview from '../../components/aton-preview.vue';
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins:[
            // AtonCssLoader,
            AtonBaseForm,
        ],
        name: 'aton-admin-playlist_conteudo-view',
        data() {
            return {
                loading: false,

                itemSelected: null,

                openDialogExcluir: false,
                openDialogPreview: false,

                link_preview: '',
                mime_preview: '',

                pesquisa: {
                    filtro: '',
                },

                search: '',
                pagination: {},
                headers: [
                    {text: 'Id', value: 'id', align: 'center', width: '5%'},
                    {text: 'Preview', value: '_', align: 'center', class: 'hidden-sm-and-down'},
                    {text: 'Nome', value: 'nome', align: 'left'},
                    {text: 'Tags', value: 'tags', align: 'left', class: 'hidden-sm-and-down'},
                    {text: 'Duração/Tipo', value: 'tempo', align: 'center', class: 'hidden-md-and-down'},
                    {text: 'Status', value: '__', align: 'center', width: '20%'},
                    {text: 'Ações', value: '', align: 'right', sortable: false},
                ],
                items: []
            }
        },
        mounted() {
            var self = this;

            bus.$on('playlist_conteudo:updated', () => self.loadDados());

        },


        methods: {
            selecionaIcone: function (processado, ativo) {
                var dif = 1;

                if (dif > 60) {
                    return error;
                }

                return check_circle;
            },
            selecionaCor: function (processado, ativo) {
                if (!ativo) {
                    return "red";
                }
                return "green";
            },
            callDownload: function (item) {
                let link = document.createElement("a");
                link.download = item.nome;
                link.href = item.link_externo;
                link.click();
            },

            callPreview: function (item) {
                this.mime_preview = item.mime;

                if ((item.tipo_conteudo == 'url') || (item.tipo_conteudo == 'streaming')) {
                    this.link_preview = item.url;
                } else {
                    this.link_preview = item.link_externo;
                }
                ;


                this.openDialogPreview = true;
            },
            openViewAdd: function (item) {
                this.$router.push({name: 'playlist_conteudo-add'});
            },
            openViewEdit: function (item) {
                this.$router.push({name: 'playlist_conteudo-edit', params: {id: item.id}});
            },
            loadDados: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/playlist_conteudo/listar', this.pesquisa)
                    .then(response => {
//                        console.log(response);
                        self.loading = false;
                        self.items = response.data.data;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        // self.errors = error.response.data;
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
                this.$http.get('/admin/playlist_conteudo/' + self.itemSelected.id + '/destroy')
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
            AtonMsgExcluir,
            AtonPreview,
        },


    }
</script>

<style>
    /*#create .v-speed-dial {*/
        /*position: absolute;*/
    /*}*/

    /*#create .v-btn--floating {*/
        /*position: relative;*/
    /*}*/

    .atonSpeedDial {
        margin: 0px 2px;
        z-index: 114;
    }

    .atonFab {
        margin: 4px 2px;
        z-index: 115;

    }

    .atonPadding {
        padding: 0 24px;
    }

    .atonPaddingZero {
        padding: 0px;
        /*width: 100%;*/
    }

    table.v-table tbody td[class*="tagColumn"] .v-chip {
        margin: 1px;
    }

    table.v-table tbody td[class*="tagColumn"] .v-chip .v-chip__content {
        padding: 0 4px;
    }

    /*video::-webkit-media-controls-fullscreen-button {*/
    /*display: none;*/
    /*}*/


</style>