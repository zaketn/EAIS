<script setup>
import {onMounted, ref} from 'vue';
import Navbar from "@/Components/Partials/Navbar.vue";
import Breadcrumbs from "../Partials/Breadcrumbs.vue";
import {useStatisticsStore} from "../../Stores/StatisticsStore";
import Select from "../Partials/Select.vue";
import {useSupportStore} from "../../Stores/SupportStore";
import Button from "../Partials/Button.vue";

const statisticsStore = useStatisticsStore()
const supportStore = useSupportStore()

const years = ref(null)
const selectedYear = ref(null)

const supportTypes = ref(null)
const selectedSupportType = ref(null)

const supportForms = ref(null)
const selectedSupportForm = ref(null)

const supportUnitTypes = ref(null)
const selectedSupportUnitType = ref(null)

onMounted(async () => {
    years.value = await statisticsStore.years()

    supportTypes.value = await supportStore.getEntity('support-type')
    supportForms.value = await supportStore.getEntity('support-form')
    supportUnitTypes.value = await supportStore.getEntity('support-unit-type')
})

</script>


<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto mt-3 px-3">

        <breadcrumbs :elements="[{text: 'Табличные данные', url: '/tables'}]"/>

        <div class="flex justify-between dark:text-white">
            <p class="text-2xl text-gray-900 dark:text-white font-bold text-2xl">
                Реестр поддержки государством малого и среднего бизнеса
            </p>

            <Button text="Применить" />
        </div>

        <div class="flex justify-between gap-2 py-4">
            <Select v-model="selectedYear" id="year" label="Год" disabled-value="Выберите год">
                <option v-for="year in years" :value="year" :key="year">
                    {{ year }}
                </option>
            </Select>

            <Select v-model="selectedSupportType" id="support-type" label="Тип поддердки"
                    disabled-value="Выберите тип поддержки">
                <option v-for="supportType in supportTypes" :value="supportType" :key="supportType">
                    {{ supportType.name }}
                </option>
            </Select>

            <Select v-model="selectedSupportForm" id="support-form" label="Форма поддердки"
                    disabled-value="Выберите форму поддержки">
                <option v-for="supportForm in supportForms" :value="supportForm" :key="supportForm">
                    {{ supportForm.name }}
                </option>
            </Select>

            <Select v-model="selectedSupportUnitType" id="support-unit-type" label="Единица поддержки"
                    disabled-value="Выберите единицу поддержки">
                <option v-for="supportUnitType in supportUnitTypes" :value="supportUnitType" :key="supportUnitType">
                    {{ supportUnitType.name }}
                </option>
            </Select>
        </div>
    </div>
    <div class="container mx-auto px-3">

    </div>
</template>
