<script setup>
import {computed, ref} from "vue";
import {useRoute} from "vue-router";
import {useUserStore} from "@/Stores/UserStore";
import Button from "@/Components/Partials/Button.vue";

// TODO: Сделать обновление пользователя при входе/выходе из аккаунта
// TODO: Починить работу выпадающих списков

const userStore = useUserStore()
const user = ref(await userStore.getUser())

const currentRouteName = computed({
    get: () => useRoute().name,
    set: () => undefined
})

const linksClasses = {
    active: 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent',
    default: 'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent'
}

const tablesLink = ref()
const statsLink = ref()
const dropdownProfile = ref()
const burgerMenu = ref()

const switchTheme = () => {
    const currentTheme = localStorage.getItem('theme');
    switch (currentTheme) {
        case 'light':
            localStorage.setItem('theme', 'dark')
            break
        case 'dark':
            localStorage.setItem('theme', 'light')
            break
    }
    document.documentElement.classList.toggle('dark')
}
</script>

<template>
    <div class="container mx-auto mt-3">
        <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 mb-8">
            <div
                class="flex flex-wrap items-center justify-between p-4 rounded border-gray-700 bg-gray-100 dark:bg-gray-800">
                <router-link :to="{ name: 'home' }" class="flex items-center">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ЕАИС</span>
                </router-link>
                <button data-collapse-toggle="burger-dropdown" type="button"
                        class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="burger-dropdown" aria-expanded="false"
                        @click="toggleBurger">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto"
                     id="burger-dropdown"
                     ref="burgerMenu">
                    <ul v-if="user"
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
                        <li v-if="user.data.role && user.data.role.name === 'Админ'">
                            <router-link :to="{ name: 'users' }"
                                         :class="[currentRouteName === 'users' ? linksClasses.active : linksClasses.default]"
                                         ref="tablesLink">
                                Пользователи
                            </router-link>
                        </li>
                        <li v-if="user.data.role && user.data.role.name === 'Админ'">
                            <router-link :to="{ name: 'tables' }"
                                         :class="[currentRouteName === 'tables' ? linksClasses.active : linksClasses.default]"
                                         ref="tablesLink">
                                Таблицы
                            </router-link>
                        </li>
                        <li v-if="user.data.role && (user.data.role.name === 'Админ' || user.data.role.name === 'Менеджер')">
                            <router-link :to="{ name: 'statistics' }"
                                         :class="[currentRouteName === 'statistics' ? linksClasses.active : linksClasses.default]"
                                         ref="statsLink">Статистика
                            </router-link>
                        </li>
                        <li v-if="user.data.role && (user.data.role.name === 'Админ' || user.data.role.name === 'Менеджер')">
                            <router-link :to="{ name: 'incomeCalculator' }"
                                         :class="[currentRouteName === 'income-calculator' ? linksClasses.active : linksClasses.default]"
                                         ref="statsLink">Калькулятор
                            </router-link>
                        </li>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarProfile"
                                    @click="toggleProfileDropdown"
                                    class="flex items-center"
                                    :class="linksClasses.default">
                                {{ user.data.name }}
                                <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div id="dropdownNavbarProfile"
                                 ref="dropdownProfile"
                                 class="absolute z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-800 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                    aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <router-link :to="{ name: 'home' }"
                                                     class="text-center block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black-900 font-bold">
                                            Профиль
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'settings.incomeCalculator' } "
                                                     v-if="user.data.role.name === 'Админ'"
                                                     class="text-center block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black-900 font-bold">
                                            Настройки калькулятора
                                        </router-link>
                                    </li>
                                    <li>
                                        <button
                                            @click="switchTheme"
                                            class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black-900 font-bold">
                                            Тема
                                        </button>
                                    </li>
                                    <li>
                                        <form :action="{ name: 'logout' }" method="post" class="m-0 p-0">
                                            <button type="submit"
                                                    class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black font-bold">
                                                Выйти
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul v-else
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
                        <li>
                            <router-link :to="{ name: 'login' }"
                                         class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Войти
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<style scoped>

</style>
