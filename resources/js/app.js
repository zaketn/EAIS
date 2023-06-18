import './bootstrap';
import {createApp} from "vue";

import Tables from "./Components/TablesData.vue";
import Statistics from "./Components/Statistics.vue";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const app = createApp({
    components: {
        Tables,
        Statistics
    }
})

app.mount('#app');
app.mount('#stats');
