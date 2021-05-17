<template>
  <tr class="odd:bg-gray-50 even:bg-white">
    <td class="px-6 py-4 whitespace-nowrap align-top">
      <a
        class="text-gray-900"
        target="_blank"
        :href="`//${link.address}`"
      >
        {{ link.address }}
      </a>
    </td>

    <td class="px-6 py-4 align-top">
      <p class="text-gray-900">
        {{ link.destination }}
      </p>
      <p
        v-if="link.description"
        class="mt-3 text-gray-500"
      >
        {{ link.description }}
      </p>
    </td>

    <td class="px-6 py-4 whitespace-nowrap align-top">
      <div class="flex justify-end">
        <span class="text-gray-900">
          {{ relativeTime(link.created_at) }}
        </span>
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap align-top">
      <div class="flex items-center justify-end space-x-2">
        <inertia-link :href="route('links.show', { link: link.id })">
          <eye-icon class="w-5 h-6 text-blue-500" />
        </inertia-link>

        <button
          class="focus:outline-none"
          @click="$emit('edit', link)"
        >
          <pencil-icon class="w-5 h-6 text-blue-500" />
        </button>

        <button
          class="focus:outline-none"
          @click="$emit('delete', link)"
        >
          <trash-icon class="w-5 h-6 text-blue-500" />
        </button>
      </div>
    </td>
  </tr>
</template>

<script>
import { relativeTime } from '@/utils/filters'
import { EyeIcon, PencilIcon, TrashIcon } from '@heroicons/vue/outline'

export default {
  name: 'LinkListItem',
  components: {
    EyeIcon,
    PencilIcon,
    TrashIcon
  },

  props: {
    link: {
      type: Object,
      required: true
    }
  },

  methods: {
    relativeTime
  }
}
</script>
