<template>
    <v-card
            v-bind="$attrs"
            v-on="$listeners"
            :color="color"
            :dark="!this.$parent.isModeDarkForms"
            :light="this.$parent.isModeDarkForms"
            class="elevation-1">

        <v-card-text v-if="$slots.default">
            <slot/>
        </v-card-text>

        <v-divider
                v-if="$slots.actions"

        />

        <v-card-actions v-if="$slots.actions"
                        :style="styles"
                        class="customActionsSearchBox align-center">
            <slot name="actions"/>
        </v-card-actions>

    </v-card>
</template>

<script>
    export default {
        inheritAttrs: false,

        props: {
            color: {
                type: String,
                default: 'secondary'
            },
            elevation: {
                type: [Number, String],
                default: 0
            },
            height: {
                type: [Number, String],
                default: 55
            },
            inline: {
                type: Boolean,
                default: false
            },
            fullWidth: {
                type: Boolean,
                default: false
            },
            offset: {
                type: [Number, String],
                default: 12
            },
            title: {
                type: String,
                default: undefined
            },
            text: {
                type: String,
                default: undefined
            },
            dark: {
                type: Boolean,
                default: false
            },
            light: {
                type: Boolean,
                default: false
            }
        },

        // data() {
        //     return {
        //     }
        // },
        computed:
            {
                // hasOffset() {
                //     return this.$slots.header ||
                //         this.$slots.offset ||
                //         this.$slots.option ||
                //         this.title ||
                //         this.text
                // }
                // ,
                styles() {
                    return {
                        // marginBottom: `${this.offset}px`,
                        // height: `${this.height}px`
                    }
                }
            }
    }
</script>


