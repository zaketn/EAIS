<script setup>
    const props = defineProps(['name'])
</script>

<template>
    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
        <legend class="text-gray-900 font-medium dark:text-white">{{ props.name }}</legend>
        <slot></slot>
    </fieldset>
</template>

<style scoped>

</style>
