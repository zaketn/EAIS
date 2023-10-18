<script setup>
    const props = defineProps(['id', 'label', 'popoverText'])
</script>

<template>
    <div>
        <label for="first_name"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ props.label }}

            <button v-if="props.popoverText !== undefined"
                    :data-popover-target="props.id + '_popover'"
                    data-popover-placement="bottom-end"
                    type="button">
                <svg class="w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Показать подсказку</span></button>

            <span v-if="props.popoverText !== undefined"
                 data-popover :id="props.id + '_popover'"
                 role="tooltip"
                 class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <span class="p-3">
                    <span class="w-fit">{{ props.popoverText }}</span>
                </span>
            </span>

        </label>
        <input type="text"
               :id="props.id"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg mb-3 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               required>
    </div>
</template>

<style scoped>

</style>
