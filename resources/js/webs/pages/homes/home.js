
import HomeComponent  from './components/HomeComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'home-component': HomeComponent,
    }
})

app.mount("#main-home-page")
