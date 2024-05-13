<script setup>

import Navbar from "../Partials/Navbar.vue";
import {onMounted, ref, watch} from "vue";
import BarChart from "../Partials/BarChart.vue";
import ChartBlock from "../Statistics/ChartBlock.vue";
import {useStatisticsStore} from "../../Stores/StatisticsStore";

const selectedYear = ref(null)
const years = ref(null)

const statisticsStore = useStatisticsStore()

onMounted(() => {
    axios.post('/api/statistics/years').then((response) => {
        years.value = response.data
    });
})

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container flex flex-col gap-6 mx-auto mt-3 px-3">
        <h1 class="text-3xl text-center font-bold dark:text-white">Поддержка малого бизнеса государством</h1>
        <div>

            <form class="max-w-sm mx-auto">
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Выберите год
                </label>
                <select v-model="selectedYear"
                        id="year"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option :value="null" selected>Все года</option>
                    <option v-for="year in years" :value="year">
                        {{ year }}
                    </option>
                </select>
            </form>

        </div>

        <ChartBlock name="Объем поддержки"
                    chart-title="Кол-во поддержки"
                    :get-data-method="statisticsStore.bySupportType"
                    v-model:year="selectedYear"
        />

        <ChartBlock name="Кол-во получателей поддержки по типу компании"
                    chart-title="Кол-во поддержки"
                    :get-data-method="statisticsStore.byCompanyType"
                    v-model:year="selectedYear"
        />

        <ChartBlock name="Частота поддержки по регионам"
                    chart-title="Кол-во поддержки"
                    :get-data-method="statisticsStore.byRegion"
                    v-model:year="selectedYear"
        />
    </div>
</template>

<style scoped>

</style>
