
import { defineStore } from 'pinia'

export const useShopStore = defineStore('shopStore', {
    state: () => ({
        size_id: '',
        color_id: '',
        brand_id: '',
        category_id: '',
        price_range: '',
        sort_price: '',
        keyword: '',
        page : 1
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
      setBrand(val) {
        this.brand_id = val
      },
      setCategory(val) {
        this.category_id = val
      },
      setPriceRange(val) {
        this.price_range = val
      },
      setSortPrice(val) {
        this.sort_price = val;
      },
      setKeyword(val) {
        this.keyword = val;
      },
      setPage(val) {
        this.page = val
      },
    },
  })
