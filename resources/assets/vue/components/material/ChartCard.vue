<template>
    <material-card
            v-bind="$attrs"
            class="v-card--material-chart"
            v-on="$listeners"
            :dark="_isdark"
            :light="_islight"
    >
        <chartist
                slot="header"
                :data="data"
                :event-handlers="eventHandlers"
                :options="options"
                :ratio="ratio"
                :responsive-options="responsiveOptions"
                :type="type"
        />


        <slot v-if="!$slots.extra"/>

        <slot   v-else
                slot="extra"
                name="extra"/>


        <slot
                slot="actions"
                name="actions"
        />
    </material-card>
</template>

<script>
    export default {
        inheritAttrs: false,

        props: {
            data: {
                type: Object,
                default: () => ({})
            },
            eventHandlers: {
                type: Array,
                default: () => ([])
            },
            options: {
                type: Object,
                default: () => ({})
            },
            ratio: {
                type: String,
                default: undefined
            },
            responsiveOptions: {
                type: Array,
                default: () => ([])
            },
            type: {
                type: String,
                required: true,
                validator: v => ['Bar', 'Line', 'Pie'].includes(v)
            }
        },
        computed:
            {
                _isdark() {
                    return _.includes(this.$store.state.auth.userAtivo.config.tema_formularios, 'Escuro');
                },
                _islight() {
                    return !_.includes(this.$store.state.auth.userAtivo.config.tema_formularios, 'Escuro');
                }

            }
    }
</script>

<style lang="scss">
    .v-card--material-chart {
        .v-card--material__header {

            .ct-chart-pie .ct-label,
            .ct-chart-donut .ct-label {
                fill: white !important;
                color: white !important;
            }


            .ct-label {
                color: inherit;
                opacity: .7;
                font-size: 0.975rem;
                font-weight: 100;
            }

            .ct-grid {
                stroke: rgba(255, 255, 255, 0.2);
            }
            .ct-series-a .ct-point,
            .ct-series-a .ct-line,
            .ct-series-a .ct-bar,
            /*.ct-series-a .ct-slice-donut {*/
            .ct-series-a {
                stroke: rgba(255, 255, 255, .8);
            }
            .ct-series-a .ct-slice-pie,
            .ct-series-a .ct-area {
                fill: rgba(255, 255, 255, .4);
            }

            .ct-square {
                /*float: unset !important;*/
                display: flex; // ajusta tamanho do componente no grid

            }


        }
    }
</style>
