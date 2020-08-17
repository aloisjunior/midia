<template>

    <material-card
            :title="getTitulo('Configurações')"
            @keyup.esc.prevent="voltaView(true)"
    >
        <v-form v-model="formCtrl" ref="form" lazy-validation>
            <div class="div-progress">
                <v-progress-linear v-show="loading || loading_extras" height="3" color="success"
                                   :indeterminate="true"></v-progress-linear>
            </div>


            <v-layout row wrap>
                <v-flex xs12 md6>
                    <v-flex xs12 class="pa-1">
                        <material-card

                                title="Notificações do player"
                                text="Indique em quantos minutos sem sinal do player deseja ser notificado."
                                color="grey darken-1"
                                :dark="!this.isModeDarkForms"
                                :light="this.isModeDarkForms"
                        >
                            <v-slider
                                    v-model="dadosDB.players_tempo_notifica"
                                    label="Quantos minutos?"
                                    step="5"
                                    thumb-label="always"
                                    thumb-size="24"
                                    max="120"
                                    min="0"
                                    hint="Selecione 0 para desabilitar"
                                    persistent-hint
                            ></v-slider>
                        </material-card>
                    </v-flex>
                    <v-flex xs12 class="pa-1">
                        <material-card

                                title="Plugins da área de trabalho"
                                text="Serão adicionados na tela inicial do dashboard"
                                color="grey darken-1"
                                :dark="!this.isModeDarkForms"
                                :light="this.isModeDarkForms"
                        >
                            <v-autocomplete
                                    v-model="dadosDB.plugins"
                                    :items="listItens"
                                    chips

                                    label="Plugins"
                                    multiple

                                    return-object
                                    item-text="text"
                                    item-value="text"
                            >
                                <template
                                        slot="selection"
                                        slot-scope="data"
                                >
                                    <v-chip
                                            :selected="data.selected"
                                            close
                                            class="chip--select-multi"
                                            @input="remove(data.item)"
                                    >
                                        {{ data.item.text }}
                                    </v-chip>
                                </template>
                                <template
                                        slot="item"
                                        slot-scope="data"
                                >
                                    <template v-if="typeof data.item !== 'object'">
                                        <v-list-tile-content v-text="data.item.text"></v-list-tile-content>
                                    </template>
                                    <template v-else>
                                        <v-list-tile-content>
                                            <v-list-tile-title v-html="data.item.text"></v-list-tile-title>
                                        </v-list-tile-content>
                                    </template>
                                </template>
                            </v-autocomplete>
                        </material-card>
                    </v-flex>
                </v-flex>
                <v-flex xs12 md6 class="px-1">
                    <material-card

                            title="Aparência do gerenciador"
                            text="Customize a aplicação conforme seus gostos."
                            color="grey darken-1"
                            :dark="!this.isModeDarkForms"
                            :light="this.isModeDarkForms"
                    >

                        <v-layout row wrap>
                            <v-flex xs12 md6>

                                <v-select
                                        class="px-1"
                                        v-model="dadosDB.tema_fundo"
                                        :items="['Escuro', 'Claro']"
                                        label="Tema de fundo"
                                        required

                                        @input="atualizaCoresPreview()"
                                ></v-select>
                            </v-flex>
                            <v-flex xs12 md6>
                                <v-select
                                        class="px-1"
                                        v-model="dadosDB.tema_formularios"
                                        :items="['Escuro', 'Claro']"
                                        label="Tema dos formulários"
                                        required

                                        @input="atualizaCoresPreview()"
                                ></v-select>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>

                            <v-flex xs12 md6>
                                <v-autocomplete
                                        class="px-1"
                                        v-model="dadosDB.primaryColorModel"
                                        :items="colorsValue"
                                        item-text="text"
                                        item-value="text"
                                        label="Cor primária"
                                        chips

                                        dense
                                        return-object
                                        @input="(pay) => setCorPreview(pay, 'primary')"
                                        :background-color="(dadosDB.primaryColorModel)?'': '#4caf50'"
                                        placeholder="Cor primária padrão"
                                >
                                    <template
                                            slot="selection"
                                            slot-scope="data">
                                        <v-chip
                                                :selected="data.selected"
                                                :close="data.item.text != $configPadraoManager.primaryColorModel.text"
                                                @input="redefinePadraoCores('primary')"
                                        >
                                            <v-avatar class="elevation-2" :color="data.item.value">
                                            </v-avatar>
                                            {{ data.item.text}}
                                        </v-chip>
                                    </template>


                                    <template
                                            slot="item"
                                            slot-scope="{item, index, tile}">
                                        <v-list-tile-content>
                                            <v-chip small >
                                                <v-avatar class="elevation-2" :color="item.value">
                                                </v-avatar>
                                                {{ item.text}}
                                            </v-chip>
                                        </v-list-tile-content>
                                    </template>
                                </v-autocomplete>
                            </v-flex>

                            <v-flex xs12 md6>
                                <v-autocomplete
                                        class="px-1"
                                        v-model="dadosDB.secundaryColorModel"
                                        :items="colorsValue"
                                        item-text="text"
                                        item-value="text"
                                        label="Cor secundária"
                                        chips

                                        dense
                                        return-object
                                        @input="(pay) => setCorPreview(pay, 'secundary')"
                                        :background-color="(dadosDB.secundaryColorModel)?'' : '#546E7A'"
                                        placeholder="Cor secundária padrão"
                                >
                                    <template
                                            slot="selection"
                                            slot-scope="data">
                                        <v-chip
                                                :selected="data.selected"
                                                :close="data.item.text != $configPadraoManager.secundaryColorModel.text"
                                                @input="redefinePadraoCores('secundary')"
                                        >
                                            <v-avatar class="elevation-2" :color="data.item.value">
                                            </v-avatar>
                                            {{ data.item.text}}
                                        </v-chip>
                                    </template>
                                    <template
                                            slot="item"
                                            slot-scope="{item, index, tile}">
                                        <v-list-tile-content>
                                            <v-chip small >
                                                <v-avatar class="elevation-2" :color="item.value">
                                                </v-avatar>
                                                {{ item.text}}
                                            </v-chip>
                                        </v-list-tile-content>
                                    </template>
                                </v-autocomplete>
                            </v-flex>

                        </v-layout>
                        <template slot="actions">
                            <v-spacer></v-spacer>
                            <v-btn
                                    depressed
                                    @click="redefinirTudo"
                                    small
                            >
                                <v-icon left>mdi-backup-restore</v-icon>
                                Redefinir
                            </v-btn>
                        </template>
                    </material-card>
                </v-flex>
            </v-layout>


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
    import AtonRules from '../../components/aton-rules';
    import atonBaseFormEdit from '../../components/aton-base-form-edit.vue';

    export default {
        mixins: [
            AtonRules,
            atonBaseFormEdit
        ],
        data() {
            return {
                name: 'aton-admin-config',

                dadosDB: Object.assign({}, this.dadosDB, this.$configPadraoManager), // cria nova instancia

                listItens: Object.assign([], this.listItens, this.$configPadraoManager.plugins), // cria nova instancia

                configAtual: null,

                colors: [
                    "black",
                    "white",
                    "red",
                    "red lighten-5",
                    "red lighten-4",
                    "red lighten-3",
                    "red lighten-2",
                    "red lighten-1",
                    "red darken-1",
                    "red darken-2",
                    "red darken-3",
                    "red darken-4",
                    "red accent-1",
                    "red accent-2",
                    "red accent-3",
                    "red accent-4",
                    "pink",
                    "pink lighten-5",
                    "pink lighten-4",
                    "pink lighten-3",
                    "pink lighten-2",
                    "pink lighten-1",
                    "pink darken-1",
                    "pink darken-2",
                    "pink darken-3",
                    "pink darken-4",
                    "pink accent-1",
                    "pink accent-2",
                    "pink accent-3",
                    "pink accent-4",
                    "purple",
                    "purple lighten-5",
                    "purple lighten-4",
                    "purple lighten-3",
                    "purple lighten-2",
                    "purple lighten-1",
                    "purple darken-1",
                    "purple darken-2",
                    "purple darken-3",
                    "purple darken-4",
                    "purple accent-1",
                    "purple accent-2",
                    "purple accent-3",
                    "purple accent-4",
                    "deep-purple",
                    "deep-purple lighten-5",
                    "deep-purple lighten-4",
                    "deep-purple lighten-3",
                    "deep-purple lighten-2",
                    "deep-purple lighten-1",
                    "deep-purple darken-1",
                    "deep-purple darken-2",
                    "deep-purple darken-3",
                    "deep-purple darken-4",
                    "deep-purple accent-1",
                    "deep-purple accent-2",
                    "deep-purple accent-3",
                    "deep-purple accent-4",
                    "indigo",
                    "indigo lighten-5",
                    "indigo lighten-4",
                    "indigo lighten-3",
                    "indigo lighten-2",
                    "indigo lighten-1",
                    "indigo darken-1",
                    "indigo darken-2",
                    "indigo darken-3",
                    "indigo darken-4",
                    "indigo accent-1",
                    "indigo accent-2",
                    "indigo accent-3",
                    "indigo accent-4",
                    "blue",
                    "blue lighten-5",
                    "blue lighten-4",
                    "blue lighten-3",
                    "blue lighten-2",
                    "blue lighten-1",
                    "blue darken-1",
                    "blue darken-2",
                    "blue darken-3",
                    "blue darken-4",
                    "blue accent-1",
                    "blue accent-2",
                    "blue accent-3",
                    "blue accent-4",
                    "light-blue",
                    "light-blue lighten-5",
                    "light-blue lighten-4",
                    "light-blue lighten-3",
                    "light-blue lighten-2",
                    "light-blue lighten-1",
                    "light-blue darken-1",
                    "light-blue darken-2",
                    "light-blue darken-3",
                    "light-blue darken-4",
                    "light-blue accent-1",
                    "light-blue accent-2",
                    "light-blue accent-3",
                    "light-blue accent-4",
                    "cyan",
                    "cyan lighten-5",
                    "cyan lighten-4",
                    "cyan lighten-3",
                    "cyan lighten-2",
                    "cyan lighten-1",
                    "cyan darken-1",
                    "cyan darken-2",
                    "cyan darken-3",
                    "cyan darken-4",
                    "cyan accent-1",
                    "cyan accent-2",
                    "cyan accent-3",
                    "cyan accent-4",
                    "teal",
                    "teal lighten-5",
                    "teal lighten-4",
                    "teal lighten-3",
                    "teal lighten-2",
                    "teal lighten-1",
                    "teal darken-1",
                    "teal darken-2",
                    "teal darken-3",
                    "teal darken-4",
                    "teal accent-1",
                    "teal accent-2",
                    "teal accent-3",
                    "teal accent-4",
                    "green",
                    "green lighten-5",
                    "green lighten-4",
                    "green lighten-3",
                    "green lighten-2",
                    "green lighten-1",
                    "green darken-1",
                    "green darken-2",
                    "green darken-3",
                    "green darken-4",
                    "green accent-1",
                    "green accent-2",
                    "green accent-3",
                    "green accent-4",
                    "light-green",
                    "light-green lighten-5",
                    "light-green lighten-4",
                    "light-green lighten-3",
                    "light-green lighten-2",
                    "light-green lighten-1",
                    "light-green darken-1",
                    "light-green darken-2",
                    "light-green darken-3",
                    "light-green darken-4",
                    "light-green accent-1",
                    "light-green accent-2",
                    "light-green accent-3",
                    "light-green accent-4",
                    "lime",
                    "lime lighten-5",
                    "lime lighten-4",
                    "lime lighten-3",
                    "lime lighten-2",
                    "lime lighten-1",
                    "lime darken-1",
                    "lime darken-2",
                    "lime darken-3",
                    "lime darken-4",
                    "lime accent-1",
                    "lime accent-2",
                    "lime accent-3",
                    "lime accent-4",
                    "yellow",
                    "yellow lighten-5",
                    "yellow lighten-4",
                    "yellow lighten-3",
                    "yellow lighten-2",
                    "yellow lighten-1",
                    "yellow darken-1",
                    "yellow darken-2",
                    "yellow darken-3",
                    "yellow darken-4",
                    "yellow accent-1",
                    "yellow accent-2",
                    "yellow accent-3",
                    "yellow accent-4",
                    "amber",
                    "amber lighten-5",
                    "amber lighten-4",
                    "amber lighten-3",
                    "amber lighten-2",
                    "amber lighten-1",
                    "amber darken-1",
                    "amber darken-2",
                    "amber darken-3",
                    "amber darken-4",
                    "amber accent-1",
                    "amber accent-2",
                    "amber accent-3",
                    "amber accent-4",
                    "orange",
                    "orange lighten-5",
                    "orange lighten-4",
                    "orange lighten-3",
                    "orange lighten-2",
                    "orange lighten-1",
                    "orange darken-1",
                    "orange darken-2",
                    "orange darken-3",
                    "orange darken-4",
                    "orange accent-1",
                    "orange accent-2",
                    "orange accent-3",
                    "orange accent-4",
                    "deep-orange",
                    "deep-orange lighten-5",
                    "deep-orange lighten-4",
                    "deep-orange lighten-3",
                    "deep-orange lighten-2",
                    "deep-orange lighten-1",
                    "deep-orange darken-1",
                    "deep-orange darken-2",
                    "deep-orange darken-3",
                    "deep-orange darken-4",
                    "deep-orange accent-1",
                    "deep-orange accent-2",
                    "deep-orange accent-3",
                    "deep-orange accent-4",
                    "brown",
                    "brown lighten-5",
                    "brown lighten-4",
                    "brown lighten-3",
                    "brown lighten-2",
                    "brown lighten-1",
                    "brown darken-1",
                    "brown darken-2",
                    "brown darken-3",
                    "brown darken-4",
                    "blue-grey",
                    "blue-grey lighten-5",
                    "blue-grey lighten-4",
                    "blue-grey lighten-3",
                    "blue-grey lighten-2",
                    "blue-grey lighten-1",
                    "blue-grey darken-1",
                    "blue-grey darken-2",
                    "blue-grey darken-3",
                    "blue-grey darken-4",
                    "grey",
                    "grey lighten-5",
                    "grey lighten-4",
                    "grey lighten-3",
                    "grey lighten-2",
                    "grey lighten-1",
                    "grey darken-1",
                    "grey darken-2",
                    "grey darken-3",
                    "grey darken-4"]
                ,
                colorsValue: [
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

            // bus.$emit('atonprogress:on');

            this.configAtual = this.$store.state.auth.userAtivo.config;

            self.loadItemEdit();

            // bus.$emit('atonprogress:off');
        },

        methods: {
            remove (item) {
                let idx = _.findIndex(this.dadosDB.plugins, {'value': item.value}); // this.$logDebug('idx= ' + idx);

                if (idx >= 0) this.dadosDB.plugins.splice(idx, 1);
            },

            setCorPreview: function(payload, tipo = 'all'){
                if (payload){
                    this.atualizaCoresPreview();
                } else{
                    this.$nextTick(function () {
                        this.redefinePadraoCores(tipo);
                    });
                }

            },

            atualizaCoresPreview: function (Aconf = null) {
                // let self = this;

                let cf = this.dadosDB;

                if (Aconf) {
                    cf = Aconf;
                }

                this.$store.dispatch('SetUserConfig', cf);
                bus.$emit('update:config', cf); // atualiza dados de referencia para validar no form base alterações de dados
            },

            redefinirTudo: function () {
                this.redefinePadraoCores('all');
                this.redefinePadraoTemas('all');
            },
            redefinePadraoTemas: function (tipo = 'all') {
                let foiEditado = false;
                if ((tipo == 'fundo') || (tipo == 'all')) {
                    this.dadosDB.tema_fundo = this.$configPadraoManager.tema_fundo;
                    foiEditado = true;
                }
                ;
                if ((tipo == 'forms') || (tipo == 'all')) {
                    this.dadosDB.tema_formularios = this.$configPadraoManager.tema_formularios;
                    foiEditado = true;
                }

                if (foiEditado) {
                    this.atualizaCoresPreview();
                }
            },
            redefinePadraoCores: function (tipo = 'all') {
                let foiEditado = false;
                if ((tipo == 'primary') || (tipo == 'all')) {
                    this.dadosDB.primaryColorModel = this.$configPadraoManager.primaryColorModel;
                    foiEditado = true;
                }
                ;
                if ((tipo == 'secundary') || (tipo == 'all')) {
                    this.dadosDB.secundaryColorModel = this.$configPadraoManager.secundaryColorModel;
                    foiEditado = true;
                }

                if (foiEditado) {
                    this.atualizaCoresPreview();
                }
            },

            loadItemEdit: function () {
                let self = this;
                // self.activesAjax++;
                bus.$emit('atonprogress:on');
                this.loading = true;
                this.$http.get('/admin/usuario/config')
                    .then(response => {
                        self.loading = false;
                        self.dadosDB = response.data;

                        // self.dadosDB.tema_formularios = response.data.tema_formularios ? response.data.tema_formularios : 'Claro';
                        // self.dadosDB.tema_fundo = response.data.tema_fundo ? response.data.tema_fundo : 'Escuro';

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        // bus.$emit('update:config', response.data); // atualiza dados de referencia para validar no form base alterações de dados

                        // bus.$emit('atonprogress:off'); // colocado no mounted
                    })
                    .catch(error => {
                        console.log(error.response);
                        self.loading = false;
                        self.errors = error.response.data;
                        // bus.$emit('atonprogress:off');
                    }).finally(() => {
                    bus.$emit('atonprogress:off');
                });
            },

            voltaView: function (atualizaConfig = false) {
                bus.$emit('atonprogress:off');
                if (atualizaConfig) {
                    this.atualizaCoresPreview(this.configAtual);
                }
                this.voltaViewFrom('/admin');
                // this.$router.go(-1);
            },

            callPost: function () {
                if (this.loading) return false;

                var self = this;
                this.loading = true;
                this.inError = false;

                let _url = '/admin/usuario/config';


                bus.$emit('atonprogress:on', 'Atualizando dados');

                var novaConf = self.dadosDB;

                this.$http.post(_url, novaConf)
                    .then(response => {
                        self.loading = false;

                        let msg = response.data;

                        bus.$emit('afterPost'); // atualiza dados de referencia para validar no form base alterações de dados

                        bus.$emit('atonmsg', 'success', msg);

                        console.log('novaConf');
                        console.log(novaConf);

                        self.$store.dispatch('SetUserConfig', novaConf);

                        bus.$emit('update:config', novaConf); // atualiza dados de referencia para validar no form base alterações de dados
                        // bus.$emit('update:config', this.dadosDB); // atualiza dados de referencia para validar no form base alterações de dados
                        self.voltaView(false);
                    })
                    .catch(error => {
                        bus.$emit('atonprogress:off');
                        bus.$emit('atonmsg', 'error', 'Dados não foram inseridos');

                        self.loading = false;
                        self.inError = true;
                        self.errors = error.response.data.errors;
                    });
            },
        }
    }
</script>

<style>
</style>