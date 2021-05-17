<template>
  <app-layout>
    <template #header>
      <div class="flex flex-1 justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Your Links
        </h2>
        <link-create-form />
      </div>
    </template>
    <section class="py-12">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <app-alert
          v-if="!links.data.length"
        >
          You currently do not have any links. Maybe create one?
        </app-alert>

        <template v-else>
          <div
            class="
              space-y-3
              md:space-y-0
              md:flex
              flex-row-reverse
              justify-between
            "
          >
            <div class="flex justify-end">
              <app-pagination
                :total="links.total"
                :per-page="links.per_page"
                :current="links.current_page"
                @change="onPaginate"
              />
            </div>
            <app-search-input
              v-model="form.search"
              placeholder="Search"
              type="text"
            />
          </div>
          <link-list
            class="my-4"
            :links="links.data"
          />
          <div class="flex justify-end">
            <app-pagination
              :total="links.total"
              :per-page="links.per_page"
              :current="links.current_page"
              @change="onPaginate"
            />
          </div>
        </template>
      </div>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import LinkList from '@/Components/Link/LinkList'
import AppSearchInput from '@/Components/Ui/AppSearchInput'
import AppPagination from '@/Components/Ui/AppPagination'
import AppAlert from '@/Components/Ui/AppAlert'
import LinkCreateForm from '../../Components/Link/LinkCreateForm'
import { throttle, pickBy } from 'lodash'

export default {
  components: {
    AppLayout,
    LinkList,
    AppAlert,
    AppSearchInput,
    AppPagination,
    LinkCreateForm
  },

  props: {
    links: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      required: false
    }
  },

  data () {
    return {
      form: {
        search: this.filters.search || '',
        page: this.filters.page || ''
      }
    }
  },

  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        const query = pickBy(this.form)
        this.$inertia.get(this.route('dashboard'), query, {
          preserveState: true
        })
      }, 500)
    }
  },

  methods: {
    onPaginate (page) {
      this.form.page = page
    }
  }
}
</script>
