<script setup>
import Line from '../Partials/LineChart.vue'
import Input from "@/Components/Partials/Input.vue";
import Navbar from "@/Components/Partials/Navbar.vue";


const chartData = {
    labels: ['', '', ''],
    datasets: [
        {
            label: 'Величина(объем) спроса на предметы первой необходимости, предметы длительного пользования и предметы роскоши',
            data: [3931 / 134, 90041 / 134, 82374 / 132],
            borderColor: '#36A2EB',
            backgroundColor: '#9BD0F5',
            color: '#fff'
        },
        {
            label: 'Уровень дохода',
            data: [886826 / 5262, 5242415 / 10652, 2933327 / 5262],
            borderColor: '#FF6384',
            backgroundColor: '#FFB1C1',
        },
    ],
}
</script>

<template>
    <Suspense>
        <Navbar />
    </Suspense>

    <div class="container mx-auto mt-3 px-3">
            <div class="container mb-5">
                <Line :data="chartData"/>
            </div>
            <div class="container">
                <form action="">
                    <fieldset class="border-2 border-solid rounded p-5 mb-5">
                        <legend class="text-gray-900 font-medium dark:text-white">Обязательные параметры.</legend>

                        <Input id="consumer_income" label="Потребительские доходы домашнего хозяйства" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                        <Input id="household_average" label="Среднедушевой денежный доход домашнего хозяйства" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                        <Input id="household_growth" label="Прирост среднедушевого денежного дохода домашнего хозяйства" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                        <Input id="variable_household_income" label="Непостоянный доход домашнего хозяйства" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                        <Input id="amount_of_savings" label="Сумма сбережений, сформированных домашним хозяйством" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                        <Input id="disposable_resources" label="Располагаемые ресурсы домашнего хозяйства" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                        <Input id="lump_sum_taxes" label="Сумма аккордных налогов, уплачиваемых домашним хозяйством" popoverText="В среднем на члена домашнего хозяйства в месяц, в рублях"/>
                    </fieldset>

                    <fieldset class="border-2 border-solid rounded p-5 mb-5">
                        <legend class="text-gray-900 font-medium dark:text-white">Опционально для заполнения. При отсутствии будет взят средний показатель.</legend>

                        <Input id="essential_items_share" label="Доля предметов первой необходимости в структуре потребительских расходов домашнего хозяйства" />
                        <Input id="durable_goods_share" label="Доля предметов длительного пользования в структуре потребительских расходов домашнего хозяйства" />
                        <Input id="luxury_goods_share" label="Доля предметов роскоши в структуре потребительских расходов домашнего хозяйства" />
                        <Input id="consumer_spending_essentials" label="Потребительские расходы домашнего хозяйства на приобретение предметов первой необходимости" popoverText="В рублях" />
                        <Input id="consumer_spending_durable" label="Потребительские расходы домашнего хозяйства на приобретение предметов длительного пользования" popoverText="В рублях" />
                        <Input id="consumer_spending_luxury" label="Потребительские расходы домашнего хозяйства на приобретение предметов роскоши" popoverText="В рублях" />
                    </fieldset>
                </form>
            </div>
        </div>
</template>

<style scoped>

</style>
