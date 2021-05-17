<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    class="rounded-sm border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
  >
</template>

<script>
export default {

  props: {
    checked: {
      type: [Array, Boolean],
      default: false
    },
    value: {
      default: null
    }
  },
  emits: ['update:checked'],

  computed: {
    proxyChecked: {
      get () {
        return this.checked
      },

      set (val) {
        this.$emit('update:checked', val)
      }
    }
  }
}
</script>
