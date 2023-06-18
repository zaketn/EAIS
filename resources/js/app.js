import './bootstrap';
import {createApp} from "vue";

import Navbar from "./Components/Navbar.vue";
import Tables from "./Components/TablesData.vue";
import Statistics from "./Components/Statistics.vue";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const app = createApp({
    components: {
        Navbar,
        Tables,
        Statistics
    }
})

app.mount('#app');
app.mount('#tables');
app.mount('#stats');
