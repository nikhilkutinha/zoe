<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile
      </h2>
    </template>

    <div>
      <div class="container mx-auto py-10 sm:px-6 lg:px-8">
        
        <app-tabs>
          <app-tab title="Profile">
            <update-profile-information-form :user="$page.props.user" />
          </app-tab>
          <app-tab title="Passwords">
            <update-password-form />
          </app-tab>
          <app-tab title="2FA">
            <two-factor-authentication-form />
          </app-tab>
          <app-tab title="Active Sessions">
            <logout-other-browser-sessions-form :sessions="sessions" />
          </app-tab>
          <app-tab title="Danger Zone">
            <delete-user-form />
          </app-tab>
        </app-tabs>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppTabs from '@/Components/Ui/AppTabs'
import AppTab from '@/Components/Ui/AppTab'

import AppLayout from '@/Layouts/AppLayout'
import DeleteUserForm from './DeleteUserForm'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
import UpdatePasswordForm from './UpdatePasswordForm'
import UpdateProfileInformationForm from './UpdateProfileInformationForm'

export default {

  components: {
    AppTabs,
    AppTab,
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm
  },
  props: ['sessions'],

  data () {
    return {
      activeTab: 1,
    }
  },
}
</script>
