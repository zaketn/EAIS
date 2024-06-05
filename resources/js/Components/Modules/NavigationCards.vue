<script setup>
import {useAuthStore} from "@/Stores/AuthStore";
import {useUserStore} from "@/Stores/UserStore";
import LinkCard from "@/Components/Partials/LinkCard.vue";

const auth = useAuthStore()
const userStore = useUserStore()

const user = await userStore.getUser()
</script>

<template>
    <LinkCard :to="{name: 'buisnessCalculator'}"
              :isShowed="true"
              header="Бизнес-калькулятор"
              description="Бизнес-калькулятор"/>

    <LinkCard :to="{name: 'aiRecommendations'}"
              :isShowed="true"
              header="Рекомендации от ИИ"
              description="Получите персональные рекоммендации от ИИ, с учётом особенностей вашего бизнеса"/>

    <LinkCard :to="{name: 'governmentSupport'}"
              :isShowed="true"
              header="Статистика о поддержке малого и среднего бизнеса государством"
              description="Просмотр, оказываемой бизнесу, поддержки государством"/>

    <LinkCard :to="{name: 'tables'}"
              :isShowed="true"
              header="Реестр поддержки"
              description="Просмотр реестра поддержки с сайта "/>

    <LinkCard :to="{name: 'incomeCalculator'}"
              :isShowed="true"
              header="Калькулятор идентификации диапазонов благосостояния"
              description="Идентификация диапазонов благосостояния"/>
</template>

<style scoped>

</style>
