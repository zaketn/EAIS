<script setup>
import Input from "@/Components/Partials/Input.vue";
import {onMounted, ref} from "vue";
import Button from "@/Components/Partials/Button.vue";
import Navbar from "@/Components/Partials/Navbar.vue";


const settings = ref()

onMounted(() => {
    getSettings()
})

const getSettings = () => {
    axios.get('/api/calculator-parameters')
        .then((response) => settings.value = response.data)
        .catch((error) => console.log(error))
}

const saveSettings = () => {
    const inputs = document.querySelectorAll('input')
    for(let input of inputs){
        const name = input.getAttribute('name')
        const value = input.value
        if(name === '_token') continue;

        axios.patch('/api/calculator-parameters/' + name, { value })
            .then(response => console.log(response.data))
            .catch(error => console.error(error))
    }

    console.log(inputs)
}

</script>

<template>
    <Suspense>
        <Navbar />
    </Suspense>

    <form class="container mx-auto mt-3 px-3">
        <h1 class="text-4xl font-bold mb-5 dark:text-white">Настройки переменных для калькулятора</h1>
        <Button @click.prevent="saveSettings" text="Сохранить"/>
        <div>
            <Input v-for="setting in settings"
                   :id="setting.id"
                   :name="setting.slug"
                   :label="setting.name"
                   :modelValue="setting.value"
            />
        </div>
    </form>
</template>

<style scoped>

</style>
