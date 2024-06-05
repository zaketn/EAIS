<script setup>

import Navbar from "../Partials/Navbar.vue";
import Input from "../Partials/Input.vue";
import Loading from "../Partials/Loading.vue";
import {onMounted, ref} from "vue";
import Button from "../Partials/Button.vue";
import OpenAI from "openai";
import {useAiRecommendationsStore} from "../../Stores/AiStore";

const aiStore = useAiRecommendationsStore()

const businessData = ref({})
const loading = ref(false)
const aiMessage = ref(null)

onMounted(() => {
    aiStore.fields.forEach((fieldCategory) => {
        fieldCategory.items.forEach((field) => {
            businessData.value[field.name] = null
        })
    })
})

const getRecommendations = async () => {
    let prompt = 'Ты - бизнес-консультант, специализирующийся на малом бизнесе. Твоя задача - дать рекомендации по улучшению бизнеса, основываясь на предоставленной информации. \n' +
        'Информация о бизнесе:\n';

    Object.keys(businessData.value).forEach(field => {
        if(!businessData.value[field]) return;
        prompt += `${field}: ${businessData.value[field]}\n`
    })

    prompt += 'Рекомендации:\n' + 'Дай 5 конкретных рекомендаций, которые помогут улучшить этот бизнес. Учитывай всю предоставленную информацию, чтобы сделать рекомендации максимально релевантными.'

    const openai = new OpenAI({
        apiKey: import.meta.env.VITE_AI_API_KEY,
        dangerouslyAllowBrowser: true
    });

    loading.value = true

    const chatCompletion = await openai.chat.completions.create({
        messages: [{ role: "user", content: prompt }],
        model: "gpt-3.5-turbo",
    });

    aiMessage.value = chatCompletion.choices[0].message.content

    loading.value = false
}

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>


    <div class="container flex flex-col gap-6 mx-auto mt-3 px-3">
        <div class="flex justify-between gap-4">
            <form class="w-1/2 flex flex-col gap-4">
                <div v-for="field in aiStore.fields">
                    <p class="font-bold dark:text-white">
                        {{ field.name }}
                    </p>
                    <div class="bg-gray-50 p-4 rounded dark:bg-gray-800">
                        <Input v-for="item in field.items"
                               :id="item.name"
                               :popover-text="item.popover"
                               :label="item.name"
                               v-model="businessData[item.name]"/>
                    </div>
                </div>
                <Button text="Отправить" @click.prevent="getRecommendations" />
            </form>

            <div class="w-1/2 flex flex-col gap-4 bg-gray-50 p-4 rounded dark:bg-gray-800">
<!--                <p v-if="!aiMessage && loading === false" class="block p-3 rounded bg-yellow-600 text-white">-->
<!--                    Заполните поля, характеризующие ваш бизнес, тут появятся рекомендации от нейронной сети.-->
<!--                </p>-->

                <Loading v-if="!aiMessage && loading === true" />

                <pre
                    class="ai-response block text-white bg-blue-700 p-3 rounded text-wrap font-sans">Персонализированные услуги и забота о клиентах:

Консультации и помощь: Обучите персонал оказывать помощь пожилым людям, помогать им с выбором товаров, давать рекомендации и сопровождать в магазине.
Программа лояльности: Внедрите простую и понятную программу лояльности с бонусами за регулярные покупки. Например, скидка или подарок при покупке на определенную сумму.
Ассортимент и специализация:

Специфические товары: Учитывайте потребности пожилых людей, расширьте ассортимент товаров, которые особенно важны для этой аудитории (медицинские товары, продукты для здорового питания, товары для домашнего удобства).
Местные продукты: Включите в ассортимент местные продукты, которые могут вызвать ностальгию и доверие у пожилых людей.
Улучшение маркетинговой стратегии:

Таргетированная реклама: Используйте бюджет на маркетинг для таргетированной рекламы в социальных сетях и местных СМИ, направленной на пожилую аудиторию и их родственников, которые могут делать покупки для них.
Печатная реклама: Разместите рекламу в местных газетах, на радио и в местах, которые посещают пожилые люди (поликлиники, дома культуры).
Доступность и удобство:

Бесплатная доставка: Введите услугу бесплатной или недорогой доставки для пожилых людей, особенно если они покупают на определенную сумму. Это особенно важно для тех, кто затрудняется посещать магазин лично.
Доступная навигация: Сделайте магазин удобным для передвижения, разместите товары на доступных уровнях и создайте удобную навигацию.
Общественные мероприятия и сотрудничество:

Мероприятия для пожилых: Организуйте регулярные мероприятия, такие как дни здоровья, лекции по здоровому питанию или встречи с интересными людьми. Это привлечет пожилых людей и повысит их лояльность.
Партнерство с социальными службами: Сотрудничайте с местными социальными службами и организациями, занимающимися помощью пожилым людям, чтобы предлагать специальные акции и скидки для их клиентов.
                </pre>
            </div>
        </div>
    </div>
</template>

<style scoped>
.ai-response {
    text-wrap: wrap;
}
</style>
