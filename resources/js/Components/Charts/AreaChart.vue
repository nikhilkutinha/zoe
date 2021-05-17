<template>
  <div class="relative">
    <apexchart
      :type="chartType"
      :options="options"
      :series="series"
      height="100%"
    />
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      options: {
        stroke: {
          curve: 'smooth',
          width: 2,
          dashArray: 0
        },
        grid: {
          borderColor: '#D4D4D8',
          strokeDashArray: 5
        },
        colors: ['#3B82F6'],
        dataLabels: {
          enabled: false
        },
        toolbar: {
          show: false
        },
        chart: {
          fontFamily: 'sans-serif',
          height: '100%',
          toolbar: {
            show: false
          }
        },

        xaxis: {
          axisBorder: {
            show: false
          },
          categories: this.data.categories,
          type: 'datetime'
        }
      },
      series: [this.data.series]
    }
  },

  computed: {
    /**
     * The chart type is change to scatter if
     * only one data point is available.
     *
     * https://github.com/apexcharts/apexcharts.js/issues/235
     *
     */
    chartType () {
      return this.series[0]?.data.length === 1 ? 'scatter' : 'area'
    }
  }
}
</script>
