import ListProductComponent from './components/ListProductComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'list-product-component': ListProductComponent,
    }
})

app.mount("#product-list")
