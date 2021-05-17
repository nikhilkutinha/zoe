<template>
  <div>
    <jet-banner />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-gray-800 border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center">
                <inertia-link :href="route('dashboard')">
                  <app-logo class="h-10 block" />
                </inertia-link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <jet-nav-link
                  :href="route('dashboard')"
                  :active="route().current('dashboard')"
                >
                  Dashboard
                </jet-nav-link>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Settings Dropdown -->
              <profile-dropdown />
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="pt-2 pb-3 space-y-1">
            <jet-responsive-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-responsive-nav-link>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
              <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="flex-shrink-0 mr-3"
              >
                <img
                  class="h-10 w-10 rounded-full object-cover"
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                >
              </div>

              <div>
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <jet-responsive-nav-link
                :href="route('profile.show')"
                :active="route().current('profile.show')"
              >
                Profile
              </jet-responsive-nav-link>

              <jet-responsive-nav-link
                v-if="$page.props.jetstream.hasApiFeatures"
                :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')"
              >
                API Tokens
              </jet-responsive-nav-link>

              <!-- Authentication -->
              <form
                method="POST"
                @submit.prevent="logout"
              >
                <jet-responsive-nav-link as="button">
                  Log Out
                </jet-responsive-nav-link>
              </form>

              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-200" />

                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Team
                </div>

                <!-- Team Settings -->
                <jet-responsive-nav-link
                  :href="route('teams.show', $page.props.user.current_team)"
                  :active="route().current('teams.show')"
                >
                  Team Settings
                </jet-responsive-nav-link>

                <jet-responsive-nav-link
                  :href="route('teams.create')"
                  :active="route().current('teams.create')"
                >
                  Create New Team
                </jet-responsive-nav-link>

                <div class="border-t border-gray-200" />

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Switch Teams
                </div>

                <template
                  v-for="team in $page.props.user.all_teams"
                  :key="team.id"
                >
                  <form @submit.prevent="switchToTeam(team)">
                    <jet-responsive-nav-link as="button">
                      <div class="flex items-center">
                        <svg
                          v-if="team.id == $page.props.user.current_team_id"
                          class="mr-2 h-5 w-5 text-green-400"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                          />
                        </svg>
                        <div>{{ team.name }}</div>
                      </div>
                    </jet-responsive-nav-link>
                  </form>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header
        v-if="$slots.header"
        class="bg-white shadow"
      >
        <div
          class="container flex items-center mx-auto min-h-full h-[4.5rem] px-4 sm:px-6 lg:px-8"
        >
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
import AppLogo from '@/Components/AppLogo'
import ProfileDropdown from '@/Components/ProfileDropdown'
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetBanner from '@/Jetstream/Banner'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
  components: {
    AppLogo,
    JetApplicationMark,
    JetBanner,
    JetDropdown,
    ProfileDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink
  },

  data () {
    return {
      showingNavigationDropdown: false
    }
  },

  methods: {
    switchToTeam (team) {
      this.$inertia.put(
        route('current-team.update'),
        {
          team_id: team.id
        },
        {
          preserveState: false
        }
      )
    },

    logout () {
      this.$inertia.post(route('logout'))
    }
  }
}
</script>
