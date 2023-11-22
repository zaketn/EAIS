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
              :isShowed="user.data.role && (user.data.role.name === 'Админ' || user.data.role.name === 'Менеджер')"
              header="Статистика"
              description="Просмотр статистики по табличным данным"/>

    <LinkCard :to="{name: 'incomeCalculator'}"
              :isShowed="user.data.role && (user.data.role.name === 'Админ' || user.data.role.name === 'Менеджер')"
              header="Калькулятор"
              description="Идентификация диапазонов благосостояния"/>

</template>

<style scoped>

</style>
