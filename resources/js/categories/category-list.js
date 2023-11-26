
import ListCategoryComponent from './components/ListCategoryComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'list-category-component': ListCategoryComponent,
    }
})

app.mount("#category-list")
