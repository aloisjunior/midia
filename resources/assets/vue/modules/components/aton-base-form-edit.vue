<script>
    import bus from '../../modules/events/bus';
    // import AtonCssLoader from '../components/comum/aton-css-loader.vue';
    import AtonBaseForm from './aton-base-form.vue';

    export default {
        mixins:[
            // AtonCssLoader,
            AtonBaseForm,
        ],

        data() {
            return {
                name: 'aton-base-form-edit',
                formCtrl: false,
                errors: [],
                inError: false,
                itemSelected:{},
                loading_extras: false,


                isReadOnlyValue: false,
            }
        },

        watch: {
            loading: function (newValue, oldValue) {
                if ((newValue) || (this.loading_extras)) {
                    bus.$emit('atonprogress:open');
                }else if ((!newValue) && (!this.loading_extras)) {
                    bus.$emit('atonprogress:close');
                }
            },
            loading_extras: function (newValue, oldValue) {
                if ((newValue) || (this.loading)) {
                    bus.$emit('atonprogress:open');
                }else if ((!newValue) && (!this.loading)) {
                    bus.$emit('atonprogress:close');
                }
            }
        },

        mounted(){
            let self = this;
            bus.$on('afterPost', () => self.afterPost());

            if (this.isAdd){
                this.afterPost();
            // } else if (this.isEdit){
            //     bus.$emit('atonprogress:start');
            }
        },

        beforeDestroy(){
           // if (!this.loading){
               bus.$emit('atonprogress:close');
           // }
        },

        // beforeRouteLeave(to, from, next) {
        //     if (JSON.stringify(this.dadosDB) != JSON.stringify(this.dadosDBOriginal)) {
        //
        //         let answer = window.confirm('Você quer mesmo sair? Existem dados não salvos!');
        //         if (answer) {
        //             next();
        //         } else {
        //             return next(false);
        //         }
        //     }else{
        //         next();
        //     }
        // },

        methods: {
            avisaChangeForm: function () {
//                if (JSON.stringify(this.dadosDB) != JSON.stringify(this.dadosDBOriginal)){
                    return "Existe dados não salvo, cancelar alterações?";
//                }
            },
            setDadosDB: function (val) {
                this.dadosDB = val;
//                if (this.dadosDBOriginal == []){
                    this.dadosDBOriginal = JSON.parse(JSON.stringify(this.dadosDB));
//                }
            },

            // getTitulo: function (titulo) {
            //     return this._getTitulo(titulo);
            // },
            // formatDate(date) {
            //     return this._formatDate(date);
            // },
            // parseDate(date) {
            //     return this._parseDate(date);
            // },
        },
        computed: {
            isEdit: function () {
                return this.mode == 'edit';
            },
            isAdd: function () {
                return this.mode == 'add';
            },
            isReadOnly: function () {
                return this.isReadOnlyValue;
            },
        }

    }
</script>

<template>
</template>

<style>
    .div-progress{
        height: 3px;
        margin-top: -12px;
    }

    .progress-linear {
        margin: 0px;
    }
</style>

<comments>
    /*
    para uso com este template é necessário os componentes serem envolvidos com a tag form
    <v-form v-model="this.formCtrl" ref="form" lazy-validation>

    */
</comments>