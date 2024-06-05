<script setup>

import Select from "../../Partials/Select.vue";
import Loading from "../../Partials/Loading.vue";
import {inject, onMounted, ref, watch} from "vue";
import {useSupportStore} from "../../../Stores/SupportStore";
import Button from "../../Partials/Button.vue";
import {useHelpersStore} from "../../../Stores/HelpersStore";

const supportStore = useSupportStore()
const helpersStore = useHelpersStore()

const years = inject('years')
const selectedYear = ref(null)

const companyTypes = inject('companyTypes')
const selectedCompanyType = ref(null)

const districts = ref(null)
const selectedDistrict = ref(null)

const regions = ref(null)
const selectedRegion = ref(null)

const supports = ref(null)
const loading = ref(false)

onMounted(async () => {
    districts.value = await supportStore.getEntity('district')
    regions.value = await supportStore.getEntity('region')
})

watch(selectedDistrict, async () => {
    regions.value = await supportStore.getEntity('region', {
        district: selectedDistrict.value
    })
})

const applyFilter = () => {
    loading.value = true

    axios.get('/api/support', {
        params: {
            year: selectedYear.value,
            district: selectedDistrict.value,
            region: selectedRegion.value,
            companyType: selectedCompanyType.value
        }
    })
        .then((response) => {
            supports.value = response.data
            loading.value = false
        })
}
</script>

<template>
    <div class="flex flex-col gap-2 mt-4 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-2">
        <div class="flex gap-2">
            <Select v-model="selectedYear" id="year" label="Год" disabled-value="Выберите год">
                <option v-for="year in years" :value="year" :key="year">
                    {{ year }}
                </option>
            </Select>

            <Select v-model="selectedDistrict" id="district" label="Федеральный округ"
                    disabled-value="Выберите ФО">
                <option v-for="district in districts" :value="district" :key="district">
                    {{ district.name }}
                </option>
            </Select>

            <Select v-model="selectedRegion" id="region" label="Регион" disabled-value="Выберите регион">
                <option v-for="region in regions" :value="region" :key="region">
                    {{ region.name }}
                </option>
            </Select>

            <Select v-model="selectedCompanyType" id="company-type" label="Тип предприятия" disabled-value="Выберите тип предприятия">
                <option v-for="companyType in companyTypes" :value="companyType" :key="companyType.name">
                    {{ companyType.owner_type ? `${companyType.owner_type.name}. ${companyType.name}.` : `${companyType.name}.` }}
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
        <div class="flex flex-col gap-2 mt-4">
            <div v-for="support in supports"
                 class="p-4 flex flex-col justify-between gap-2 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                <span><b>Область:</b> {{ support.regions[0] ? support.regions[0].name : '' }}</span>
                <span>
                    <b>Получатели:</b>
                    {{  support.company_type.owner_type ? `${support.company_type.owner_type.name}. ${support.company_type.name}.` : `${support.company_type.name}.` }}
                </span>
                <span><b>Кол-во получателей:</b> {{ support.amount }}</span>
                <span><b>Дата:</b> {{ helpersStore.localizeDate(support.date) }}</span>
            </div>
        </div>
    </template>
</template>

<style scoped>

</style>
