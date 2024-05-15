<script setup>
import {defineModel, defineProps} from 'vue';

const selectedValue = defineModel()
const props = defineProps(['id', 'label', 'disabledValue'])

</script>

<template>
    <div>
        <label v-if="props.label" :for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ props.label }}
        </label>
        <select :id="props.id"
                v-model="selectedValue"
                class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option v-if="props.disabledValue" disabled>
                {{ disabledValue }}
            </option>
            <slot></slot>
        </select>
    </div>
</template>

<style scoped>

</style>
