<script setup>
import {ref} from "vue";

import {read, utils} from 'xlsx'
import axios from "axios";

const emit = defineEmits(['dataAdded'])

const name = ref(undefined)
const description = ref(undefined)
const year = ref(undefined)

let file = undefined
let loadedSheets = []
let tipText = ref(null)

const loadTable = (event) => {
    file = event.target.files[0]

    if (file) {
        let fileReader = new FileReader()
        fileReader.readAsBinaryString(file)
        fileReader.onload = (event) => {
            let tableData = event.target.result
            let workbook = read(tableData, {type: 'binary'})
            loadedSheets = []
            for (let sheetName in workbook.SheetNames) {
                loadedSheets.push(
                    utils.sheet_to_json(
                        workbook.Sheets[workbook.SheetNames[sheetName]],
                        {header: 1}
                    ))
            }
        }
    }
}

const save = async (event) => {
    event.preventDefault()
    if (name && description && year && file) {
        for (let sheet in loadedSheets) {
            axios
                .post('/tables', {
                    year: year.value,
                    name: name.value,
                    description: description.value,
                    data: loadedSheets[sheet]
                })
                .then(() => {
                    tipText.value = {success: true, text: 'Таблица успешно добавлена.'}
                    emit('dataAdded')
                })
                .catch(() => tipText.value = {success: false, text: 'Ошибка при добавлении таблицы.'})
        }
    } else {
        tipText = {success: false, text: 'Заполните обязательные поля.'}
    }
}

</script>

<template>
    <form @submit="save" class="modal" tabindex="-1" id="addTableModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить таблицу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="addTableName" class="form-label">Название</label>
                    <input type="text" id="addTableName" class="form-control" v-model="name" required>

                    <label for="addTableDescription" class="form-label mt-2">Описание</label>
                    <textarea id="addTableDescription" cols="30" rows="10" class="form-control"
                              v-model="description">
                    </textarea>

                    <label for="addTableYear" class="form-label mt-2">Год</label>
                    <input type="number" min="1998" class="form-control" id="addTableYear" required
                           :max="new Date().getFullYear()"
                           v-model="year">

                    <label for="addTableFile" class="form-label mt-2">Файл(.xlsx)</label>
                    <input type="file" id="addTableFile" class="form-control" required
                           accept=".xls, .xlsx"
                           @change="loadTable">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
                <p v-if="tipText !== null"
                   class="mx-auto fw-bold"
                   :class="{'text-success': tipText.success === true, 'text-danger': tipText.success === false}">
                    {{ tipText.text }}
                </p>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
