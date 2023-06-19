import './bootstrap';
import { createApp } from "vue";
import { createPinia } from "pinia";
import { router } from './router'
import App from './Components/App.vue'

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)

app.mount('#app');
