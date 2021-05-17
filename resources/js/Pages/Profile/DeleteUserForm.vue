<template>
  <app-action-card>
    <template #title>
      Delete Account
    </template>

    <template #description>
      Permanently delete your account.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once your account is deleted, all of its resources and data will be
        permanently deleted. Before deleting your account, please download any
        data or information that you wish to retain.
      </div>

      <div class="mt-5">
        <app-button
          accent="danger"
          @click="confirmUserDeletion"
        >
          Delete Account
        </app-button>
      </div>

      <app-modal
        :open="confirmingUserDeletion"
        @close="closeModal"
      >
        <template #header>
          Delete account
        </template>

        <template #default>
          <form
            id="deleteUserForm"
            @submit.prevent="deleteUser"
          >
            <p class="text-gray-500">
              Are you sure you want to delete your account? Once your account is
              deleted, all of its resources and data will be permanently
              deleted. Please enter your password to confirm you would like to
              permanently delete your account.
            </p>
            <app-field class="mt-4">
              <template #label>
                <label class="sr-only">Password</label>
              </template>

              <app-input
                ref="password"
                v-model="form.password"
                type="password"
                placeholder="Password"
                class="w-full"
                required
                :error="form.errors.password"
              />
            </app-field>
          </form>
        </template>

        <template #footer>
          <app-button
            accent="danger"
            class="mb-3 sm:ml-3 sm:mb-0 w-full sm:w-auto"
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            form="deleteUserForm"
          >
            Delete
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
  </app-action-card>
</template>

<script>
import AppActionCard from '@/Components/Ui/AppActionCard'
import AppButton from '@/Components/Ui/AppButton'
import AppModal from '@/Components/AppModal'
import AppField from '@/Components/Ui/AppField'
import AppInput from '@/Components/Ui/AppInput.vue'

import { useModal } from '@/Hooks/Modal'

export default {
  components: {
    AppActionCard,
    AppField,
    AppButton,
    AppInput,
    AppModal
  },

  setup () {
    const {
      isOpen: confirmingUserDeletion,
      openModal: confirmUserDeletion,
      closeModal
    } = useModal()

    return {
      confirmUserDeletion,
      confirmingUserDeletion,
      closeModal
    }
  },

  data () {
    return {
      form: this.$inertia.form({
        password: ''
      })
    }
  },

  methods: {
    deleteUser () {
      this.form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset()
      })
    }
  }
}
</script>
