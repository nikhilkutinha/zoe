import { ref } from 'vue'

export const useModal = () => {
  const isOpen = ref(false)

  return {
    isOpen,
    openModal: () => isOpen.value = true,
    closeModal: () => isOpen.value = false
  }
}
