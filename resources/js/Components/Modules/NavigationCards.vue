<script setup>
import {useAuthStore} from "@/Stores/AuthStore";
import {useUserStore} from "@/Stores/UserStore";
import LinkCard from "@/Components/Partials/LinkCard.vue";

const auth = useAuthStore()
const userStore = useUserStore()

const user = await userStore.getUser()
</script>

<template>
    <LinkCard :to="{name: 'tables'}"
              :isShowed="true"
              header="Таблицы"
              description="Просмотр таблиц с сайта "/>

    <LinkCard :to="{name: 'statistics'}"
              :isShowed="true"
              header="Статистика"
              description="Просмотр статистики по табличным данным"/>

    <LinkCard :to="{name: 'incomeCalculator'}"
              :isShowed="true"
              header="Калькулятор"
              description="Идентификация диапазонов благосостояния"/>

    <LinkCard :to="{name: 'governmentSupport'}"
              :isShowed="true"
              header="Поддержка государства"
              description="Просмотр, оказываемой бизнесу, поддержки государством"/>

    <LinkCard :to="{name: 'buisnessCalculator'}"
              :isShowed="true"
              header="Бизнес-калькулятор"
              description="Бизнес-калькулятор"/>

    <LinkCard :to="{name: 'aiRecommendations'}"
              :isShowed="true"
              header="Рекомендации от ИИ"
              description="Получите персональные рекоммендации от ИИ, с учётом особенностей вашего бизнеса"/>
</template>

<style scoped>

</style>
