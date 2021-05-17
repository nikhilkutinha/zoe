<template>
  <Menu
    as="div"
    class="relative"
  >
    <MenuButton
      class="flex rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
    >
      <img
        class="h-10 w-10 rounded-full object-cover"
        :src="$page.props.user.profile_photo_url"
        :alt="$page.props.user.email"
      >
    </MenuButton>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="shadow-md bg-white absolute right-0 rounded w-56 divide-y divide-gray-100 mt-1 focus:outline-none"
      >
        <div class="py-1">
          <MenuItem
            v-slot="{ active }"
            class="flex items-center w-full px-4 py-2 text-sm"
          >
            <a
              :class="{ 'bg-gray-100': active }"
              :href="route('profile.show')"
            >
              Account
            </a>
          </MenuItem>
          <MenuItem
            v-slot="{ active }"
            class="flex items-center w-full px-4 py-2 text-sm"
          >
            <a
              :class="{ 'bg-gray-100': active }"
              href="/account-settings"
            >
              Help
            </a>
          </MenuItem>
        </div>
        <div class="py-1">
          <MenuItem
            v-slot="{ active }"
            class="flex items-center w-full px-4 py-2 text-sm"
          >
            <button
              type="button"
              class="focus:outline-none"
              :class="{ 'bg-gray-100': active }"
              @click="logout"
            >
              Logout
            </button>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import Button from '../Jetstream/Button.vue'

export default {
  components: {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem
  },

  methods: {
    logout () {
      this.$inertia.post(route('logout'))
    }
  }
}
Button
</script>
