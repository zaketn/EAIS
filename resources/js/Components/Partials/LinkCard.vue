<script setup>
const props = defineProps(['to', 'isShowed', 'header', 'description'])
</script>

<template>
    <router-link :to="props.to" v-if="props.isShowed ?? false"
                 class="block w-96 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ props.header }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
            {{ props.description }}
        </p>
    </router-link>
</template>

<style scoped>

</style>
