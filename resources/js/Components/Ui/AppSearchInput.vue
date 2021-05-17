<template>
  <div class="inline-flex relative items-center w-full md:w-auto">
    <input
      v-bind="$attrs"
      ref="input"
      class="w-full border-gray-300 rounded shadow-inner focus:ring focus:ring-opacity-50 focus:border-blue-300 focus:ring-blue-200"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    >

    <search-icon class="w-5 h-5 text-gray-500 absolute right-2" />
  </div>
</template>

<script>
import { SearchIcon } from '@heroicons/vue/outline'

export default {
  components: {
    SearchIcon
  },

  inheritAttrs: false,

  props: {
    modelValue: {
      type: String,
      required: true
    }
  },
  emits: ['update:modelValue'],

  methods: {
    focus () {
      this.$refs.input.focus()
    }
  }
}
</script>
