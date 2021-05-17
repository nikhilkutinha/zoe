<template>
  <app-modal
    :open="open"
    @close="$emit('close')"
  >
    <template
      #default
    >
      <div class="p-2 sm:flex sm:items-start ">
        <div
          class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
        >
          <exclamation-icon
            aria-hidden="true"
            class="h-6 w-6 text-red-600"
          />
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
          <div
    
            class="text-lg leading-6 font-medium text-gray-900"
          >
            Delete link
          </div>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              Are you sure you want to delete this link? This action cannot be
              undone.
            </p>
          </div>
        </div>
      </div>
    </template>
    <template #footer>
      <form @submit.prevent="deleteLink">
        <app-button
          accent="danger"
          class="mb-3 sm:ml-3 sm:mb-0 w-full sm:w-auto"
          type="submit"
        >
          Delete
        </app-button>
      </form>

      <app-button
        accent="light"
        type="button"
        class="w-full sm:w-auto"
        @click="closeModal"
      >
        Cancel
      </app-button>
    </template>
  </app-modal>
</template>

<script>
import AppModal from '@/Components/Ui/AppModal'
import AppButton from '../Ui/AppButton'
import { ExclamationIcon } from '@heroicons/vue/outline'

export default {
  name: 'LinkDeleteForm',

  components: {
    AppModal,
    AppButton,
    ExclamationIcon
  },

  props: {
    link: {
      type: Object
    },
    open: {
      type: Boolean,
      default: false
    }
  },

  methods: {
    closeModal () {
      this.$emit('close')
    },
    deleteLink () {
      this.$inertia.delete(route('links.destroy', this.link.id), {
        preserveScroll: true,
        onSuccess: () => this.$emit('close')
      })
    }
  }
}
</script>
