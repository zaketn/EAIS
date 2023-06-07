import './bootstrap';
import {createApp} from "vue";
import Tables from "./components/TablesData.vue";

const app = createApp({
    components:{
        Tables,
    }
})

app.mount('#app');
