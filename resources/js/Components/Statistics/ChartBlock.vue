<script setup>

import BarChart from "../Partials/BarChart.vue";
import {defineModel, onMounted, ref, watch} from "vue";
import Loading from "../Partials/Loading.vue";

const year = defineModel('year')

const props = defineProps(['name', 'chartTitle', 'getDataMethod'])

const loaded = ref(false)
const barData = ref({
    labels: [],
    datasets: [{
        label: props.chartTitle ?? '',
        data: [],
        borderWidth: 1,
    }]
})

onMounted(() => {
    getChartData()
})

watch(year, async () => {
    loaded.value = false
    await getChartData()
    loaded.value = true
})

const getChartData = async () => {
    await props.getDataMethod(barData, year)
    loaded.value = true
}
</script>

<template>
    <div class="flex flex-col gap-4 bg-gray-50 p-4 rounded dark:bg-gray-800">
            <h2 class="text-2xl text-center font-bold dark:text-white">{{ name }}</h2>

            <BarChart v-if="loaded === true"
                      :id="props.name"
                      :chart-data="barData"
            />
            <Loading v-else />
    </div>
</template>

<style scoped>

</style>
