
import { defineStore } from 'pinia'

export const useOrderStore = defineStore('orderStore', {
    state: () => ({
        formCustomers: [],
    }),
    getters: {

    },
    actions: {
        setFormCustomers(val) {
            this.formCustomers = val
        },

    }
})
