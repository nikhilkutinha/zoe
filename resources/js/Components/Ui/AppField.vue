<template>
  <div>
    <template v-if="$slots.label">
      <slot name="label" />
    </template>
    <label
      v-else
      :for="for"
      class="font-medium text-sm text-gray-700 mb-1 block"
    >{{ label }}</label>
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      required: false
    },
    for: {
      type: String,
      required: false
    }
  }
}
</script>

<style></style>
