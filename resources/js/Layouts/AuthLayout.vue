<template>
  <div class="min-h-screen flex">
    <div
      :style="{ backgroundImage: 'url(/images/mountains.jpg)' }"
      class="hidden flex-shrink-0 w-96 bg-center bg-cover lg:block"
    />
    <div class="bg-gray-50 flex-1 flex flex-col">
      <header class="w-full flex justify-end py-4 px-6">
        <div class="space-x-4">
          <inertia-link
            :href="route('login')"
            class="uppercase text-sm font-medium hover:text-blue-500"
            :class="[ route().current('login') ? 'text-blue-500': 'text-gray-500']"
          >
            Login
          </inertia-link>

          <inertia-link
            :href="route('register')"
            class="uppercase text-sm font-medium hover:text-blue-500"
            :class="[ route().current('register') ? 'text-blue-500': 'text-gray-500']"
          >
            Register
          </inertia-link>
        </div>
      </header>

      <div class="flex flex-1 justify-center items-center">
        <div class="w-full sm:max-w-md">
          <div class="flex flex-col items-center">
            <app-logo class="h-16" />

            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
              <slot name="header" />
            </h2>
          </div>

          <div class="bg-white p-5 mt-8 shadow sm:rounded">
            <slot name="default" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLogo from '@/Components/AppLogo'

export default {
  components: {
    AppLogo
  },

  methods: {
    isUrl (...urls) {
      const currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter(url => currentUrl.startsWith(url)).length
    }
  }
}
</script>
