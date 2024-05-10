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
              :isShowed="user.data.role && user.data.role.name === 'Админ'"
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

    <LinkCard :to="{name: 'settings.incomeCalculator'}"
              :isShowed="user.data.role && user.data.role.name === 'Админ'"
              header="Настройки калькулятора"
              description="Настройте предустановленные значения для калькулятора"/>

    <LinkCard :to="{name: 'buisnessCalculator'}"
              :isShowed="true"
              header="Бизнес-калькулятор"
              description="Бизнес-калькулятор"/>
</template>

<style scoped>

</style>
