<template>

    <material-card
            :title="getTitulo('Cliente')"
            @keyup.enter.prevent="callPost()"
            @keyup.esc.prevent="voltaView()"
    >


        <div class="div-progress">
            <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                               :indeterminate="true"></v-progress-linear>
        </div>


        <v-form v-model="formCtrl" ref="form" lazy-validation>
            <v-layout row wrap align-end>
                <v-flex xs12 md6>
                    <v-text-field class="px-1" v-model="dadosDB.nome"
                                  :label="dadosDB.tipo_pessoa=='PJ' ? 'Nome Fantasia' : 'Nome'" required
                                  ref="nome"
                                  :error-messages="errors.nome"
                                  :error="inError"
                                  autofocus
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-autocomplete class="px-1"
                                    label="Tipo de Pessoa"
                                    required
                                    v-bind:items="tipo_pessoa"
                                    v-model="dadosDB.tipo_pessoa"
                                    @keyup.enter.stop=""
                    >
                    </v-autocomplete>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.cnpj_cpf" label="CNPJ/CPF"
                                  ref="cnpj_cpf"
                                  :error-messages="errors.cnpj_cpf"
                                  :error="inError"
                                  :mask="getMask"
                                  :append-icon="this.dadosDB.tipo_pessoa=='PJ' ? 'find_replace' : ''"
                                  @click:append="(val) => this.loadCNPJ(val)"
                                  :loading="loading_cnpj"
                    >
                        <v-progress-linear v-show="loading_cnpj" slot="progress" :indeterminate="true" height="3"
                                           color="success"></v-progress-linear>
                    </v-text-field>
                </v-flex>
            </v-layout>

            <v-layout row wrap>
                <v-flex xs12 md6>
                    <v-text-field class="px-1" v-model="dadosDB.razao_social" label="Razão Social"
                                  ref="razao_social"
                                  :error-messages="errors.razao_social"
                                  :error="inError"
                                  v-show="dadosDB.tipo_pessoa=='PJ'"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.inscricao_estadual" label="Inscrição Estadual"
                                  ref="inscricao_estadual"
                                  :error-messages="errors.inscricao_estadual"
                                  :error="inError"
                                  v-show="dadosDB.tipo_pessoa=='PJ'"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.inscricao_municipal" label="Inscrição Municipal"
                                  ref="inscricao_municipal"
                                  :error-messages="errors.inscricao_municipal"
                                  :error="inError"
                                  v-show="dadosDB.tipo_pessoa=='PJ'"
                    ></v-text-field>
                </v-flex>
            </v-layout>


            <v-layout row wrap>
                <v-flex xs12 md6>
                    <v-text-field class="px-1" v-model="dadosDB.email" label="Email"
                                  ref="email"
                                  :error-messages="errors.email"
                                  :error="inError"
                                  hint="Email usado para cobrança e notificações, para mais de um separe por ;"
                                  persistent-hint
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.contato" label="Contato"
                                  ref="contato"
                                  :error-messages="errors.contato"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.telefone" label="Telefone"
                                  ref="telefone"
                                  :error-messages="errors.telefone"
                                  :error="inError"
                                  :mask="'(##)#####-####'"
                    ></v-text-field>
                </v-flex>

            </v-layout>


            <v-layout row wrap>
                <v-flex xs12 md2>
                    <v-text-field class="px-1" v-model="dadosDB.cep" label="Cep"
                                  ref="cep"
                                  :error-messages="errors.cep"
                                  :error="inError"
                                  :mask="'#####-###'"
                                  return-masked-value
                                  :append-icon="'find_replace'"
                                  @click:append="(val) => this.loadCEP(val)"
                                  :loading="loading_cep"
                    >
                        <v-progress-linear v-show="loading_cep" slot="progress" :indeterminate="true" height="3"
                                           color="success"></v-progress-linear>

                    </v-text-field>
                </v-flex>


                <v-flex xs12 md5>
                    <v-text-field class="px-1" v-model="dadosDB.endereco" label="Endereco"
                                  ref="endereco"
                                  :error-messages="errors.endereco"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md2>
                    <v-text-field class="px-1" v-model="dadosDB.numero" label="Número"
                                  ref="numero"
                                  :error-messages="errors.numero"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.complemento" label="Complemento"
                                  ref="complemento"
                                  :error-messages="errors.complemento"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>

            </v-layout>

            <v-layout row wrap>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.cidade" label="Cidade"
                                  ref="cidade"
                                  :error-messages="errors.cidade"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.bairro" label="Bairro"
                                  ref="bairro"
                                  :error-messages="errors.bairro"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 md3>
                    <v-autocomplete class="px-1"
                                    label="Estado"
                                    required
                                    v-bind:items="estados"
                                    itemValue="value"
                                    itemText="text"
                                    v-model="dadosDB.estado"
                                    @keyup.enter.stop=""
                    >
                    </v-autocomplete>
                </v-flex>
                <v-flex xs12 md3>
                    <v-text-field class="px-1" v-model="dadosDB.pais" label="País"
                                  ref="pais"
                                  :error-messages="errors.pais"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>

            </v-layout>

            <v-layout row wrap>
                <v-flex xs12 md12>
                    <v-text-field class="px-1" v-model="dadosDB.url_perfil" label="Link do perfil"
                                  ref="url_perfil"
                                  :error-messages="errors.url_perfil"
                                  :error="inError"
                    ></v-text-field>
                </v-flex>
            </v-layout>

            <v-layout row wrap>
                <v-flex xs12 md12>
                    <v-textarea class="px-1"
                                v-model="dadosDB.observacao" label="Observacao"
                                ref="observacao"
                                :error-messages="errors.observacao"
                                :error="inError"
                                outline
                    ></v-textarea>
                </v-flex>
            </v-layout>


            <v-layout row>
                <v-combobox
                        class="px-1"
                        label="Tags"
                        required
                        :items="tags"
                        v-model="dadosDB.list_tags"
                        chips
                        tags
                        multiple
                        deletable-chips
                        :loading="loading_extras"
                        color="primary"
                        hint="Você pode indicar mais de uma tag"
                        persistent-hint
                        no-data-text="Nenhum histórico encontrado"
                        ref="tags"
                        @keyup.enter.stop=""
                >
                </v-combobox>

            </v-layout>


        </v-form>

        <v-card-text>
        <v-expansion-panel popout class="elevation-1">
            <v-expansion-panel-content>
                <div slot="header">Depoimento</div>

                <v-card-text>
                    <v-container fluid grid-list-md>
                        <v-layout row wrap>
                            <v-flex xs12 md12>
                                <v-textarea v-model="dadosDB.depoimento_texto" label="Depoimento"
                                            ref="depoimento_texto"
                                            :error-messages="errors.depoimento_texto"
                                            :error="inError"
                                            outline
                                ></v-textarea>
                            </v-flex>

                            <v-flex xs12 md3>
                                <v-text-field class="px-1" v-model="dadosDB.depoimento_autor" label="Autor"
                                              ref="depoimento_autor"
                                              :error-messages="errors.depoimento_autor"
                                              :error="inError"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 md3>
                                <v-text-field class="px-1" v-model="dadosDB.depoimento_cargo" label="Cargo"
                                              ref="depoimento_cargo"
                                              :error-messages="errors.depoimento_cargo"
                                              :error="inError"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>


            </v-expansion-panel-content>
            <v-expansion-panel-content>
                <div slot="header">Logo</div>
                <v-card flat>
                    <v-card-text>
                        <div class="body-1 text--lighten-1">Selecione seu arquivo</div>
                        <dropzone id="myVueDropzone" ref="dropzone"
                                  :options="dropzoneOptions"
                                  @vdropzone-success="arquivoAdicionado"
                                  @vdropzone-removed-file="arquivoExcluido"
                        >
                            <input name="_token" type="hidden" ref="token">
                        </dropzone>


                    </v-card-text>
                </v-card>

            </v-expansion-panel-content>
        </v-expansion-panel>
        </v-card-text>

        <template slot="actions">
            <v-layout row wrap d-flex>

                <v-flex sm12 md2>
                    <v-checkbox
                            hide-details
                            class="mt-1"
                            height="20px"
                            label="Receber Mailing?"
                            v-model="dadosDB.receber_mailing"
                    ></v-checkbox>
                </v-flex>
                <v-flex sm12 md2>
                    <v-checkbox
                            class="mt-1"
                            height="20px"
                            label="Ativo"
                            v-model="dadosDB.ativo"
                    ></v-checkbox>
                </v-flex>


                <v-flex sm12 lg8 md8>
                    <v-layout align-start justify-end row fill-height>
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
                    </v-layout>
                </v-flex>

            </v-layout>
        </template>
    </material-card>

</template>

<script>
    import bus from '../../../modules/events/bus';
    import Dropzone from 'vue2-dropzone';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [atonBaseFormEdit],
        name: 'aton-admin-clientes-add-edit',
        data() {
            return {

                loading_cnpj: false,
                loading_cep: false,

                dadosDB: {
                    tipo_pessoa: 'PJ',
                    nome: '',
                    razao_social: '',
                    cnpj_cpf: '',
                    inscricao_estadual: '',
                    inscricao_municipal: '',
                    email: '',
                    contato: '',
                    telefone: '',
                    endereco: '',
                    complemento: '',
                    numero: '',
                    bairro: '',
                    cidade: '',
                    cep: '',
                    estado: '',
                    tags: [],
                    observacao: '',
                    ativo: true,
                    receber_mailing: true,
                    arquivosLocal: [],
                },

                tipo_pessoa: [
                    {value: 'PJ', text: 'Pessoa Jurídica'},
                    {value: 'PF', text: 'Pessoa Física'},
                ],

                estados: [
                    {value: 'AC', text: 'Acre'},
                    {value: 'AL', text: 'Alagoas'},
                    {value: 'AP', text: 'Amapá'},
                    {value: 'AM', text: 'Amazonas'},
                    {value: 'BA', text: 'Bahia'},
                    {value: 'CE', text: 'Ceará'},
                    {value: 'DF', text: 'Distrito Federal'},
                    {value: 'ES', text: 'Espírito Santo'},
                    {value: 'GO', text: 'Goiás'},
                    {value: 'MA', text: 'Maranhão'},
                    {value: 'MT', text: 'Mato Grosso'},
                    {value: 'MS', text: 'Mato Grosso do Sul'},
                    {value: 'MG', text: 'Minas Gerais'},
                    {value: 'PA', text: 'Pará'},
                    {value: 'PB', text: 'Paraíba'},
                    {value: 'PR', text: 'Paraná'},
                    {value: 'PE', text: 'Pernambuco'},
                    {value: 'PI', text: 'Piauí'},
                    {value: 'RJ', text: 'Rio de Janeiro'},
                    {value: 'RN', text: 'Rio Grande do Norte'},
                    {value: 'RS', text: 'Rio Grande do Sul'},
                    {value: 'RO', text: 'Rondônia'},
                    {value: 'RR', text: 'Roraima'},
                    {value: 'SC', text: 'Santa Catarina'},
                    {value: 'SP', text: 'São Paulo'},
                    {value: 'SE', text: 'Sergipe'},
                    {value: 'TO', text: 'Tocantins'},
                ],

                arquivosExcluir: [],

                tags: [],

                dropzoneOptions: {
                    url: "/api/i/upload/dir/clientes",

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

                    duplicateCheck: true,
                    maxFiles: 1,
                    maxFileSizeInMB: 50,
                    thumbnailHeight: 200,
                    thumbnailWidth: 300,

                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
            }
        },
        mounted() {
            this.loadTags();

            if (this.isEdit) {
                this.loadItemEdit();
            } else {
                this.$refs.form.reset();
                this.dadosDB.tipo_pessoa = 'PJ';
                this.dadosDB.receber_mailing = true;
                this.dadosDB.ativo = true;
            }

            $('[name=_token').val(this.$http.defaults.headers.common['X-CSRF-TOKEN']);
        },
        components: {
            Dropzone,
        },

        computed: {
            temMidia: function () {
                var _tem = false;

                for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                    _tem = _tem || !this.dadosDB.arquivosLocal[i].excluir;
                }

                _tem = ((_tem) || (this.dadosDB.url_video));

                console.log(_tem);

                return (_tem) ? true : false;
            },

            getMask: function () {
                if (this.dadosDB.tipo_pessoa == 'PF') {
                    return '###.###.###-##'
                } else {
                    return '##.###.###/####-##'
                }
            }
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

//                    self.$refs.dropzone.manuallyAddFile(mockFile, self.dadosDB.arquivosLocal[i].link_externo, null, true, options);
                    self.$refs.dropzone.manuallyAddFile(mockFile, '/api/e/imagem/clientes/' + self.dadosDB.arquivosLocal[i].filename + '/350', null, true, options);

                }
                self.$refs.dropzone.setOption('resizeMethod', 'contain');

            },
            loadItemEdit: function () {
                let self = this;
                this.loading = true;
                bus.$emit('atonprogress:on');
                this.$http.get('/admin/cliente/' + self.$route.params.id + '/update')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;

                        self.dadosDB.arquivosLocal = self.dadosDB.arquivos;

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

            callbackCnpj: function (response) {
                let self = this;
                self.loading = false;
                console.log(response.data);

                self.dadosDB.nome = (response.data.fantasia != "") ? response.data.fantasia : response.data.nome;
                self.dadosDB.razao_social = response.data.nome;
                self.dadosDB.email = response.data.email;
                self.dadosDB.cep = response.data.cep;
                self.dadosDB.bairro = response.data.bairro;
                self.dadosDB.cidade = response.data.municipio;
                self.dadosDB.estado = response.data.uf;
                self.dadosDB.telefone = response.data.telefone;
                self.dadosDB.numero = response.data.numero;
                self.dadosDB.endereco = response.data.logradouro;
                self.dadosDB.pais = 'Brasil';

                self.$refs.nome.focus();

                bus.$emit('atonprogress:off');
            },
            loadCNPJ: function () {
                let self = this;
//                bus.$emit('atonprogress:on');

                this.loading_cnpj = true;

                this.$http.options.credentials = true;
                this.$http.get('/api/i/consulta/cnpj/' + this.dadosDB.cnpj_cpf.replace(/\D/g, ""))
                    .then(response => {
                        self.loading_cnpj = false;
//                        console.log(response.data);

                        self.dadosDB.nome = (response.data.fantasia != "") ? response.data.fantasia : response.data.nome;
                        self.dadosDB.razao_social = response.data.nome;
                        self.dadosDB.email = response.data.email;
                        self.dadosDB.cep = response.data.cep;
                        self.dadosDB.bairro = response.data.bairro;
                        self.dadosDB.cidade = response.data.municipio;
                        self.dadosDB.estado = response.data.uf;
                        self.dadosDB.telefone = response.data.telefone;
                        self.dadosDB.numero = response.data.numero;
                        self.dadosDB.endereco = response.data.logradouro;
                        self.dadosDB.pais = 'Brasil';

                        self.$refs.nome.focus();

//                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
//                        bus.$emit('atonprogress:off');
                        self.loading_cnpj = false;
                        console.log(error.response);
                    });
            },

            loadCEP: function () {
                let self = this;
//                bus.$emit('atonprogress:on');
                this.loading_cep = true;
                this.$http.get('/api/i/consulta/cep/' + this.dadosDB.cep.replace(/\D/g, ""))
                    .then(response => {
                        self.loading_cep = false;
//                        console.log(response.data);

                        self.dadosDB.endereco = response.data.logradouro;
                        self.dadosDB.complemento = response.data.complemento;
                        self.dadosDB.bairro = response.data.bairro;
                        self.dadosDB.cidade = response.data.localidade;
                        self.dadosDB.estado = response.data.uf;
                        self.dadosDB.pais = 'Brasil';

                        self.$refs.numero.focus();
//                        bus.$emit('atonprogress:off');
                    })
                    .catch(error => {
//                        bus.$emit('atonprogress:off');
                        self.loading_cep = false;
                        console.log(error.response);
                    });
            },


            arquivoAdicionado: function (arquivo, response) {
                var tmpArquivo = {};

                tmpArquivo.link = response.arquivo;
                tmpArquivo.mime = response.mime;
                tmpArquivo.filename = response.filename;
                tmpArquivo.size = response.size;
                tmpArquivo.isMock = false;
                tmpArquivo.original = false;
                tmpArquivo.excluir = false;

                this.dadosDB.arquivosLocal.push(tmpArquivo);

            },
            arquivoExcluido: function (file) {
                let nomeArquivo = file.filename;

                if (file.isMock) { // se não é o arquivo original prepara para excluir
                    for (var i = 0, len = this.dadosDB.arquivosLocal.length; i < len; i++) {
                        if (this.dadosDB.arquivosLocal[i].filename == nomeArquivo) {
                            this.dadosDB.arquivosLocal[i].excluir = true;
                            this.$refs.dropzone.maxFiles = 1;
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
                        (excluirNovos && !this.dadosDB.arquivosLocal[i].original)
                    ) {
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
//                bus.$emit('atonprogress:on');
                self.loading_extras = true;
                this.$http.get('/admin/cliente/tags/listar')

                    .then(response => {
                        self.loading_extras = false;
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

            voltaView: function (excluirPendentes) {
                if (excluirPendentes) {
                    this.callDeleteFiles(false, true);
                }

//                this.$router.push({name: 'clientes'});

                this.$router.push({path: '/admin/clientes'});

            },

            callPost: function () {
                if (this.loading) return false;

//                if (this.isAdd && !this.temMidia) {
//                    bus.$emit('atonmsg', 'error', 'Falta enviar o arquivo ou completar o upload!');
//                    return false;
//                }

                let self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/cliente';

                if (this.isEdit) {
                    _url = '/admin/cliente/' + self.dadosDB.id + '/update';
                }

                this.$http.post(_url, self.dadosDB)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('atonmsg', 'success', msg);

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        self.callDeleteFiles(true, false);
                        self.voltaView();

                        bus.$emit('cliente:updated');
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

<style>
</style>