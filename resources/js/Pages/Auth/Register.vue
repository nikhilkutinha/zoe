<template>
  <auth-layout>
    <template #header>
      Sign Up
    </template>

    <form
      class="space-y-6"
      method="POST"
      @submit.prevent="submit"
    >
      <div class="space-y-5">
        <app-input
          v-model="form.email"
          :error="form.errors.email"
          name="email"
          type="email"
          autocomplete="off"
          required
          placeholder="Email address"
          class="w-full"
        />

        <app-input
          v-model="form.password"
          :error="form.errors.email"
          name="password"
          type="password"
          required
          placeholder="Password"
          class="w-full"
        />
        <app-input
          v-model="form.password_confirmation"
          name="password_confirmation"
          type="password"
          required
          placeholder="Confirm password"
          class="w-full"
        />
      </div>

      <div class="flex items-center">
        <label class="flex items-center">
          <app-checkbox
            v-model:checked="form.terms"
            name="terms"
            required
          />
          <span class="ml-2 text-sm text-gray-600">
            I agree to the
            <a
              href="#"
              target="_blank"
              class="underline text-sm text-gray-600 hover:text-gray-900"
            >Terms of Service</a>
            and
            <a
              href="#"
              target="_blank"
              class="underline text-sm text-gray-600 hover:text-gray-900"
            >Privacy Policy</a>
          </span>
        </label>
      </div>

      <app-button
        class="w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Sign up
      </app-button>
    </form>
  </auth-layout>
</template>

<script>
import AuthLayout from '@/Layouts/AuthLayout'
import AppButton from '@/Components/Ui/AppButton'
import AppInput from '@/Components/Ui/AppInput'
import AppCheckbox from '@/Components/Ui/AppCheckbox'

export default {
  components: {
    AuthLayout,
    AppButton,
    AppInput,
    AppCheckbox
  },

  data () {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        password_confirmation: '',
        terms: false
      })
    }
  },

  methods: {
    submit () {
      this.form.post(this.route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation')
      })
    }
  }
}
</script>
