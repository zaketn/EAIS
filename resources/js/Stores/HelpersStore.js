import {defineStore} from "pinia";

export const useHelpersStore = defineStore('helpersStore', () => {
    const localizeDateTime = (stringDate) => {
        const date = new Date(stringDate)

        return date.toLocaleTimeString(undefined, { hour: 'numeric', minute: 'numeric' })
            + ', '
            + date.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' })
    }

    const localizeDate = (stringDate) => {
        const date = new Date(stringDate)

        return date.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' })
    }

    return {
        localizeDateTime,
        localizeDate
    }
})
