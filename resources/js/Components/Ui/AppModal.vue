<template>
  <TransitionRoot
    :after-leave="startTransitioning"
    :before-leave="stopTransitioning"
    :show="open"
    as="template"
  >
    <Dialog
      :open="isDialogOpen"
      as="div"
      class="fixed inset-0 overflow-y-auto z-10"
      static
      @close="$emit('close')"
    >
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild
          enter="ease-out duration-200"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-150"
          leave-from="opacity-100"
          leave-to="opacity-0"
          as="template"
        >
          <DialogOverlay class="fixed inset-0 bg-black backdrop-filter backdrop-blur-sm bg-opacity-60 transition-opacity" />
        </TransitionChild>
        <span
          aria-hidden="true"
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
        >&#8203;</span>
        <TransitionChild
          enter="ease-out duration-200"
          enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to="opacity-100 translate-y-0 sm:scale-100"
          leave="ease-in duration-150"
          leave-from="opacity-100 translate-y-0 sm:scale-100"
          leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          as="template"
        >
          <div
            class="inline-block align-bottom bg-white rounded text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle w-full sm:max-w-lg sm:w-full"
          >
            <DialogTitle
              v-if="$slots.header"
              as="div"
              class="bg-gray-50 p-4 flex justify-between"
            >
              <h5 class="text-lg text-gray-900">
                <slot name="header" />
              </h5>
              <button
                class="focus:outline-none"
                type="button"
                @click="$emit('close')"
              >
                <x-icon class="w-5 h-5 text-gray-500" />
              </button>
            </DialogTitle>
            <DialogDescription class="p-4">
              <slot />
            </DialogDescription>
            <div
              v-if="$slots.footer"
              class="bg-gray-50 p-4 sm:flex sm:flex-row-reverse"
            >
              <slot name="footer" />
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import {
  Dialog,
  DialogTitle,
  DialogOverlay,
  DialogDescription,
  TransitionChild,
  TransitionRoot
} from '@headlessui/vue'

import { XIcon } from '@heroicons/vue/outline'

export default {
  components: {
    Dialog,
    DialogTitle,
    DialogOverlay,
    DialogDescription,
    TransitionChild,
    TransitionRoot,
    XIcon
  },

  props: {
    open: {
      type: Boolean,
      default: false
    }
  },

  data () {
    return {
      isTransitioning: false
    }
  },

  computed: {
    isDialogOpen () {
      return !(this.isTransitioning && this.open)
    }
  },

  methods: {
    startTransitioning () {
      this.isTransitioning = true
    },
    stopTransitioning () {
      this.isTransitioning = false
    }
  }
}
</script>
