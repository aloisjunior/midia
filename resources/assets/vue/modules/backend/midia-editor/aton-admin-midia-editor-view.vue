<template>


    <material-card

            :title="getTitulo('Criação de templates de conteúdo')"
    >

        <material-card
                color="blue-grey darken-1"
                :dark="!this.isModeDarkForms"
                :light="this.isModeDarkForms"

        >


            <v-container fluid grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 md9>
                        <v-card id="printMe" ref="printMe" :width="getWidth() + 'px'" :height="getHeight() + 'px'">
                            <div id="konva">

                            </div>
                        </v-card>
                    </v-flex>
                    <v-flex xs12 md3>
                        <v-expansion-panel
                                v-model="panels"
                                focusabled

                        >
                            <v-expansion-panel-content
                                    :key="0"
                            >
                                <div slot="header">Fundo</div>
                                <v-card>
                                    <v-card-text>
                                        <v-btn
                                                color="primary"

                                                @click.native="novoFundo()"

                                        >
                                            Novo fundo

                                        </v-btn>
                                    </v-card-text>
                                </v-card>
                            </v-expansion-panel-content>
                            <v-expansion-panel-content
                                    :key="1"
                            >
                                <div slot="header">Orientação</div>
                                <v-card>
                                    <v-card-text>
                                        <v-select
                                                v-model="orientacaoModel"
                                                :items="['Paisagem', 'Retrato', '1x1']"
                                                label="Orientação"
                                                @change="aplicarOrientacao()"
                                        >
                                        </v-select>
                                    </v-card-text>
                                </v-card>
                            </v-expansion-panel-content>

                            <v-expansion-panel-content
                                    :key="2"
                                    v-show="temConfig"
                            >
                                <div slot="header">Propriedades</div>
                                <v-card>
                                    <v-card-text>
                                        <template v-for="(item, index) in itemSelectedConfig">
                                            <v-layout row wrap v-show="exibirProp(index)">
                                                <v-flex md-12>
                                                    <v-autocomplete
                                                            v-if="(index=='fill')"
                                                            v-model="fillModel"
                                                            :items="colorsValue"
                                                            item-text="text"
                                                            item-value="value"
                                                            label="Cor de preenchimento"
                                                            chips
                                                            return-object
                                                            clearable
                                                            @blur="ajustaSelectComp"
                                                            @change="aplicarProps()"
                                                            :background-color="(fillModel)? fillModel.text : undefined"
                                                    >
                                                        <template
                                                                slot="selection"
                                                                slot-scope="{item, parent, selected}">
                                                            <v-chip
                                                                    :selected="selected"
                                                                    @input="item.parent.selectItem(item)">

                                                                {{ item.text}}
                                                            </v-chip>
                                                        </template>
                                                        <template
                                                                slot="item"
                                                                slot-scope="{item, index, tile}">
                                                            <v-list-tile-content>
                                                                <v-chip small>
                                                                    <v-avatar :color="item.text">
                                                                    </v-avatar>
                                                                    {{ item.text}}
                                                                </v-chip>
                                                            </v-list-tile-content>
                                                        </template>
                                                    </v-autocomplete>
                                                    <v-autocomplete
                                                            v-else-if="(index=='stroke')"
                                                            v-model="strokeModel"
                                                            :items="colorsValue"
                                                            item-text="text"
                                                            item-value="value"
                                                            label="Cor da Borda"
                                                            chips
                                                            return-object
                                                            clearable
                                                            @blur="ajustaSelectComp"
                                                            @change="aplicarProps()"
                                                            :background-color="(strokeModel)? strokeModel.text : undefined"
                                                    >
                                                        <template
                                                                slot="selection"
                                                                slot-scope="{item, parent, selected}">
                                                            <v-chip
                                                                    :selected="selected"
                                                                    @input="item.parent.selectItem(item)">

                                                                {{ item.text}}
                                                            </v-chip>
                                                        </template>
                                                        <template
                                                                slot="item"
                                                                slot-scope="{item, index, tile}">
                                                            <v-list-tile-content>
                                                                <v-chip small>
                                                                    <v-avatar :color="item.text">
                                                                    </v-avatar>
                                                                    {{ item.text}}
                                                                </v-chip>
                                                            </v-list-tile-content>
                                                        </template>
                                                    </v-autocomplete>


                                                    <v-slider
                                                            v-else-if="index=='opacity'"
                                                            v-model="opacityModel"
                                                            label="Transparência"
                                                            min="0"
                                                            :max="10"
                                                            thumb-label
                                                            @change="aplicarProps()"
                                                    ></v-slider>

                                                    <v-slider
                                                            v-else-if="((index=='cornerRadius')||(index=='strokeWidth')||(index=='numPoints')||(index=='innerRadius')||(index=='outerRadius'))"
                                                            v-model="itemSelectedConfig[index]"
                                                            :label="(index=='cornerRadius')? 'Arredondar cantos': (index=='strokeWidth') ? 'Espessura da borda' : (index=='numPoints')? 'Pontas': (index=='innerRadius')? 'Raio Interno' : 'Radio Externo'"
                                                            min="0"
                                                            :max="((index=='innerRadius') || (index=='outerRadius')) ? 100 : 50"
                                                            thumb-label
                                                            @change="aplicarProps()"
                                                    ></v-slider>

                                                    <v-switch
                                                            v-else-if="((index=='transparente') || (index=='sombra'))"
                                                            :label="(index=='transparente') ? 'Fundo transparente' : 'Sombra'"
                                                            v-model="itemSelectedConfig[index]"
                                                            @change="aplicarProps()"
                                                    ></v-switch>

                                                    <v-text-field v-else
                                                                  ma-1
                                                                  v-model="itemSelectedConfig[index]"
                                                                  :label="index"
                                                                  @change="aplicarProps()"
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                        </template>
                                    </v-card-text>
                                </v-card>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-flex>
                </v-layout>
            </v-container>

            <template slot="offset" >
                <v-card
                        color="primary"
                        :dark="this.isModeDarkForms"
                        :light="!this.isModeDarkForms"
                class="v-card--material__header elevation-1 headerConteudo"

                >
                <v-layout row wrap align-center>
                    <span class="mr-3">Incluir conteúdos</span>
                    <v-tooltip content-class="top" top  >
                        <v-btn


                                small
                                flat
                                fab
                                slot="activator"
                                @click="addText">
                            <v-icon >title</v-icon>
                        </v-btn>
                        <span>Incluir Titulo</span>
                    </v-tooltip>
                    <v-tooltip content-class="top" top  >
                        <v-btn


                                small
                                flat
                                fab
                                slot="activator"
                                @click="addImage">
                            <v-icon >image</v-icon>
                        </v-btn>
                        <span>Imagem</span>
                    </v-tooltip>
                    <v-tooltip content-class="top" top  >
                        <v-btn


                                small
                                flat
                                fab
                                slot="activator"
                                @click="addRect">
                            <v-icon >crop_5_4</v-icon>
                        </v-btn>
                        <span>Retângulo</span>
                    </v-tooltip>

                    <v-tooltip content-class="top" top  >
                        <v-btn


                                small
                                flat
                                fab
                                slot="activator"
                                @click="addCircle">
                            <v-icon >panorama_fish_eye</v-icon>
                        </v-btn>
                        <span>Circulo</span>
                    </v-tooltip>

                    <v-tooltip content-class="top" top  >
                        <v-btn


                                small
                                flat
                                fab
                                slot="activator"
                                @click="addStar">
                            <v-icon >stars</v-icon>
                        </v-btn>
                        <span>Estrela</span>
                    </v-tooltip>

                    <v-tooltip content-class="top" top  >
                        <v-btn


                                small
                                flat
                                fab
                                slot="activator"
                                @click="removeItem">
                            <v-icon >delete</v-icon>
                        </v-btn>
                        <span>Excluir item</span>
                    </v-tooltip>


                    <v-spacer></v-spacer>
                    <v-btn
                            depressed
                            @click="downloadImagem()"
                            small
                    >
                        <v-icon small left>mdi-update</v-icon>
                        Salvar

                    </v-btn>
                </v-layout>
                </v-card>
            </template>


        </material-card>

    </material-card>

</template>

<script>
    import AtonBaseForm from '../../components/aton-base-form.vue';

    export default {
        mixins: [
            // AtonCssLoader,
            AtonBaseForm,
        ],
        name: 'aton-admin-midia-editor-view',
        data() {
            return {


                loading: false,

                itemSelected: null,
                itemSelectedConfig: null,

                drawerRight: true,

                stage: null,
                layer: null,
                text: null,
                rect: null,
                circle: null,
                star: null,
                image: null,
                imageBg: null,
                tr: null,

                opacityModel: null,

                orientacaoModel: 'Paisagem',


                fileBG: '',
                panels: 0,

                fillModel: {
                    text: 'black',
                    value: '#000000',
                },
                strokeModel: {
                    text: 'black',
                    value: '#000000',
                },

                colors: ["nenhum"
                    , "black"
                    , "white"
                    , "red"
                    , "red lighten-5"
                    , "red lighten-4"
                    , "red lighten-3"
                    , "red lighten-2"
                    , "red lighten-1"
                    , "red darken-1"
                    , "red darken-2"
                    , "red darken-3"
                    , "red darken-4"
                    , "red accent-1"
                    , "red accent-2"
                    , "red accent-3"
                    , "red accent-4"
                    , "pink"
                    , "pink lighten-5"
                    , "pink lighten-4"
                    , "pink lighten-3"
                    , "pink lighten-2"
                    , "pink lighten-1"
                    , "pink darken-1"
                    , "pink darken-2"
                    , "pink darken-3"
                    , "pink darken-4"
                    , "pink accent-1"
                    , "pink accent-2"
                    , "pink accent-3"
                    , "pink accent-4"
                    , "purple"
                    , "purple lighten-5"
                    , "purple lighten-4"
                    , "purple lighten-3"
                    , "purple lighten-2"
                    , "purple lighten-1"
                    , "purple darken-1"
                    , "purple darken-2"
                    , "purple darken-3"
                    , "purple darken-4"
                    , "purple accent-1"
                    , "purple accent-2"
                    , "purple accent-3"
                    , "purple accent-4"
                    , "deep-purple"
                    , "deep-purple lighten-5"
                    , "deep-purple lighten-4"
                    , "deep-purple lighten-3"
                    , "deep-purple lighten-2"
                    , "deep-purple lighten-1"
                    , "deep-purple darken-1"
                    , "deep-purple darken-2"
                    , "deep-purple darken-3"
                    , "deep-purple darken-4"
                    , "deep-purple accent-1"
                    , "deep-purple accent-2"
                    , "deep-purple accent-3"
                    , "deep-purple accent-4"
                    , "indigo"
                    , "indigo lighten-5"
                    , "indigo lighten-4"
                    , "indigo lighten-3"
                    , "indigo lighten-2"
                    , "indigo lighten-1"
                    , "indigo darken-1"
                    , "indigo darken-2"
                    , "indigo darken-3"
                    , "indigo darken-4"
                    , "indigo accent-1"
                    , "indigo accent-2"
                    , "indigo accent-3"
                    , "indigo accent-4"
                    , "blue"
                    , "blue lighten-5"
                    , "blue lighten-4"
                    , "blue lighten-3"
                    , "blue lighten-2"
                    , "blue lighten-1"
                    , "blue darken-1"
                    , "blue darken-2"
                    , "blue darken-3"
                    , "blue darken-4"
                    , "blue accent-1"
                    , "blue accent-2"
                    , "blue accent-3"
                    , "blue accent-4"
                    , "light-blue"
                    , "light-blue lighten-5"
                    , "light-blue lighten-4"
                    , "light-blue lighten-3"
                    , "light-blue lighten-2"
                    , "light-blue lighten-1"
                    , "light-blue darken-1"
                    , "light-blue darken-2"
                    , "light-blue darken-3"
                    , "light-blue darken-4"
                    , "light-blue accent-1"
                    , "light-blue accent-2"
                    , "light-blue accent-3"
                    , "light-blue accent-4"
                    , "cyan"
                    , "cyan lighten-5"
                    , "cyan lighten-4"
                    , "cyan lighten-3"
                    , "cyan lighten-2"
                    , "cyan lighten-1"
                    , "cyan darken-1"
                    , "cyan darken-2"
                    , "cyan darken-3"
                    , "cyan darken-4"
                    , "cyan accent-1"
                    , "cyan accent-2"
                    , "cyan accent-3"
                    , "cyan accent-4"
                    , "teal"
                    , "teal lighten-5"
                    , "teal lighten-4"
                    , "teal lighten-3"
                    , "teal lighten-2"
                    , "teal lighten-1"
                    , "teal darken-1"
                    , "teal darken-2"
                    , "teal darken-3"
                    , "teal darken-4"
                    , "teal accent-1"
                    , "teal accent-2"
                    , "teal accent-3"
                    , "teal accent-4"
                    , "green"
                    , "green lighten-5"
                    , "green lighten-4"
                    , "green lighten-3"
                    , "green lighten-2"
                    , "green lighten-1"
                    , "green darken-1"
                    , "green darken-2"
                    , "green darken-3"
                    , "green darken-4"
                    , "green accent-1"
                    , "green accent-2"
                    , "green accent-3"
                    , "green accent-4"
                    , "light-green"
                    , "light-green lighten-5"
                    , "light-green lighten-4"
                    , "light-green lighten-3"
                    , "light-green lighten-2"
                    , "light-green lighten-1"
                    , "light-green darken-1"
                    , "light-green darken-2"
                    , "light-green darken-3"
                    , "light-green darken-4"
                    , "light-green accent-1"
                    , "light-green accent-2"
                    , "light-green accent-3"
                    , "light-green accent-4"
                    , "lime"
                    , "lime lighten-5"
                    , "lime lighten-4"
                    , "lime lighten-3"
                    , "lime lighten-2"
                    , "lime lighten-1"
                    , "lime darken-1"
                    , "lime darken-2"
                    , "lime darken-3"
                    , "lime darken-4"
                    , "lime accent-1"
                    , "lime accent-2"
                    , "lime accent-3"
                    , "lime accent-4"
                    , "yellow"
                    , "yellow lighten-5"
                    , "yellow lighten-4"
                    , "yellow lighten-3"
                    , "yellow lighten-2"
                    , "yellow lighten-1"
                    , "yellow darken-1"
                    , "yellow darken-2"
                    , "yellow darken-3"
                    , "yellow darken-4"
                    , "yellow accent-1"
                    , "yellow accent-2"
                    , "yellow accent-3"
                    , "yellow accent-4"
                    , "amber"
                    , "amber lighten-5"
                    , "amber lighten-4"
                    , "amber lighten-3"
                    , "amber lighten-2"
                    , "amber lighten-1"
                    , "amber darken-1"
                    , "amber darken-2"
                    , "amber darken-3"
                    , "amber darken-4"
                    , "amber accent-1"
                    , "amber accent-2"
                    , "amber accent-3"
                    , "amber accent-4"
                    , "orange"
                    , "orange lighten-5"
                    , "orange lighten-4"
                    , "orange lighten-3"
                    , "orange lighten-2"
                    , "orange lighten-1"
                    , "orange darken-1"
                    , "orange darken-2"
                    , "orange darken-3"
                    , "orange darken-4"
                    , "orange accent-1"
                    , "orange accent-2"
                    , "orange accent-3"
                    , "orange accent-4"
                    , "deep-orange"
                    , "deep-orange lighten-5"
                    , "deep-orange lighten-4"
                    , "deep-orange lighten-3"
                    , "deep-orange lighten-2"
                    , "deep-orange lighten-1"
                    , "deep-orange darken-1"
                    , "deep-orange darken-2"
                    , "deep-orange darken-3"
                    , "deep-orange darken-4"
                    , "deep-orange accent-1"
                    , "deep-orange accent-2"
                    , "deep-orange accent-3"
                    , "deep-orange accent-4"
                    , "brown"
                    , "brown lighten-5"
                    , "brown lighten-4"
                    , "brown lighten-3"
                    , "brown lighten-2"
                    , "brown lighten-1"
                    , "brown darken-1"
                    , "brown darken-2"
                    , "brown darken-3"
                    , "brown darken-4"
                    , "blue-grey"
                    , "blue-grey lighten-5"
                    , "blue-grey lighten-4"
                    , "blue-grey lighten-3"
                    , "blue-grey lighten-2"
                    , "blue-grey lighten-1"
                    , "blue-grey darken-1"
                    , "blue-grey darken-2"
                    , "blue-grey darken-3"
                    , "blue-grey darken-4"
                    , "grey"
                    , "grey lighten-5"
                    , "grey lighten-4"
                    , "grey lighten-3"
                    , "grey lighten-2"
                    , "grey lighten-1"
                    , "grey darken-1"
                    , "grey darken-2"
                    , "grey darken-3"
                    , "grey darken-4"],
                colorsValue: [
                    {text: "nenhum", value: ""},
                    {text: "black", value: "#000000"},
                    {text: "white", value: "#FFFFFF"},
                    {text: "red", value: "#F44336"},
                    {text: "red lighten-5", value: "#FFEBEE"},
                    {text: "red lighten-4", value: "#FFCDD2"},
                    {text: "red lighten-3", value: "#EF9A9A"},
                    {text: "red lighten-2", value: "#E57373"},
                    {text: "red lighten-1", value: "#EF5350"},
                    {text: "red darken-1", value: "#E53935"},
                    {text: "red darken-2", value: "#D32F2F"},
                    {text: "red darken-3", value: "#C62828"},
                    {text: "red darken-4", value: "#B71C1C"},
                    {text: "red accent-1", value: "#FF8A80"},
                    {text: "red accent-2", value: "#FF5252"},
                    {text: "red accent-3", value: "#FF1744"},
                    {text: "red accent-4", value: "#D50000"},
                    {text: "pink", value: "#e91e63"},
                    {text: "pink lighten-5", value: "#fce4ec"},
                    {text: "pink lighten-4", value: "#f8bbd0"},
                    {text: "pink lighten-3", value: "#f48fb1"},
                    {text: "pink lighten-2", value: "#f06292"},
                    {text: "pink lighten-1", value: "#ec407a"},
                    {text: "pink darken-1", value: "#d81b60"},
                    {text: "pink darken-2", value: "#c2185b"},
                    {text: "pink darken-3", value: "#ad1457"},
                    {text: "pink darken-4", value: "#880e4f"},
                    {text: "pink accent-1", value: "#ff80ab"},
                    {text: "pink accent-2", value: "#ff4081"},
                    {text: "pink accent-3", value: "#f50057"},
                    {text: "pink accent-4", value: "#c51162"},
                    {text: "purple", value: "#9c27b0"},
                    {text: "purple lighten-5", value: "#f3e5f5"},
                    {text: "purple lighten-4", value: "#e1bee7"},
                    {text: "purple lighten-3", value: "#ce93d8"},
                    {text: "purple lighten-2", value: "#ba68c8"},
                    {text: "purple lighten-1", value: "#ab47bc"},
                    {text: "purple darken-1", value: "#8e24aa"},
                    {text: "purple darken-2", value: "#7b1fa2"},
                    {text: "purple darken-3", value: "#6a1b9a"},
                    {text: "purple darken-4", value: "#4a148c"},
                    {text: "purple accent-1", value: "#ea80fc"},
                    {text: "purple accent-2", value: "#e040fb"},
                    {text: "purple accent-3", value: "#d500f9"},
                    {text: "purple accent-4", value: "#aa00ff"},
                    {text: "deep-purple", value: "#673ab7"},
                    {text: "deep-purple lighten-5", value: "#ede7f6"},
                    {text: "deep-purple lighten-4", value: "#d1c4e9"},
                    {text: "deep-purple lighten-3", value: "#b39ddb"},
                    {text: "deep-purple lighten-2", value: "#9575cd"},
                    {text: "deep-purple lighten-1", value: "#7e57c2"},
                    {text: "deep-purple darken-1", value: "#5e35b1"},
                    {text: "deep-purple darken-2", value: "#512da8"},
                    {text: "deep-purple darken-3", value: "#4527a0"},
                    {text: "deep-purple darken-4", value: "#311b92"},
                    {text: "deep-purple accent-1", value: "#b388ff"},
                    {text: "deep-purple accent-2", value: "#7c4dff"},
                    {text: "deep-purple accent-3", value: "#651fff"},
                    {text: "deep-purple accent-4", value: "#6200ea"},
                    {text: "indigo", value: "#3f51b5"},
                    {text: "indigo lighten-5", value: "#e8eaf6"},
                    {text: "indigo lighten-4", value: "#c5cae9"},
                    {text: "indigo lighten-3", value: "#9fa8da"},
                    {text: "indigo lighten-2", value: "#7986cb"},
                    {text: "indigo lighten-1", value: "#5c6bc0"},
                    {text: "indigo darken-1", value: "#3949ab"},
                    {text: "indigo darken-2", value: "#303f9f"},
                    {text: "indigo darken-3", value: "#283593"},
                    {text: "indigo darken-4", value: "#1a237e"},
                    {text: "indigo accent-1", value: "#8c9eff"},
                    {text: "indigo accent-2", value: "#536dfe"},
                    {text: "indigo accent-3", value: "#3d5afe"},
                    {text: "indigo accent-4", value: "#304ffe"},
                    {text: "blue", value: "#2196F3"},
                    {text: "blue lighten-5", value: "#E3F2FD"},
                    {text: "blue lighten-4", value: "#BBDEFB"},
                    {text: "blue lighten-3", value: "#90CAF9"},
                    {text: "blue lighten-2", value: "#64B5F6"},
                    {text: "blue lighten-1", value: "#42A5F5"},
                    {text: "blue darken-1", value: "#1E88E5"},
                    {text: "blue darken-2", value: "#1976D2"},
                    {text: "blue darken-3", value: "#1565C0"},
                    {text: "blue darken-4", value: "#0D47A1"},
                    {text: "blue accent-1", value: "#82B1FF"},
                    {text: "blue accent-2", value: "#448AFF"},
                    {text: "blue accent-3", value: "#2979FF"},
                    {text: "blue accent-4", value: "#2962FF"},
                    {text: "light-blue", value: "#03a9f4"},
                    {text: "light-blue lighten-5", value: "#e1f5fe"},
                    {text: "light-blue lighten-4", value: "#b3e5fc"},
                    {text: "light-blue lighten-3", value: "#81d4fa"},
                    {text: "light-blue lighten-2", value: "#4fc3f7"},
                    {text: "light-blue lighten-1", value: "#29b6f6"},
                    {text: "light-blue darken-1", value: "#039be5"},
                    {text: "light-blue darken-2", value: "#0288d1"},
                    {text: "light-blue darken-3", value: "#0277bd"},
                    {text: "light-blue darken-4", value: "#01579b"},
                    {text: "light-blue accent-1", value: "#80d8ff"},
                    {text: "light-blue accent-2", value: "#40c4ff"},
                    {text: "light-blue accent-3", value: "#00b0ff"},
                    {text: "light-blue accent-4", value: "#0091ea"},
                    {text: "cyan", value: "#00bcd4"},
                    {text: "cyan lighten-5", value: "#e0f7fa"},
                    {text: "cyan lighten-4", value: "#b2ebf2"},
                    {text: "cyan lighten-3", value: "#80deea"},
                    {text: "cyan lighten-2", value: "#4dd0e1"},
                    {text: "cyan lighten-1", value: "#26c6da"},
                    {text: "cyan darken-1", value: "#00acc1"},
                    {text: "cyan darken-2", value: "#0097a7"},
                    {text: "cyan darken-3", value: "#00838f"},
                    {text: "cyan darken-4", value: "#006064"},
                    {text: "cyan accent-1", value: "#84ffff"},
                    {text: "cyan accent-2", value: "#18ffff"},
                    {text: "cyan accent-3", value: "#00e5ff"},
                    {text: "cyan accent-4", value: "#00b8d4"},
                    {text: "teal", value: "#009688"},
                    {text: "teal lighten-5", value: "#e0f2f1"},
                    {text: "teal lighten-4", value: "#b2dfdb"},
                    {text: "teal lighten-3", value: "#80cbc4"},
                    {text: "teal lighten-2", value: "#4db6ac"},
                    {text: "teal lighten-1", value: "#26a69a"},
                    {text: "teal darken-1", value: "#00897b"},
                    {text: "teal darken-2", value: "#00796b"},
                    {text: "teal darken-3", value: "#00695c"},
                    {text: "teal darken-4", value: "#004d40"},
                    {text: "teal accent-1", value: "#a7ffeb"},
                    {text: "teal accent-2", value: "#64ffda"},
                    {text: "teal accent-3", value: "#1de9b6"},
                    {text: "teal accent-4", value: "#00bfa5"},
                    {text: "green", value: "#4CAF50"},
                    {text: "green lighten-5", value: "#E8F5E9"},
                    {text: "green lighten-4", value: "#C8E6C9"},
                    {text: "green lighten-3", value: "#A5D6A7"},
                    {text: "green lighten-2", value: "#81C784"},
                    {text: "green lighten-1", value: "#66BB6A"},
                    {text: "green darken-1", value: "#43A047"},
                    {text: "green darken-2", value: "#388E3C"},
                    {text: "green darken-3", value: "#2E7D32"},
                    {text: "green darken-4", value: "#1B5E20"},
                    {text: "green accent-1", value: "#B9F6CA"},
                    {text: "green accent-2", value: "#69F0AE"},
                    {text: "green accent-3", value: "#00E676"},
                    {text: "green accent-4", value: "#00C853"},
                    {text: "light-green", value: "#8bc34a"},
                    {text: "light-green lighten-5", value: "#f1f8e9"},
                    {text: "light-green lighten-4", value: "#dcedc8"},
                    {text: "light-green lighten-3", value: "#c5e1a5"},
                    {text: "light-green lighten-2", value: "#aed581"},
                    {text: "light-green lighten-1", value: "#9ccc65"},
                    {text: "light-green darken-1", value: "#7cb342"},
                    {text: "light-green darken-2", value: "#689f38"},
                    {text: "light-green darken-3", value: "#558b2f"},
                    {text: "light-green darken-4", value: "#33691e"},
                    {text: "light-green accent-1", value: "#ccff90"},
                    {text: "light-green accent-2", value: "#b2ff59"},
                    {text: "light-green accent-3", value: "#76ff03"},
                    {text: "light-green accent-4", value: "#64dd17"},
                    {text: "lime", value: "#cddc39"},
                    {text: "lime lighten-5", value: "#f9fbe7"},
                    {text: "lime lighten-4", value: "#f0f4c3"},
                    {text: "lime lighten-3", value: "#e6ee9c"},
                    {text: "lime lighten-2", value: "#dce775"},
                    {text: "lime lighten-1", value: "#d4e157"},
                    {text: "lime darken-1", value: "#c0ca33"},
                    {text: "lime darken-2", value: "#afb42b"},
                    {text: "lime darken-3", value: "#9e9d24"},
                    {text: "lime darken-4", value: "#827717"},
                    {text: "lime accent-1", value: "#f4ff81"},
                    {text: "lime accent-2", value: "#eeff41"},
                    {text: "lime accent-3", value: "#c6ff00"},
                    {text: "lime accent-4", value: "#aeea00"},
                    {text: "yellow", value: "#ffeb3b"},
                    {text: "yellow lighten-5", value: "#fffde7"},
                    {text: "yellow lighten-4", value: "#fff9c4"},
                    {text: "yellow lighten-3", value: "#fff59d"},
                    {text: "yellow lighten-2", value: "#fff176"},
                    {text: "yellow lighten-1", value: "#ffee58"},
                    {text: "yellow darken-1", value: "#fdd835"},
                    {text: "yellow darken-2", value: "#fbc02d"},
                    {text: "yellow darken-3", value: "#f9a825"},
                    {text: "yellow darken-4", value: "#f57f17"},
                    {text: "yellow accent-1", value: "#ffff8d"},
                    {text: "yellow accent-2", value: "#ffff00"},
                    {text: "yellow accent-3", value: "#ffea00"},
                    {text: "yellow accent-4", value: "#ffd600"},
                    {text: "amber", value: "#ffc107"},
                    {text: "amber lighten-5", value: "#fff8e1"},
                    {text: "amber lighten-4", value: "#ffecb3"},
                    {text: "amber lighten-3", value: "#ffe082"},
                    {text: "amber lighten-2", value: "#ffd54f"},
                    {text: "amber lighten-1", value: "#ffca28"},
                    {text: "amber darken-1", value: "#ffb300"},
                    {text: "amber darken-2", value: "#ffa000"},
                    {text: "amber darken-3", value: "#ff8f00"},
                    {text: "amber darken-4", value: "#ff6f00"},
                    {text: "amber accent-1", value: "#ffe57f"},
                    {text: "amber accent-2", value: "#ffd740"},
                    {text: "amber accent-3", value: "#ffc400"},
                    {text: "amber accent-4", value: "#ffab00"},
                    {text: "orange", value: "#ff9800"},
                    {text: "orange lighten-5", value: "#fff3e0"},
                    {text: "orange lighten-4", value: "#ffe0b2"},
                    {text: "orange lighten-3", value: "#ffcc80"},
                    {text: "orange lighten-2", value: "#ffb74d"},
                    {text: "orange lighten-1", value: "#ffa726"},
                    {text: "orange darken-1", value: "#fb8c00"},
                    {text: "orange darken-2", value: "#f57c00"},
                    {text: "orange darken-3", value: "#ef6c00"},
                    {text: "orange darken-4", value: "#e65100"},
                    {text: "orange accent-1", value: "#ffd180"},
                    {text: "orange accent-2", value: "#ffab40"},
                    {text: "orange accent-3", value: "#ff9100"},
                    {text: "orange accent-4", value: "#ff6d00"},
                    {text: "deep-orange", value: "#ff5722"},
                    {text: "deep-orange lighten-5", value: "#fbe9e7"},
                    {text: "deep-orange lighten-4", value: "#ffccbc"},
                    {text: "deep-orange lighten-3", value: "#ffab91"},
                    {text: "deep-orange lighten-2", value: "#ff8a65"},
                    {text: "deep-orange lighten-1", value: "#ff7043"},
                    {text: "deep-orange darken-1", value: "#f4511e"},
                    {text: "deep-orange darken-2", value: "#e64a19"},
                    {text: "deep-orange darken-3", value: "#d84315"},
                    {text: "deep-orange darken-4", value: "#bf360c"},
                    {text: "deep-orange accent-1", value: "#ff9e80"},
                    {text: "deep-orange accent-2", value: "#ff6e40"},
                    {text: "deep-orange accent-3", value: "#ff3d00"},
                    {text: "deep-orange accent-4", value: "#dd2c00"},
                    {text: "brown", value: "#795548"},
                    {text: "brown lighten-5", value: "#efebe9"},
                    {text: "brown lighten-4", value: "#d7ccc8"},
                    {text: "brown lighten-3", value: "#bcaaa4"},
                    {text: "brown lighten-2", value: "#a1887f"},
                    {text: "brown lighten-1", value: "#8d6e63"},
                    {text: "brown darken-1", value: "#6d4c41"},
                    {text: "brown darken-2", value: "#5d4037"},
                    {text: "brown darken-3", value: "#4e342e"},
                    {text: "brown darken-4", value: "#3e2723"},
                    {text: "blue-grey", value: "#607d8b"},
                    {text: "blue-grey lighten-5", value: "#eceff1"},
                    {text: "blue-grey lighten-4", value: "#cfd8dc"},
                    {text: "blue-grey lighten-3", value: "#b0bec5"},
                    {text: "blue-grey lighten-2", value: "#90a4ae"},
                    {text: "blue-grey lighten-1", value: "#78909c"},
                    {text: "blue-grey darken-1", value: "#546e7a"},
                    {text: "blue-grey darken-2", value: "#455a64"},
                    {text: "blue-grey darken-3", value: "#37474f"},
                    {text: "blue-grey darken-4", value: "#263238"},
                    {text: "grey", value: "#9e9e9e"},
                    {text: "grey lighten-5", value: "#fafafa"},
                    {text: "grey lighten-4", value: "#f5f5f5"},
                    {text: "grey lighten-3", value: "#eeeeee"},
                    {text: "grey lighten-2", value: "#e0e0e0"},
                    {text: "grey lighten-1", value: "#bdbdbd"},
                    {text: "grey darken-1", value: "#757575"},
                    {text: "grey darken-2", value: "#616161"},
                    {text: "grey darken-3", value: "#424242"},
                    {text: "grey darken-4", value: "#212121"},
                ],
            }
        },
        mounted() {
            let self = this;

            this.stage = new Konva.Stage({
                container: 'konva',
                width: 960,
                height: 540,
            });


            this.layer = new Konva.Layer();

            this.stage.add(this.layer);

            self.layer.draw();

        },
        created() {
        },
        computed: {
            temConfig: function () {
                return this.itemSelectedConfig != null;
            }
        },

        methods: {
            ajustaSelectComp: function (event) {
                // console.log(payload);
                if (!this.fillModel) {
                    this.fillModel = {
                        text: "nenhum",
                        value: ""
                    }
                }


                if (!this.strokeModel) {
                    this.strokeModel = {
                        text: "nenhum",
                        value: ""
                    }
                }


            },
            ajustaOpacity: function () {
                let tmp = 0;
                if (this.opacityModel > 0) {
                    tmp = this.opacityModel / 10;
                }

                this.itemSelected.opacity(tmp);
            },
            aplicarOrientacao: function () {
                this.stage.width(this.getWidth());
                this.stage.height(this.getHeight());
                this.imageBg.width(this.getWidth());
                this.imageBg.height(this.getHeight());
                this.stage.draw();
            },
            aplicarProps: function () {
                if (this.itemSelected) {
                    var itemDef = this.colorsValue.find(x => x.text == 'black');

                    this.ajustaOpacity();

                    if (this.itemSelectedConfig.opacity) {
                        if (this.opacityModel > 0) {
                            this.itemSelectedConfig.opacity = this.opacityModel / 10;
                        }
                    }


                    if (this.itemSelectedConfig.strokeWidth == '0') {
                        this.itemSelectedConfig.stroke = '';
                    } else {
                        if (this.strokeModel) {
                            this.itemSelectedConfig.stroke = this.strokeModel.value;
                        }
                    }

                    if (this.itemSelectedConfig.transparente) {
                        this.itemSelectedConfig.fill = 'rgba(0, 0, 0, 0)';
                        if (this.itemSelectedConfig.strokeWidth == '0') {
                            this.itemSelectedConfig.stroke = itemDef.value;
                            this.itemSelectedConfig.strokeWidth = 1;
                        }
                    } else {
                        if (this.fillModel) {
                            this.itemSelectedConfig.fill = this.fillModel.value;
                        }
                    }

                    if (this.itemSelectedConfig.sombra) {
                        this.itemSelectedConfig.shadowColor = itemDef.value;
                        this.itemSelectedConfig.shadowBlur = 5;
                        this.itemSelectedConfig.shadowOffset = {x: 3, y: 3};
                        this.itemSelectedConfig.shadowOpacity = 0.7;
                    } else {
                        this.itemSelectedConfig.shadowColor = '';
                        this.itemSelectedConfig.shadowBlur = 0;
                        this.itemSelectedConfig.shadowOffsetX = 0;
                        this.itemSelectedConfig.shadowOffsetY = 0;
                        this.itemSelectedConfig.shadowOpacity = 0;
                    }

                    this.ajustaOpacity();

                    this.itemSelected.setAttrs(this.itemSelectedConfig);
                    this.layer.draw();
                }

            },
            exibirProp: function (index) {
                return (
                    (index == 'fill') ||
                    (index == 'numPoints') ||
                    (index == 'sombra') ||
                    (index == 'innerRadius') ||
                    (index == 'outerRadius') ||
                    (index == 'cornerRadius') ||
                    (index == 'strokeWidth') ||
                    (index == 'opacity') ||
                    (index == 'transparente') ||
                    (index == 'stroke')
                );
            },
            getWidth: function () {
                return (this.orientacaoModel == 'Paisagem') ? 960 : 540;
            },
            getHeight: function () {
                return (this.orientacaoModel == 'Retrato') ? 960 : 540;
            },
            novoFundo: function () {
                let self = this;


                function handleFileSelect(evt) {
                    var files = evt.target.files; // FileList object

                    // Loop through the FileList and render image files as thumbnails.
                    if (files) {
                        var f = files[0];

                        // Only process image files.
                        if (f.type.match('image.*')) {
                            if (self.imageBg) {
                                self.imageBg.destroy();
                            }
                            ;

                            var reader = new FileReader();

                            // Closure to capture the file information.
                            reader.onload = (function (theFile) {
                                return function (e) {
                                    // Render thumbnail.
                                    var imageObj = new Image();
                                    imageObj.onload = function () {
                                        self.imageBg = new Konva.Image(
                                            {
                                                x: 0,
                                                y: 0,
                                                image: imageObj,
                                                width: (self.orientacaoModel == 'Paisagem') ? 960 : 540,
                                                height: (self.orientacaoModel == 'Retrato') ? 960 : 540,
                                                draggable: false,
                                                // onFinish : function() {
                                                //     // remove all references from Konva
                                                //     self.imageBg.destroy();
                                                // }
                                            });


                                        self.imageBg.on('click', function (e) {
                                            // if click on empty area - remove all transformers
                                            self.itemSelected = null;
                                            self.itemSelectedConfig = null;
                                            self.stage.find('Transformer').destroy();
                                            self.layer.draw();
                                            return;
                                        });

                                        self.layer.add(self.imageBg);

                                        self.imageBg.moveToBottom();

                                        self.layer.draw();

                                    };
                                    imageObj.src = e.target.result;
                                };
                            })(f);

                            // Read in the image file as a data URL.
                            reader.readAsDataURL(f);
                        }
                    }
                }

                var input = document.createElement('input');
                input.type = "file";
                input.hidden;
                input.id = 'files';

                $(input).on('change', handleFileSelect);

                $(input).click();


            },

            removeItem: function () {
                if (this.itemSelected) {
                    this.itemSelected.destroy();
                    this.itemSelectedConfig = null;
                    this.stage.find('Transformer').destroy();
                    this.layer.draw();
                }
            },
            downloadURI: function (uri, name) {
                let link = document.createElement("a");
                link.download = name;
                link.href = uri;
                document.body.appendChild(link);
                link.click(function (e) {
                    // Special stuff to do when this link is clicked...

                    // Cancel the default action
                    e.preventDefault();
                });
                document.body.removeChild(link);
                return true;

            },

            downloadImagem: function () {


                this.stage.find('Transformer').destroy();
                this.stage.draw();

                // this.stage.clearCache();
                var dataURL = this.stage.toDataURL({
                    mimeType: 'image/jpeg',
                    quality: 1,
                    // width: 1920,
                    // height: 1080,
                    pixelRatio: 2,
                });

                this.downloadURI(dataURL, 'nova_arte.jpg');
                return true;
            },

            loadAttrs: function (comp) {
                let self = this;

                self.itemSelectedConfig = null;

                if (!comp && self.itemSelected) {
                    comp = self.itemSelected;
                }

                if (!self.itemSelected) {
                    return false;
                }

                self.itemSelectedConfig = comp.getAttrs();

                if (self.itemSelectedConfig.fill) {
                    var item = self.colorsValue.find(x => x.value == self.itemSelectedConfig.fill);

                    self.fillModel = {
                        text: 'nenhum',
                        value: '',
                    };
                    if (item) {
                        self.fillModel = {
                            text: item.text,
                            value: item.value,
                        };
                    }
                }
                if (self.itemSelectedConfig.stroke) {
                    var item = self.colorsValue.find(x => x.value == self.itemSelectedConfig.stroke);

                    self.strokeModel = {
                        text: 'nenhum',
                        value: '',
                    };
                    if (item) {
                        self.strokeModel = {
                            text: item.text,
                            value: item.value,
                        };
                    }
                }

                if (self.itemSelectedConfig.opacity) {
                    if (self.itemSelectedConfig.opacity > 0) {
                        self.opacityModel = self.itemSelectedConfig.opacity * 10;
                    }
                }
            },

            addText: function () {
                let self = this;

                this.text = new Konva.Text({
                    x: 100,
                    y: 100,
                    text: 'Seu texto',
                    fontSize: 30,
                    // fontFamily: 'Calibri',
                    fill: self.fillModel.value,
                    draggable: true,
                    stroke: '',
                    strokeWidth: 0,
                    shadowColor: '',
                    opacity: 1,
                    shadowBlur: 0,
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowOpacity: 0,
                    sombra: false,
                });

                this.layer.add(this.text);
                self.itemSelected = self.text;
                self.loadAttrs(self.text);

                self.stage.find('Transformer').destroy();

                // create new transformer
                self.tr = new Konva.Transformer();
                self.layer.add(self.tr);
                this.tr.attachTo(this.text);
                this.layer.draw();

                self.text.on('dblclick', () => {
                    // create textarea over canvas with absolute position

                    // first we need to find its positon
                    var textPosition = self.text.getAbsolutePosition();
                    var stageBox = self.stage.getContainer().getBoundingClientRect();

                    var areaPosition = {
                        x: textPosition.x + stageBox.left,
                        y: textPosition.y + stageBox.top
                    };


                    // create textarea and style it
                    var textarea = document.createElement('textarea');
                    document.body.appendChild(textarea);

                    textarea.value = self.text.text();
                    textarea.style.position = 'absolute';
                    textarea.style.top = areaPosition.y + 'px';
                    textarea.style.left = areaPosition.x + 'px';
                    textarea.style.width = self.text.width() * self.text.scale();

                    textarea.focus();


                    textarea.addEventListener('keydown', function (e) {
                        // hide on enter
                        if (e.keyCode === 13) {
                            self.text.text(textarea.value);
                            self.layer.draw();
                            document.body.removeChild(textarea);
                        }
                        if (e.keyCode === 27) {
                            document.body.removeChild(textarea);
                        }
                    });
                });

                self.text.on('dblclick', function (e) {
                    e.target.moveToTop();
                    self.layer.draw();
                });

                self.text.on('click', function (e) {
                    // if click on empty area - remove all transformers
                    self.stage.find('Transformer').destroy();

                    // create new transformer
                    self.tr = new Konva.Transformer();
                    self.layer.add(self.tr);
                    self.tr.attachTo(e.target);
                    self.layer.draw();

                    self.itemSelected = e.target;
                    self.loadAttrs(self.itemSelected);
                });


            },
            addRect: function () {
                let self = this;

                this.rect = new Konva.Rect({
                    x: 10,
                    y: 10,
                    width: 200,
                    height: 80,
                    fill: self.fillModel.value,
                    draggable: true,
                    cornerRadius: 0,
                    stroke: '',
                    strokeWidth: 0,
                    transparente: false,
                    shadowColor: '',
                    opacity: 1,
                    shadowBlur: 0,
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowOpacity: 0,
                    sombra: false,
                });

                this.layer.add(this.rect);
                self.itemSelected = self.rect;
                self.loadAttrs(self.itemSelected);

                self.stage.find('Transformer').destroy();

                // create new transformer
                self.tr = new Konva.Transformer();
                self.layer.add(self.tr);
                this.tr.attachTo(this.rect);
                this.layer.draw();

                self.rect.on('dblclick', function (e) {
                    e.target.moveToTop();
                    self.layer.draw();
                });

                self.rect.on('click', function (e) {
                    // if click on empty area - remove all transformers
                    self.stage.find('Transformer').destroy();

                    // create new transformer
                    self.tr = new Konva.Transformer();
                    self.layer.add(self.tr);
                    self.tr.attachTo(e.target);
                    self.layer.draw();

                    self.itemSelected = e.target;
                    self.loadAttrs(self.itemSelected);
                });


            },

            addCircle: function () {
                let self = this;

                this.circle = new Konva.Circle({
                    x: 150,
                    y: 150,
                    width: 200,
                    height: 200,
                    fill: self.fillModel.value,
                    draggable: true,
                    stroke: '',
                    strokeWidth: 0,
                    transparente: false,
                    shadowColor: '',
                    opacity: 1,
                    shadowBlur: 0,
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowOpacity: 0,
                    sombra: false,
                });

                this.layer.add(this.circle);
                self.itemSelected = self.circle;
                self.loadAttrs(self.itemSelected);

                self.stage.find('Transformer').destroy();

                // create new transformer
                self.tr = new Konva.Transformer();
                self.layer.add(self.tr);
                this.tr.attachTo(this.circle);
                this.layer.draw();

                self.circle.on('dblclick', function (e) {
                    e.target.moveToTop();
                    self.layer.draw();
                });

                self.circle.on('click', function (e) {
                    // if click on empty area - remove all transformers
                    self.stage.find('Transformer').destroy();

                    // create new transformer
                    self.tr = new Konva.Transformer();
                    self.layer.add(self.tr);
                    self.tr.attachTo(e.target);
                    self.layer.draw();

                    self.itemSelected = e.target;
                    self.loadAttrs(self.itemSelected);
                });
            },

            addStar: function () {
                let self = this;

                this.star = new Konva.Star({
                    x: 150,
                    y: 150,
                    width: 200,
                    height: 200,
                    fill: self.fillModel.value,
                    draggable: true,
                    stroke: '',
                    strokeWidth: 0,
                    numPoints: 5,
                    innerRadius: 45,
                    outerRadius: 100,
                    transparente: false,
                    shadowColor: '',
                    opacity: 1,
                    shadowBlur: 0,
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowOpacity: 0,
                    sombra: false,
                });

                this.layer.add(this.star);
                self.itemSelected = self.star;
                self.loadAttrs(self.itemSelected);

                self.stage.find('Transformer').destroy();

                // create new transformer
                self.tr = new Konva.Transformer();
                self.layer.add(self.tr);
                this.tr.attachTo(this.star);
                this.layer.draw();

                self.star.on('dblclick', function (e) {
                    e.target.moveToTop();
                    self.layer.draw();
                });

                self.star.on('click', function (e) {
                    // if click on empty area - remove all transformers
                    self.stage.find('Transformer').destroy();

                    // create new transformer
                    self.tr = new Konva.Transformer();
                    self.layer.add(self.tr);
                    self.tr.attachTo(e.target);
                    self.layer.draw();

                    self.itemSelected = e.target;
                    self.loadAttrs(self.itemSelected);
                });
            },

            addImage: function () {
                let self = this;

                function handleFileSelect(evt) {
                    var files = evt.target.files; // FileList object

                    // Loop through the FileList and render image files as thumbnails.
                    if (files) {
                        var f = files[0];

                        // Only process image files.
                        if (f.type.match('image.*')) {
                            var reader = new FileReader();

                            // Closure to capture the file information.
                            reader.onload = (function (theFile) {
                                return function (e) {
                                    // Render thumbnail.

                                    var imageObj = new Image();
                                    imageObj.onload = function () {

                                        let m = imageObj.height / imageObj.width;
                                        let wid = 200;
                                        let hei = wid * m;


                                        self.image = new Konva.Image(
                                            {
                                                x: 50,
                                                y: 50,
                                                image: imageObj,
                                                width: wid,
                                                height: hei,
                                                draggable: true,
                                                stroke: '',
                                                strokeWidth: 0,
                                                shadowColor: '',
                                                opacity: 1,
                                                shadowBlur: 0,
                                                shadowOffsetX: 0,
                                                shadowOffsetY: 0,
                                                shadowOpacity: 0,
                                                sombra: false,
                                            });

                                        self.itemSelected = self.image;
                                        self.loadAttrs(self.itemSelected);
                                        self.image.on('click', function (e) {
                                            // if click on empty area - remove all transformers
                                            self.stage.find('Transformer').destroy();

                                            // create new transformer
                                            self.tr = new Konva.Transformer();
                                            self.layer.add(self.tr);
                                            self.tr.attachTo(e.target);
                                            self.layer.draw();
                                            self.itemSelected = e.target;
                                            self.loadAttrs(self.itemSelected);
                                        });

                                        self.image.on('dblclick', function (e) {
                                            e.target.moveToTop();
                                            self.layer.draw();
                                        });


                                        self.layer.add(self.image);

                                        self.stage.find('Transformer').destroy();
                                        // create new transformer
                                        self.tr = new Konva.Transformer();

                                        self.tr.attachTo(self.image);
                                        self.layer.draw();
                                    };
                                    imageObj.src = e.target.result;
                                };
                            })(f);

                            // Read in the image file as a data URL.
                            reader.readAsDataURL(f);
                        }
                    }
                }

                var input = document.createElement('input');
                input.type = "file";
                input.hidden;
                input.id = 'files';

                $(input).on('change', handleFileSelect);

                $(input).click();


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
        components: {},

        watch: {
            // fillModel: function(val){
            //     if (!val){
            //         this.fillModel = {
            //             text:"nenhum",
            //             value: ""
            //         }
            //     }
            // },
            // strokeModel: function (val){
            //     if (!val){
            //         this.strokeModel = {
            //             text:"nenhum",
            //             value: ""
            //         }
            //     }
            // },
            // itemSelectedConfig: {
            //     handler: function (conf) {
            //         if (conf) {
            //             let self = this;
            //             var item = this.colorsValue.find(x => x.value == conf.fill);
            //             self.fillModel = {
            //                 text: 'nenhum',
            //                 value: '',
            //             };
            //             if (item) {
            //                 self.fillModel = {
            //                     text: item.text,
            //                     value: item.value,
            //                 };
            //             }
            //
            //             var item = this.colorsValue.find(x => x.value == conf.stroke);
            //             if (item) {
            //                 self.strokeModel = {
            //                     text: item.text,
            //                     value: item.value,
            //                 };
            //             }
            //             if (conf.opacity) {
            //                 if (conf.opacity > 0) {
            //                     this.opacityModel = conf.opacity * 10;
            //                 }
            //             }
            //             // console.log(item);
            //         }
            //     },
            //     deep: true
            // },
        },
    }
</script>

<style>

    .headerConteudo{
        padding: 0 15px 0 15px !important;
        height: 50px;
    }


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

