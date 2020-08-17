<template>

    <helper-offset
      v-if="hasOffset"
      :inline="inline"
      :full-width="fullWidth"
      :offset="offset"
    >
      <v-card
        v-if="!$slots.offset"
        :color="color"
        :class="`'v-card--material__header d-inline ' + elevation-${elevation}`"


        v-bind="$attrs"
        :style="styles"
        v-on="$listeners"

        dark
      >
        <slot
          v-if="!title && !text"
          name="header"
        />

        <span v-else>
          <h4
            class="title font-weight-light"
            v-text="title"
          />
          <p
            class="category font-weight-thin"
            v-text="text"
          />
        </span>
        <slot name="option">

        </slot>
      </v-card>
      <slot
        v-else
        name="offset"
      />
    </helper-offset>
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
      default: 10
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
      default: 0
    },
    title: {
      type: String,
      default: undefined
    },
    text: {
      type: String,
      default: undefined
    }
  },

  computed: {
    hasOffset () {
      return this.$slots.header ||
        this.$slots.offset ||
        this.$slots.option ||
        this.title ||
        this.text
    },
    styles () {
      if (!this.hasOffset) return null

      return {
        // marginBottom: `${this.offset}px`,
        marginTop: `${this.offset * 2}px`
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
