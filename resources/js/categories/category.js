
import CreateCategoryComponent from './components/CreateCategoryComponent.vue';
import ListCategoryComponent from './components/ListCategoryComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'create-category-component': CreateCategoryComponent,
        'list-category-component': ListCategoryComponent,
    }
})

app.mount("#category")
