<script setup>
import { onBeforeMount, ref, watchEffect } from "vue";
import axios from "axios";
import Breadcrumbs from "@/Components/Partials/Breadcrumbs.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import Input from "../Partials/Input.vue";
import Modal from "../Partials/Modal.vue";
import Button from "../Partials/Button.vue";
import TextArea from "../Partials/TextArea.vue";
import modal from "bootstrap/js/src/modal";

const stories = ref([]);
const searchTerm = ref('');

onBeforeMount(async () => {
    await getLinks();
});

const nameInput = ref()
const descriptionInput = ref()
const linkInput = ref()

const alert = ref({
    'display': false,
    'success': false,
    'message': ''
})

const getLinks = async () => {
    try {
        const response = await axios.get('/api/useful-links');
        stories.value = response.data.data ?? response.data;
    } catch (error) {
        console.error(error);
    }
};

// Реактивное вычисляемое свойство для отфильтрованных данных
const filteredStories = ref([]);

watchEffect(() => {
    filteredStories.value = stories.value.filter(link => link.name.toLowerCase().includes(searchTerm.value.toLowerCase()));
});

const sendUsefulLink = () => {
    axios.post('/api/useful-links', {
        name: nameInput.value,
        description: descriptionInput.value,
        url: linkInput.value
    }).then(response => {
        alert.value.display = true
        alert.value.success = true
        alert.value.message = 'Ссылка успешно отправлена администраторам, и обязательно будет рассмотрена.'
    }).catch(response => {
        alert.value.display = true
        alert.value.success = false
        alert.value.message = response.response.data.message
    })
}

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto p-3">
        <Breadcrumbs :elements="[{text: 'Полезные ссылки', url: '/history'}]"/>

        <div class="flex justify-end">
            <Modal id="suggest" button-text="Предложить свой источник" accept-button="Перейти">
                <template #header>
                    <h3 class="font-bold text-2xl dark:text-white">Предложить полезный источник</h3>
                </template>
                <template #body>
                    <div v-if="alert.display === true"
                        class="p-4 mb-4 text-sm rounded-lg"
                         :class="{'text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400': alert.success, 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400': !alert.success}" role="alert">
                        <span class="font-medium" v-if="alert.success">Успех!</span>
                        <span class="font-medium" v-if="!alert.success">Ошибка!</span>
                        <div>{{ alert.message }}</div>
                    </div>

                    <form>
                        <Input v-model="nameInput" label="Название" name="suggested-name"/>
                        <TextArea v-model="descriptionInput" label="Описание" name="suggested-description" />
                        <Input v-model="linkInput" label="Ссылка" />
                    </form>
                </template>
                <template #footer>
                    <Button text="Отправить" @click="sendUsefulLink"/>
                </template >
            </Modal>
        </div>

        <!-- Строка поиска -->
        <div class="mb-3">
            <Input id="search" label="Поиск по названию" v-model="searchTerm"/>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Название
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="link in filteredStories" :key="link.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ link.name }}
                    </th>
                    <td class="px-6 py-4 flex justify-end">
                        <Modal :id="link.id" button-text="Подробнее" accept-button="Перейти">
                            <template #header>
                                <h3 class="font-bold text-2xl dark:text-white">{{ link.name }}</h3>
                            </template>
                            <template #body>
                                {{ link.description }}
                            </template>
                            <template #footer>
                                <Button text="Перейти" target="_blank" :href="link.url" />
                            </template >
                        </Modal>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
/* ваш стиль для таблицы */
</style>
