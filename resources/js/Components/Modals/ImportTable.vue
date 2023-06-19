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
                .post('/api/tables', {
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
    <div id="addTableModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="addTableModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавить таблицу</h3>
                    <form @submit="save" class="space-y-6">
                        <div>
                            <label for="addTableName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                            <input v-model="name" type="text" id="addTableName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="addTableDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
                            <textarea v-model="description" id="addTableDescription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required></textarea>
                        </div>
                        <div>
                            <label for="addTableYear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Год</label>
                            <input v-model="year"
                                   type="number"
                                   id="addTableYear"
                                   min="1998"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="addTableFile">Upload file</label>
                        <input
                            @change="loadTable"
                            id="addTableFile"
                            accept=".xls, .xlsx"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="load_file"
                            type="file"
                            required>
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Если файл содержит несколько листов - они будут выгружены как отдельные таблицы, а названы по названию листов.</div>

                        <input type="submit" class="cursor-pointer w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Сохранить"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
