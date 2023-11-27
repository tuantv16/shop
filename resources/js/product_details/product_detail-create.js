
import CreateProductDetailComponent from './components/CreateProductDetailComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'create-product-detail-component': CreateProductDetailComponent,
    }
})

app.mount("#product-detail-create")
