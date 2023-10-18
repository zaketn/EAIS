<script setup>
import Input from "@/Components/Partials/Input.vue";
</script>

<template>
    <div class="container mx-auto mt-3 px-3">
        <h1 class="text-4xl font-bold mb-5">Настройки переменных для калькулятора</h1>
        <div>
            <Input id="living_wage" label="Прожиточный минимум" />
            <Input id="essential_items_share" label="Доля предметов первой необходимости в структуре потребительских расходов домашнего хозяйства" />
            <Input id="durable_goods_share" label="Доля предметов длительного пользования в структуре потребительских расходов домашнего хозяйства" />
            <Input id="luxury_goods_share" label="Доля предметов роскоши в структуре потребительских расходов домашнего хозяйства" />
            <Input id="luxury_lower_limit" label="Нижняя граница среднедушевого денежного дохода домашнего хозяйства в месяц, позволяющего приобретать предметы роскоши" />
            <Input id="income_tax_rate" label="Ставка налога на доходы физических лиц" />
        </div>
    </div>
</template>

<style scoped>

</style>
