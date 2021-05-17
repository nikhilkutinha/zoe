<template>
  <app-form-section @submitted="updateProfileInformation">
    <template #title>
      Profile Information
    </template>

    <template #description>
      Here you can update your profile information and email address.
    </template>

    <template #form>




      <!-- Profile Photo -->
      <div class="space-y-4 lg:w-6/12">
        <app-field
          for="photo"
          label="Photo"
        >
          <input
            ref="photo"
            type="file"
            class="hidden"
            @input="updatePhotoPreview"
          >

          <div
            v-show="!photoPreview"
            class="mt-2"
          >
            <img
              :src="user.profile_photo_url"
              :alt="user.name"
              class="rounded-full h-20 w-20 object-cover"
            >
          </div>

          <!-- New Profile Photo Preview -->
          <div
            v-show="photoPreview"
            class="mt-2"
          >
            <span
              class="block rounded-full w-20 h-20"
              :style="
                'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                  photoPreview +
                  '\');'
              "
            />
          </div>

          <app-button
            class="mt-2 mr-2"
            type="button"
            accent="light"
            @click.prevent="selectNewPhoto"
          >
            Change Photo
          </app-button>

          <app-button
            v-if="user.profile_photo_path"
            class="mt-2 mr-2"
            type="button"
            accent="light"
            @click.prevent="deletePhoto"
          >
            Change Photo
          </app-button>

          <jet-input-error
            :message="form.errors.photo"
            class="mt-2"
          />
        </app-field>

        <!-- Email -->
        <app-field
          for="email"
          label="Email"
        >
          <app-input
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            :error="form.errors.email"
          />
        </app-field>
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
        type="submit"
      >
        Save
      </app-button>
    </template>
  </app-form-section>
</template>

<script>
import AppFormSection from '@/Components/Ui/AppFormSection'
import AppButton from '@/Components/Ui/AppButton'
import AppInput from '@/Components/Ui/AppInput'
import AppField from '@/Components/Ui/AppField'

import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
  components: {
    JetActionMessage,

    AppButton,
    AppFormSection,
    AppInput,
    AppField,

    JetInputError,
    JetLabel,
    JetSecondaryButton
  },

  props: ['user'],

  data () {
    return {
      form: this.$inertia.form({
        _method: 'PUT',
        email: this.user.email,
        photo: null
      }),

      photoPreview: null
    }
  },

  methods: {
    updateProfileInformation () {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0]
      }

      this.form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true
      })
    },

    selectNewPhoto () {
      this.$refs.photo.click()
    },

    updatePhotoPreview () {
      const photo = this.$refs.photo.files[0]

      if (!photo) return

      const reader = new FileReader()

      reader.onload = (e) => {
        this.photoPreview = e.target.result
      }

      reader.readAsDataURL(photo)
    },

    deletePhoto () {
      this.$inertia.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => (this.photoPreview = null)
      })
    }
  }
}
</script>
