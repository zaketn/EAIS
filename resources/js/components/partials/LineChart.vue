<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, CategoryScale, LinearScale, PointElement, LineElement } from 'chart.js'

const props = defineProps({
    id: String,
    chartData: Object,
})

const chartOptions = {
    responsive: true,
}

ChartJS.register(Title, Tooltip, Legend, CategoryScale, LinearScale, PointElement, LineElement)

</script>

<template>
    <Line
        :id="props.id"
        :options="chartOptions"
        :data="props.chartData"
    />
</template>

<style scoped>

</style>
