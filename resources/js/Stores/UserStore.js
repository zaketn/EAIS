import {defineStore} from "pinia";
import {ref} from "vue";

export const metaInfo = defineStore('userStore', () => {
    const user = ref(document
        .querySelector('meta[name="currentUser"]')
        .getAttribute('content')
    )
    const role = ref(document
        .querySelector('meta[name="role"]')
        .getAttribute('content')
    )
    const csrf = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

    return {user, role, csrf}
})
