<template>
  <div
    class="py-5 px-6 rounded"
    :class="colorClass"
  >
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    accent: {
      type: String,
      default: 'primary'
    }
  },

  computed: {
    colorClass () {
      return {
        warning: 'bg-yellow-200 text-yellow-900',
        primary: 'bg-blue-200 text-blue-900'
      }[this.accent]
    }
  }
}
</script>
