<script setup>

import {onMounted, ref, watch} from "vue";
import {Chart, registerables} from "chart.js";

let line = null

const props = defineProps({
    id: String,
    chartData: Object,
})

onMounted(() => {
    line = new Chart(
        document.getElementById('line-chart'), {
            type: 'line',
            data: props.chartData,
            options: {
                responsive: true,
            }
        }
    )

    line.render()
})

watch(props.chartData, () => {
    line.destroy()

    line = new Chart(
        document.getElementById('line-chart'), {
            type: 'line',
            data: props.chartData,
            options: {
                responsive: true,
            }
        }
    )

    line.render()
})



Chart.register(...registerables)

</script>

<template>
    <canvas id="line-chart"></canvas>
</template>

<style scoped>

</style>
