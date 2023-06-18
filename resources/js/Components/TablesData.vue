<script setup>
import {computed, onBeforeMount, ref} from 'vue';
import axios from 'axios';
import Table from './Partials/Table.vue'
import AddTable from "./Modals/ImportTable.vue";

const tablesMeta = ref({})
const selectedYear = ref(null)
const selectedTable = ref(null)
const tableData = ref(null)

const years = computed({
    get: () => Object.keys(tablesMeta.value),
    set: undefined
})

const tables = computed({
    get: () => tablesMeta.value[parseInt(selectedYear.value)],
    set: undefined
})

onBeforeMount(function () {
    getTablesMeta()
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
    <div class="container">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                Выберите таблицу для просмотра
                <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addTableModal">+
                </button>
                <Teleport to="#modal-container">
                    <AddTable @data-added="getTablesMeta"/>
                </Teleport>
            </div>
            <div class="row px-3 py-2">
                <div class="col-2">
                    <label for="year" class="form-label">Год</label>
                    <select v-model="selectedYear"
                            class="form-select mb-3" id="year">
                        <option disabled>Год</option>
                        <option v-for="year in years" :value="year" :key="year">
                            {{ year }}
                        </option>
                    </select>
                </div>
                <div class="col-10" ref="tableBlock" v-show="selectedYear !== null">
                    <label for="table" class="form-label">Таблица</label>
                    <select @change="getTableData" class="form-select mb-3" id="table" v-model="selectedTable">
                        <option disabled>Выберите таблицу</option>
                        <option v-for="(table, index) in tables" :value="table.id" :key="index">
                            {{ table.name }}
                        </option>

                    </select>
                </div>
            </div>
        </div>
        <div class="row" v-if="tableData !== null">
            <div class="col-12" id="table-block">
                <Table :data="tableData" height="700px"/>
            </div>
        </div>
    </div>
</template>
