<template>
  <app-card class="flex-1">
    <template #header>
      <div class="flex items-center justify-between p-3">
        <p class="text-gray-800 font-semibold uppercase text-sm">
          Countries
        </p>

        <app-input
          v-model="search"
          placeholder="Search"
          type="text"
          class="h-8 px-2"
        />
      </div>
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
            v-for="row in rows"
            :key="row.index"
          >
            <td class="px-6 py-3 text-gray-800 align-top">
              {{ row.country }}
            </td>
            <!-- <td class="px-6 py-3 text-right text-gray-800 align-top">
              {{ count }}
            </td> -->
          </tr>
        </tbody>
      </table>
    </div>
  </app-card>
</template>

<script>
import AppCard from '@/Components/Ui/AppCard'
import AppInput from '@/Components/Ui/AppInput'
import { useTable } from '@/Hooks/Table'

export default {
  components: {
    AppCard,
    AppInput
  },

  setup () {
    const data = [
      {
        id: 1,
        country: 'Australia'
      },
      {
        id: 2,
        country: 'United Kingdom'
      }
    ]

    const { rows, search } = useTable({ data })

    return {
      rows,
      search
    }
  }
}
</script>

<style></style>
