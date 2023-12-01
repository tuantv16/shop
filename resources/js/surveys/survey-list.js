import ListSurveyComponent from './components/ListSurveyComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'list-survey-component': ListSurveyComponent,
    }
})

app.mount("#survey-list")
