<template>
  <auth-layout>
    <template #header>
      Sign In
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
          name="password"
          type="password"
          required
          placeholder="Password"
          class="w-full"
        />
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center">
          <app-checkbox
            v-model:checked="form.remember"
            name="remember"
          />
          <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>

        <div class="text-sm">
          <inertia-link
            :href="route('password.request')"
            class="font-medium text-blue-500 hover:text-blue-600"
          >
            Forgot your password?
          </inertia-link>
        </div>
      </div>

      <app-button
        class="w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Sign in
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

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data () {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit () {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? 'on' : ''
        }))
        .post(this.route('login'), {
          onFinish: () => this.form.reset('password')
        })
    }
  }
}
</script>
