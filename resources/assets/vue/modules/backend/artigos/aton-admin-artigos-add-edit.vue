<template>
    <v-form v-model="formCtrl" ref="form" lazy-validation>
        <v-card
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >
            <v-toolbar  dark color="secondary" class=" white--text">
                <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Artigo') }}</v-toolbar-title>
            </v-toolbar>
            <div class="div-progress"><v-progress-linear v-show="loading || loading_extras" height="3" color="success" :indeterminate="true"></v-progress-linear></div>
        <v-divider black></v-divider>
        <v-card-text>
            <v-text-field v-model="dadosDB.titulo" label="Titulo" required
                          ref="titulo"
                          :error-messages="errors.titulo"
                          :error="inError"
                          :rules="rules.required"
                          autofocus
            ></v-text-field>

            <v-tabs dark fixed centered
                    slider-color="yellow"
            >
                    <v-tab
                            :href="'#tab-imagem'"
                    >
                        Imagens
                    </v-tab>
                    <v-tab
                            :href="'#tab-video'"
                    >
                        Vídeo
                    </v-tab>

                <v-tabs-items>
                    <v-tab-item
                            :id="'tab-imagem'"
                    >
                        <v-card flat>
                            <v-card-text>
                                <div class="body-1 text--lighten-1">Selecione seu arquivo</div>
                                <dropzone id="myVueDropzone"  ref="dropzone"
                                         :options="dropzoneOptions"
                                          @vdropzone-success="arquivoAdicionado"
                                          @vdropzone-removed-file="arquivoExcluido"
                                >
                                    <input name="_token" type="hidden" ref="token">
                                </dropzone>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item
                            :id="'tab-video'"
                    >
                        <v-card flat>
                            <v-card-text>
                                <v-text-field v-model="dadosDB.url_video" label="Incorporar vídeo"
                                              ref="url_video"
                                              :error-messages="errors.url_video"
                                ></v-text-field>
                                <v-alert error value="true">
                                    Inclua neste campo todo o código de incorporação do vídeo e não somente a url do mesmo.
                                </v-alert>

                                <v-alert warning value="true">
                                    Quando indicado um url de vídeo as imagens não serão exibidas. Para exibi-las mantenha este campo vazio.
                                </v-alert>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </v-tabs>

            <v-divider black></v-divider>

            <v-card
                    @keyup.enter.stop=""
                    @keyup.esc.stop=""
            >
                <v-card-text>
                    <div class="headline">Apresentação</div>
                    <froala :tag="'textarea'" :config="configFroala" v-model="dadosDB.apresentacao"></froala>


                    <v-divider black></v-divider>
                    <div class="headline">Corpo</div>
                    <froala :tag="'textarea'" :config="configFroala" v-model="dadosDB.corpo"></froala>
                </v-card-text>
            </v-card>

            <v-autocomplete
                    label="Tags"
                    required
                    v-bind:items="tags"
                    v-model="dadosDB.list_tags"
                    multiple
                    chips
                    deletable-chips
                    tags
                    hint="Você pode indicar mais de uma tag"
                    persistent-hint
                    no-data-text="Nenhum histórico encontrado"
                    ref="tags"
                    @keyup.enter.stop=""
            >
            </v-autocomplete>

            <v-autocomplete
                    label="Categorias"
                    required
                    v-bind:items="categorias"
                    v-model="dadosDB.list_categorias"
                    multiple
                    chips
                    deletable-chips
                    tags
                    hint="Você pode indicar mais de uma categoria"
                    persistent-hint
                    no-data-text="Nenhum histórico encontrado"
                    ref="categorias"
                    @keyup.enter.stop=""
            >
            </v-autocomplete>

            <v-text-field
                    v-model="dadosDB.created_at"
                    label="Data de criação"
                    persistent-hint
                    prepend-icon="event"
                    hint="Mantenha formato yyyy-mm-dd hh:mm:ss"
            ></v-text-field>


            <v-container fluid>
                <v-layout row wrap>
                    <v-flex xs12 sm4 md4>
                        <v-checkbox green
                                    label="Ativo"
                                    v-model="dadosDB.ativo"   ></v-checkbox>
                    </v-flex>
                </v-layout>
            </v-container>

        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn class="blue--text darken-1" @click="voltaView(true)"><v-icon left>mdi-close</v-icon>Fechar</v-btn>
            <v-btn
                                    color="primary darken-2"
                                    :loading="loading"
                                    @click="callPost()"
                                    :disabled="loading"
                            >
                                <v-icon left>mdi-check</v-icon>
                            Salvar
                            </v-btn>
        </v-card-actions>
    </v-card>
    </v-form>
</template>

<script>
    import bus from '../../../modules/events/bus';
    import Dropzone from 'vue2-dropzone';
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        name: 'aton-admin-artigos-add',
        data() {
            return {

                loading: false,

                menu_created_at: null,

                dadosDB: {
                    titulo: '',
                    apresentacao: '',
                    corpo: '',
                    tags: [],
                    categorias: [],
                    ativo: true,
                    exibe_site: true,
                    arquivosLocal: [],
                    url_video: '',
                    created_at: '',
                },

                tags: [],
                categorias: [],


                configFroala: {
                },

                dropzoneOptions:{
                    url:"/api/i/upload/dir/artigos",

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

                    duplicateCheck:true,
                    maxFiles:5,
                    maxFileSizeInMB:50,
                    thumbnailHeight:200,
                    thumbnailWidth:300,

                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
            }
        },
        mounted() {
            this.loadTags();
            this.loadCategorias();

            if (this.isEdit){
                this.loadItemEdit();
            }else{
                this.$refs.form.reset();

                this.$nextTick(function () {
                    this.dadosDB.ativo = false;
                    this.dadosDB.created_at = moment(new Date()).format("DD/MM/YYYY HH:mm");
                })

            }


            // >>> muito importante para validação de csrf token do dropzone
            $('[name=_token').val(this.$http.defaults.headers.common['X-CSRF-TOKEN']);

        },
        components: {
            Dropzone,
        },

        computed: {
            temMidia: function(){
                var _tem = false;

                for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                    _tem = _tem || !this.dadosDB.arquivosLocal[i].excluir;
                }

                _tem = ((_tem) || (this.dadosDB.url_video));

//                console.log(_tem);

                return (_tem)? true: false;
            },
        },

        methods: {
            saveCreatedAt(date) {
                this.$refs.menu_created_at.save(date)
            },
            loadFile: function () {
                var self = this;

//                console.log('entrou no loadfile');
//                console.log(self.dadosDB.arquivosLocal);

                for (var i = 0, len = self.dadosDB.arquivosLocal.length; i < len; i++) {
                    var mockFile = {
                        link: self.dadosDB.arquivosLocal[i].link,
                        mime: self.dadosDB.arquivosLocal[i].mime,
                        filename: self.dadosDB.arquivosLocal[i].filename,
                        size: self.dadosDB.arquivosLocal[i].size,
                        isMock: true,
                        original: true,
                        excluir : false,
                    };

//                    console.log(self.dadosDB.arquivosLocal[i]);

                    mockFile.isMock = true;

                    // Tell eveyone this file was accepted.
                    mockFile.status = 'success';
                    mockFile.accepted = true;


                    var options = {
                        dontSubstractMaxFiles: true,
                        addToFiles: true,
                    };

                    self.$refs.dropzone.manuallyAddFile(mockFile, self.dadosDB.arquivosLocal[i].link_externo, null, true, options);
                    self.$refs.dropzone.setOption('resizeMethod', 'contain');
                }


            },
            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/artigo/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;

                        self.dadosDB.arquivosLocal = self.dadosDB.arquivos;

                        for (var i = 0, len = self.dadosDB.arquivosLocal.length; i < len; i++) {
                            self.dadosDB.arquivosLocal[i].isMock = true;
                            self.dadosDB.arquivosLocal[i].original = true;
                            self.dadosDB.arquivosLocal[i].excluir = false;
                        }

                        // self.dadosDB.created_at = formatDate(self.dadosDB.created_at);

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        self.loadFile();

                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },
            arquivoAdicionado: function (arquivo, response) {
                var tmpArquivo = {};

                tmpArquivo.link = response.arquivo;
                tmpArquivo.mime = response.mime;
                tmpArquivo.filename = response.filename;
                tmpArquivo.size = response.size;
                tmpArquivo.isMock= false;
                tmpArquivo.original= false;
                tmpArquivo.excluir = false;

                this.dadosDB.arquivosLocal.push(tmpArquivo);

            },
            arquivoExcluido: function (file) {
                let nomeArquivo = file.filename;

//                console.log(file);

                if (file.isMock) { // se não é o arquivo original prepara para excluir
                    for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                        if (this.dadosDB.arquivosLocal[i].filename == nomeArquivo){
                            this.dadosDB.arquivosLocal[i].excluir = true;
                            this.$refs.dropzone.maxFiles = 5;
                            break;
                        }
                    }
                } else {
                    if (file.status != 'error') { // se não deu erro ao inserir
                        let retorno = JSON.parse(file.xhr.responseText);

                        for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                            if (this.dadosDB.arquivosLocal[i].filename == nomeArquivo){
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
                    if (( excluirOriginal && this.dadosDB.arquivosLocal[i].original && this.dadosDB.arquivosLocal[i].excluir )||
                        ( !this.dadosDB.arquivosLocal[i].original && this.dadosDB.arquivosLocal[i].excluir ) ||
                        ( excluirNovos && !this.dadosDB.arquivosLocal[i].original )
                    ){
                        tmpExclusao.push(this.dadosDB.arquivosLocal[i].link);
                    }
                }

                if (tmpExclusao.length <= 0) return false;

                let self = this;
                this.loading = true;
                this.$http.post('/api/i/upload/destroy', tmpExclusao)
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
                this.$http.get('/admin/artigo/tags/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.tags = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },

            loadCategorias: function () {
                let self = this;
                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/admin/artigo/categorias/listar')

                    .then(response => {
                        self.loading_extras = false;
                        self.categorias = response.data;
                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading_extras = false;
                        self.errors = error.response.data;
                        bus.$emit('atonprogress:off');
                    });
            },


            voltaView: function (excluirPendentes) {

                if (excluirPendentes) {
                    this.callDeleteFiles(false, true);
                }


                this.$router.push({path: '/admin/artigos'});
            },

            callPost: function () {
                if (this.loading) return false;

                if (this.isAdd && !this.temMidia) {
                    bus.$emit('atonmsg', 'error', 'Falta enviar o arquivo ou completar o upload!');
                    return false;
                }

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/artigo';

                if (this.isEdit) {
                    _url = '/admin/artigo/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;


                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados
                        bus.$emit('atonmsg', 'success', msg);


                        self.callDeleteFiles(true, false);

                        self.voltaView();
                        bus.$emit('artigo:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.errors = error.response.data;
                    });
            }
        }
    }
</script>

<style>
    a[href="https://www.froala.com/wysiwyg-editor?k=u"] {
        display: none !important;
        position: absolute;
        top: -99999999px;
    }

</style>