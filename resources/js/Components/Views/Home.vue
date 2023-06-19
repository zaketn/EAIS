<script setup>
import {metaInfo} from "../../Stores/UserStore.js";

const meta = metaInfo()
const role = meta.role ? JSON.parse(meta.role) : undefined
</script>

<template>
    <div class="container mx-auto p-3">
        <div class="flex gap-8 md:flex-col">
            <router-link :to="{name: 'tables'}"
                         v-if="role && role.name === 'Админ'"
                         class="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Таблицы</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Просмотр таблиц с сайта </p>
            </router-link>

            <router-link :to="{name: 'statistics'}"
                         v-if="role && (role.name === 'Админ' || role.name === 'Менеджер')"
                         class="block grow p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Статистика</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Просмотр статистики по табличным данным</p>
            </router-link>
        </div>
    </div>
</template>

<style scoped>

</style>
