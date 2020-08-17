<template>

    <material-card

            :title="getTitulo('Permissões de Perfil')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >

        <v-form v-model="formCtrl" ref="form" lazy-validation>

            <v-card-text class="pa-0">
                <v-layout align-center justify-space-around row fill-height pb-1>
                    <v-flex xs6>
                        <v-chip
                                class="pa-1 white--text ml-1 headline font-weight-light"
                                color="red lighten-2"
                                label
                        >
                            {{ 'Perfil: ' + (role.name || '' ) }}
                        </v-chip>
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex class="align-center text-xs-right">
                        <v-text-field
                                prepend-inner-icon="search"
                                label="Filtrar permissões"
                                single-line
                                clearable
                                hide-details
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>
            <v-divider class="mt-2"></v-divider>
            <v-layout row wrap>

                <v-flex xs12
                        sm5>
                    <v-flex xs12>
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                      >
                                           <v-chip
                                                   class="white--text ml-0"
                                                   color="green darken-3"
                                                   label
                                                   small
                                           >
                                              Lista de permissões
                                            </v-chip>
                                      </h4>
                                    </span>
                    </v-flex>

                    <v-card-text class="pa-0">
                        <v-treeview
                                v-model="treeModelSelections"
                                :items="permissoesFiltrado"
                                :open="nodesOpen"
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

                        ></v-treeview>


                    </v-card-text>
                </v-flex>

                <v-divider vertical></v-divider>

                <v-flex
                        xs12
                        sm6
                >
                    <v-flex xs12>
                                    <span>
                                      <h4
                                              class="title font-weight-light"
                                      >
                                           <v-chip
                                                   class="white--text ml-0"
                                                   color="green darken-3"
                                                   label
                                                   small
                                           >
                                              Permissões atribuidas
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
                            Seleciona ao lado as permissões desejadas
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
                                    @input="ExcluirPermission(selection)"
                            >
                                <v-icon
                                        left
                                        small
                                >
                                    shield-check-outline
                                </v-icon>
                                {{ selection.permission_slug }}
                            </v-chip>
                        </v-scroll-x-transition>
                    </v-card-text>
                </v-flex>


            </v-layout>

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

    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [
            atonBaseFormEdit
        ],
        name: 'aton-admin-perfil-permissoes',
        data() {
            return {


                loading: false,

                permissoes: [],
                // permissoesFiltro: [],

                treeModelSelections: [],

                role: [],

                search: null,

                grupos: [],

                nodesOpen: ['all'],

                // nodes que ficaram verde ou primary se coincidirem com search
                nodesActive: [],
            }
        },
        mounted() {
            this.loadPermissoes();
        },
        methods: {
            loadPermissoes: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.get('/api/i/perfil/' + self.$route.params.id + '/permissoes')
                    .then(response => {
                        // console.log(response);
                        self.loading = false;
                        // self.permissoes= response.data.permissions;
                        self.permissoes = response.data.permissions;
                        // self.treeModelSelections = Object.assign([], response.data.permissions_saved);
                        self.treeModelSelections = response.data.permissions_saved;

                        self.role = response.data.role;
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
            // voltaView: function () {
            //     this.$router.push({path: '/admin/perfis/add'});
            //     this.$router.push({path: '/admin/perfis'});
            // },
            callPost: function () {
                if (this.loading) return false;

                let self = this;


                this.loading = true;
                this.$http.post('/api/i/perfil/' + self.$route.params.id + '/permissoes/update', self.selections)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('atonmsg', 'success', msg);

                        self.voltaView();
                        bus.$emit('permissoes:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
            getChildren(group) {
                var permissoes = [];

                for (const perm of this.permissoes) {
                    if (perm.permission_group !== group) continue;

                    permissoes.push({
                        ...perm,
                        name: this.getName(perm.permission_title)
                    })
                }

                return permissoes.sort((a, b) => {
                    return a.name > b.name ? 1 : -1
                })
            },
            getName(name) {
                return `${name.charAt(0).toUpperCase()}${name.slice(1)}`
            },

            ExcluirPermission(selection) {
                var localPerm = Object.assign([], this.cleanListPermission(this.treeModelSelections));

                var res = _.pullAll(localPerm, [selection.id]);

                this.treeModelSelections = res;
            },

            getNodesActive() {

                var busca = this.search || '';

                if (busca === '') {
                    return [];
                }

                var nodesTmp =  _.filter(this.permissoes, player =>
                    (player.permission_title.toLowerCase().includes(busca.toLowerCase()) >= 0)
                );

                var ret = nodesTmp.reduce((acc, cur) => {
                    const grupo = cur.id;

                    if (!acc.includes(grupo)) {
                        acc.push(grupo)
                    }

                    return acc;
                }, []);

                return ret.sort();
            },

            getNodesOpen(val = null) {

                this.nodesActive = this.getNodesActive();

                this.search = this.search || '';

                if (this.search === '') {
                    // this.treeModelSelections = this.selections;
                    return ['all'];
                }

                if (!val) {
                    val = this.permissoes;
                }

                var ret = val.reduce((acc, cur) => {
                    const grupo = cur.permission_group;

                    if (!acc.includes(grupo)) {
                        acc.push(grupo)
                    }

                    return acc;
                }, []);

                ret.push('all');

                // console.log(ret);

                return ret.sort();
            },

            cleanListPermission: function(inArr){
                const selections = [];

                for (const leaf of inArr) {
                    const permission = this.permissoes.find(permission => permission.id === leaf);

                    if (!permission) continue;

                    selections.push(permission.id);
                }

                return selections;
            },
        },
        watch: {
            search(val) {
                // // console.log('playersFiltro watch');
                this.nodesOpen = this.getNodesOpen();
            },
            permissoes(val) {
                this.grupos = val.reduce((acc, cur) => {
                    const grupo = cur.permission_group;

                    if (!acc.includes(grupo)) {
                        acc.push(grupo)
                    }


                    return acc;
                }, []).sort();

                // ajusta nodes abertos
                // // console.log('permissoes watch');
                this.nodesOpen = this.getNodesOpen(val);
            },
            permissoesFiltrado(val) {
                // // console.log('permissoesFiltro watch');
                this.nodesOpen = this.getNodesOpen(val);
            },
        },
        computed: {
            // permissoesFiltro() {
            //     var self = this;
            //
            //     var busca = this.search || '';
            //
            //     return _.filter(this.permissoes, permissao => (permissao.permission_title.toLowerCase().indexOf(busca.toLowerCase()) >= 0 ||
            //         permissao.permission_description.toLowerCase().indexOf(busca.toLowerCase()) >= 0 ||
            //         permissao.permission_group.toLowerCase().indexOf(busca.toLowerCase()) >= 0 ||
            //         permissao.permission_slug.toLowerCase().indexOf(busca.toLowerCase()) >= 0));
            // },
            permissoesFiltrado() {
                var gruposFiltro = this.permissoes.reduce((acc, cur) => {
                    const grupo = cur.permission_group;

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
                    name: 'Todas permissões',
                    children
                }]
            },

            selections() {
                const selections = [];

                for (const leaf of this.treeModelSelections) {
                    const permission = this.permissoes.find(permission => permission.id === leaf);

                    if (!permission) continue;

                    selections.push(permission.id);
                }

                return selections;
            },
            selectionsObjs() {
                const selections = [];

                for (const leaf of this.treeModelSelections) {
                    const permission = this.permissoes.find(permission => permission.id === leaf);

                    if (!permission) continue;

                    selections.push(permission);
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


</style>