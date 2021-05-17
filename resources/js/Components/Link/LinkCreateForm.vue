<template>
  <div>
    <app-button
      accent="primary"
      @click="openModal"
    >
      Create link
    </app-button>
    <app-modal
      :open="isOpen"
      @close="closeModal"
    >
      <template #header>
        Create link
      </template>

      <template #default>
        <form
          id="createLinkForm"
          class="space-y-4"
          @submit.prevent="createLink"
        >
          <app-field
            for="destination"
            label="Destination"
          >
            <app-input
              id="destination"
              v-model="form.destination"
              :error="form.errors.destination"
              autocomplete="off"
              class="w-full"
              required
              type="text"
            />
          </app-field>

          <app-field
            for="description"
            label="Description"
          >
            <app-textarea
              id="description"
              v-model="form.description"
              :error="form.errors.description"
              class="w-full"
              rows="5"
            />
          </app-field>
        </form>
      </template>

      <template #footer>
        <app-button
          accent="primary"
          class="mb-3 sm:ml-3 sm:mb-0 w-full sm:w-auto"
          type="submit"
          form="createLinkForm"
        >
          Create
        </app-button>
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
  </div>
</template>

<script>
import { useModal } from '@/Hooks/Modal'
import AppInput from '@/Components/Ui/AppInput'
import AppField from '@/Components/Ui/AppField'
import AppTextarea from '@/Components/Ui/AppTextarea'
import AppButton from '@/Components/Ui/AppButton'
import AppModal from '@/Components/Ui/AppModal'

export default {
  components: {
    AppField,
    AppInput,
    AppTextarea,
    AppButton,
    AppModal
  },

  setup () {
    const { isOpen, openModal, closeModal } = useModal()
    return {
      isOpen,
      openModal,
      closeModal
    }
  },

  data () {
    return {
      form: this.$inertia.form({
        destination: '',
        description: ''
      })
    }
  },

  methods: {
    createLink () {
      this.form.post(route('links.store'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onFinish: () => this.form.reset()
      })
    }
  }
}
</script>
