<template>
  <inertia-link
    :href="href"
    :class="classes"
  >
    <slot />
  </inertia-link>
</template>

<script>
export default {
  props: ['href', 'active'],

  computed: {
    classes () {
      return this.active
        ? 'inline-flex items-center px-1 pt-1 border-b-[3px] border-blue-500 text-sm font-medium leading-5 text-white focus:text-white transition'
        : 'inline-flex items-center px-1 pt-1 border-b-[3px] border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-blue-500 focus:text-white transition'
    }
  }
}
</script>
