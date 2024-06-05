<script setup>

import Navbar from "../Partials/Navbar.vue";
import {onMounted, ref} from "vue";
import ChartBlock from "../Statistics/ChartBlock.vue";
import {useStatisticsStore} from "../../Stores/StatisticsStore";
import Select from "../Partials/Select.vue";
import Breadcrumbs from "../Partials/Breadcrumbs.vue";

const selectedYear = ref(null)
const years = ref(null)

const statisticsStore = useStatisticsStore()

onMounted(async () => {
    years.value = await statisticsStore.years()
})

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container flex flex-col gap-6 mx-auto mt-3 px-3">
        <breadcrumbs :elements="[{text: 'Статистика поддержки государством', url: '/government-support'}]"/>

        <h1 class="text-3xl text-center font-bold dark:text-white">Поддержка малого бизнеса государством</h1>
        <div>

            <form class="max-w-sm mx-auto">
                <Select v-model="selectedYear" id="year" label="Год" disabled-value="Выберите год">
                    <option v-for="year in years" :value="year" :key="year">
                        {{ year }}
                    </option>
                </Select>
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
