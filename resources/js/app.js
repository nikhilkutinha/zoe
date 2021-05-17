// Import modules...
import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import VueApexCharts from 'vue3-apexcharts'

require('./bootstrap')

const el = document.getElementById('app')

createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) => require(`./Pages/${name}`).default
    })
})
  .mixin({ methods: { route } })
  .use(InertiaPlugin)
  .use(VueApexCharts)
  .mount(el)

InertiaProgress.init({ color: '#0EA5E9' })
