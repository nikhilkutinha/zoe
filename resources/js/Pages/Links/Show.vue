<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between items-center py-2">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ link.address }}
        </h2>
      </div>
    </template>
    <section class="py-12">
      <div class="container mx-auto space-y-6 px-3 sm:px-6 lg:px-8">
        <app-alert
          v-if="!metrics"
          accent="warning"
        >
          The link doesn't have enough visitors to generate metrics. Please check back later.
        </app-alert>

        <template v-else>
          <app-card v-if="metrics.has('click')">
            <template #header>
              <p class="text-gray-800 font-semibold uppercase text-sm">
                Clicks
              </p>
            </template>
            <template #default>
              <area-chart
                :data="metrics.click"
                class="h-96 mr-3 my-6 sm:ml-6 sm:mr-10"
              />
            </template>
          </app-card>

          <div
            v-if="metrics.has('country') || metrics.has('referer')"
            class="xl:flex space-y-6 xl:space-y-0 xl:space-x-6"
          >
            <app-card
              v-if="metrics.has('country')"
              class="flex-1"
            >
              <template #header>
                <p class="text-gray-800 font-semibold uppercase text-sm">
                  Countries
                </p>
              </template>
              <div class="h-96 overflow-y-auto">
                <table
                  class="divide-y divide-gray-200 min-w-full bg-white table-fixed relative"
                >
                  <thead>
                    <tr class="select-none">
                      <th
                        scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Country
                      </th>

                      <th
                        scope="col"
                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Visits
                      </th>
                    </tr>
                  </thead>

                  <tbody class="divide-y divide-gray-200">
                    <tr />

                    <tr
                      v-for="(count, name) in metrics.country"
                      :key="name"
                    >
                      <td class="px-6 py-3 text-gray-800 align-top">
                        {{ name }}
                      </td>
                      <td class="px-6 py-3 text-right text-gray-800 align-top">
                        {{ count }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </app-card>

            <app-card
              v-if="metrics.has('referer')"
              class="flex-1"
            >
              <template #header>
                <p class="text-gray-800 font-semibold uppercase text-sm">
                  Referers
                </p>
              </template>
              <div class="h-96 overflow-y-auto">
                <table
                  class="divide-y divide-gray-200 min-w-full bg-white table-fixed relative"
                >
                  <thead>
                    <tr class="select-none">
                      <th
                        scope="col"
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Referer
                      </th>

                      <th
                        scope="col"
                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Visits
                      </th>
                    </tr>
                  </thead>

                  <tbody class="divide-y divide-gray-200">
                    <tr />

                    <tr
                      v-for="(count, name) in metrics.referer"
                      :key="name"
                    >
                      <td class="px-6 py-3 text-gray-800 align-top">
                        {{ name }}
                      </td>
                      <td class="px-6 py-3 text-right text-gray-800 align-top">
                        {{ count }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </app-card>
          </div>

          <app-card v-if="metrics.has('platform')">
            <template #header>
              <p class="text-gray-800 font-semibold uppercase text-sm">
                Platforms
              </p>
            </template>
            <template #default>
              <bar-chart
                :data="metrics.platform"
                class="h-96 mr-3 my-6 sm:ml-6 sm:mr-10"
              />
            </template>
          </app-card>

          <app-card v-if="metrics.has('browser')">
            <template #header>
              <p class="text-gray-800 font-semibold uppercase text-sm">
                Browsers
              </p>
            </template>
            <template #default>
              <bar-chart
                :data="metrics.browser"
                class="h-96 mr-3 my-6 sm:ml-6 sm:mr-10"
              />
            </template>
          </app-card>
        </template>
      </div>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import AppCard from '@/Components/Ui/AppCard'
import AreaChart from '@/Components/Charts/AreaChart'
import BarChart from '@/Components/Charts/BarChart'
import { isEmpty } from 'lodash'
import AppAlert from '@/Components/Ui/AppAlert'

const SERIES_NAME = 'Visits'
const TABULAR_METRICS = [
  'country',
  'referer'
]

export default {
  components: {
    AppLayout,
    AppCard,
    AreaChart,
    BarChart,
    AppAlert
  },

  props: {
    link: {
      type: Object,
      required: true
    }
  },

  computed: {
    metrics () {
      if (!this.hasAnyMetrics()) return

      const metrics = {
        has (key) {
          return !!this[key]
        }
      }

      Object.entries(this.link.metrics).forEach(([column, data]) => {
        if (isEmpty(data)) return

        /**
         * The metrics that are to be displayed in
         * table format.
         */

        if (TABULAR_METRICS.includes(column)) {
          metrics[column] = data
          return
        }

        /**
         * The metrics that are to be displayed on
         * graphs.
         */

        metrics[column] = {
          categories: Object.keys(data),
          series: {
            name: SERIES_NAME,
            data: Object.values(data)
          }
        }
      })

      return metrics
    }
  },

  methods: {
    hasAnyMetrics () {
      return Object.values(this.link.metrics).some((value) => {
        return !isEmpty(value)
      })
    }
  }
}
</script>
