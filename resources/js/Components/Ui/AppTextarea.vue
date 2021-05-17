<template>
  <div class="w-full">
    <div class="flex relative items-center">
      <textarea
        class="border-gray-300 rounded shadow-inner focus:ring focus:ring-opacity-50"
        :class="[
          error
            ? 'border-red-500 focus:border-red-500 focus:ring-red-300'
            : 'focus:border-blue-300 focus:ring-blue-300',
        ]"
        :value="modelValue"
        v-bind="$attrs"
        @input="$emit('update:modelValue', $event.target.value)"
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
export default {
  inheritAttrs: false,
  props: {
    modelValue: {
      type: String
    },

    error: {
      type: String
    }
  },
  emits: ['update:modelValue']
}
</script>
