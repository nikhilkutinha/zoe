<template>
  <div class="px-6 py-5 bg-white shadow sm:rounded-lg">
    <jet-section-title>
      <template #title>
        <slot name="title" />
      </template>
      <template #description>
        <slot name="description" />
      </template>
    </jet-section-title>
    <div class="mb-1 mt-6">
      <slot name="content" />
    </div>
  </div>
</template>

<script>
import JetSectionTitle from '@/Jetstream/SectionTitle'

export default {
  components: {
    JetSectionTitle
  }
}
</script>
