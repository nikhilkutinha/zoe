<template>
  <div>
    <button
      v-if="as == 'button'"
      type="submit"
      class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
    >
      <slot />
    </button>

    <a
      v-else-if="as =='a'"
      :href="href"
      class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
    >
      <slot />
    </a>

    <inertia-link
      v-else
      :href="href"
      class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
    >
      <slot />
    </inertia-link>
  </div>
</template>

<script>
export default {
  props: ['href', 'as']
}
</script>
