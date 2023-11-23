
import ListBrandComponent from './components/ListBrandComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'list-brand-component': ListBrandComponent,
    }
})

app.mount("#brand_form")
