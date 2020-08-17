<script>
    export default {
        name: 'storageLocal',
        data() {
            return {
                itensCache: this.fetch(),
                STORAGE_KEY: 'acl-artech',
                isLocal: true,
            }
        },
        watch: {
            itensCache: {
                handler: function (itensCache) {
                    this.save(itensCache);
                }
            }
        },
        // computed: {
        //     // filteredTodos: function () {
        //     //     return filters[this.visibility](this.itensCache);
        //     // }
        // },
        methods: {
            fetch: function () {
                if (this.isLocal) {
                    var itensCache = JSON.parse(localStorage.getItem(this.STORAGE_KEY) || '[]');
                    return (itensCache);
                } else {
                    var itensCache = JSON.parse(sessionStorage.getItem(this.STORAGE_KEY) || '[]');
                    return (itensCache);
                }

            },
            save: function (itensCache) {
                // this.$logDebug(itensCache);
                if (this.isLocal) {
                    // localStorage.setItem(this.STORAGE_KEY, (JSON.stringify(itensCache)));
                    localStorage.setItem(this.STORAGE_KEY, btoa(JSON.stringify(itensCache)));
                } else {
                    sessionStorage.setItem(this.STORAGE_KEY, (JSON.stringify(itensCache)));
                }

            },
            addStorageLocal: function (name, value) {
                // this.$logDebug('valor emaddStoreLocal');
                // this.$logDebug(value);
                var tmpVal = JSON.parse('{"' + name + '":' + JSON.stringify(value) + '}');
                //
                // this.$logDebug(tmpVal);
                let idx = _.findIndex((this.itensCache), _.property(name) );
                // this.$logDebug('idx= ' + idx);
                if (idx > -1){
                    this.deleteStorageLocal(idx);
                    // this.$logDebug('pos delete= ' + this.itensCache);
                }

                // this.$nextTick(
                //     function(){
                        this.itensCache.push(tmpVal);
                    // }
                // );
                // this.inputVal = '';
            },
            deleteStorageLocal: function (index) {
                this.$delete(this.itensCache, index)
            },

            // filterTodos: function (filter) {
            //     this.visibility = filter;
            // },
        }
    }

    // var filters = {
    //     all: function (itensCache) {
    //         return itensCache;
    //     },
    //     complete: function (itensCache) {
    //         return itensCache.filter(function (todo) {
    //             return todo.complete;
    //         });
    //     },
    //     incomplete: function (itensCache) {
    //         return itensCache.filter(function (todo) {
    //             return !todo.complete;
    //         });
    //     }
    // };

</script>