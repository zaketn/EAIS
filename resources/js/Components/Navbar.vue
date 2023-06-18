<script setup>
import axios from "axios";
import {onBeforeMount, ref} from "vue";

const routes = {
    home: '/home',
    tables: '/tables',
    statistics: '/statistics',
    logout: '/logout'
}

const linksClasses = {
    active: 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent',
    default: 'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent'
}
const tablesLink = ref()
const statsLink = ref()
const dropdownProfile = ref()
const burgerMenu = ref()

let currentUser = ref({});

onBeforeMount(() => {
    themeInit()
    getCurrentUser()
})

const isIncludedInUrl = (search) => {
    return window.location.pathname.includes(search)
}

const getCurrentUser = () => {
    axios.get('/users')
        .then((response) => currentUser.value = response.data)
        .catch((error) => console.log(error))
}

const themeInit = () => {
    const localStorageTheme = localStorage.getItem('theme')

    if(localStorage.getItem('theme')){
        document.documentElement.classList.add(localStorageTheme);
    } else {
        localStorage.setItem('theme', 'light');
        document.documentElement.classList.add('light');
    }
}

const switchTheme = () => {
    const currentTheme = localStorage.getItem('theme');
    switch(currentTheme){
        case 'light':
            localStorage.setItem('theme', 'dark')
            break
        case 'dark':
            localStorage.setItem('theme', 'light')
            break
    }
    document.documentElement.classList.toggle('dark')
}

const toggleProfileDropdown = () => {
    dropdownProfile.value.classList.toggle('hidden')
}
const toggleBurger = () => {
    burgerMenu.value.classList.toggle('hidden')
}
</script>

<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="container mx-auto">

            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a :href="routes.home" class="flex items-center">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ЕАИС</span>
                </a>
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
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a :href="routes.tables"
                               :class="[isIncludedInUrl(routes.tables) ? linksClasses.active : linksClasses.default]"
                               ref="tablesLink">
                                Таблицы
                            </a>
                        </li>
                        <li>
                            <a :href="routes.statistics"
                               :class="[isIncludedInUrl(routes.statistics) ? linksClasses.active : linksClasses.default]"
                               ref="statsLink">Статистика</a>
                        </li>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" @click="toggleProfileDropdown"
                                    class="flex items-center"
                                    :class="linksClasses.default">
                                {{ currentUser.name }}
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
                                        <a href="#"
                                           class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black-900 font-black">
                                            Профиль
                                        </a>
                                    </li>
                                    <li>
                                        <button
                                            @click="switchTheme"
                                            class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black-900 font-black">
                                            Тема
                                        </button>
                                    </li>
                                    <li>
                                        <form :action="routes.logout" method="post" class="m-0 p-0">
                                            <button type="submit"
                                                    class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-black-900 font-black">
                                                Выйти
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
