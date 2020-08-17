<script>
    import bus from '../../modules/events/bus';
    import storageLocal from '../../mixins/storageLocal';
    // import AtonFormBase from '../../modules/components/aton-base-form';

    export default {
        mixins: [storageLocal,
                // AtonFormBase
        ],
        name: 'aton-permissions',
        data() {
            return {

                loading:false,
                _permissionBase: '',
                // permissions:[],


            }
        },

        mounted() {

        },

        methods: {
            loadPermissions2: function(force = false){
                return this.loadPermissions(force);
            },
            loadPermissions: function (force = false) {
                // this.$logDebug('load permissions chamado');

                if (!force){
                    if (this.permissions.length > 0){
                        this.$logDebug('permissões não foram carregadas, já existente');
                        return false;
                    }
                }


                let self = this;
                this.loading = true;
                this.$http.get('/api/i/usuario/permissions_v1')
                    .then(response => {
                        this.loading = false;
                        // this.permissions = response.data.acessos;

                        this.access = response.data.acessos;

                        var tmpuserAtivo = response.data.usuario;
                        // this.$logDebug('recebido usuario abaixo');
                        // this.$logDebug(tmpuserAtivo);
                        this.$store.dispatch('SetUser', tmpuserAtivo);

                        this.addStorageLocal('acessos', response.data.acessos);

                        var _conf = tmpuserAtivo.config;
                        var _userId = tmpuserAtivo.id;

                        bus.$emit('update:config', _conf );

                        // bus.$emit('userId-update', _userId);

                        bus.$emit('user:refresh', _userId);

                        return true;
//                        this.$logDebug('setado permissões nova');
//                        return this.permissions;
                    })
                    .catch(error => {
                        this.$logDebug(error.response);
                        this.loading = false;
                        return false;
                    });

            },
            // can: function (permission) {
            //     return ((this.permissions) &&  this.permissions.indexOf(permission) > -1);
            // },


        },

        // watch: {
        //     permissions: function (newV, oldV) {
        //         if (newV !== oldV) {
        //             let self = this;
        //         }
        //     },
        // },

        computed: {
            hasIndex: function () {
                return this.$can(this._permissionBase+'-index');
            },
            hasStore: function () {
                return this.$can(this._permissionBase+'-store');
            },
            hasUpdate: function () {
                return this.$can(this._permissionBase+'-update');
            },
            hasDestroy: function () {
                return this.$can(this._permissionBase+'-destroy');
            },

            // permissions: function () {
            //     return this.access;
            // },

        }
    }
</script>

<template>
</template>

<style >

</style>