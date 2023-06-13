import './bootstrap';
import {createApp} from "vue";

import Tables from "./components/TablesData.vue";
import Statistics from "./components/Statistics.vue";

const app = createApp({
    components: {
        Tables,
        Statistics
    }
})

app.mount('#app');
app.mount('#stats');
