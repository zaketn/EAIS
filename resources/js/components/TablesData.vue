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
                    <option v-for="meta in metaData"
                        :value="meta.year">
                        {{ getYearFromDate(meta.year) }}
                    </option>
                </select>
            </div>
            <div @change="tableOpened" class="col-5" ref="tableBlock">
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
            <div v-if="isTableSelected" class="col-12" id="table-block"
                 :class="{'col-12': isTableSelected, 'col-6': isStatisticsShowing}">
                <Table :data="JSON.parse(tablesData.data)" :width="tableWidth" :height="tableHeight"/>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import axios from 'axios';
import Table from './Table.vue'

export default defineComponent({
    mounted() {
        this.getMetaData()
        this.$refs.tableBlock.style.display = 'none'
    },

    components: {
        Table
    },

    data() {
        return {
            isYearSelected: false,
            isTableSelected: false,
            isStatisticsShowing: false,

            tableWidth: 1300,
            tableHeight: 1300,

            metaData: null,
            tablesData: null,
            tablesByYear: null,
        }
    },
    methods: {
        tableOpened(event) {
            this.isTableSelected = event.target.value !== ''

            axios
                .post('tables/' + this.tableSelect, this.tableSelect)
                .then((response) => this.tablesData = response.data)
                .catch((error) => console.log(error))

            this.isTableSelected = !this.isTableSelected
            this.isTableSelected = !this.isTableSelected
        },

        yearSelected(event) {
            this.isYearSelected = event.target.value === '' ? null : !this.isYearSelected
            let tableBlock = this.$refs.tableBlock
            if(tableBlock.style.display === 'block') this.isTableSelected = false
            else tableBlock.style.display = 'block'
            axios
                .post('tables/list/' + this.yearSelect, this.yearSelect)
                .then((response) => this.tablesByYear = response.data)
                .catch((error) => console.log(error))
        },

        getMetaData() {
            axios
                .post('tables/get-meta')
                .then((response) => this.metaData = response.data)
                .catch((error) => console.log(error))
        },

        getYearFromDate(date) {
            return new Date(date).getFullYear()
        }
    }
})
</script>

