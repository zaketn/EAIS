<script setup>
import {onBeforeMount} from "vue";
import {useRoute} from "vue-router";

const route = useRoute()

onBeforeMount(() => {

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
    <router-view :key="route.path"></router-view>

    <div id="modal-container"></div>
</template>

<style scoped>

</style>
