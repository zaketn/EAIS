<template>
    <div class="container">
        <h1 class="mb-3">Выберите таблицу</h1>
        <div class="row">
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
        <div class="row" v-if="tableData !== null">
            <div class="col-12" id="table-block">
                <Table :data="tableData"/>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, onBeforeMount, ref } from 'vue';
import axios from 'axios';
import Table from './Table.vue'

export default {
    components: {
        Table
    },

    setup(_, context) {
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
            .post('/table', {id: selectedTable.value})
            .then((response) => tableData.value = JSON.parse(response.data.data))
            .catch((response) => console.log(response.data))

        const getTablesMeta = () => axios
            .post('/tables/get-meta')
            .then((response) => tablesMeta.value = response.data)
            .catch((response) => console.log(response.data))

        return {
            years, tables, selectedYear, selectedTable, tableData, getTableData
        }
    }
}
</script>
