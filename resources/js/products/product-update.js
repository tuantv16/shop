
import UpdateProductComponent from './components/UpdateProductComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'update-product-component': UpdateProductComponent,
    }
})

app.mount("#product-update")
