<template>
    <material-card

            :title="getTitulo('Playlist')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >


        <v-form v-model="formCtrl" ref="form" lazy-validation>

            <div class="div-progress">
                <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                                   :indeterminate="true"></v-progress-linear>
            </div>

            <v-card-title>

                <v-text-field v-model="dadosDB.nome" label="Nome" required
                              ref="nome"
                              :error-messages="errors.nome"
                              box
                              hide-details
                              autofocus
                              :disabled="isReadOnly"
                ></v-text-field>

                <v-spacer></v-spacer>
                <v-text-field
                        prepend-inner-icon="search"
                        clearable
                        label="Filtrar conteúdos inseridos"
                        single-line
                        hide-details
                        v-model="search"
                ></v-text-field>
            </v-card-title>


            <v-card
                    :dark="this.isModeDarkForms"
                    :light="!this.isModeDarkForms"
            >
                <v-toolbar :dark="!isModeDarkForms"
                           :light="isModeDarkForms">
                    <v-toolbar-title class="subheading">Incluir conteúdos</v-toolbar-title>
                    <v-tooltip top content-class="top">
                        <v-btn icon small

                               slot="activator"
                               @click="callConteudoAdd()"
                               :disabled="isReadOnly"
                        >
                            <v-icon color="teal lighten-1">video_label</v-icon>
                        </v-btn>
                        <span>Conteúdo</span>
                    </v-tooltip>
                    <v-tooltip top content-class="top">
                        <v-btn icon small

                               slot="activator"
                               :disabled="isReadOnly"
                               @click="callConteudoCarosselAdd()">
                            <v-icon color="teal lighten-1">subscriptions</v-icon>
                        </v-btn>
                        <span>Carrossel</span>
                    </v-tooltip>
                    <v-tooltip top content-class="top">
                        <v-btn icon small

                               slot="activator"
                               :disabled="isReadOnly"
                               @click="callConteudoPlaylistAdd()">
                            <v-icon color="teal lighten-1">local_movies</v-icon>
                        </v-btn>
                        <span>Playlist</span>
                    </v-tooltip>
                    <v-tooltip top content-class="top">
                        <v-btn icon small

                               slot="activator"
                               :disabled="isReadOnly"
                               @click="callLayoutAdd()">
                            <v-icon color="teal lighten-1">picture_in_picture_alt</v-icon>
                        </v-btn>
                        <span>Layouts</span>
                    </v-tooltip>
                    <v-tooltip top content-class="top">
                        <v-btn icon small

                               slot="activator"
                               :disabled="isReadOnly || true"
                               @click="callRssAdd()">
                            <v-icon color="teal lighten-1">cast_connected</v-icon>
                        </v-btn>
                        <span>Notícias</span>
                    </v-tooltip>

                    <v-spacer></v-spacer>

                    <v-btn v-if="false" class="blue--text darken-1" @click="voltaView()">
                        <v-icon left>mdi-close</v-icon>
                        Fechar
                    </v-btn>
                    <v-btn v-if="false"
                           color="primary darken-2"
                           :loading="loading"
                           @click="callPost()"
                           :disabled="loading || isReadOnly"
                    >
                        <v-icon left>mdi-check</v-icon>
                        Salvar
                    </v-btn>
                </v-toolbar>

                    <draggable v-model="dadosDB.conteudos" class="container fluid grid-list-sm pa-0 my-1" :options="options"
                               :move="onMove">
                        <transition-group :name="'flip-list'" class="layout justify-center row fill-height wrap ma-0">
                        <v-flex
                                v-for="(element, key) in conteudosFiltrado" :key="element.id"
                                class="item pa-0">

                            <v-hover>
                                <v-card
                                    slot-scope="{ hover }"

                                    :dark="!isModeDarkForms"
                                    :light="isModeDarkForms"
                                    class="aton-move" >
                                <v-layout column mt-1>
                                    <v-img
                                            :src=" getThumbConteudo(element)"
                                            aspect-ratio="2"
                                            class="marginCustomImg elevation-1"
                                            v-on:dblclick.native="callPreview(element)"
                                    >


                                        <v-expand-transition>
                                            <div
                                                    v-if="hover || ( (( (element.tipo =='carrossel') || (element.tipo =='subplaylist')) && (!element.conteudos || !element.conteudos.length)) )"
                                                    class="d-flex transition-fast-in-fast-out v-card--reveal caption font-weight-regular white--text container fluid"
                                                    :class="( (( (element.tipo =='carrossel') || (element.tipo =='subplaylist')) && (!element.conteudos || !element.conteudos.length)) ) ? 'red darken-3' : 'orange darken-3'"
                                                    style="height: 100%;"
                                            >
                                                <div class="layout justify-center align-center column fill-height" v-if="element.tipo=='conteudo'">
                                                Size: {{ element.conteudos.size | prettyBytes}}
                                                </div>
                                                <div class="layout justify-center align-center column fill-height" v-else-if="(element.tipo=='carrossel') || (element.tipo=='subplaylist') ">
                                                {{  'Mídias: ' + element.conteudos.length }}
                                                </div>
                                                <div class="layout justify-center align-center column fill-height" v-else>
                                                {{  'Neste ponto o layout do player mudará' }}
                                                </div>
                                            </div>
                                        </v-expand-transition>

                                        <v-container text-xs-right pa-0 ma-0>
                                        <v-layout row align-start pa-0 ma-0>
                                            <v-flex xs-12 pa-0 ma-0>

                                                <v-menu left top class="aton-pointer" v-show="!isReadOnly">
                                                    <v-btn dark small icon slot="activator" class="pa-1 ma-0 customColorBtnIcon">
                                                        <v-icon dark small>more_vert</v-icon>
                                                    </v-btn>
                                                    <v-list class="aton-pointer" dense>
                                                        <v-list-tile>
                                                            <v-list-tile-action>
                                                                <v-icon  color="pink">delete</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title @click="excluirUm(key)">Excluir
                                                            </v-list-tile-title>

                                                        </v-list-tile>
                                                        <v-list-tile>
                                                            <v-list-tile-action>
                                                                <v-icon  color="pink">clear_all</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title @click="excluirTodos(element)">Excluir
                                                                todos
                                                            </v-list-tile-title>
                                                        </v-list-tile>
                                                        <v-list-tile v-show="(element.tipo == 'carrossel')">
                                                            <v-list-tile-action>
                                                                <v-icon  color="secondary">subscriptions</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title @click="visualizarCarrossel(element)">
                                                                Visualizar este carrossel
                                                            </v-list-tile-title>
                                                        </v-list-tile>
                                                        <v-list-tile v-show="(element.tipo == 'subplaylist') ">
                                                            <v-list-tile-action>
                                                                <v-icon  color="secondary">subscriptions</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title @click="visualizarPlaylist(element)">
                                                                Visualizar esta SubPlaylist
                                                            </v-list-tile-title>
                                                        </v-list-tile>
                                                        <v-list-tile v-show="element.tipo == 'conteudo'">
                                                            <v-list-tile-action>
                                                                <v-icon  color="indigo">video_label</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title @click="callPreview(element)">Preview
                                                            </v-list-tile-title>
                                                        </v-list-tile>
                                                        <v-list-tile v-show="(element.tipo == 'subplaylist') && $can('playlist-update') ">
                                                            <v-list-tile-action>
                                                                <v-icon  color="indigo">local_movies</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title @click="callEditSubPlaylist(element)">Editar SubPlaylist
                                                            </v-list-tile-title>
                                                        </v-list-tile>
                                                    </v-list>
                                                </v-menu>
                                            </v-flex>
                                        </v-layout>
                                        </v-container>
                                    </v-img>
                                </v-layout>

                                <v-card-text class="aton-conteudo">

                                    <v-layout column v-if="element.tipo=='conteudo'">
                                        <span class="font-weight-regular text-truncate">
                                            Ref.: {{element.conteudos.nome }}
                                        </span>
                                        <span class="caption font-weight-light text-truncate">
                                            Tipo: Conteúdo
                                        </span>
                                    </v-layout>

                                    <v-layout column v-else-if="element.tipo=='carrossel'">
                                    <span class="font-weight-regular text-truncate">
                                            Ref.: {{element.tag_carrossel }}
                                        </span>
                                        <span class="caption font-weight-light text-truncate">
                                            Tipo: Carrossel
                                        </span>
                                    </v-layout>
                                    <v-layout column v-else-if="element.tipo=='layout'">
                                        <span class="font-weight-regular text-truncate">
                                            Ref.: {{element.layout.id + '-' + element.layout.nome }}

                                        </span>
                                        <span class="caption font-weight-light text-truncate">
                                            Tipo: Layout
                                        </span>
                                    </v-layout>
                                    <v-layout column v-else-if="(element.tipo=='url') || (element.tipo=='streaming')">
                                        <span class="font-weight-regular text-truncate">
                                            URL: {{element.nome }}
                                        </span>
                                    </v-layout>
                                    <v-layout column v-else>
                                        <span class="font-weight-regular text-truncate">
                                            Ref.: {{ element.subplaylist.id + '-' + element.subplaylist.nome }}
                                        </span>
                                        <span class="caption font-weight-light text-truncate">
                                            Tipo: SubPlaylist
                                        </span>
                                    </v-layout>
                                </v-card-text>
                                <v-footer dark :style="{backgroudColor: backColor(element)}">
                                    <v-layout row align-left justify-center ma-0>
                                        <v-flex class="ml-1" grow>
                                            <span class="fs-9">{{ getTextDuracaoForCard(element) }}</span>
                                        </v-flex>

                                        <v-flex v-if="( (( (element.tipo =='carrossel') || (element.tipo =='subplaylist')) && (!element.conteudos || !element.conteudos.length)) )" class="mr-1">
                                            <v-tooltip top content-class="top">
                                                <v-icon slot="activator" class="aton-pointer" color="red">warning</v-icon>
                                                <span>Esta lista está sem conteúdo</span>
                                            </v-tooltip>
                                        </v-flex>

                                        <v-flex v-else-if="( (( (element.tipo =='carrossel') || (element.tipo =='subplaylist')) && (element.conteudos && element.conteudos.length)) )" class="mr-1">
                                            <v-tooltip top content-class="top">
                                                <v-icon slot="activator" class="aton-pointer" color="red lighten-2">info_outline</v-icon>
                                                <span>Esta duração é referente a todo o conteúdo{{ element.tipo =='carrossel'? ' do carrossel': ' da subplaylist'}}</span>
                                            </v-tooltip>
                                        </v-flex>

                                    </v-layout>
                                </v-footer>
                            </v-card>
                            </v-hover>
                        </v-flex>
                        </transition-group>
                    </draggable>



                <v-footer class="pa-3"
                          :dark="!isModeDarkForms"
                          :light="isModeDarkForms">
                    <div>Tempo total: {{ this.tempoTotal }}</div>
                    <v-spacer></v-spacer>
                </v-footer>
            </v-card>



        </v-form>

        <v-fab-transition>
            <v-speed-dial
                    v-show="fabAddEditShow"
                    v-model="fabAddEdit"
                    fixed
                    top
                    right

                    :direction="$vuetify.breakpoint.smAndDown ? 'bottom': 'left'"

                    transition="scale-transition"
            >
                <v-btn

                        slot="activator"
                        v-model="fabAddEdit"
                        color="blue-grey darken-1"

                        dark

                        fab
                        small

                        class="no-print mx-0"
                >
                    <v-icon>create</v-icon>
                    <v-icon>close</v-icon>
                </v-btn>
                <v-tooltip left content-class="left">
                    <v-btn
                            slot="activator"
                            fab
                            small
                            class="ma-1"

                            :dark="this.isModeDarkForms"
                            :light="!this.isModeDarkForms"

                            color="primary"
                            @click="callPost()"

                            :loading="loading"
                            :disabled="loading || isReadOnly"

                    >
                        <v-icon>mdi-content-save</v-icon>
                    </v-btn>
                    <span>Salvar</span>
                </v-tooltip>

                <v-tooltip left content-class="left">
                    <v-btn
                            slot="activator"
                            fab
                            small

                            dark

                            class="ma-1 blue--text darken-1"

                            color="secondary darken-2"
                            @click="voltaView()"
                    >
                        <v-icon>arrow_back</v-icon>
                    </v-btn>
                    <span>Fechar</span>
                </v-tooltip>
            </v-speed-dial>
        </v-fab-transition>
        <aton-preview
                @setCancel="val => openDialogPreview = val"
                :openDialog="openDialogPreview"
                :linkPreview="link_preview"
                :mime="mime_preview"
        ></aton-preview>

        <aton-conteudo-add
                @setCancel="val => openDialogConteudo = val"
                @setOK="(val, quantidade) => incluirConteudo(val, quantidade)"
                :openDialog="openDialogConteudo"
        ></aton-conteudo-add>
        <aton-conteudo-carossel-add
                @setCancel="fechaCarrossel"
                @setOK="(val, quantidade, duracao, conteudos) => incluirCarrosel(val, quantidade, duracao, conteudos)"
                :openDialog="openDialogCarossel"
                :tagSelected="selectedCarrossel"
        ></aton-conteudo-carossel-add>
        <aton-conteudo-subplaylist-add
                @setCancel="val => openDialogPlaylist = val"
                @setOK="(val, quantidade) => incluirSubPlaylist(val, quantidade)"
                :openDialog="openDialogPlaylist"
                :playlist_id="dadosDB.id"
        ></aton-conteudo-subplaylist-add>

        <aton-conteudo-subplaylist-edit
                @setCancel="val => openDialogPlaylistEdit = val"
                @setOK="(val) => loadItemEdit()"
                :openDialog="openDialogPlaylistEdit"
                :playlist_id="selectedPlaylist"
        ></aton-conteudo-subplaylist-edit>

        <aton-conteudo-layout-add
                @setCancel="val => openDialogLayout = val"
                @setOK="(val, quantidade) => incluirLayout(val, quantidade)"
                :openDialog="openDialogLayout"
        ></aton-conteudo-layout-add>
    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    import draggable from 'vuedraggable';
    import AtonPreview from '../../components/aton-preview.vue';
    import AtonConteudoAdd from '../../components/aton-conteudo-add.vue';
    import AtonConteudoCarosselAdd from '../../components/aton-conteudo-carossel-add.vue';
    import AtonConteudoSubplaylistAdd from '../../components/aton-conteudo-subplaylist-add.vue';
    import AtonConteudoSubplaylistEdit from '../../components/aton-conteudo-subplaylist-edit.vue';
    import AtonConteudoLayoutAdd from '../../components/aton-conteudo-layout-add.vue';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        name: 'aton-admin-playlist-add-edit',
        data() {
            return {

                // list: message.map((name, index) => {
                //     return { name, order: index + 1, fixed: false };
                // }),
                dadosDB: {
                    ativo: true,
                    conteudos: [],
                    playlist: {
                        nome: '',
                    },

                },

                tags: [],

                search: '',

                tempoTotal: '',

                openDialogPreview: false,
                openDialogConteudo: false,
                openDialogCarossel: false,
                openDialogPlaylist: false,
                openDialogPlaylistEdit: false,
                openDialogLayout: false,
                link_preview: '',
                mime_preview: '',

                selectedCarrossel: '',
                selectedPlaylist: null,

                items: [],
            }
        },
        mounted() {
            // alert('oi');

            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                // this.$refs.form.reset();
                this.dadosDB.ativo = true;
            }
            ;



            this.isReadOnlyValue = !this.$can('playlist-update');

            // this.loadConteudos();
        },

        components: {
            draggable,
            AtonPreview,
            AtonConteudoAdd,
            AtonConteudoCarosselAdd,
            AtonConteudoSubplaylistAdd,
            AtonConteudoSubplaylistEdit,
            AtonConteudoLayoutAdd,
        },


        methods: {
            backColor: function (element) {
                if ((element.tipo =='carrossel') && (!element.conteudos || !element.conteudos.length)){
                    return 'red'
                }
                return '';
            },

            getTextDuracaoForCard: function(element){
                if (element.tipo=='layout' && !element.layout.ativo){
                    return 'Layout DESATIVADO';
                }

                if ( (( (element.tipo =='carrossel') || (element.tipo =='subplaylist')) && (!element.conteudos || !element.conteudos.length)) ) {
                    return 'Lista sem mídias'
                }

                if (element.tipo =='conteudo') {
                    return 'Duração: ' + element.tempo;
                }

                if (element.tipo =='carrossel') {
                    return 'Duração: ' + element.duracao;
                }

                if (element.tipo =='subplaylist') {
                    return 'Duração: ' + element.subplaylist.duracao;
                }
            },

            callEditSubPlaylist: function(element){
                let route = this.$router.resolve({name: 'playlists-edit', params: {id: element.subplaylist.id}});

                window.open(route.href, '_blank');

                // this.$router.push({name: 'playlists-edit', params: {id: element.subplaylist.id}});// target="_blank"
            },

            getThumbConteudo: function (element) {
                switch (element.tipo) {
                    case 'carrossel':
                        return '/img/atonmidia/icone_carrossel.png'
                        break;
                    case 'rss':
                        return '/img/atonmidia/icone_rss.png'
                        break;
                    case 'url':
                        return '/img/atonmidia/icone_url.png'
                        break;
                    case 'streaming':
                        return '/img/atonmidia/icone_url.png'
                        break;
                    case 'subplaylist':
                        return '/img/atonmidia/icone_playlist.png';
                        break;
                    case 'layout':
                        return '/img/atonmidia/icone_layout.png';
                        break;
                    case 'conteudo':
                        return element.conteudos.link_thumbnail;
                        break;
                }
                ;

            },
            incluirLayout: function (layout, quantidade) {
                this.openDialogLayout = false;

                let conteudo = {
                    id: 0,
                    nome: '',
                    tipo: 'layout',
                    layout_id: null,
                    layout: {
                        id: '',
                        nome: '',
                        ativo: false,
                    }
                };


                conteudo.id = this.nextIdNovoConteudo();
                conteudo.nome = 'Layout: ' + layout.nome;
                conteudo.layout_id = layout.id;
                conteudo.layout.nome = layout.nome;
                conteudo.layout.ativo = layout.ativo;

                for (var i = 0, len = quantidade; i < len; i++) {
                    this.dadosDB.conteudos.push(conteudo);
                }
            },
            incluirCarrosel: function (tag, quantidade, duracao, conteudos) {
                this.openDialogCarossel = false;


                let tmpId = this.nextIdNovoConteudo();



                for (var i = 0, len = quantidade; i < len; i++) {
                    let conteudo = {
                        id: 0,
                        nome: '',
                        tipo: 'carrossel',
                        duracao: '',
                        conteudos: {},
                    };
                    conteudo.id = tmpId;
                    conteudo.tag_carrossel = tag;
                    conteudo.nome = 'Carrossel: ' + tag;
                    conteudo.duracao = duracao;
                    conteudo.conteudos= conteudos;
                    this.dadosDB.conteudos.push(conteudo);

                    tmpId++;
                }
            },
            incluirSubPlaylist: function (playlist_id, quantidade) {
                this.openDialogPlaylist = false;

                let tmpId = this.nextIdNovoConteudo();


                for (var i = 0, len = quantidade; i < len; i++) {
                    let conteudo = {
                        id: 0,
                        nome: '',
                        tipo: 'subplaylist',
                        subplaylist_id: null,

                        subplaylist: {
                            id: '',
                            nome: '',
                            duracao: '00:00',
                        },
                        conteudos: {},
                    };
                    conteudo.id = tmpId;
                    conteudo.nome = playlist_id.nome;
                    conteudo.subplaylist_id = playlist_id.id;
                    conteudo.subplaylist.nome = playlist_id.nome;
                    conteudo.subplaylist.duracao = playlist_id.duracao;
                    conteudo.conteudos = playlist_id.conteudos;

                    this.dadosDB.conteudos.push(conteudo);


                    tmpId++;
                }
            },
            incluirConteudo: function (conteudo, quantidade) {
                this.openDialogConteudo = false;

                let tmpId = this.nextIdNovoConteudo();

                for (var i = 0, len = quantidade; i < len; i++) {
                    let conteudoPai = {
                        id: 0,
                        nome: conteudo.nome,
                        tipo: ((conteudo.tipo_conteudo == 'url') || (conteudo.tipo_conteudo == 'streaming')) ? conteudo.tipo_conteudo : 'conteudo',
                        conteudos: {},
                        tempo: '',
                    };
                    conteudoPai.id = tmpId;
                    conteudoPai.conteudos = conteudo;
                    conteudoPai.tempo = conteudo.tempo;

                    this.dadosDB.conteudos.push(conteudoPai);

                    tmpId++;
                }
            },
            excluirUm: function (key) {
                this.dadosDB.conteudos.splice(key, 1);
            },
            excluirTodos: function (element) {
                let self = this;

                let Arraytmp = [];
                switch (element.tipo) {
                    case 'conteudo':
                        for (var i = 0, len = self.dadosDB.conteudos.length; i < len; i++) {
                            if (self.dadosDB.conteudos[i].conteudos.id != element.conteudos.id) {
                                Arraytmp.push(self.dadosDB.conteudos[i]);
                            }
                        }
                        break;
                    case 'carrossel':
                        for (var i = 0, len = self.dadosDB.conteudos.length; i < len; i++) {
                            if (self.dadosDB.conteudos[i].tag_carrossel != element.tag_carrossel) {
                                Arraytmp.push(self.dadosDB.conteudos[i]);
                            }
                        }
                        break;
                    case 'subplaylist':
                        for (var i = 0, len = self.dadosDB.conteudos.length; i < len; i++) {
                            if (self.dadosDB.conteudos[i].subplaylist_id != element.subplaylist_id) {
                                Arraytmp.push(self.dadosDB.conteudos[i]);
                            }
                        }
                        break;
                    case 'layout':
                        for (var i = 0, len = self.dadosDB.conteudos.length; i < len; i++) {
                            if (self.dadosDB.conteudos[i].layout_id != element.layout_id) {
                                Arraytmp.push(self.dadosDB.conteudos[i]);
                            }
                        }
                        break;
                    case 'rss':
                        for (var i = 0, len = self.dadosDB.conteudos.length; i < len; i++) {
                            if (self.dadosDB.conteudos[i].tipo != element.tipo) {
                                Arraytmp.push(self.dadosDB.conteudos[i]);
                            }
                        }
                        break;
                }

                // console.log(Arraytmp);

                self.dadosDB.conteudos = Arraytmp;

            },
            callPreview: function (element) {
                if (element.tipo == 'conteudo' && element.conteudos) {
                    this.mime_preview = element.conteudos.mime;
                    this.link_preview = element.conteudos.link_externo;

                    this.openDialogPreview = true;
                }
            },
            callConteudoAdd: function () {

                this.openDialogConteudo = true;
            },
            callLayoutAdd: function () {

                this.openDialogLayout = true;
            },

            visualizarCarrossel: function (element) {
                this.selectedCarrossel = element.tag_carrossel;
                this.openDialogCarossel = true;
            },

            visualizarPlaylist: function (element) {
                this.selectedPlaylist = element;
                this.openDialogPlaylistEdit = true;
            },

            fechaCarrossel: function () {
                this.selectedCarrossel = '';
                this.openDialogCarossel = false;
            },
            callConteudoCarosselAdd: function () {

                this.openDialogCarossel = true;
            },
            callConteudoPlaylistAdd: function () {
                this.openDialogPlaylist = true;
            },

            nextIdNovoConteudo: function () {
                var xs = this.dadosDB.conteudos;
                var result = 0;
                if (xs.length && (xs.length > 0)) {
                    let Regs = xs.map(function (registro) {
                        return registro.id || 0;
                    });
                    result = _.max(Regs, 'id') + 1;  // '11.01.1993'
                } else {
                    result = 1
                }

                return result;
            },


            loadItemEdit: function () {
                let self = this;
                this.loading = true;

                bus.$emit('atonprogress:on');
                this.$http.get('/admin/playlist/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;
                        // self.dadosDB = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },

            callPost: function () {
                if (this.loading) return false;

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/playlist';

                if (this.isEdit) {
                    _url = '/admin/playlist/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('playlist:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });
            },
            updateTempo: function () {
                var self = this;
                this.$http.post('/api/e/signage/playlist/tempo', {playlist: self.dadosDB.conteudos})
                    .then(response => {
                        this.tempoTotal = response.data.tempos.total;
                    })
                    .catch(error => {
                        console.log(error);
                        this.tempoTotal = '00:00:00';
                    });
            },

            embaralhar: function () {
                var arr = this.dadosDB.conteudos;
                var n = arr.length;
                var tempArr = [];
                for (var i = 0; i < n - 1; i++) {
                    // The following line removes one random element from arr
                    // and pushes it onto tempArr
                    tempArr.push(arr.splice(Math.floor(Math.random() * arr.length), 1)[0]);
                }
                // Push the remaining item onto tempArr
                tempArr.push(arr[0]);
                this.dadosDB.conteudos = tempArr;
            },
            onMove: function({ relatedContext, draggedContext }) {
                const relatedElement = relatedContext.element;
                const draggedElement = draggedContext.element;
                return (
                    (!relatedElement || !relatedElement.fixed) && !draggedElement.fixed
                );
            },
        },
        computed: {
            conteudosChange() {
                return this.dadosDB.conteudos;
            },
            conteudosFiltrado() {
                var self = this;

                var busca = this.search || '';

                return _.filter(this.dadosDB.conteudos, conteudo => (
                    (conteudo.conteudos && conteudo.conteudos.nome && conteudo.conteudos.nome.toLowerCase().indexOf(busca.toLowerCase()) >= 0 )||
                    (conteudo.nome && conteudo.nome.toLowerCase().indexOf(busca.toLowerCase()) >= 0 ) ||
                    (conteudo.tag_carrossel && conteudo.tag_carrossel.toLowerCase().indexOf(busca.toLowerCase()) >= 0 ) ||
                    (conteudo.subplaylist && conteudo.subplaylist.nome && conteudo.subplaylist.nome.toLowerCase().indexOf(busca.toLowerCase()) >= 0 )
                    )
                );
            },

            options: function () {
                return {
                    // dragClass: 'dragClass',

                    animation: 0,

                    ghostClass: "ghost",
                    // swapThreshold: 1,

                };
            },
        },
        watch: {
            conteudosChange: function (oldV, newV) {
                this.updateTempo();
            },

        },
    }
</script>

<style>
    .flip-list-move {
        transition: transform 0.5s;
    }

    .item{
        width: 155px !important;
        max-width: 155px !important;
    }

    .ghost {
        opacity: 0.5;
        background: red;
        box-shadow: 0 5px 5px -3px rgba(255, 0, 0, .2), 0 8px 10px 1px rgba(255, 0, 0, .14), 0 3px 14px 2px rgba(255, 0, 0, .12);
    }

    .marginCustomImg{
        margin: 2px;
        margin-top: 0px !important;
        border-radius: 4px;
    }

    .customColorBtnIcon{
        background-color: rgba(0, 0, 0, .3) !important;
    }


     /*hover laranja*/
    .v-card--reveal {
         align-items: center;
         bottom: 0;
         justify-content: center;
         opacity: .75;
         position: absolute;
         width: 100%;
     }

    .aton-conteudo {
        padding: 2px;
        margin-left: 3px !important;
        min-height: 30px;
    }

    .aton-move {
        cursor: move;
        margin: 2px !important;
    }


</style>