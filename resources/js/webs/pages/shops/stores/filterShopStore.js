
import { defineStore } from 'pinia'

export const useShopStore = defineStore('shopStore', {
    state: () => ({
        size_id: '',
        color_id: '',
        newPage : 1
    }),
    getters: {
      doubleCount() {

      }
    },
    actions: {
      setSize(val) {
        this.size_id = val
      },
      setColor(val) {
        this.color_id = val
      },
      setPage(val) {
        this.page = val
      },
    //   getSize() {
    //         return this.size_id;
    //   }

    },
  })
