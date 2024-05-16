import {defineStore} from "pinia";

export const useSupportStore = defineStore('supportStore', () => {
    const getEntity = async (url, params = null) => {
        let entityData

        await axios.get(`/api/${url}`, {
            params: params
        }).then(response => entityData = response.data)

        return entityData
    }

    return {
        getEntity
    }
})
