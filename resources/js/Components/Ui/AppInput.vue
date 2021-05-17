<template>
  <div>
    <div class="flex relative items-center">
      <input
        v-bind="$attrs"
        ref="input"
        class="border-gray-300 rounded shadow-inner focus:ring focus:ring-opacity-50"
        :class="[
          error
            ? 'border-red-500 focus:border-red-500 focus:ring-red-300'
            : 'focus:border-blue-300 focus:ring-blue-300',
        ]"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
      >

      <exclamation-circle-icon
        v-if="error"
        class="text-red-500 absolute right-2 h-5 w-5"
      />
    </div>

    <p
      v-if="error"
      class="text-red-500 mt-1 text-sm"
    >
      {{ error }}
    </p>
  </div>
</template>

<script>
import { ExclamationCircleIcon } from '@heroicons/vue/outline'

export default {
  components: {
    ExclamationCircleIcon
  },
  inheritAttrs: false,

  props: {
    modelValue: {
      type: String
    },

    error: {
      type: String
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
