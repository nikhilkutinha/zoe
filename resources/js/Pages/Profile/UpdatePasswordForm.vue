<template>
  <app-form-section @submitted="updatePassword">
    <template #title>
      Update Password
    </template>

    <template #description>
      Ensure your account is using a long, random password to stay secure.
    </template>

    <template #form>
      <div class="space-y-4 lg:w-6/12">
        <div class="col-span-6 sm:col-span-4">
          <app-label
            for="current_password"
            value="Current Password"
          />
          <app-input
            id="current_password"
            ref="current_password"
            v-model="form.current_password"
            type="password"
            class="mt-1 block w-full"
            autocomplete="current-password"
            :error="form.errors.current_password"
          />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <app-label
            for="password"
            value="New Password"
          />
          <app-input
            id="password"
            ref="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            autocomplete="new-password"
          />
          <jet-input-error
            :message="form.errors.password"
            class="mt-2"
          />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <app-label
            for="password_confirmation"
            value="Confirm Password"
          />
          <app-input
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="mt-1 block w-full"
            autocomplete="new-password"
          />
          <jet-input-error
            :message="form.errors.password_confirmation"
            class="mt-2"
          />
        </div>
      </div>
    </template>

    <template #actions>
      <jet-action-message
        :on="form.recentlySuccessful"
        class="mr-3"
      >
        Saved.
      </jet-action-message>

      <app-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        accent="secondary"
      >
        Save
      </app-button>
    </template>
  </app-form-section>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetInputError from '@/Jetstream/InputError'

import AppLabel from '@/Components/Ui/AppLabel'
import AppInput from '@/Components/Ui/AppInput'
import AppButton from '@/Components/Ui/AppButton'
import AppFormSection from '@/Components/Ui/AppFormSection'

export default {
  components: {
    JetActionMessage,
    JetInputError,

    AppFormSection,
    AppInput,
    AppButton,
    AppLabel
  },

  data () {
    return {
      form: this.$inertia.form({
        current_password: '',
        password: '',
        password_confirmation: ''
      })
    }
  },

  methods: {
    updatePassword () {
      this.form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: () => {
          if (this.form.errors.password) {
            this.form.reset('password', 'password_confirmation')
            this.$refs.password.focus()
          }

          if (this.form.errors.current_password) {
            this.form.reset('current_password')
            this.$refs.current_password.focus()
          }
        }
      })
    }
  }
}
</script>
