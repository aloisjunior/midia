<script>
    export default {
        props: {
            openDialog: {
                default: false,
                type: Boolean,
            },
            playerId: {
                default: 0,
                type: Number,
            },
            texto: {
                default: 'Deseja excluir este registro?',
                type: String
            },
        },

        data() {
            return {
                name: 'aton-dialog',
            }
        },
        methods: {
            setOk: function () {
                this.$emit('setOk');
                this.setCancel();
            },
            setCancel: function () {
                this.$emit('setCancel', false);
            },
        },
    }
</script>

<template>
    <v-dialog
            v-model="openDialog"
            persistent
            max-width="300px"
    >
        <v-card
                @keyup.esc.prevent="setCancel()"
                @keyup.enter.prevent="setOk()"
        >

            <v-card-text ligth class="body-2">

                <v-icon x-large>help</v-icon>


                    {{ texto }}

            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="green--text" @click="setCancel()">Cancelar</v-btn>
                <v-btn class="red--text" @click="setOk()">Sim</v-btn>
            </v-card-actions>
        </v-card>

    </v-dialog>
</template>

<style scoped="">

</style>