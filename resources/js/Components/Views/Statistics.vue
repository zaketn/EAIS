<script setup>

import {computed, onBeforeMount, ref} from 'vue';
import axios from 'axios';
import Line from '../Partials/LineChart.vue'

const tablesMeta = ref({})
const selectedYear = ref(null)
const data = {
    2017: {
        labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
        datasets: [
            {
                label: 'Финансовая устойчивость / Платежеспособность',
                data: [16359 / 110, 10932 / 105, 2643 / 120],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
            {
                label: 'Сальдированный финансовый результат / Средняя численность работников',
                data: [2200179 / 11986, 1388770 / 5314, 242011 / 1567],
                borderColor: '#FF6384',
                backgroundColor: '#FFB1C1',
            },
        ]
    },
    2018: {
        labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
        datasets: [
            {
                label: 'Финансовая устойчивость / Платежеспособность',
                data: [43490 / 138, 37645 / 147, 2566 / 126],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
            {
                label: 'Сальдированный финансовый результат / Средняя численность работников',
                data: [3257334 / 11819.8, 2090763 / 5548.1, 38929 / 1535.4],
                borderColor: '#FF6384',
                backgroundColor: '#FFB1C1',
            },
        ]
    },
    2019: {
        labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
        datasets: [
            {
                label: 'Финансовая устойчивость / Платежеспособность',
                data: [16359 / 137, 10932 / 142, 2643 / 119],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
            {
                label: 'Сальдированный финансовый результат / Средняя численность работников',
                data: [3117020 / 11340, 1961319 / 5362, 292248 / 1388],
                borderColor: '#FF6384',
                backgroundColor: '#FFB1C1',
            },
        ]
    },
    2020: {
        labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
        datasets: [
            {
                label: 'Финансовая устойчивость / Платежеспособность',
                data: [90049 / 124, 83259 / 122, 3208 / 129],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
        ]
    },
    2021: {
        labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
        datasets: [
            {
                label: 'Финансовая устойчивость / Платежеспособность',
                data: [90041 / 134, 82374 / 132, 3931 / 134],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
            {
                label: 'Сальдированный финансовый результат / Средняя численность работников',
                data: [5242415 / 10652, 2933327 / 5262, 886826 / 5262],
                borderColor: '#FF6384',
                backgroundColor: '#FFB1C1',
            },
        ]
    }
}

const years = computed({
    get: () => Object.keys(tablesMeta.value),
    set: undefined
})

const selectedStats = computed({
    get: () => data[parseInt(selectedYear.value)],
    set: undefined
})

onBeforeMount(function () {
    getTablesMeta()
})

const getTablesMeta = () => axios
    .get('/api/tables')
    .then((response) => tablesMeta.value = response.data)
    .catch((response) => console.log(response.data))

</script>

<template>
    <div class="container">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                Выберите статистику для просмотра
            </div>
            <div class="row px-3 py-2">
                <div class="col-12">
                    <label for="year" class="form-label">Год</label>
                    <select v-model="selectedYear"
                            class="form-select mb-3" id="year">
                        <option disabled>Год</option>
                        <option v-for="year in years" :value="year" :key="year">
                            {{ year }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" v-if="selectedStats !== undefined">
            <div class="col-12" id="table-block">
                <div id="test"></div>
                <Line id="test" :data="selectedStats"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
