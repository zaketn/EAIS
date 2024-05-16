<script setup>

import Select from "../../Partials/Select.vue";
import Loading from "../../Partials/Loading.vue";
import {inject, onMounted, ref} from "vue";
import {useSupportStore} from "../../../Stores/SupportStore";
import {useHelpersStore} from "../../../Stores/HelpersStore";
import Button from "../../Partials/Button.vue";

const supportStore = useSupportStore()
const helpersStore = useHelpersStore()

const years = inject('years')

const loading = ref(false)
const selectedYear = ref(null)
const supportTypes = ref(null)
const selectedSupportType = ref(null)

const supportForms = ref(null)
const selectedSupportForm = ref(null)

const supportUnitTypes = ref(null)
const selectedSupportUnitType = ref(null)

const supports = ref()

onMounted(async () => {
    supportTypes.value = await supportStore.getEntity('support-type')
    supportForms.value = await supportStore.getEntity('support-form')
    supportUnitTypes.value = await supportStore.getEntity('support-unit-type')
})

const applyFilter = () => {
    loading.value = true

    axios.get('/api/support', {
        params: {
            unitType: selectedSupportUnitType.value,
            year: selectedYear.value,
            supportType: selectedSupportType.value,
            supportForm: selectedSupportForm.value,
        }
    })
        .then((response) => {
            supports.value = response.data
            loading.value = false
        })
}

</script>

<template>
    <div class="flex flex-col justify-between gap-2 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-2">
        <div class="flex gap-2 justify-between">
            <Select v-model="selectedYear" id="year" label="Год" disabled-value="Выберите год">
                <option v-for="year in years" :value="year" :key="year">
                    {{ year }}
                </option>
            </Select>

            <Select v-model="selectedSupportType" id="support-type" label="Тип поддержки"
                    disabled-value="Выберите тип поддержки">
                <option v-for="supportType in supportTypes" :value="supportType" :key="supportType">
                    {{ supportType.name }}
                </option>
            </Select>

            <Select v-model="selectedSupportForm" id="support-form" label="Форма поддержки"
                    disabled-value="Выберите форму поддержки">
                <option v-for="supportForm in supportForms" :value="supportForm" :key="supportForm">
                    {{ supportForm.name }}
                </option>
            </Select>

            <Select v-model="selectedSupportUnitType" id="support-unit-type" label="Единица поддержки"
                    disabled-value="Выберите единицу поддержки">
                <option v-for="supportUnitType in supportUnitTypes" :value="supportUnitType"
                        :key="supportUnitType">
                    {{ supportUnitType.name }}
                </option>
            </Select>
        </div>
        <div>
            <Button text="Применить" @click="applyFilter" />
        </div>
    </div>

    <template v-if="loading === true">
        <Loading />
    </template>
    <template v-else>
        <div class="flex flex-col gap-2">

        </div>
    </template>
</template>

<style scoped>

</style>
