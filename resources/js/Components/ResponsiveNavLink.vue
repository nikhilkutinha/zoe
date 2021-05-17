<template>
  <div>
    <button
      v-if="as == 'button'"
      :class="classes"
      class="w-full text-left focus:outline-none"
    >
      <slot />
    </button>

    <inertia-link
      v-else
      :href="href"
      :class="classes"
    >
      <slot />
    </inertia-link>
  </div>
</template>

<script>
export default {
  props: ['active', 'href', 'as'],

  computed: {
    classes () {
      return this.active
        ? 'block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-white bg-gray-700 transition'
        : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 hover:border-blue-500 transition'
    }
  }
}
</script>
