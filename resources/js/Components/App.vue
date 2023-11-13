<script setup>
import Navbar from "./Partials/Navbar.vue";
import {onBeforeMount} from "vue";
import {initFlowbite} from "flowbite";

onBeforeMount(() => {
    initFlowbite()
    themeInit()
})

const themeInit = () => {
    const localStorageTheme = localStorage.getItem('theme')

    if(localStorage.getItem('theme')){
        document.documentElement.classList.add(localStorageTheme);
    } else {
        localStorage.setItem('theme', 'light');
        document.documentElement.classList.add('light');
    }
}
</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <router-view></router-view>

    <div id="modal-container"></div>
</template>

<style scoped>

</style>
