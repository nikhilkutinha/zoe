<template>
  <div>
    <form @submit.prevent="$emit('submitted')">
      <div
        class="px-6 py-5 bg-white shadow"
        :class="
          hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'
        "
      >
        <jet-section-title>
          <template #title>
            <slot name="title" />
          </template>
          <template #description>
            <slot name="description" />
          </template>
        </jet-section-title>
        <div class="mb-2 mt-6">
          <slot name="form" />
        </div>
      </div>

      <div
        v-if="hasActions"
        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
      >
        <slot name="actions" />
      </div>
    </form>
  </div>
</template>

<script>
import JetSectionTitle from '@/Jetstream/SectionTitle'

export default {

  components: {
    JetSectionTitle
  },
  emits: ['submitted'],

  computed: {
    hasActions () {
      return !!this.$slots.actions
    }
  }
}
</script>
