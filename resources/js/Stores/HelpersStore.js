import {defineStore} from "pinia";

export const useHelpersStore = defineStore('helpersStore', () => {
    const localizeDate = (stringDate) => {
        const date = new Date(stringDate)

        return date.toLocaleTimeString(undefined, { hour: 'numeric', minute: 'numeric' })
            + ', '
            + date.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' })
    }

    return {
        localizeDate
    }
})
