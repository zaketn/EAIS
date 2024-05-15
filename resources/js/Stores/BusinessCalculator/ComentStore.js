import {defineStore} from "pinia";
import {ref} from "vue";

export const useComentStore = defineStore('bcComentStore', () => {
    //Комментарий
    const coment = ref()

    return {
        coment,
    }
})
