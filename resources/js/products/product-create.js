
import CreateProductComponent from './components/CreateProductComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'create-product-component': CreateProductComponent,
    }
})

app.mount("#product-create")
