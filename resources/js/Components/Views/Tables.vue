<script setup>
import {onMounted, provide, ref} from 'vue';
import Navbar from "@/Components/Partials/Navbar.vue";
import Breadcrumbs from "../Partials/Breadcrumbs.vue";
import {useStatisticsStore} from "../../Stores/StatisticsStore";
import {useSupportStore} from "../../Stores/SupportStore";
import Button from "../Partials/Button.vue";
import {useHelpersStore} from "../../Stores/HelpersStore";
import FormsTab from "../Modules/Tables/FormsTab.vue";
import RegionsTab from "../Modules/Tables/RegionsTab.vue";

const statisticsStore = useStatisticsStore()
const supportStore = useSupportStore()
const helpersStore = useHelpersStore()

const loading = ref(false)
const years = ref(null)
const companyTypes = ref(null)

provide('years', years)
provide('companyTypes', companyTypes)

const formsData = ref(null)

onMounted(async () => {
    years.value = await statisticsStore.years()
    companyTypes.value = await supportStore.getEntity('company-type')
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
        </div>

        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">
                        По виду поддержки
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">
                        По региону
                    </button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <FormsTab />
            </div>
            <div class="hidden" id="dashboard" role="tabpanel"
                 aria-labelledby="dashboard-tab">
                <RegionsTab />
            </div>
        </div>
    </div>
    <div class="container mx-auto px-3">

    </div>
</template>
