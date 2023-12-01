
import SettingFeedbackComponent from './components/SettingFeedbackComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'setting-feedback-component': SettingFeedbackComponent,
    }
})

app.mount("#feedback-setting")
