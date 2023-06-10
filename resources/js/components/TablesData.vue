<template>
    <div class="container">
        <h1 class="mb-3">Выберите таблицу</h1>
        <div class="row">
            <div class="col-1">
                <label for="year" class="form-label">Год</label>
                <select @change="yearSelected" v-model="yearSelect"
                        class="form-select mb-3" id="year">
                    <option disabled>Год</option>
                    <option value=""></option>
                    <option v-for="meta in availableTables"
                            :value="meta.year">
                        {{ getYearFromDate(meta.year) }}
                    </option>
                </select>
            </div>
            <div class="col-5" ref="tableBlock">
                <label for="table" class="form-label">Таблица</label>
                <select @change="tableOpened" v-model="tableSelect"
                        class="form-select mb-3" id="table">
                    <option disabled>Выберите таблицу</option>
                    <option value=""></option>
                    <option v-for="table in tablesByYear"
                            :value="table.id">
                        {{ table.name }}
                    </option>

                </select>
            </div>
        </div>
        <div class="row">
            <div v-if="showTable" class="col-12" id="table-block" >
                <Table :data="JSON.parse(tableData.data)" :width="tableWidth" :height="tableHeight"/>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import axios from 'axios';
import Table from './Table.vue'

export default defineComponent({
    components: {
        Table
    },

    mounted() {
        this.getTablesList()
        this.$refs.tableBlock.style.display = 'none'
    },

    data() {
        return {
            isYearSelected: false,
            showTable: false,

            tableSelect: null,
            yearSelect: null,
            availableTables: null,
            tablesByYear: null,

            tableWidth: 1400,
            tableHeight: 1400,
            tableData: null,
        }
    },
    methods: {
        yearSelected(event) {
            this.isYearSelected = event.target.value === '' ? false : !this.isYearSelected
            if (this.isYearSelected) {
                let tableBlock = this.$refs.tableBlock
                if (tableBlock.style.display === 'block') this.showTable = false
                else tableBlock.style.display = 'block'
                axios
                    .post('tables/list/', {year: this.yearSelect})
                    .then((response) => this.tablesByYear = response.data)
                    .catch((error) => console.log(error))
            }
        },

        tableOpened(event) {
            let notEmptySelected = event.target.value !== ''
            let ths = this

            if (notEmptySelected) {
                axios
                    .post('tables/', {id: this.tableSelect})
                    .then(function(response){
                        ths.tableData = response.data
                        ths.showTable = notEmptySelected
                    })
                    .catch((error) => console.log(error))
            }
        },

        getTablesList() {
            axios
                .post('tables/get-meta')
                .then((response) => this.availableTables = response.data)
                .catch((error) => console.log(error))
        },

        getYearFromDate(date) {
            return new Date(date).getFullYear()
        },
    }
})
</script>

