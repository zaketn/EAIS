<script setup>
import {useAuthStore} from "@/Stores/AuthStore";
import Button from "@/Components/Partials/Button.vue";
import Input from "@/Components/Partials/Input.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import {ref} from "vue";
import {useRouter} from 'vue-router'

const router = useRouter()
const auth = useAuthStore()

const email = ref()
const password = ref()

const hasErrors = ref(false)

const authUser = async () => {
    const authStatus = await auth.login(email.value, password.value)

    if(authStatus >= 200 && authStatus < 300){
        await router.push({name: 'home'})
    } else {
        const inputs = document.querySelectorAll('#email, #password')
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
                            Войдите в свой аккаунт
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <Input id="email" type="email" name="login" label="Электронная почта" v-model="email" :display="hasErrors ? 'error' : 'default'"/>
                            <Input id="password" type="password" name="password" label="Пароль" v-model="password" :display="hasErrors ? 'error' : 'default'"/>
                            <p v-if="hasErrors" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">
                                Вы ввели некорректные данные. Попробуйте ещё раз.
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox"
                                               class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                               required="">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-gray-500 dark:text-gray-300">Запомнить
                                            меня</label>
                                    </div>
                                </div>
                                <a href="#"
                                   class="text-sm font-medium text-primary-600 hover:underline dark:text-gray-500">Забыли пароль?</a>
                            </div>
                            <Button @click.prevent="authUser" text="Войти"/>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Нет аккаунта? <a href="/registration"
                                                 class="font-medium text-primary-600 hover:underline dark:text-primary-500">Зарегистрироваться</a>
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
