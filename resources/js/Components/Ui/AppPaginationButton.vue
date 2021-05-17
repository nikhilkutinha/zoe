<template>
  <a
    href="#"
    class="inline-flex items-center justify-around p-2 h-10 w-10 min-w-max rounded focus:outline-none border border-gray-300"
    :class="classes"
    @click.prevent="page.click"
  >
    <slot>{{ page.number }}</slot>
  </a>
</template>

<script>
export default {
  name: 'AppPaginationButton',
  props: {
    page: {
      type: Object,
      required: true
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    isDisabled () {
      return this.disabled || this.page.disabled
    },

    isCurrent () {
      return this.page.isCurrent
    },

    classes () {
      return [
        this.isCurrent && !this.isDisabled ? 'bg-blue-500 border-blue-500 text-white' : '',
        this.isDisabled ? 'bg-transparent border-gray-300 text-gray-400 cursor-not-allowed' : 'hover:border-gray-400'
      ]
    }
  }
}
</script>

<!--<style scoped lang="scss">-->
<!--.current {-->
<!--  @apply bg-blue-500-->
<!--         border-blue-500-->
<!--         text-white;-->
<!--}-->

<!--.disabled {-->
<!--  @apply ;-->
<!--}-->
<!--</style>-->
