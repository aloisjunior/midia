<template>
    <v-card
            v-bind="$attrs"
            :style="styles"
            v-on="$listeners"
            :dark="dark || this.$parent.isModeDarkForms"
            :light="light || !this.$parent.isModeDarkForms"


    >
        <helper-offset
                v-if="hasOffset"
                :inline="inline"
                :full-width="fullWidth"
                :offset="offset"
        >
            <v-card
                    v-if="!$slots.offset"
                    :color="color"
                    :class="`elevation-${elevation}`"
                    class="v-card--material__header"
                    dark
            >
                <slot
                        v-if="!title && !text"
                        name="header"
                />
                <v-layout v-else row wrap align-center class="mx-0 px-1">
                    <v-flex text-xs-left xs-2 sm-1 shrink v-show="$slots.optionLeft">
                        <slot name="optionLeft">
                        </slot>
                    </v-flex>
                    <v-flex >
                        <span
                                class="title font-weight-regular"
                                v-text="title"
                        />
                        <br>
                        <span
                                class="category font-weight-thin"
                                v-text="text"
                        />
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex text-xs-right v-show="$slots.option">
                        <slot name="option">
                        </slot>
                    </v-flex>
                </v-layout>
            </v-card>
            <slot
                    v-else
                    name="offset"
            />
        </helper-offset>

        <v-card-text v-if="!$slots.extra">
            <slot/>
        </v-card-text>

        <slot
                v-else
                name="extra"/>

        <v-divider
                v-if="$slots.actions"
                class="mx-3"
        />

        <v-card-actions v-if="$slots.actions" class="align-center row">
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
                hasOffset() {
                    return this.$slots.header ||
                        this.$slots.offset ||
                        this.$slots.option ||
                        this.title ||
                        this.text
                }
                ,
                styles() {
                    if (!this.hasOffset) return null

                    return {
                        // marginBottom: `${this.offset}px`,
                        marginTop: `${this.offset * 2 - 4}px`
                    }
                }
            }
    }
</script>

<style lang="scss">
    .v-card--material {
        &__header {
            &.v-card {
                border-radius: 4px;
            }
        }
    }
</style>
