<script>
import { provide, computed, ref } from 'vue'

export default {
  name: 'Tabs',
  props: {
    modelValue: {
      type: [String, Number],
      default: 0
    }
  },
  emits: ['update:modelValue'],

  setup (props, { slots, emit }) {
    const active = ref(props.modelValue)
    const tabs = ref([])

    function selectTab (tab) {
      active.value = tab
      emit('update:modelValue', tab)
    }

    provide('tabsState', {
      active,
      tabs
    })

    return {
      tabs,
      active,
      selectTab
    }
  }
}
</script>

<template>
  <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
      <nav
        class="
          cursor-pointer
          bg-white
          divide-y divide-gray-200
          border border-gray-200
          shadow
          rounded
        "
      >
        <a
          v-for="(tab, i) of tabs"
          :key="i"
          :href="tab.href"
          class="px-4 py-3 block hover:bg-gray-50"
          :class="{ 'bg-blue-50 text-blue-500': active == i }"
          @click="selectTab(i)"
        >{{ tab.props.title }}</a>
      </nav>
    </div>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
      <slot />
    </div>
  </div>

  <!-- <ul class="flex space-x-2">
    <li
      v-for="(tab, i) of tabs"
      :key="i"
      :class="
        active === i
          ? 'border-b-4 border-green-500 box-content text-gray-800'
          : 'border-b-2 border-white text-gray-500'
      "
      class="flex items-center px-6 py-3 rounded-tl-md rounded-tr-md overflow-hidden cursor-pointer hover:text-gray-800"
      @click="selectTab(i)"
    >
      {{ tab.props.title }}
    </li>
  </ul>
  <div class="bg-gray-300 -m-1 h-1"></div>
  <div class="mt-6">

  </div> -->
</template>
