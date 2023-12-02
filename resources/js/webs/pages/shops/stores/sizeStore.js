
import { defineStore } from 'pinia'

export const useSizeStore = defineStore('sizeStore', {
    state: () => ({
        size_id: 0
    }),
    getters: {
      doubleCount() {

      }
    },
    actions: {
      setSize(val) {
        this.size_id = val
        alert('store size id: ' + val);
        console.log('set size to store', this.size_id);
      },
      getSize() {
            return this.size_id;
      }

    },
  })
