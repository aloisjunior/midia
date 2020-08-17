<template>
    <material-card

            :title="getTitulo('Arquivo')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >

    <v-form v-model="formCtrl" ref="form" lazy-validation>


        <div class="div-progress"><v-progress-linear v-show="loading || loading_extras" height="3" color="success" :indeterminate="true"></v-progress-linear></div>

        <v-card-text>
            <div class="body-1 text--lighten-1">Selecione seu arquivo</div>
            <dropzone id="myVueDropzone"  ref="dropzone"
                      :options="dropzoneOptions"
                      @vdropzone-success="arquivoAdicionado"
                      @vdropzone-removed-file="arquivoExcluido"
            >
                <input name="_token" type="hidden" ref="token">
            </dropzone>

            <v-text-field v-model="dadosDB.nome" label="Nome" required
                          ref="nome"
                          :error-messages="errors.nome"
                          :rules="rules.required"
                          autofocus
            ></v-text-field>
            <v-text-field v-model="dadosDB.descricao" label="Descrição" required
                          ref="descricao"
                          :error-messages="errors.descricao"
                          :rules="rules.required"
            ></v-text-field>


            <v-layout row >
                <v-combobox
                        label="Tags"
                        required
                        v-bind:items="tags"
                        v-model="dadosDB.list_tags"
                        multiple
                        chips
                        deletable-chips
                        hint="Você pode indicar mais de uma tag"
                        persistent-hint
                        no-data-text="Nenhum histórico encontrado"
                        ref="tags"
                        tags
                        @keyup.enter.stop=""
                        :rules="rules.required"
                >
                </v-combobox>
            </v-layout>


            <v-container fluid>
                <v-layout row wrap>
                    <v-flex xs12 sm4 md4>
                        <v-checkbox green
                                    label="Exibe site?"
                                    v-model="dadosDB.exibe_site"   ></v-checkbox>

                        <v-checkbox green
                                    label="Ativo"
                                    v-model="dadosDB.ativo"   ></v-checkbox>
                    </v-flex>
                </v-layout>
            </v-container>

        </v-card-text>


    </v-form>
        <template slot="actions">
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
        </template>
    </material-card>

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
        name: 'aton-admin-arquivos-add-edit',
        data() {
            return {


                arquivosEnviados: false,

                dadosDB: {
                    nome: '',
                    descricao: '',
                    tags: [],
                    ativo: true,
                    exibe_site: true,
                    arquivo: '',
                    filename: '',
                    mime: '',
                    size: 0,
                    link: '',
                    arquivosLocal: [],

                },

                arquivosExcluir: [],
                arquivoOriginal: '',

                tags: [],

                dropzoneOptions:{
                    url:"/api/i/upload/dir/arquivos",

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
                    maxFiles:1,
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
            if (this.isEdit){
                this.loadItemEdit();
            }else{
                this.$refs.form.reset();
                this.dadosDB.ativo = true;
                this.dadosDB.exibe_site = true;
            }

            this.loadTags();

            // >>> muito importante para validação de csrf token do dropzone
            $('[name=_token').val(this.$http.defaults.headers.common['X-CSRF-TOKEN']);
        },
        components: {
            Dropzone,
        },
        methods: {
            loadFile: function () {
                var self = this;

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

                    mockFile.isMock = true;

                    // Tell eveyone this file was accepted.
                    mockFile.status = 'success';
                    mockFile.accepted = true;


                    var options = {
                        dontSubstractMaxFiles: true,
                        addToFiles: true,
                    };

//                    self.$refs.dropzone.manuallyAddFile(mockFile, self.dadosDB.arquivosLocal[i].link_externo, null, true, options);
                    self.$refs.dropzone.manuallyAddFile(mockFile, '/api/e/imagem/arquivos/'+self.dadosDB.arquivosLocal[i].filename+'/350', null, true, options);

                }
                self.$refs.dropzone.setOption('resizeMethod', 'contain');
            },
            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/arquivo/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;

                        self.dadosDB.arquivosLocal = [{
                            filename: self.dadosDB.filename,
                            mime: self.dadosDB.mime,
                            size: self.dadosDB.size,
                            link: self.dadosDB.link,
                        }];

                        for (var i = 0, len = self.dadosDB.arquivosLocal.length; i < len; i++) {
                            self.dadosDB.arquivosLocal[i].isMock = true;
                            self.dadosDB.arquivosLocal[i].original = true;
                            self.dadosDB.arquivosLocal[i].excluir = false;
                        }

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

                this.dadosDB.filename = tmpArquivo.filename;
                this.dadosDB.mime = tmpArquivo.mime;
                this.dadosDB.size = tmpArquivo.size;
                this.dadosDB.link = tmpArquivo.link;
                this.dadosDB.arquivo = tmpArquivo.link;

                this.dadosDB.arquivosLocal.push(tmpArquivo);
            },
            arquivoExcluido: function (file) {
             let nomeArquivo = file.filename;

                if (file.isMock) { // se não é o arquivo original prepara para excluir
                    for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                        if (this.dadosDB.arquivosLocal[i].filename == nomeArquivo){
                            this.dadosDB.arquivosLocal[i].excluir = true;
                            this.$refs.dropzone.maxFiles = 1;
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
                this.$http.get('/admin/arquivo/tags/listar')

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

            voltaView: function (excluirPendentes) {
                if (excluirPendentes) {
                    this.callDeleteFiles(false, true);
                }

                this.$router.push({path: '/admin/arquivos'});

            },

            callPost: function () {
                if (this.loading) return false;

//                if (!this.arquivosEnviados) {
//                    bus.$emit('atonmsg', 'error', 'Falta enviar o arquivo ou completar o upload!');
//                    return false;
//                }

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/arquivo';

                if (this.isEdit) {
                    _url = '/admin/arquivo/' + self.dadosDB.id + '/update';
                }


                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados
                        bus.$emit('atonmsg', 'success', msg);

                        self.callDeleteFiles(true, false);
                        self.voltaView();
                        bus.$emit('arquivo:updated');
                    })
                    .catch(error => {
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });

            }
        }
    }
</script>

<style scoped>
    .vue-dropzone .dz-preview .dz-image {
        width: 300px;
        height: 200px;
        position: relative;
        overflow: hidden;
    }


    .dropzone .dz-preview .dz-image img {
        /* width: 100%; */
        /* height: 100%; */
        /* left: -50px; */
        position: absolute;
        left: 50%;
        top: 50%;
        height: 100%;
        width: auto;
        -webkit-transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
    }

</style>