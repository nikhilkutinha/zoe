<template>
  
  

  
  
  <div class="bg-white overflow-x-auto shadow-lg">
    <table class="min-w-full divide-y divide-gray-200 bg-white table-fixed relative">
      <thead>
        <tr>
          <th
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap w-2/12"
            scope="col"
          >
            Short Link
          </th>
          <th
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-6/12"
            scope="col"
          >
            Destination
          </th>
          <th
            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap w-2/12"
            scope="col"
          >
            Created at
          </th>
          <th
            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12"
            scope="col"
          >
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        
       <template v-if="links?.length">
        <tr
          v-is="'link-list-item'"
          v-for="link in links"
          :key="link.id"
          :link="link"
          @delete="openDeleteModal"
          @edit="openEditModal"
        />
        </template>
        
        <div v-else class="px-6 py-4">
          No links match you query D:
        </div>
      </tbody>
    </table>

    <link-delete-form
      :link="link"
      :open="isDeleteModalOpen"
      @close="closeDeleteModal"
    />
    <link-edit-form
      :link="link"
      :open="isEditModalOpen"
      @close="closeEditModal"
    />
  </div>
</template>

<script>
import LinkListItem from './LinkListItem'
import LinkDeleteForm from './LinkDeleteForm'
import LinkEditForm from './LinkEditForm'
import AppButton from '../Ui/AppButton'
import { useModal } from '../../Hooks/Modal'

export default {
  name: 'LinkList',

  components: {
    LinkListItem,
    LinkDeleteForm,
    LinkEditForm,
    AppButton
  },

  props: {
    links: {
      type: Array,
      required: true
    }
  },

  setup () {
    const { isOpen: isDeleteModalOpen, closeModal: closeDeleteModal } = useModal()
    const { isOpen: isEditModalOpen, closeModal: closeEditModal } = useModal()

    return {
      isDeleteModalOpen,
      closeDeleteModal,
      isEditModalOpen,
      closeEditModal
    }
  },

  data () {
    return {
      link: {}
    }
  },

  methods: {
    openDeleteModal (link) {
      this.isDeleteModalOpen = true
      this.link = link
    },
    openEditModal (link) {
      this.isEditModalOpen = true
      this.link = link
    }
  }
}
</script>

<style scoped>

</style>
