import { ref, computed } from 'vue'

export const useTable = ({ data, columns }) => {
  //   const sortBy = ref('');
  //   const orderBy = ref('');
  const search = ref('')

  const rowsAfterFiltration = computed(() => {
    if (!search.value.length) return data

    return data.filter((item) => {
      return Object.values(item).some((value) =>
        String(value).toLowerCase().includes(search.value)
      )
    })
  })

  return {
    rows: rowsAfterFiltration,
    search
  }
}
