<template>
  <nav class="space-x-2 flex items-center">
    <app-pagination-button
      :disabled="!hasPrev"
      :page="getPage(current - 1)"
      @click="prev"
    >
      <chevron-left-icon class="w-4 h-4 text-gray-500" />
    </app-pagination-button>

    <app-pagination-button
      v-if="hasFirst"
      :page="getPage(1)"
    />

    <span v-if="hasFirstEllipsis">&hellip;</span>

    <app-pagination-button
      v-for="page in pagesInRange"
      :key="page.number"
      :page="page"
    />

    <span v-if="hasLastEllipsis">&hellip;</span>

    <app-pagination-button
      v-if="hasLast"
      :page="getPage(pageCount)"
    />

    <app-pagination-button
      :disabled="!hasNext"
      :page="getPage(pageCount)"
      @click="next"
    >
      <chevron-right-icon class="w-4 h-4 text-gray-500" />
    </app-pagination-button>
  </nav>
</template>

<script>
import AppPaginationButton from '@/Components/Ui/AppPaginationButton'
import { ChevronRightIcon, ChevronLeftIcon } from '@heroicons/vue/outline'

export default {
  components: {
    AppPaginationButton,
    ChevronRightIcon,
    ChevronLeftIcon
  },
  props: {
    total: {
      type: [Number, String],
      required: true
    },

    perPage: {
      type: [Number, String],
      default: 20
    },

    current: {
      type: [Number, String],
      default: 1
    },

    rangeBefore: {
      type: [Number, String],
      default: 1
    },

    rangeAfter: {
      type: [Number, String],
      default: 1
    }
  },

  emits: ['update:current', 'change'],
  computed: {
    beforeCurrent () {
      return parseInt(this.rangeBefore)
    },
    afterCurrent () {
      return parseInt(this.rangeAfter)
    },
    /**
     * Total page size (count).
     */
    pageCount () {
      return Math.ceil(this.total / this.perPage)
    },
    /**
     * First item of the page (count).
     */
    firstItem () {
      const firstItem = this.current * this.perPage - this.perPage + 1
      return firstItem >= 0 ? firstItem : 0
    },
    /**
     * Check if previous button is available.
     */
    hasPrev () {
      return this.current > 1
    },
    /**
     * Check if first page button should be visible.
     */
    hasFirst () {
      return this.current >= 2 + this.beforeCurrent
    },
    /**
     * Check if first ellipsis should be visible.
     */
    hasFirstEllipsis () {
      return this.current >= this.beforeCurrent + 4
    },
    /**
     * Check if last page button should be visible.
     */
    hasLast () {
      return this.current <= this.pageCount - (1 + this.afterCurrent)
    },
    /**
     * Check if last ellipsis should be visible.
     */
    hasLastEllipsis () {
      return this.current < this.pageCount - (2 + this.afterCurrent)
    },
    /**
     * Check if next button is available.
     */
    hasNext () {
      return this.current < this.pageCount
    },
    /**
     * Get near pages, 1 before and 1 after the current.
     * Also add the click event to the array.
     */
    pagesInRange () {
      let left = Math.max(1, this.current - this.beforeCurrent)
      if (left - 1 === 2) {
        left-- // Do not show the ellipsis if there is only one to hide
      }
      let right = Math.min(this.current + this.afterCurrent, this.pageCount)
      if (this.pageCount - right === 2) {
        right++ // Do not show the ellipsis if there is only one to hide
      }
      const pages = []
      for (let i = left; i <= right; i++) {
        pages.push(this.getPage(i))
      }
      return pages
    }
  },
  watch: {
    /**
     * If current page is trying to be greater than page count, set to last.
     */
    pageCount (value) {
      if (this.current > value) this.last()
    }
  },
  methods: {
    /**
     * Previous button click listener.
     */
    prev (event) {
      this.changePage(this.current - 1, event)
    },
    /**
     * Next button click listener.
     */
    next (event) {
      this.changePage(this.current + 1, event)
    },
    /**
     * First button click listener.
     */
    first (event) {
      this.changePage(1, event)
    },
    /**
     * Last button click listener.
     */
    last (event) {
      this.changePage(this.pageCount, event)
    },
    changePage (num, event) {
      if (this.current === num || num < 1 || num > this.pageCount) return
      this.$emit('update:current', num)
      this.$emit('change', num)
      // Set focus on element to keep tab order
      if (event && event.target) {
        this.$nextTick(() => event.target.focus())
      }
    },
    getPage (num, options = {}) {
      return {
        number: num,
        isCurrent: this.current === num,
        click: event => this.changePage(num, event),
        disabled: options.disabled || false
      }
    }
  }
}
</script>
