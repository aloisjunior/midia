<template>
    <material-card

            :title="getTitulo('Conteúdo')"
            @keyup.esc.prevent="voltaViewLocal()"
    >


        <v-form v-model="formCtrl" ref="form" lazy-validation>
            <div class="div-progress">
                <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                                   :indeterminate="true"></v-progress-linear>
            </div>


            <v-text-field v-model="dadosDB.nome" label="Nome" required
                          ref="nome"
                          box
                          :error-messages="errors.nome"
                          autofocus
            ></v-text-field>

            <v-tabs
                    color="purple"
                    v-model="tabs"
                    slider-color="white"
                    :dark="this.isModeDarkForms"
                    :light="!this.isModeDarkForms"
                    class="elevation-1"

            >
                <v-tab
                        href="#tab_conteudo"
                        class="white--text"
                        active-class="green--text"

                >
                    <span class="white--text">Conteúdo</span>
                </v-tab>
                <v-tab
                        href="#tab_agendamento"
                        class="white--text"
                        active-class="green--text"
                >
                    Agendamento
                </v-tab>
                <v-tab
                        href="#tab_cliente"
                        class="white--text"
                        active-class="green--text"
                >
                    Cliente
                </v-tab>
            </v-tabs>
            <v-tabs-items v-model="tabs" class="elevation-1">
                <v-tab-item
                        value="tab_conteudo"
                >


                    <v-card-text
                            :dark="!this.isModeDarkForms"
                            :light="this.isModeDarkForms"
                    >
                        <v-card-text
                                :dark="this.isModeDarkForms"
                                :light="!this.isModeDarkForms"
                        >

                            <div class="body-1 text--lighten-1">
                                <span>Tipo de Conteúdo: </span>
                            </div>

                            <v-btn-toggle dark
                                          v-model="dadosDB.tipo_conteudo"
                                          mandatory
                            >
                                <v-btn
                                        v-for="item in tipo_conteudo"
                                        :key="item"
                                        flat
                                        :value="item"
                                        active-class="v-btn--active atonSelecaoDias"
                                >
                                    {{item}}
                                </v-btn>
                            </v-btn-toggle>


                            <v-divider class="mt-2 mb-2"></v-divider>


                            <vue2-dropzone v-show="dadosDB.tipo_conteudo=='arquivo'" id="dropzone"
                                           ref="myVueDropzone"
                                           :options="dropzoneOptions"
                                           :useCustomSlot=true
                                           @vdropzone-success="arquivoAdicionado"
                                           @vdropzone-complete="stopUploadMsg"
                                           @vdropzone-removed-file="arquivoExcluido"
                                           @vdropzone-file-added="startUploadMsg"
                                           @vdropzone-file-added-manually="arquivoAdicionadoManualmente"
                                           @vdropzone-canceled="stopUploadMsg"
                                           @vdropzone-error="stopUploadMsg"

                            >

                                <input name="_token" type="hidden" ref="token">
                                <div class="dropzone-custom-content">
                                    <h3 class="dropzone-custom-title">Arraste seu arquivo para este local</h3>
                                    <div class="subtitle">...ou clique e escolha de seu computador</div>
                                </div>

                            </vue2-dropzone>


                            <v-text-field v-show="dadosDB.tipo_conteudo!='arquivo'" v-model="dadosDB.url"
                                          label="Url/Streaming" required
                                          ref="url"
                                          :error-messages="errors.url"
                                          autofocus

                            ></v-text-field>


                        </v-card-text>

                        <v-layout row wrap>
                            <v-flex sm12 md6>
                                <v-text-field v-model="dadosDB.tempo" label="Tempo" required
                                              ref="tempo"
                                              :error-messages="errors.tempo"
                                              mask="time"
                                              class="mt-3"
                                              return-masked-value
                                ></v-text-field>
                            </v-flex>


                            <v-flex sm12 md6>
                                <v-combobox
                                        label="Tags"
                                        required
                                        v-bind:items="tags"
                                        v-model="dadosDB.tags"
                                        multiple
                                        chips
                                        deletable-chips
                                        hint="Você pode indicar mais de uma tag"
                                        persistent-hint
                                        no-data-text="Nenhum histórico encontrado"
                                        :error-messages="errors.tags"
                                        ref="tags"
                                        tags

                                        @keyup.enter.stop=""
                                        :rules="rules.required"
                                >
                                    <template slot="append-outer">
                                        <v-tooltip left content-class="left">
                                            <v-icon class="aton-pointer" color="blue darken-1" slot="activator" v-text="'info_outline'"></v-icon>
                                            <span>As tags são utilizadas na criação de carrossel nas playlists</span>
                                        </v-tooltip>
                                    </template>
                                </v-combobox>
                            </v-flex>

                            <v-flex sm12 md6>
                                <v-checkbox
                                        hide-details
                                        class="my-3"
                                        height="20px"
                                        label="Reproduzir Audio se disponível"
                                        v-model="dadosDB.force_audio"
                                ></v-checkbox>
                            </v-flex>
                        </v-layout>

                    </v-card-text>

                </v-tab-item>
                <v-tab-item
                        value="tab_agendamento"
                >
                    <v-card-text>

                        <p>Data de validade para a <strong>veiculação</strong></p>
                        <v-layout row wrap>
                            <v-flex xs12 lg3>
                                <v-menu
                                        ref="menu_validade_de"
                                        :close-on-content-click="false"
                                        v-model="menu_validade_de"
                                        :nudge-right="40"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                >
                                    <v-text-field
                                            class="px-1"
                                            slot="activator"
                                            v-model="dadosDB.validade_de"
                                            label="Data de início da veiculação"
                                            clearable
                                            box
                                            persistent-hint
                                            prepend-icon="event"

                                    ></v-text-field>
                                    <v-date-picker
                                            v-model="dadosDB._validade_de"
                                            no-title
                                            reactive
                                            @change="saveDateDe"
                                            @input="dadosDB.validade_de = formatDate($event)"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>

                            <v-flex xs12 lg3>
                                <v-menu
                                        ref="menu_validade_ate"
                                        :close-on-content-click="false"
                                        v-model="menu_validade_ate"
                                        :nudge-right="40"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                >
                                    <v-text-field
                                            class="px-1"
                                            slot="activator"
                                            v-model="dadosDB.validade_ate"
                                            label="Data do final da veiculação"
                                            clearable
                                            box
                                            persistent-hint
                                            prepend-icon="event"

                                    ></v-text-field>
                                    <v-date-picker
                                            v-model="dadosDB._validade_ate"
                                            no-title
                                            reactive
                                            @change="saveDateAte"
                                            @input="dadosDB.validade_ate = formatDate($event)"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>
                        </v-layout>
                        <v-divider></v-divider>

                        <p class="mt-2">Inclusão de filtro <strong>semanal</strong></p>

                        <v-layout row wrap align-center>
                            <v-flex xs6 sm6 md2>
                                <v-menu
                                        ref="menu_hora_inicio"
                                        :close-on-content-click="false"
                                        v-model="menu_hora_inicio"
                                        :nudge-right="40"
                                        :return-value.sync="agendamento_modelo.hora_inicio"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                >
                                    <v-text-field
                                            class="px-1"
                                            slot="activator"
                                            v-model="agendamento_modelo.hora_inicio"
                                            label="Hora de início"
                                            readonly
                                            box
                                            clearable
                                            prepend-icon="access_time"
                                    ></v-text-field>
                                    <v-time-picker
                                            v-model="agendamento_modelo.hora_inicio"
                                            format="24hr"
                                            scrollable

                                            v-if="menu_hora_inicio"
                                            full-width

                                            @change="$refs.menu_hora_inicio.save(agendamento_modelo.hora_inicio)"
                                    ></v-time-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs6 sm6 md2>
                                <v-menu
                                        ref="menu_hora_fim"
                                        :close-on-content-click="false"
                                        v-model="menu_hora_fim"
                                        :nudge-right="40"
                                        :return-value.sync="agendamento_modelo.hora_fim"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                >
                                    <v-text-field
                                            class="px-1"
                                            slot="activator"
                                            v-model="agendamento_modelo.hora_fim"
                                            label="Hora do final"
                                            readonly
                                            box
                                            clearable
                                            prepend-icon="access_time"
                                    ></v-text-field>
                                    <v-time-picker
                                            v-model="agendamento_modelo.hora_fim"
                                            format="24hr"
                                            max="23:59"
                                            scrollable

                                            v-if="menu_hora_fim"
                                            full-width

                                            @change="$refs.menu_hora_fim.save(agendamento_modelo.hora_fim)"
                                    ></v-time-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs10 sm10 md6>

                                <v-item-group
                                        multiple
                                        v-model="agendamento_modelo.dias"
                                        class="pr-1"
                                >
                                    <strong class="subheader">Dias: </strong>

                                    <v-item

                                            v-for="(dia, index) in dias_semana_values"
                                            :key="index"
                                            :value="dias_semana_values[index]"
                                    >

                                        <v-chip
                                                slot-scope="{ active, toggle }"
                                                :selected="active"
                                                v-bind:class="{ 'atonSelecaoDias2 active': active}"
                                                @click="toggle"

                                        >
                                            <v-tooltip
                                                    top
                                                    content-class="top"
                                                    open-delay="500"
                                                    @click.native.stop="toggle"
                                            >
                                                        <span slot="activator">
                                                        {{ dia }}
                                                        </span>
                                                <span>Clique e selecione os dias</span>
                                            </v-tooltip>
                                        </v-chip>

                                    </v-item>

                                </v-item-group>
                            </v-flex>
                            <v-spacer></v-spacer>
                            <v-flex xs2 sm2 md2 lg1>

                                <v-btn fab dark small
                                       color="primary"
                                       @click="IncluirHorarioSemanal"
                                >
                                    <v-icon dark>add</v-icon>

                                </v-btn>
                            </v-flex>
                        </v-layout>


                        <v-divider></v-divider>

                        <v-card-text :dark="!this.isModeDarkForms"
                                     :light="this.isModeDarkForms">
                            <p v-if="dadosDB.agendamento.length" class="mt-2">Horários
                                <strong>agendados </strong> de exibição</p>
                            <p v-else class="mt-2"><strong> Esta conteúdo ainda não possui agendamento
                                semanal</strong></p>


                            <v-card tile>
                                <v-alert
                                        v-for="(value, index) in dadosDB.agendamento" :key="index"
                                        :value="true"
                                        color="info"
                                        outline>
                                    <v-layout align-center justify-center row fill-height>
                                        <v-flex xs10 sm10>
                                            <v-flex xs12 sm12>
                                                <v-chip label outline color="red" class="'">
                                                    {{ value.hora_inicio + ' as ' + value.hora_fim}}
                                                </v-chip>
                                            </v-flex>
                                            <v-flex xs12 sm12>
                                                <v-chip
                                                        v-for="(valor, index) in value.dias"
                                                        :key="valor"
                                                        close
                                                        small
                                                        :color="value.conflit.indexOf(valor) !== -1 ? 'red' : 'green'"
                                                        text-color="white"
                                                        @input="ExcluirDiaSemana(value, valor)"
                                                >
                                                    {{valor}}
                                                </v-chip>
                                                <v-chip label color="warning"
                                                        v-show="value.conflit.length"
                                                        class="aton_wrap xs-12 sm-12"
                                                >
                                                    <v-avatar>
                                                        <v-icon>error</v-icon>
                                                    </v-avatar>
                                                    Existe conflito, verifique!
                                                </v-chip>
                                            </v-flex>
                                        </v-flex>
                                        <v-spacer></v-spacer>
                                        <v-flex xs2 lg1>

                                            <v-btn fab dark small
                                                   color="secondary"
                                                   @click="ExcluirItem(value)"
                                            >
                                                <v-icon dark>delete_forever</v-icon>
                                            </v-btn>
                                        </v-flex>
                                    </v-layout>

                                </v-alert>

                            </v-card>

                        </v-card-text>
                    </v-card-text>
                </v-tab-item>
                <v-tab-item
                        value="tab_cliente"
                >
                    <v-card>

                        <v-card-text>
                            <p class="mt-2">
                                <strong>Cliente</strong> vinculado ao conteúdo.</p>
                            <v-autocomplete
                                    v-model="dadosDB.cliente_id"
                                    :items="clientes"
                                    :loading="isLoading"
                                    :search-input.sync="search"
                                    hide-no-data
                                    hide-selected

                                    item-text="nome"
                                    item-value="id"

                                    label="Cliente"
                                    placeholder="Inicie a digitar para buscar"


                                    :append-icon="temCliente ? 'info' : ''"

                                    deletable-chips
                                    box
                                    chips
                                    small-chips

                                    cache-items
                            >

                                <template
                                        slot="selection"
                                        slot-scope="{ item, selected }"
                                >
                                    <v-chip
                                            :selected="selected"
                                            close
                                            color="blue-grey"
                                            class="white--text"
                                            @input="dadosDB.cliente_id = null"
                                    >
                                        {{item.nome}}

                                    </v-chip>
                                </template>

                                <template
                                        slot="append"
                                        v-if="temCliente"
                                >
                                    <v-tooltip content-class="left" left>
                                        <v-btn
                                                slot="activator"
                                                flat
                                                icon
                                                v-if="temCliente"
                                                :value="$can('cliente-edit')"
                                                color="primary"
                                                :href="'/admin/clientes/'+ dadosDB.cliente_id+'/edit'"
                                                :target="'_blank'"
                                        >
                                            <v-icon v-if="temCliente">info</v-icon>
                                        </v-btn>
                                        <span>Abrir o cadastro de clientes</span>
                                    </v-tooltip>
                                </template>

                            </v-autocomplete>
                        </v-card-text>

                    </v-card>
                </v-tab-item>
            </v-tabs-items>


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
                                @click="voltaViewLocal(true)"
                        >
                            <v-icon>arrow_back</v-icon>
                        </v-btn>
                        <span>Fechar</span>
                    </v-tooltip>
                </v-speed-dial>
            </v-fab-transition>
        </v-form>
        <template slot="actions">
            <v-checkbox
                    hide-details
                    class="mt-1"
                    height="20px"
                    label="Ativo"
                    v-model="dadosDB.ativo"
            ></v-checkbox>
            <v-spacer></v-spacer>
            <v-btn v-if="false" class="blue--text darken-1" @click="voltaViewLocal(true)">
                <v-icon left>mdi-close</v-icon>
                Fechar
            </v-btn>
            <v-btn v-if="false"
                   color="primary darken-2"
                   :loading="loading"
                   @click="callPost()"
                   :disabled="loading"
            >
                <v-icon left>mdi-check</v-icon>
                Salvar
            </v-btn>
        </template>


    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    // import Dropzone from 'vue2-dropzone';
    // import vue2Dropzone from 'vue2-dropzone';
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    import vue2Dropzone from 'vue2-dropzone';
    // import captureVideoFrame from 'capture-video-frame';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        name: 'aton-admin-playlist_conteudo-add-edit',
        data() {
            return {


                tabs: null,
                menu_validade_de: null,
                menu_validade_ate: null,

                menu_hora_inicio: null,
                menu_hora_fim: null,

                hora_inicio: true,
                hora_fim: false,

                arquivosEnviados: false,

                agendamento_modelo: {
                    hora_inicio: '00:00',
                    hora_fim: '23:59',
                    dias: [],
                },

                tipo_conteudo: ['arquivo', 'url', 'streaming'],
                dias_semana: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                dias_semana_values: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

                headers: [
                    {text: 'Início', value: 'hora_inicio', align: 'center'},
                    {text: 'Fim', value: 'hora_fim', align: 'center'},
                    {text: 'Dias Programados', value: '', align: 'center'},
                    {text: 'Ações', value: '', align: 'right', sortable: false},
                ],

                dadosDB: {
                    nome: '',
                    tags: [],
                    ativo: true,
                    arquivo: '',
                    filename: '',
                    mime: '',
                    size: 0,
                    tempo: '',
                    link: '',
                    user_id: '',
                    cliente_id: '',
                    cliente: [],
                    arquivosLocal: [],
                    agendamento: [],
                    _validade_de: '',
                    _validade_ate: '',
                    url: '',
                    tipo_conteudo: 'arquivo',
                    thumbnail: '',
                },

                arquivosExcluir: [],
                arquivoOriginal: '',

                tags: [],

                idAgenda: 0,

                dropzoneOptions: {
                    url: "/admin/playlist_conteudo/upload/dir/playlistconteudo",

                    dictDefaultMessage: '<p>Insira seus arquivos</p>',
                    dictCancelUpload: "Cancelar envio",
                    dictCancelUploadConfirmation: "Realmente cancelar envio?",
                    dictFallbackMessage: "Seu browser não suporta.",
                    dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
                    dictFileTooBig: "Arquivo muito grande ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
                    dictInvalidFileType: "Você não pode incluir arquivo deste tipo.",
                    dictMaxFilesExceeded: "Vocë não pode incluir mais arquivos. (max: {{maxFiles}})",
                    dictRemoveFile: "Remover",
                    dictRemoveFileConfirmation: null,
                    dictResponseError: "Servidor respondeu com {{statusCode}} code.",

                    // duplicateCheck: true,
                    maxFiles: 1,
                    thumbnailHeight: 200,
                    // thumbnailWidth: 300,
                    timeout: 0,

                    createImageThumbnails: false,


                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                },


                descriptionLimit: 60,
                entries: [],
                isLoading: false,
                model: null,
                search: null,

                clientes: [],
            }
        },

        mounted() {
            // >>> muito importante para validação de csrf token do dropzone
            $('[name=_token]').val(this.$http.defaults.headers.common['X-CSRF-TOKEN']);


            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.ativo = true;
                this.dadosDB.exibe_site = true;
            }

            this.loadTags();


        },

        components: {
            vue2Dropzone,
        },
        methods: {
            ExcluirItem: function (item) {

                this.$logDebug(item);
                this.dadosDB.agendamento.splice(this.dadosDB.agendamento.indexOf(item), 1);

                this.$nextTick(function () {
                    this.AjustaConflitosAll();
                });
            },

            ExcluirDiaSemana: function (item, dia) {
                item.dias.splice(item.dias.indexOf(dia), 1);

                if (item.dias.length) {
                    this.AjustaConflitosAll();
                } else {
                    this.ExcluirItem(item);
                }

            },

            AjustaConflitosAll: function () {
                for (let q = 0, len = this.dadosDB.agendamento.length; q < len; q++) {
                    // this.$logDebug(this.dadosDB.agendamento[i]);

                    // var agendaTmp = _.clone(this.dadosDB.agendamento[q]);
                    // this.dadosDB.agendamento[q] = this.AjustaConflitoIndividual(this.dadosDB.agendamento[q]);

                    this.AjustaConflitoIndividual(this.dadosDB.agendamento[q]);
                }
            },

            AjustaConflitoIndividual: function (item) {
                // this.$logDebug(item);
                // this.$logDebug(this.dadosDB.agendamento);

                if (!item) {
                    return [];
                }

                if (!item.conflit) {
                    this.$set(item, 'conflit', []);
                } else {
                    item.conflit = [];
                }

                let ItemHoraInicio = moment(item.hora_inicio, ['HH:mm']);
                let ItemHoraFim = moment(item.hora_fim, ['HH:mm']);


                for (let i = 0, len = this.dadosDB.agendamento.length; i < len; i++) { // <<<<<<<< percorre todos agendamentos
                    // this.$logDebug(this.dadosDB.agendamento[i]);
                    let AgendamentoHoraInicio = moment(this.dadosDB.agendamento[i].hora_inicio, ['HH:mm']);
                    let AgendamentoHoraFim = moment(this.dadosDB.agendamento[i].hora_fim, ['HH:mm']);
                    if (
                        (this.dadosDB.agendamento[i].id !== item.id) &&
                        (
                            (
                                ((ItemHoraInicio.isSameOrAfter(AgendamentoHoraInicio)) &&
                                    (ItemHoraInicio.isSameOrBefore(AgendamentoHoraFim))
                                ) ||
                                ((ItemHoraFim.isSameOrAfter(AgendamentoHoraInicio)) &&
                                    (ItemHoraFim.isSameOrBefore(AgendamentoHoraFim))
                                )
                            ) ||
                            (
                                ((AgendamentoHoraInicio.isSameOrAfter(ItemHoraInicio)) &&
                                    (AgendamentoHoraInicio.isSameOrBefore(ItemHoraFim))
                                ) ||
                                ((AgendamentoHoraFim.isSameOrAfter(ItemHoraInicio)) &&
                                    (AgendamentoHoraFim.isSameOrBefore(ItemHoraFim))
                                )
                            )
                        )
                    ) {
                        // this.$logDebug(item);
                        // this.$logDebug('entrou if');

                        let temConflitoItem = false;
                        for (let j = 0, len2 = this.dadosDB.agendamento[i].dias.length; j < len2; j++) { // <<<<<<<< percorre todos dias do agendamento
                            // this.$logDebug('for dias agendamento');
                            // this.$logDebug(this.dadosDB.agendamento[i].dias[j]);
                            for (let h = 0, len3 = item.dias.length; h < len3; h++) {   // <<<<<<<< percorre todos dias do item
                                this.$logDebug('for dias item');
                                this.$logDebug(item.dias[h]);
                                this.$logDebug('for dias agendamento');
                                this.$logDebug(this.dadosDB.agendamento[i]);
                                this.$logDebug(this.dadosDB.agendamento[i].dias[j]);
                                if (!this.dadosDB.agendamento[i].conflit) {
                                    this.$set(this.dadosDB.agendamento[i], 'conflit', []);
                                }


                                this.$logDebug(this.dadosDB.agendamento[i]);
                                this.$logDebug(this.dadosDB.agendamento[i].dias[j]);

                                if (this.dadosDB.agendamento[i].dias[j] === item.dias[h]) {
                                    this.$logDebug('index of agendamento');
                                    this.$logDebug(this.dadosDB.agendamento[i].conflit.indexOf(this.dadosDB.agendamento[i].dias[j]));
                                    this.dadosDB.agendamento[i].conflit.indexOf(this.dadosDB.agendamento[i].dias[j]) === -1 ? this.dadosDB.agendamento[i].conflit.push(this.dadosDB.agendamento[i].dias[j]) : false;
                                    item.conflit.indexOf(item.dias[h]) === -1 ? item.conflit.push(item.dias[h]) : false;
                                    temConflitoItem = true;
                                }
                                // else{
                                //     item.conflit.splice(item.conflit.indexOf(item.dias[h]), 1);
                                //     // return false;
                                // }
                            }
                        }
                    }
                }

                return item;

            },

            IncluirHorarioSemanal: function () {
                this.idAgenda = this.idAgenda + 1;

                this.agendamento_modelo.hora_inicio = this.agendamento_modelo.hora_inicio ? this.agendamento_modelo.hora_inicio : '00:00';
                this.agendamento_modelo.hora_fim = this.agendamento_modelo.hora_fim ? this.agendamento_modelo.hora_fim : '23:59';

                var tmpAgenda = {
                    id: this.idAgenda,
                    hora_inicio: this.agendamento_modelo.hora_inicio ? this.agendamento_modelo.hora_inicio : '00:00',
                    hora_fim: this.agendamento_modelo.hora_fim ? this.agendamento_modelo.hora_fim : '23:59',
                    dias: this.agendamento_modelo.dias.length > 0 ? this.agendamento_modelo.dias : ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                    conflit: [],
                };

                this.$logDebug(tmpAgenda);

                if (moment(tmpAgenda.hora_inicio, ['HH:mm']).isSameOrAfter(moment(tmpAgenda.hora_fim, ['HH:mm']))) {
                    bus.$emit('atonmsg', 'error', 'Hora final deve ser maior que hora inicial.');
                    return false;
                }


                for (let i = 0, len = this.dadosDB.agendamento.length; i < len; i++) {
                    if (
                        (
                            (this.dadosDB.agendamento[i].hora_inicio == tmpAgenda.hora_inicio) &&
                            (this.dadosDB.agendamento[i].hora_fim == tmpAgenda.hora_fim) &&
                            (JSON.stringify(this.dadosDB.agendamento[i].dias) == JSON.stringify(tmpAgenda.dias))
                        )

                    ) {
                        bus.$emit('atonmsg', 'error', 'Já existe agendamento para os critérios escolhidos.');
                        return false;
                    }
                }

                this.dadosDB.agendamento.push(tmpAgenda);


                this.$nextTick(function () {
                    this.AjustaConflitoIndividual(tmpAgenda);
                });

                this.agendamento_modelo = {
                    hora_inicio: '00:00',
                    hora_fim: '23:59',
                    dias: [],
                };

            },
            saveDateDe(date) {
                this.$refs.menu_validade_de.save(date)
            },
            saveDateAte(date) {
                this.$refs.menu_validade_ate.save(date)
            },
            captureVideoFrame: function (video, canvas, format, quality) {
                if (typeof video === 'string') {
                    video = document.getElementById(video);
                }

                format = format || 'jpeg';
                quality = quality || 0.92;

                if (!video || (format !== 'png' && format !== 'jpeg' && format !== 'jpg')) {
                    return false;
                }

                // this.$logDebug(canvas);

                var dataUri = canvas.toDataURL('image/' + format, quality);
                var data = dataUri.split(',')[1];
                var mimeType = dataUri.split(';')[0].slice(5)

                var bytes = window.atob(data);
                var buf = new ArrayBuffer(bytes.length);
                var arr = new Uint8Array(buf);

                for (var i = 0; i < bytes.length; i++) {
                    arr[i] = bytes.charCodeAt(i);
                }

                var blob = new Blob([arr], {type: mimeType});
                return {blob: blob, dataUri: dataUri, format: format};
            },
            loadFile: function () {
                var self = this;

                this.$logDebug('Entrou em loadFile');
                for (var i = 0, len = self.dadosDB.arquivosLocal.length; i < len; i++) {
                    var mockFile = {
                        link: self.dadosDB.arquivosLocal[i].link,
                        mime: self.dadosDB.arquivosLocal[i].mime,
                        type: self.dadosDB.arquivosLocal[i].mime,
                        filename: self.dadosDB.arquivosLocal[i].filename,
                        name: self.dadosDB.arquivosLocal[i].filename,
                        size: self.dadosDB.arquivosLocal[i].size,
                        thumbnail: self.dadosDB.arquivosLocal[i].thumbnail,
                        tempo: self.dadosDB.arquivosLocal[i].tempo,
                        isMock: true,
                        original: true,
                        excluir: false,
                    };

                    mockFile.isMock = true;

                    // Tell eveyone this file was accepted.
                    mockFile.status = 'success';
                    mockFile.accepted = true;


                    var options = {
                        dontSubstractMaxFiles: true,
                        addToFiles: true,
                    };

                    this.$logDebug('Iniciando loadFile.manuallyAddFile');
                    // self.$refs.myVueDropzone.manuallyAddFile(mockFile, '/storage/' + self.dadosDB.arquivosLocal[i].thumbnail, null, true, options);
                    self.$refs.myVueDropzone.manuallyAddFile(mockFile, '/storage/' + self.dadosDB.arquivosLocal[i].thumbnail);
                    // self.$refs.myVueDropzone.manuallyAddFile(mockFile, '/storage/' + self.dadosDB.arquivosLocal[i].link);


                    this.$logDebug('Rodou loadFile.manuallyAddFile');

                }
                // this.$refs.myVueDropzone.setOption('resizeMethod', 'contain');
                this.$logDebug('Acabou loadFile.setOption');
            },
            loadItemEdit: function () {
                // let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/playlist_conteudo/' + this.$route.params.id + '/update')
                    .then(response => {
                        this.loading = false;
                        this.dadosDB = response.data;
                        this.dadosDB.tempo = response.data.tempo.padStart(5, '0');

                        if (this.dadosDB.cliente) {
                            this.clientes = [this.dadosDB.cliente];
                            this.cliente_id = this.dadosDB.cliente;
                        }

                        if (this.dadosDB.tipo_conteudo == 'arquivo') {
                            this.dadosDB.arquivosLocal = [{
                                filename: this.dadosDB.filename,
                                name: this.dadosDB.filename,
                                mime: this.dadosDB.mime,
                                size: this.dadosDB.size,
                                link: this.dadosDB.link,
                                url: this.dadosDB.link_externo,
                                thumbnail: this.dadosDB.thumbnail,
                            }];

                            for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                                this.dadosDB.arquivosLocal[i].isMock = true;
                                this.dadosDB.arquivosLocal[i].original = true;
                                this.dadosDB.arquivosLocal[i].excluir = false;
                            }

                            if (this.dadosDB.agendamento == null) {
                                this.dadosDB.agendamento = [];
                                this.idAgenda = 0;
                            } else {
                                for (var i = 0, len = this.dadosDB.agendamento.length; i < len; i++) {
                                    if (this.idAgenda < this.dadosDB.agendamento[i].id) {
                                        this.idAgenda = this.dadosDB.agendamento[i].id;
                                    }
                                    this.$set(this.dadosDB.agendamento[i], 'conflit', []);
                                }
                            }

                            this.$logDebug('Chamando loadFile()');
                            this.loadFile();

                            this.$logDebug('Passou chamada loadFile()');
                        } else {
                            this.dadosDB.arquivosLocal = [];
                        }


                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        this.$logDebug('erro no GET de loadItemEdit');
                        this.$logDebug(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            startUploadMsg: function () {
                this.$logDebug('Entrou em startUploadMsg');
                // if (!arquivo.manuallyAdded){
                this.loading_extras = true;
                bus.$emit('atonprogress:on', 'Fazendo upload de novo arquivo');
                // }
            },
            stopUploadMsg: function () {
                this.$logDebug('Entrou em stopUploadMsg');
                bus.$emit('atonprogress:off');
                this.loading_extras = false;
            },
            arquivoAdicionadoManualmente: function (arquivo) {
                this.$logDebug('Entrou em arquivoAdicionadoManualmente');
                this.stopUploadMsg();

                // if (!arquivo.type.match(/image.*/)) {
                // This is not an image, so Dropzone doesn't create a thumbnail.
                // Set a default thumbnail:
                var thumbnails = arquivo.previewElement.querySelectorAll('[data-dz-thumbnail]');
                for (var i = 0; i < thumbnails.length; i++) {
                    // thumbnails[i].style.width = this.dropzoneSettings.thumbnailWidth + 'px';
                    // thumbnails[i].style.height = this.dropzoneSettings.thumbnailHeight + 'px';
                    // thumbnails[i].style['object-fit'] = 'contain';
                    thumbnails[i].src = '/storage/' + arquivo.thumbnail;
                }

                // }

            },

            arquivoAdicionado: function (arquivo, response) {
                this.$logDebug('Entrou em arquivoAdicionado');
                this.$logDebug(arquivo);
                this.$logDebug(response);
                // if(arquivo.isMock){
                //     return true;
                // }


                var self = this;

                this.loading_extras = true;
                bus.$emit('atonprogress:on', 'Fazendo upload de novo arquivo');
                // this.$logDebug(arquivo);

                var tmpArquivo = {};

                tmpArquivo.link = response.arquivo;
                tmpArquivo.mime = response.mime;
                tmpArquivo.filename = arquivo.name;
                tmpArquivo.thumbnail = response.thumbnail;
                tmpArquivo.size = response.size;
                tmpArquivo.tempo = response.duration.padStart(5, '0');
                tmpArquivo.isMock = false;
                tmpArquivo.original = false;
                tmpArquivo.excluir = false;


                this.dadosDB.filename = response.filename;
                this.dadosDB.mime = tmpArquivo.mime;
                this.dadosDB.size = tmpArquivo.size;
                this.dadosDB.link = tmpArquivo.link;
                this.dadosDB.arquivo = tmpArquivo.link;
                this.dadosDB.thumbnail = tmpArquivo.thumbnail;
                this.dadosDB.tempo = tmpArquivo.tempo.padStart(5, '0');

                this.dadosDB.arquivosLocal.push(tmpArquivo);


                // sefor video deve gerar thumbnail
                if (this.dadosDB.mime.indexOf('video') > -1) {
                    var video = document.createElement('video');
                    // document.body.appendChild(video);

                    video.src = '/storage/' + tmpArquivo.link + '#t=4';
                    video.id = 'video';

                    video.setAttribute("width", "320");
                    video.setAttribute("height", "240");
                    video.setAttribute("controls", "controls");
                    video.setAttribute("type", "video/mp4");

                    // video.addEventListener('loadeddata', function() {
                    //     this.currentTime = 7;
                    // }, false);

                    var canvas = document.createElement("canvas");
                    // document.body.appendChild(canvas);
                    // var canvas = document.getElementById('canvas');

                    canvas.width = 320;
                    canvas.height = 240;


                    // canvas.getContext('2d').drawImage(video, 0, 0, 320, 240);
                    video.addEventListener('canplaythrough', function fn(event) {
                        video.removeEventListener("canplaythrough", fn);
                        canvas.getContext('2d').drawImage(video, 0, 0, 320, 240);
                        // this.$logDebug('canplaythrough');

                        var frame = self.captureVideoFrame(video, canvas, 'jpg');

                        // Upload the image...
                        var formData = new FormData();
                        formData.append('file', frame.blob, tmpArquivo.filename.slice(0, -4) + '.' + frame.format);
                        self.loading_extras = true;
                        bus.$emit('atonprogress:on', 'Fazendo upload de thumbnail');

                        self.$http.post('/admin/playlist_conteudo/uploadthumbnail/dir/playlistconteudo', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                            .then(response => {
                                self.dadosDB.thumbnail = response.data.thumbnail;

                                var thumbnails = arquivo.previewElement.querySelectorAll('[data-dz-thumbnail]');
                                for (var i = 0; i < thumbnails.length; i++) {
                                    // thumbnails[i].style.width = this.dropzoneSettings.thumbnailWidth + 'px';
                                    // thumbnails[i].style.height = this.dropzoneSettings.thumbnailHeight + 'px';
                                    // thumbnails[i].style['object-fit'] = 'contain';
                                    thumbnails[i].src = '/storage/' + response.data.thumbnail;
                                }

                                bus.$emit('atonprogress:off');
                                self.loading_extras = false;
                            })
                            .catch(error => {
                                bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');
                                bus.$emit('atonprogress:off');
                                self.loading_extras = false;
                            }).finally(() => {
                            bus.$emit('atonprogress:off');
                            self.loading_extras = false;
                        });


                        return false;
                    });

                } else {
                    var thumbnails = arquivo.previewElement.querySelectorAll('[data-dz-thumbnail]');
                    for (var i = 0; i < thumbnails.length; i++) {
                        // thumbnails[i].style.width = this.dropzoneSettings.thumbnailWidth + 'px';
                        // thumbnails[i].style.height = this.dropzoneSettings.thumbnailHeight + 'px';
                        // thumbnails[i].style['object-fit'] = 'contain';
                        thumbnails[i].src = '/storage/' + tmpArquivo.thumbnail;
                    }

                    self.loading_extras = false;
                    bus.$emit('atonprogress:off');
                }


            },
            arquivoExcluido: function (file) {
                this.$logDebug('Entrou em arquivoExcluido', file);
                this.$logDebug(file);
                let nomeArquivo = file.name;
                this.$logDebug(nomeArquivo);

                if (file.isMock) { // se não é o arquivo original prepara para excluir
                    for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                        if (this.dadosDB.arquivosLocal[i].filename == nomeArquivo) {
                            this.dadosDB.arquivosLocal[i].excluir = true;
                            this.$refs.myVueDropzone.maxFiles = 1;
                            break;
                        }
                    }
                } else {
                    if (file.status != 'error') { // se não deu erro ao inserir
                        let retorno = JSON.parse(file.xhr.responseText);

                        for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                            if (this.dadosDB.arquivosLocal[i].filename == nomeArquivo) {
                                this.dadosDB.arquivosLocal[i].excluir = true;
                                break;
                            }
                        }
                    }
                }
            },
            callDeleteFiles: function (excluirOriginal, excluirNovos) {
                if (this.loading) return false;

                let tmpExclusao = [];

                for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                    if ((excluirOriginal && this.dadosDB.arquivosLocal[i].original && this.dadosDB.arquivosLocal[i].excluir) ||
                        (!this.dadosDB.arquivosLocal[i].original && this.dadosDB.arquivosLocal[i].excluir) ||
                        (excluirNovos && !this.dadosDB.arquivosLocal[i].original) ||
                        (this.dadosDB.tipo_conteudo != 'arquivo') // exclui todos arquivos pendentes se tipo for diferente de arquivo
                    ) {
                        tmpExclusao.push(this.dadosDB.arquivosLocal[i].link);
                        if (this.dadosDB.arquivosLocal[i].thumbnail != '') { // adicionado pois estava mandando vazio para exclusão na desistencia de uma inserção de registro
                            tmpExclusao.push(this.dadosDB.arquivosLocal[i].thumbnail);
                        }

                        // if (this.dadosDB.thumbnail != '') { // adicionado pois estava mandando vazio para exclusão na desistencia de uma inserção de registro
                        //     tmpExclusao.push(this.dadosDB.thumbnail);
                        // }

                    }
                }

                if (tmpExclusao.length <= 0) return false;

                let self = this;
                this.loading = true;
                this.$http.post('/admin/playlist_conteudo/upload/destroy', tmpExclusao)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('atonmsg', 'success', msg);
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.errors = error.response.data;
                    });
            },
            loadTags: function () {
                let self = this;
                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/admin/playlist_conteudo/tags/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.tags = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        this.$logDebug(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },

            voltaViewLocal: function (excluirPendentes = false) {
                if (excluirPendentes) {
                    this.callDeleteFiles(false, true);
                }
                this.loading_extras = false;

                this.voltaView('/admin/playlist/conteudo');
                // this.$router.push({path: '/admin/playlist/conteudo'});

            },

            callPost: function () {
                if (this.loading) return false;

                if (this.dadosDB.tipo_conteudo == 'arquivo') {
                    var arquivosIncluidos = this.$refs.myVueDropzone.getAcceptedFiles();

                    if (!arquivosIncluidos.length) {
                        this.$logDebug(arquivosIncluidos);
                        bus.$emit('atonmsg', 'error', 'Você deve incluir um arquivo');
                        return false;
                    }
                } else {
                    this.$refs.myVueDropzone.removeAllFiles(true);
                    if ((!this.dadosDB.url) || (this.dadosDB.url == '')) {
                        bus.$emit('atonmsg', 'error', 'Informe a url do conteúdo');
                        return false;
                    }
                }

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/playlist_conteudo';

                if (this.isEdit) {
                    _url = '/admin/playlist_conteudo/' + self.dadosDB.id + '/update';
                }


                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados
                        bus.$emit('atonmsg', 'success', msg);

                        self.callDeleteFiles(true, false);
                        self.voltaViewLocal();
                        bus.$emit('playlist_conteudo:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    })
                    .finally(() => {
                        this.loading_extras = false;
                        bus.$emit('atonprogress:off');
                    });

            },

            ExcluirCliente: function () {
                this.dadosDB.cliente_id = '';
                this.dadosDB.cliente = [];
                this.clientes = [];
            },

            querySelections(val) {
                if ((!val.length || (val.length < 4)) ||
                    (this.loading || this.loading_extras || this.isLoading)) return;

                this.isLoading = true;
                let arrPesquisa = {
                    "filtro": '*',
                };

                if ((val)) {
                    arrPesquisa = {
                        "filtro": '*',
                        "fields": {
                            "nome": val,
                            "cnpj_cpf": val,
                        }
                    }
                }

                this.$logDebug('entrou no querySelection: ' + arrPesquisa);
                // Lazily load input items
                this.$http.post('/admin/cliente/listar', arrPesquisa)
                    .then(res => {
                        // const { count, entries } = res.data
                        this.clientes = res.data;
                        // this.entries = entries
                    })
                    .catch(err => {
                        console.log(err)
                    })
                    .finally(() => (this.isLoading = false))
            },
        },

        computed: {

            temCliente: function () {
                return this.ValisNotEmptyNull(this.dadosDB.cliente_id);
            },
        },

        watch: {
            search(val) {
                this.$logDebug('entrou no watch');
                this.$logDebug('val: ' + val);
                if (val) {
                    val && val !== this.dadosDB.cliente_id && this.querySelections(val)
                }
            }
        },
    }
</script>

<style scoped>
    .atonSelecaoDias {
        color: white;
        background-color: #ff4d44;
    }

    .atonSelecaoDias2 {
        color: white;
        background-color: #A128FF;
    }

    /*@keyup.enter.prevent="callPost()"*/
    /*@keyup.esc.prevent="voltaViewLocal()"*/
</style>

