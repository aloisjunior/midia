<script>
    // import bus from '../../modules/events/bus';

    export default {
        data() {
            return {
                name: 'aton-base-theme',

            }
        },

        beforeCreate(){
            this.$vuetify.theme.primary = "#146b68";
            this.$vuetify.theme.secondary = "#ff8c80";
            this.$vuetify.theme.accent = "#9c27b0";
            this.$vuetify.theme.error = "#f44336";
            this.$vuetify.theme.warning = "#ffeb3b";
            this.$vuetify.theme.info = "#2196f3";
            this.$vuetify.theme.success = "#4caf50";
        },
    }
</script>

<template>
</template>

<style>
</style>

<comments>
    /*
    para uso com este template é necessário os componentes serem envolvidos com a tag form
    <v-form v-model="this.formCtrl" ref="form" lazy-validation>

    */
</comments>