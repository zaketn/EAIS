<script setup>
import {computed, onMounted} from "vue";
import {initFlowbite} from 'flowbite'

onMounted(() => {
    initFlowbite();
})

const props = defineProps(['id', 'name', 'label', 'modelValue', 'type', 'display', 'popoverText', 'readonly'])
defineEmits(['update:modelValue'])

const display = {
    default: {
        label: 'text-gray-900 dark:text-white',
        input: 'bg-gray-50 border-gray-300 text-gray-900 mb-3 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
    },
    error: {
        label: 'text-red-700 dark:text-red-500',
        input: 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
    },
    readonly_input: {
        label: 'text-gray-900 dark:text-white',
        input: 'bg-gray-90 border-gray-900 text-gray-300 mb-3 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
    }
}

const labelStyle = computed(() => props.display === 'error' ? display.error.label : display.default.label)
//const inputClass = computed(() => props.readonly === 'true' ? display.readonly_input.input : display.default.input) чето я не смог так сделать
const inputClass = computed(() => props.readonly ? 'readonly-input' : '')
const inputStyle = computed(() => {
    if (props.type === 'textarea') {
        return `${props.display === 'error' ? display.error.input : display.default.input} h-64`;
    } else {
        return props.display === 'error' ? display.error.input : display.default.input;
    }
});
</script>

<template>
    <div>
        <label :for="props.id"
               class="block mb-2 text-sm font-medium"
               :class="labelStyle" >
            {{ props.label }}

            <button v-if="props.popoverText !== undefined"
                    :data-popover-target="props.id + '_popover'"
                    data-popover-placement="right-end"
                    type="button">
                <svg class="w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Показать подсказку</span></button>

            <span v-if="props.popoverText !== undefined"
                  data-popover :id="props.id + '_popover'"
                  role="tooltip"
                  class="flex absolute z-10 invisible text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <span class="p-3">
                    <span class="w-fit">{{ props.popoverText }}</span>
                </span>
            </span>

        </label>
        <component :is="props.type ?? 'textarea'"
                   :id="props.id"
                   :name="props.name"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"
                   class="block w-full p-2.5 border text-sm rounded-lg"
                   :class="[inputStyle, inputClass]"
                   :readonly="props.readonly"
                   required>
        </component>
    </div>

</template>


<style scoped>
.readonly-input {
    background-color: #bbecce;
}
</style>

