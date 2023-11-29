<script setup>
import {onBeforeMount, ref} from "vue";


const history = ref()

onBeforeMount(async () => {
    await getHistory()

    console.log(history.value)
})
const getHistory = async () => {
    return await axios.get('/api/calculator-history')
        .then((response) => history.value = response.data.data ?? response.data)
        .catch((error) => console.log(error))
}
</script>

<template>

</template>

<style scoped>

</style>
