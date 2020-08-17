

export default {
    data() {
        return {
            name:'atonStorage',
            atonStorage: {
                fetch: function () {
                    var itensCache = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                    return itensCache;
                },
                save: function (itensCache) {
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(itensCache));
                }
            },
            STORAGE_KEY: 'localStorage_Default',
        }
    }
    ,
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