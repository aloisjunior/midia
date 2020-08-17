<template>
    <v-btn
            v-bind="$attrs"
            v-on="$listeners"
            :color="color"

            class="blue--text darken-1"
            @click="voltaView">
        <v-icon left>mdi-close</v-icon>
        <slot>
            {{text}}
        </slot>
    </v-btn>
</template>

<script>
    import bus from '../../modules/events/bus';
    import AtonBaseForm from '../../modules/components/aton-base-form.vue';

    export default {
        mixins: [
            // AtonCssLoader,
            AtonBaseForm,
        ],
        inheritAttrs: false,

        props: {
            color: {
                type: String,
                default: 'secondary darken-2'
            },

            inline: {
                type: Boolean,
                default: false
            },
            fullWidth: {
                type: Boolean,
                default: false
            },
            dark: {
                type: Boolean,
                default: false
            },
            light: {
                type: Boolean,
                default: false
            },
            text: {
                type: String,
                default: "Fechar"
            },
            // backRoutePath:{
            //     type: String,
            //     default: "/admin"
            // },
        },

        methods:{
            voltaView: function (atualizaConsulta) {
                bus.$emit('atonprogress:off');

                this.voltaViewFrom(this.backRoutePath);
            },
        },
    }
</script>

<style lang="scss">
    /*.v-card--material {*/
        /*&__header {*/
            /*&.v-card {*/
                /*border-radius: 4px;*/
            /*}*/
        /*}*/
    /*}*/
</style>
