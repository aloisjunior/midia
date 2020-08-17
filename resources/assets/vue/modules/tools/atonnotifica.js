import Vue from 'vue';



const bus = new Vue({
    name: 'AtonApp',
    data() {
        return {
            mensage: 'Olá mensagem Vue',
        }
    },
    components: {
    },
    mounted() {
        console.log('componente notifica creado')
    },
    methods: {
        swal: function () {
            this
        }
    }
});
export default bus;