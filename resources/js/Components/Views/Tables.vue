<script setup>
import {computed, onBeforeMount, onMounted, ref} from 'vue';
import axios from 'axios';
import { PlusCircleIcon } from '@heroicons/vue/24/outline';
import { Modal } from 'flowbite';
import Table from '../Partials/Table.vue'
import AddTable from "../Modals/ImportTable.vue";
import Breadcrumbs from "../Partials/Breadcrumbs.vue";


const tablesMeta = ref({})
const selectedYear = ref(null)
const selectedTable = ref(null)
const tableData = ref(null)

let importModal = undefined
let fbModal = undefined

const years = computed({
    get: () => Object.keys(tablesMeta.value),
    set: undefined
})

const tables = computed({
    get: () => tablesMeta.value[parseInt(selectedYear.value)],
    set: undefined
})

onBeforeMount(() => {
    getTablesMeta()
})

onMounted(() => {
    importModal = document.getElementById('addTableModal')
    fbModal = new Modal(importModal)
})

const getTableData = () => axios
    .get(`/api/tables/${selectedTable.value}`)
    .then((response) => tableData.value = JSON.parse(response.data.data))
    .finally(() => console.log(tableData.value))
    .catch((response) => console.log(response.data))

const getTablesMeta = () => axios
    .get('/api/tables')
    .then((response) => tablesMeta.value = response.data)
    .catch((response) => console.log(response.data))

</script>


<template>
    <div class="container mx-auto mt-3 px-3">

        <breadcrumbs :elements="[{text: 'Табличные данные', url: '/tables'}]"/>

        <div class="flex justify-between dark:text-white">
            <p class="text-2xl text-gray-900 dark:text-white">Выберите таблицу для просмотра</p>
            <button
                @click="fbModal.show()"
                type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <PlusCircleIcon class="h-6 w-6 text-white" />
            </button>
            <Teleport to="#modal-container">
                <AddTable :modal-object="fbModal" @data-added="getTablesMeta"/>
            </Teleport>
        </div>

        <div class="flex py-2">
            <div class="w-fit">
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Год</label>
                <select id="year"
                        v-model="selectedYear"
                        class="rounded-l-lg bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled>Год</option>
                    <option v-for="year in years" :value="year" :key="year">
                        {{ year }}
                    </option>
                </select>
            </div>
            <div class="grow" ref="tableBlock">
                <label for="table" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Таблица</label>
                <select
                    @change="getTableData"
                    v-model="selectedTable"
                    id="table"
                    class="rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled>Таблица</option>
                    <option v-for="(table, index) in tables" :value="table.id" :key="index">
                        {{ table.name }}
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-3" v-if="tableData !== null">
        <div id="table-block">
            <Table :data="tableData" height="700px"/>
        </div>
    </div>
</template>
