
import HomeComponent  from './components/HomeComponent.vue';
import { createApp } from 'vue';
alert(2222);
const app = createApp({
  components: {
        'home-component': HomeComponent,
    }
})

app.mount("#main-home-page")
