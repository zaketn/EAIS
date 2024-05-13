<script setup>
import {Chart, registerables} from "chart.js";
import {onMounted, watch} from "vue";

const props = defineProps({
    id: String,
    chartData: Object,
})

let bar = null

onMounted(() => {
    bar = new Chart(
        document.getElementById(props.id), {
            type: 'bar',
            data: props.chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true
            }
        }
    )

    bar.render()
})

watch(props.chartData, () => {
    bar.destroy()

    bar = new Chart(
        document.getElementById(props.id), {
            type: 'bar',
            data: props.chartData,
            options: {
                responsive: true,
            }
        }
    )

    bar.render()
})

Chart.register(...registerables)
</script>

<template>
    <canvas :id="props.id"></canvas>
</template>

<style scoped>

</style>
