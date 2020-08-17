<template>


    <v-card>
        <v-toolbar dark color="secondary" class=" white--text">
            <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Criação de templates de conteúdo</div>
        </v-toolbar>


        <v-card-text>
            <v-toolbar>
                <v-toolbar-title class="font-weight-light white--text">{{ getTitulo('Incluir conteúdos')}}</v-toolbar-title>
                <v-tooltip content-class="top" top  >
                    <v-btn
                            color="primary"
                            dark
                            small
                            flat
                            fab
                            slot="activator"
                            @click="addTitleGridItem">
                        <v-icon dark>title</v-icon>
                    </v-btn>
                    <span>Incluir Titulo</span>
                </v-tooltip>
                <v-tooltip content-class="top" top  >
                    <v-btn
                            color="primary"
                            dark
                            small
                            flat
                            fab
                            slot="activator"
                            @click="addContentGridItem">
                        <v-icon dark>receipt</v-icon>
                    </v-btn>
                    <span>Incluir Área de Texto</span>
                </v-tooltip>
                <v-tooltip content-class="top" top  >
                    <v-btn
                            color="primary"
                            dark
                            small
                            flat
                            fab
                            slot="activator"
                            @click="addImageGridItem">
                        <v-icon dark>image</v-icon>
                    </v-btn>
                    <span>Imagem</span>
                </v-tooltip>
                <v-tooltip content-class="top" top  >
                    <v-btn
                            color="primary"
                            dark
                            small
                            flat
                            fab
                            slot="activator"
                            @click="addImageBackground">
                        <v-icon dark>image</v-icon>
                    </v-btn>
                    <span>Usar arte atual como novo fundo</span>
                </v-tooltip>
                <span class="pt-3">
                <v-switch
                        :label="`Preview`"
                        v-model="preview"
                        @click="disableGrid"
                ></v-switch>
                </span>

                <v-spacer></v-spacer>
                <v-btn class="blue--text darken-1" @click="voltaView()">Reiniciar</v-btn>
                <v-btn
                        color="primary"
                        :loading="loading"
                        @click="callPost()"
                        :disabled="loading"
                >
                    Incluir como conteúdo

                </v-btn>
            </v-toolbar>
            <v-card-text>

                <v-card id="printMe" ref="printMe" :style="{'background-image':'url(' + imageFundo + ')' ,'background-size': 'contain'}" height="540px" width="960" max-width="960">
                    <grid-layout :layout="getResources"
                                 :is-draggable="isDraggable"
                                 :is-resizable="isResizable"
                                 :col-num="1920"
                                 :max-rows="540"
                                 :row-height="1"
                                 :vertical-compact="false"
                                 :margin="[0, 0]"
                                 :use-css-transforms="true"
                    >
                        <grid-item v-for="(item, index) in getResources" :key="index" :class="{ 'editMode' : !preview }"
                                   :autoSize="true" :x="item.x" :y="item.y" :w="item.w" :h="item.h" :i="item.i">

                            <v-btn v-if="!preview" style="position: absolute; bottom: 0px; left: 0px;" flat dark icon small @click="removeItem({key: index})" >
                                <v-icon dark>delete_forever</v-icon>
                            </v-btn>

                            <text-widget v-if="item.type == 'title'" :preview="preview"
                                         :contenteditable="contenteditable" :item="item"
                                         :itemIndex="index"></text-widget>

                            <text-area-widget v-if="item.type == 'content'" :preview="preview"
                                              :contenteditable="contenteditable" :item="item"
                                              :itemIndex="index"></text-area-widget>

                            <image-widget v-if="item.type == 'image'" :preview="preview"
                                          :contenteditable="contenteditable" :item="item"
                                          :itemIndex="index"></image-widget>
                        </grid-item>
                    </grid-layout>
                </v-card>

            </v-card-text>
        </v-card-text>
    </v-card>

</template>

<script>
    import bus from '../../../modules/events/bus';


    import {mapGetters, mapActions} from 'vuex'
    import TextWidget from '../../components/grid-layout/components/editor/TextWidget'
    import TextAreaWidget from '../../components/grid-layout/components/editor/TextAreaWidget'
    import ImageWidget from '../../components/grid-layout/components/editor/ImageWidget'
    import {GridLayout, GridItem} from 'vue-grid-layout'

    // import GridView from '../../components/grid-layout/components/editor/GridView';


    export default {
        name: 'aton-admin-midia-editor-view',
        data() {
            return {


                loading: false,

                itemSelected: null,

                drawerRight: true,

                layout: [
                    {"x": 0, "y": 0, "w": 1920, "h": 50, "i": "0"},
                    {"x": 0, "y": 50, "w": 1920, "h": 490, "i": "1"},
                ],
                items: [
                    {title: 'Dashboard', icon: 'dashboard'},
                    {title: 'Account', icon: 'account_box'},
                    {title: 'Admin', icon: 'gavel'}
                ],


                isDraggable: true,
                isResizable: true,
                preview: false,
                contenteditable: true,
                imageFundo: '/img/atonmidia/midiaindoor1.jpg',
            }
        },
        mounted() {


        },
        created() {
            this.fetchResources();
        },
        computed: {
            ...mapGetters([
                'getResources'
            ]),

        },
        methods: {
            ...mapActions([
                'addTitleGridItem',
                'addContentGridItem',
                'addImageGridItem',
                'removeItem',
                'fetchResources',
            ]),
            addImageBackground: async function(){
                const el = document.getElementById('printMe');
                // add option type to get the image version
                // if not provided the promise will return
                // the canvas.
                const options = {
                    type: 'dataURL'
                };

                let self = this;

                // this.$html2canvas(el).then(function (canvas) {
                //     var base64encodedstring = canvas.toDataURL("image/jpeg", 1);
                //     self.imageFundo = base64encodedstring;
                // });


                // console.log(await this.$html2canvas(el, options));
                this.imageFundo = await this.$html2canvas(el, options);
            },

            disableGrid() {
                this.isDraggable = !this.isDraggable;
                this.isResizable = !this.isResizable;
                // this.preview = !this.preview;
                this.contenteditable = !this.contenteditable;
            },
            loadDados: function () {
                if (this.loading) return false;
                let self = this;
                this.loading = true;
                this.$http.post('/admin/playlist/listar', this.pesquisa)
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
        },
        components: {GridLayout, GridItem, TextWidget, TextAreaWidget, ImageWidget},

        watch: {},
    }
</script>

<style >
    .aton_imagem {
        background-image: url("/img/atonmidia/midiaindoor1.jpg");
        background-size: contain;
    }

    #content {
        width: 100%;
    }

    .vue-grid-layout {
        /*background: #eee;*/
    }

    .layoutJSON {
        background: #ddd;
        border: 1px solid black;
        margin-top: 10px;
        padding: 10px;
    }

    .eventsJSON {
        background: #ddd;
        border: 1px solid black;
        margin-top: 10px;
        padding: 10px;
        height: 100px;
        overflow-y: scroll;
    }

    .columns {
        -moz-columns: 120px;
        -webkit-columns: 120px;
        columns: 120px;
    }

    .vue-resizable-handle {
        z-index: 5000;
        position: absolute;
        width: 20px;
        height: 20px;
        bottom: 0;
        right: 0;
        background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pg08IS0tIEdlbmVyYXRvcjogQWRvYmUgRmlyZXdvcmtzIENTNiwgRXhwb3J0IFNWRyBFeHRlbnNpb24gYnkgQWFyb24gQmVhbGwgKGh0dHA6Ly9maXJld29ya3MuYWJlYWxsLmNvbSkgLiBWZXJzaW9uOiAwLjYuMSAgLS0+DTwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DTxzdmcgaWQ9IlVudGl0bGVkLVBhZ2UlMjAxIiB2aWV3Qm94PSIwIDAgNiA2IiBzdHlsZT0iYmFja2dyb3VuZC1jb2xvcjojZmZmZmZmMDAiIHZlcnNpb249IjEuMSINCXhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiDQl4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjZweCIgaGVpZ2h0PSI2cHgiDT4NCTxnIG9wYWNpdHk9IjAuMzAyIj4NCQk8cGF0aCBkPSJNIDYgNiBMIDAgNiBMIDAgNC4yIEwgNCA0LjIgTCA0LjIgNC4yIEwgNC4yIDAgTCA2IDAgTCA2IDYgTCA2IDYgWiIgZmlsbD0iIzAwMDAwMCIvPg0JPC9nPg08L3N2Zz4=');
        /*background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij4KICAgIDxwYXRoIGQ9Ik0xNi41OSA4LjU5TDEyIDEzLjE3IDcuNDEgOC41OSA2IDEwbDYgNiA2LTZ6Ii8+CiAgICA8cGF0aCBkPSJNMCAwaDI0djI0SDB6IiBmaWxsPSJub25lIi8+Cjwvc3ZnPgo=');*/
        background-position: bottom right;
        padding: 0 3px 3px 0;
        background-repeat: no-repeat;
        background-origin: content-box;
        box-sizing: border-box;
        cursor: se-resize;
    }

    .vue-grid-item:not(.editMode) {
        background-color: rgba(0, 0, 0, 0);
        /*border: 1px solid black;*/
    }

    .vue-grid-item.resizing {
        opacity: 0.9;
    }

    .vue-grid-item.static {
        /*background-color:rgba(0, 0, 0, 0.2);*/
    }

    .vue-grid-item .text {
        font-size: 24px;
        text-align: center;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        height: 100%;
        width: 100%;
    }

    .vue-grid-item .no-drag {
        height: 100%;
        width: 100%;
    }

    .vue-grid-item .minMax {
        font-size: 12px;
    }

    .vue-grid-item .add {
        cursor: pointer;
    }

    .vue-draggable-handle {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 0;
        left: 0;
        /*background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>") no-repeat;*/
        background-position: bottom right;
        padding: 0 8px 8px 0;
        background-repeat: no-repeat;
        background-origin: content-box;
        box-sizing: border-box;
        cursor: pointer;
    }

    .editMode {
        background-color: rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .site-title {
        /*font-family: 'Lilita One', cursive;*/
        font-size: 50px;
        color: #F48FB1;
        text-align: center;
    }

    .heading1 {
        /*font-family: 'Crushed', cursive;*/
        font-size: 35px;
        border: none;
        color: #2196F3;
    }

    .heading2 {
        /*font-family: 'Patrick Hand', cursive;*/
        font-size: 20px;
        border: none;
        color: #3096f3;
        background-color: #FFF9C4;
        width: 100%;
        padding: 10px 5px;
    }

    .heading3 {
        /*font-family: 'Homemade Apple', cursive;*/
        font-size: 20px;
        border: none;
        color: #66d2b3;
        padding: 0 7px;
    }

    .content {
        /*font-family: 'Patrick Hand', cursive;*/
        font-size: 20px;
        color: #2196F3;
    }
</style>

