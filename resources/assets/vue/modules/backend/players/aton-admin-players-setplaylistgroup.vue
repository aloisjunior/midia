<template>
    <v-layout
            row
            justify-center
    >
        <v-dialog v-model="openDialog"
                  width="700px"
                  height="500px"
                  scrollable
                  persistent
                  content-class="elevation-0"
                  @keyup.esc.prevent="setCancel()"
        >
            <material-card
                    title="Alteração de playlist em grupo"

                    :dark="isModeDarkForms"
                    :light="!isModeDarkForms"

                    :fullWidth="true"

                    @keyup.esc.prevent="setCancel()"
            >
                <template slot="option">

                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                v-show="playersSelecionados.length && (playlist_id)"
                                icon
                                class="my-0 mx-1"
                                color="primary"
                                slot="activator"

                                @click.prevent.stop="setOK()"
                        >
                            <v-icon>create</v-icon>
                        </v-btn>
                        <span>Alterar playlists dos players</span>
                    </v-tooltip>

                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                icon
                                class="my-0 mx-1"
                                color="red"
                                slot="activator"

                                @click.prevent.stop="setCancel()"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <span>Fechar</span>
                    </v-tooltip>
                </template>

                <template slot="extra">
                    <v-card
                            class="my-2 mx-3"
                            :dark="!isModeDarkForms"
                            :light="isModeDarkForms"
                    >
                        <v-card-text>
                            <v-layout align-center justify-space-around row wrap fill-height pb-1>
                                <v-flex xs12>
                                    <v-layout row wrap>
                                        <v-flex grow>
                                            <v-select
                                                    label="Nova Playlist"
                                                    required
                                                    :items="playlists"
                                                    v-model="playlist_id"
                                                    chips

                                                    item-value="id"
                                                    item-text="nome"
                                                    box

                                                    class="mt-0"
                                                    hide-details


                                                    return-object
                                                    no-data-text="Nenhum histórico encontrado"
                                                    ref="playlists"
                                                    @keyup.enter.stop=""
                                            >
                                            </v-select>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>

                            </v-layout>
                        </v-card-text>
                    </v-card>

                    <div class="my-1 mx-3">
                        <v-layout align-center justify-space-around row wrap fill-height pb-1>
                            <v-flex xs11 class="align-center text-xs-right">
                                <v-text-field
                                        prepend-inner-icon="search"
                                        label="Filtrar grupos ou tags"
                                        single-line
                                        clearable
                                        hide-details
                                        v-model="search"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs1 class="align-center text-xs-center">
                                <v-tooltip content-class="top" top>
                                    <v-btn
                                            slot="activator"
                                            @click="refreshPlayers()"

                                            icon
                                    >
                                        <v-icon>mdi-update</v-icon>
                                    </v-btn>
                                    <span>Redefinir lista de players</span>
                                </v-tooltip>
                            </v-flex>
                        </v-layout>
                    </div>

                    <v-divider class="mt-2 mx-3"></v-divider>

                    <v-card-text class="pa-3">
                        <v-layout row wrap style="height: 300px">

                            <v-flex xs12
                                    sm4>
                                <v-flex xs12>
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                      >
                                           <v-chip
                                                   class="white--text ml-1"
                                                   color="green darken-3"
                                                   label
                                                   small
                                           >
                                              Tags e grupos disponíveis
                                            </v-chip>
                                      </h4>
                                    </span>
                                </v-flex>

                                <v-card-text class="pa-0">
                                    <div
                                            v-if="playersNodesList.length === 0"
                                            key="title"
                                            class="title font-weight-light grey--text pa-3 text-xs-center"
                                    >
                                        Aguardando dados para lista
                                    </div>
                                    <div
                                            v-else-if="(playersNodesList.length > 0) && !(playersFiltrado.length > 0)"
                                            key="title"
                                            class="title font-weight-light grey--text pa-3 text-xs-center"
                                    >
                                        Sem resultado
                                    </div>
                                    <v-treeview
                                            v-else
                                            v-model="treeModelSelections"
                                            :items="playersFiltrado"
                                            :open.sync="nodesOpen"
                                            :open-all="!!search"
                                            activatable

                                            :search="search"

                                            :hoverable="true"


                                            active-class="primary--text"
                                            selected-color="indigo"
                                            open-on-click
                                            selectable

                                            :transition="true"

                                            expand-icon="mdi-menu-down"
                                            on-icon="mdi-check-box-outline"
                                            off-icon="mdi-checkbox-blank-outline"
                                            indeterminate-icon="mdi-minus-box-outline"

                                            :active="nodesActive"
                                            multiple-active
                                            :activatable="nodesActive && (nodesActive.length > 0)"

                                    >


                                    </v-treeview>


                                </v-card-text>
                            </v-flex>

                            <v-divider :vertical="$vuetify.breakpoint.smAndUp"></v-divider>

                            <v-flex
                                    xs12
                                    sm4
                            >
                                <v-flex xs12>
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                      >
                                           <v-chip
                                                   class="white--text ml-1"
                                                   color="green darken-3"
                                                   label
                                                   small
                                           >
                                              Tags e grupos selecionados
                                            </v-chip>
                                      </h4>
                                    </span>
                                </v-flex>
                                <v-card-text class="pa-0">
                                    <div
                                            v-if="selectionsObjs.length === 0"
                                            key="title"
                                            class="title font-weight-light grey--text pa-3 text-xs-center"
                                    >
                                        Selecione ao lado os grupos e tags dos players
                                    </div>
                                    <v-scroll-x-transition
                                            group
                                            hide-on-leave
                                    >
                                        <v-chip
                                                v-for="(selection, i) in selectionsObjs"
                                                :key="i"
                                                color="secondary darken-1"
                                                dark
                                                small
                                                close
                                                @input="ExcluirGrupoTag(selection)"
                                        >
                                            <v-icon
                                                    left
                                                    small
                                            >
                                                shield-check-outline
                                            </v-icon>
                                            {{ selection.group == 'tags' ? 'Tag: ' +
                                            selection.name_tag_grupo :
                                            'Grupo: ' + selection.name_tag_grupo }}
                                        </v-chip>
                                    </v-scroll-x-transition>
                                </v-card-text>
                            </v-flex>

                            <v-divider :vertical="$vuetify.breakpoint.smAndUp"></v-divider>

                            <v-flex
                                    xs12
                                    sm3
                            >
                                <v-flex xs12>
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                      >
                                           <v-chip
                                                   class="white--text ml-1"
                                                   color="green darken-3"
                                                   label
                                                   small
                                           >
                                              Players para alteração
                                            </v-chip>
                                      </h4>
                                    </span>
                                </v-flex>
                                <v-card-text class="pa-0">
                                    <div
                                            v-if="playersSelect.length === 0"
                                            key="title"
                                            class="title font-weight-light grey--text pa-3 text-xs-center"
                                    >
                                        Lista de players para alterar
                                    </div>
                                    <v-scroll-x-transition
                                            group
                                            hide-on-leave
                                    >
                                        <v-chip
                                                v-for="(selection, i) in playersSelecionados"
                                                :key="i"
                                                color="secondary darken-1"
                                                dark
                                                small
                                                close
                                                @input="ExcluirPlayer(selection)"
                                        >
                                            <v-icon
                                                    left
                                                    small
                                            >
                                                shield-check-outline
                                            </v-icon>
                                            {{ selection.nome }}
                                        </v-chip>
                                    </v-scroll-x-transition>
                                </v-card-text>
                            </v-flex>


                        </v-layout>
                    </v-card-text>
                </template>


            </material-card>
        </v-dialog>
    </v-layout>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins: [
            AtonBaseForm
        ],
        props: {
            openDialog: {
                default: false,
                type: Boolean,
            },
        },
        name: 'aton-admin-players-setplaylistgroup',
        data() {
            return {
                // lista com TUPLA desmembrando tags e grupos organizada por tag e grupo
                playersNodesList: [],
                //model do treeview
                treeModelSelections: [],
                // lista de retorno do post
                playersSelecionados: [],
                // playlist para retorno no post
                playlist_id: null,
                // lista com playlists para seleção pelo usuário
                playlists: [],
                // campo para filtragem
                search: null,
                // nodes que devem estar abertos
                nodesOpen: ['all'],
                // nodes que ficaram verde ou primary se coincidirem com search
                nodesActive: [],
            }
        },

        methods: {
            loadPlaylists: function () {
                let self = this;

                // bus.$emit('atonprogress:on', 'Carregando Playlists');
                self.loading = true;
                this.$http.get('/api/i/playlist/listar')
                    .then(response => {
                        self.loading = false;
                        self.playlists = response.data;

                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
//                        bus.$emit('atonprogress:off');
                    });
            },

            refreshPlayers: function () {
                this.playersSelecionados = this.playersSelect;
            },

            setCancel: function () {
                this.$emit('setCancel', false);
            },

            setOK: function (val) {
                var dadosDB = {
                    playlist_id: this.playlist_id.id,
                    players_id: this.playersSelectId,
                };

                this.atualizaPlaylists(dadosDB);

                this.setCancel();
            },

            atualizaPlaylists: function (dados) {
                this.openDialogSetPlaylist = false;

                let self = this;

                this.loading = true;
                this.$http.post('/admin/player/playlist/update/group', dados)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('player:updated'); // atualiza dados de referencia para validar no form base alterações de dados


                        bus.$emit('atonmsg', 'success', msg);
                        bus.$emit('atonmsg', 'success', 'Sua consulta será atualizada.');

                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.errors = error.response.data;
                    });

                // this.$nextTick(function () {
                //     this.loadDados();
                // });
            },
            ExcluirPlayer: function (selection) {
                var localPerm = Object.assign([], this.playersSelecionados);

                var res = _.pull(localPerm, selection);


                this.playersSelecionados = res;
            },
            loadPermissoes: function () {
                // if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.get('/admin/player/tags_grupos/listar')
                    .then(response => {
                        // console.log(response);
                        self.loading = false;


                        var playersListTmp = [];

                        var tmpPlayers = response.data.players;

                        // console.log('tmpPlayers', tmpPlayers);

                        var contId = 1;
                        for (var i = 0, lenI = tmpPlayers.length; i < lenI; i++) {
                            for (var j = 0, lenJ = tmpPlayers[i].tags.length; j < lenJ; j++) {
                                playersListTmp.push(
                                    Object.assign({}, tmpPlayers[i], {group: 'tags', name_tag_grupo: tmpPlayers[i].tags[j], id_tag_grupo: contId} ));

                                contId++;
                            }

                            for (var l = 0, lenL = tmpPlayers[i].grupos.length; l < lenL; l++) {
                                playersListTmp.push(
                                    Object.assign({}, tmpPlayers[i], {group: 'grupos', name_tag_grupo: tmpPlayers[i].grupos[l], id_tag_grupo: contId} ));
                                contId++;
                            }

                        }

                        // console.log('players', players);


                        self.playersNodesList = playersListTmp;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },

            getChildren(group) {
                var players = [];

                for (const player of this.playersNodesList) {
                    if (player.group !== group) continue;


                    players.push({
                        // ...player,
                        name: this.getName(player.name_tag_grupo),
                        id: player.id_tag_grupo,
                        player_id: player.id,
                    });

                }

                return _.uniqBy(players, 'name').sort((a, b) => {
                    return a.name > b.name ? 1 : -1
                });
            },
            getName(name) {
                return `${name.charAt(0).toUpperCase()}${name.slice(1)}`
            },

            ExcluirGrupoTag(selection) {
                var localPerm = Object.assign([], this.cleanListPermission(this.treeModelSelections));

                var res = _.pullAll(localPerm, [selection.id_tag_grupo]);

                this.treeModelSelections = res;
                // this.treeModelSelections = this.selections;
            },

            getNodesActive() {

                var busca = this.search || '';

                if (busca === '') {
                    return [];
                }

                var nodesTmp =  _.filter(this.playersNodesList, player =>
                    (player.name_tag_grupo.toLowerCase().includes(busca.toLowerCase()) >= 0) ||
                    (player.nome.toLowerCase().includes(busca.toLowerCase()) >= 0)
                );

                var ret = nodesTmp.reduce((acc, cur) => {
                    const grupo = cur.id_tag_grupo;

                    if (!acc.includes(grupo)) {
                        acc.push(grupo)
                    }

                    return acc;
                }, []);

                return ret.sort();
            },

            getNodesOpen(val = null) {

                // já ajusta os nodes ativos
                this.nodesActive = this.getNodesActive();


                this.search = this.search || '';

                if (this.search === '') {
                    // this.treeModelSelections = this.selections;
                    return ['all'];
                }

                if (!val) {
                    val = this.playersNodesList;
                }

                var ret = val.reduce((acc, cur) => {
                    const grupo = cur.group;

                    if (!acc.includes(grupo)) {
                        acc.push(grupo)
                    }

                    return acc;
                }, []);

                ret.push('all');

                return ret.sort();
            },

            cleanListPermission: function (inArr) {
                const selections = [];

                for (const leaf of inArr) {
                    const player = this.playersNodesList.find(player => player.id_tag_grupo === leaf);

                    if (!player) continue;

                    selections.push(player.id_tag_grupo);
                }

                return selections;
            },

        },
        watch: {
            playersNodesList(val) {
                // ajusta nodes abertos
                // // console.log('playersNodesList watch');
                this.nodesOpen = this.getNodesOpen(val);
            },

            search(val) {
                // // console.log('playersFiltro watch');
                this.nodesOpen = this.getNodesOpen();
            },

            openDialog: function (val) {
                if (val) {
                    this.loadPlaylists();
                    this.loadPermissoes();
                } else {
                    this.playersNodesList = [];
                    this.playlists = [];
                    this.playlist_id = null;
                    this.treeModelSelections = [];
                }
            },

            selectionsObjs: function (val) {
                this.playersSelecionados = this.playersSelect;
            },

         },
        computed: {
            playersSelectId() {
                return _.map(this.playersSelecionados, 'id');
            },

            playersSelect() {
                var self = this;

                // return this.playersNodesList;
                var selections = [];


                let tmpPlayers = Object.assign([], this.playersNodesList);

                for (const leaf of this.selectionsObjs) {
                    // console.log('selecions', selections);
                    // console.log('leaf', leaf);
                    var player = [];

                    player = _.filter(tmpPlayers, player => player.name_tag_grupo === leaf.name_tag_grupo);

                    // console.log('player', player);
                    if (!player) continue;

                    for (var i = 0, len = player.length; i < len; i++) {
                        let idx = _.findIndex(selections, {'id': player[i].id}); // this.$logDebug('idx= ' + idx);
                        if (idx < 0) {
                            selections.push(player[i]);
                        }
                    }

                    // console.log('selections final', selections);

                }
                return selections;
            },

            playersFiltrado() {
                var gruposFiltro = this.playersNodesList.reduce((acc, cur) => {
                    const grupo = cur.group;

                    if (!acc.includes(grupo)) {
                        acc.push(grupo)
                    }

                    return acc;
                }, []).sort();

                const children = gruposFiltro.map(grupo => ({
                    id: grupo,
                    name: this.getName(grupo),
                    children: this.getChildren(grupo)
                }));

                return [{
                    id: 'all',
                    name: 'Todos players',
                    children
                }]
            },

            selections() { //ids do node selecionado, referente a id_tag_grupo
                const selections = [];

                for (const leaf of this.treeModelSelections) {
                    const player = this.playersNodesList.find(player => player.id_tag_grupo === leaf);

                    if (!player) continue;

                    selections.push(player.id_tag_grupo);
                }

                return selections;
            },
            selectionsObjs() { //componentes node dos itens selecionados, referente a players->item
                const selections = [];

                for (const leaf of this.treeModelSelections) {
                    const player = this.playersNodesList.find(player => player.id_tag_grupo === leaf);

                    if (!player) continue;

                    selections.push(player);
                }
                return selections;
            },
        }
    }
</script>

<style>
    .v-treeview-node--leaf {
        margin-left: 55px !important;
    }

    .v-treeview-node__root {
        height: 30px !important;
        font-size: 12px !important;
    }

    .v-treeview-node__label {
        font-size: 14px !important;
    }
    .v-dialog{
        overflow-y: inherit;
    }


</style>