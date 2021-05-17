<template>
  <button
    :type="type"
    :class="colorClass"
    class="
      flex
      justify-center
      border
      rounded
      shadow-sm
      text-sm
      font-medium
      disabled:cursor-not-allowed
      focus:outline-none
      focus:ring
      py-2.5
      px-4
    "
  >
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'submit'
    },
    accent: {
      type: String,
      default: 'primary'
    }
  },
  computed: {
    colorClass () {
      return {
        primary:
          'bg-blue-500 border-transparent text-white hover:bg-blue-600 focus:ring-opacity-50 focus:ring-blue-300',
        danger:
          'bg-red-500 border-transparent text-white hover:bg-red-600 focus:border-red-300 focus:ring-red-200',
        secondary:
          'bg-gray-800 border-transparent text-white hover:bg-gray-900 focus:ring-gray-300',
        light:
          'bg-white border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-opacity-50 focus:border-blue-300 focus:ring-blue-300'
      }[this.accent]
    }
  }
}
</script>
