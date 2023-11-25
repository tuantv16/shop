
import CreateCategoryComponent from './components/CreateCategoryComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'create-category-component': CreateCategoryComponent,
    }
})

app.mount("#category")
