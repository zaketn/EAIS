<script setup>
import { useAuthStore } from "@/Stores/AuthStore";
import Button from "@/Components/Partials/Button.vue";
import Input from "@/Components/Partials/Input.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import { ref } from "vue";
import { useRouter } from 'vue-router'

const router = useRouter()
const auth = useAuthStore()

const email = ref()
const password = ref()
const password_confirmation = ref()
const name = ref()

const hasErrors = ref(false)

const registerUser = async () => {
    const registerStatus = await auth.register(email.value, password.value, name.value, password_confirmation.value)

    if(registerStatus >= 200 && registerStatus < 300){
        // редирект на страницу входа после успешной регистрации
        await router.push({name: 'home'})
    } else {
        const inputs = document.querySelectorAll('#email, #password, #password_confirmation, #name')
        for(let input of inputs){
            hasErrors.value = true
        }
    }

}
</script>

<template>
    <Suspense>
        <Navbar />
    </Suspense>

    <section class="container mx-auto">
        <div class="bg-gray-50 dark:bg-gray-900 w-1/2 mx-auto">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Регистрация
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <Input id="name" type="text" name="name" label="Имя" v-model="name" :display="hasErrors ? 'error' : 'default'"/>
                            <Input id="email" type="email" name="login" label="Электронная почта" v-model="email" :display="hasErrors ? 'error' : 'default'"/>
                            <Input id="password" type="password" name="password" label="Пароль" v-model="password" :display="hasErrors ? 'error' : 'default'"/>
                            <Input id="password_confirmation" type="password" name="password_confirmation" label="Подтвердите пароль" v-model="password_confirmation" :display="hasErrors ? 'error' : 'default'"/>
                            <p v-if="hasErrors" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">
                                Вы ввели некорректные данные. Попробуйте ещё раз.
                            </p>
                            <Button @click.prevent="registerUser" text="Зарегистрироваться"/>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Уже есть аккаунт? <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Войти</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
