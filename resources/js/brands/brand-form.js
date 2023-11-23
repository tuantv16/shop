
import FormBrandComponent from './components/FormBrandComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'form-brand-component': FormBrandComponent
    }
})

app.mount("#brand_form")
