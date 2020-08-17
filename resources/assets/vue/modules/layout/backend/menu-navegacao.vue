<template>
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="pathInicio">Admin/</a></li>
        <div v-for="item in itens">
            <li class="breadcrumb-item" >{{item}} / </li>
        </div>
    </ol>
</template>

<script>
    import bus from '../../../modules/events/bus';
    export default {
        data () {
            return {
                name: 'aton-menu-navegacao',
                show: true,
                itens:['Inicio', 'Cadastros', 'Usuarios'],
//                pathInicio: _pathInicio,
            }
        },
        mounted() {
//           cria evento para capturar se deve exibir componente
            bus.$on('set-path-navegacao', (value) => self.alterarNav(value));
        },
        methods: {
            alterarNav: function (value) {
                this.itens = valeu;
            }

        }
    }
</script>
