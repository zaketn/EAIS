<script setup>
import {useAuthStore} from "@/Stores/AuthStore";
import {useUserStore} from "@/Stores/UserStore";
import LinkCard from "@/Components/Partials/LinkCard.vue";

const auth = useAuthStore()
const userStore = useUserStore()

const user = await userStore.getUser()
</script>

<template>
    <LinkCard :to="{name: 'aiRecommendations'}"
              :isShowed="true"
              header="Рекомендации от ИИ"
              description="Получите персональные рекоммендации от ИИ, с учётом особенностей вашего бизнеса"/>

    <LinkCard :to="{name: 'governmentSupport'}"
              :isShowed="true"
              header="Статистика о поддержке МСП государством"
              description="Статистика, оказываемой бизнесу, поддержки государством"/>

    <LinkCard :to="{name: 'tables'}"
              :isShowed="true"
              header="Реестр поддержки"
              description="Просмотр реестра поддержки с сайта ФНС"/>

    <LinkCard :to="{name: 'incomeCalculator'}"
              :isShowed="true"
              header="Калькулятор идентификации диапазонов благосостояния"
              description="Калькулятор, вычисляющий объйм спроса, относительно уровня дохода"/>

    <LinkCard :to="{name: 'buisnessCalculator'}"
              :isShowed="true"
              header="Бизнес-калькулятор"
              description="Проведение расчетов и анализ финансового состояния предприятия или проекта"/>

    <LinkCard :to="{name: 'usefulLinks'}"
              :isShowed="true"
              header="Тематические ресурсы"
              description="Ресурсы, о которых необходимо знать каждому, кто имеет бизнес."/>
</template>

<style scoped>

</style>
