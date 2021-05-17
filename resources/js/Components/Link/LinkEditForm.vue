<template>
    <app-modal
      :open="open"
      @close="closeModal"
    >
      <template #header>
        Edit {{ link.address }}
      </template>

      <template #default>
        <form
          id="editLinkForm"
          class="space-y-4"
          @submit.prevent="editLink"
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
          form="editLinkForm"
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

</template>

<script>
import AppInput from '@/Components/Ui/AppInput'
import AppField from '@/Components/Ui/AppField'
import AppTextarea from '@/Components/Ui/AppTextarea'
import AppButton from '@/Components/Ui/AppButton'
import AppModal from '@/Components/Ui/AppModal'

export default {
  components: {
    AppInput,
    AppTextarea,
    AppButton,
    AppModal,
    AppField
  },

  props: {
    link: {
      type: Object,
      required: true
    },
    open: {
      type: Boolean,
      required: true
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

  watch: {
    link: function () {
      this.form.destination = this.link.destination
      this.form.description = this.link.description
    }
  },

  methods: {
    closeModal () {
      this.$emit('close')
    },
    editLink () {
      this.form.patch(route('links.update', this.link.id), {
        preserveScroll: true,
        onSuccess: () => this.closeModal()
      })
    }
  }
}
</script>
