<script setup>
import Line from '../Partials/LineChart.vue'
import Input from "@/Components/Partials/Input.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import Button from "@/Components/Partials/Button.vue";
import {ref} from "vue";

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

const purchasingPower = 36564
const calculatorSettings = ref()
const calculated = {}

const consumerIncome = ref("23067.6")
const householdAverage = ref("44856")
const householdGrowth = ref("4636")
const variableHouseholdIncome = ref("1001")
const amountOfSavings = ref("4880")
const disposableResources = ref("35066.1")
const lumpSumTaxes = ref("174.28")
const essentialItemsShare = ref()
const durableGoodsShare = ref()
const luxuryGoodsShare = ref()
const consumerSpendingEssentials = ref()
const consumerSpendingDurable = ref()
const consumerSpendingLuxury = ref()

const getCalculatorSettings = async () => {
    await axios.get('/api/calculator-parameters')
        .then((response) => {
            let settings = {}

            response.data.map((setting) => {
                settings[setting.slug] = parseFloat(setting.value)
            })

            calculatorSettings.value = settings
        })
        .catch((error) => console.log(error))
}

const loadExpertDataIfNotSet = async () => {
    await getCalculatorSettings()

    if (!essentialItemsShare.value) {
        essentialItemsShare.value = parseFloat(calculatorSettings.value.essential_items_share)
    }
    if (!durableGoodsShare.value) {
        durableGoodsShare.value = parseFloat(calculatorSettings.value.durable_goods_share)
    }
    if (!luxuryGoodsShare.value) {
        luxuryGoodsShare.value = parseFloat(calculatorSettings.value.luxury_goods_share)
    }
}

const getCalculatedParameters = async () => {
    await loadExpertDataIfNotSet()

    const livingWage = parseFloat(calculatorSettings.value.living_wage)

    // Если не задано пользователем, то определяется расчётно
    if (!consumerSpendingEssentials.value) {
        consumerSpendingEssentials.value = essentialItemsShare.value * consumerIncome.value
    }
    if (!consumerSpendingDurable.value) {
        consumerSpendingDurable.value = durableGoodsShare.value * consumerIncome.value
    }
    if (!consumerSpendingLuxury.value) {
        consumerSpendingLuxury.value = luxuryGoodsShare.value * consumerIncome.value
    }

    // Предел насыщения потребностей в предметах длительного пользования (в рублях)
    calculated.saturationNeedsLimitForDurableGoods = ((parseFloat(consumerSpendingEssentials.value) + parseFloat(consumerSpendingDurable.value)) * (parseFloat(householdAverage.value) + parseFloat(householdGrowth.value))) / (parseFloat(householdAverage.value) - livingWage)

    // Средняя склонность домашнего хозяйства к потреблению
    calculated.avgHouseholdPropensityToConsume = 1 - parseFloat(amountOfSavings.value) / parseFloat(disposableResources.value)
}

const calculateEssentials = () => {
    return (parseFloat(calculatorSettings.value.living_wage) * purchasingPower) / (purchasingPower + parseFloat(householdGrowth.value))
}

const calculateLongTerm = () => {
    let longTerm = 0
    if (purchasingPower > calculatorSettings.value.living_wage) {
        longTerm = calculated.saturationNeedsLimitForDurableGoods * (purchasingPower - parseFloat(calculatorSettings.value.living_wage)) / ((purchasingPower + parseFloat(householdGrowth.value)))
    }

    return longTerm;
}

const calculateLuxury = () => {
    let luxuryItems = 0
    if (purchasingPower > calculatorSettings.value.luxury_lower_limit) {
        luxuryItems = purchasingPower * (purchasingPower - calculatorSettings.value.luxury_lower_limit) / (purchasingPower + parseFloat(householdGrowth.value))
    }

    return luxuryItems
}

const calculateIncomeLevel = () => {
    return (parseFloat(variableHouseholdIncome.value) + purchasingPower * parseFloat(calculated.avgHouseholdPropensityToConsume)) *
        (1 - calculatorSettings.value.income_tax_rate) - parseFloat(lumpSumTaxes.value)
}

const calculate = async () => {
    await getCalculatedParameters()

    const essentials = calculateEssentials()
    const longTerm = calculateLongTerm()
    const luxuryItems = calculateLuxury()
    const demandEssentialsLuxury = essentials + longTerm + luxuryItems
    const incomeLevel = calculateIncomeLevel()
    const P = incomeLevel - demandEssentialsLuxury
}

const inputLabels = {
    consumer_income: 'Потребительские расходы домашнего хозяйства (покупательская способность)',
    household_average: 'Среднедушевой денежный доход домашнего хозяйства',
    household_average_prev_year: 'Среднедушевой денежный доход домашнего хозяйства(прошлый год)',
    household_growth: 'Прирост среднедушевого денежного дохода домашнего хозяйства',
    variable_household_income: 'Непостоянный доход домашнего хозяйства',
    amount_of_savings: 'Сумма сбережений, сформированных домашним хозяйством',
    disposable_resources: 'Располагаемые ресурсы домашнего хозяйства',
    lump_sum_taxes: 'Сумма аккордных налогов, уплачиваемых домашним хозяйством',
    essential_items_share: 'Доля предметов первой необходимости в структуре потребительских расходов домашнего хозяйства',
    durable_goods_share: 'Доля предметов длительного пользования в структуре потребительских расходов домашнего хозяйства',
    luxury_goods_share: 'Доля предметов роскоши в структуре потребительских расходов домашнего хозяйства',
    consumer_spending_essentials: 'Потребительские расходы домашнего хозяйства на приобретение предметов первой необходимости',
    consumer_spending_durable: 'Потребительские расходы домашнего хозяйства на приобретение предметов длительного пользования',
    consumer_spending_luxury: 'Потребительские расходы домашнего хозяйства на приобретение предметов роскоши',
}

const inputPopovers = {
    consumer_income: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    household_average: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    household_growth: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    variable_household_income: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    amount_of_savings: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    disposable_resources: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    lump_sum_taxes: 'В среднем на члена домашнего хозяйства в месяц, в рублях',
    consumer_spending_essentials: 'В рублях',
    consumer_spending_durable: 'В рублях',
    consumer_spending_luxury: 'В рублях',
}
</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto mt-3 px-3">
        <div class="container mb-5">
            <Line :data="chartData"/>
        </div>
        <div class="container">
            <form>
                <Button @click.prevent="calculate" text="Рассчитать"/>

                <fieldset class="border-2 border-solid rounded p-5 mb-5">
                    <legend class="text-gray-900 font-medium dark:text-white">Обязательные параметры.</legend>
                    <Input id="consumer_income"
                           type="number"
                           v-model="consumerIncome"
                           :label="inputLabels.consumer_income"
                           :popoverText="inputPopovers.consumer_income"/>

                    <Input id="household_average"
                           type="number"
                           v-model="householdAverage"
                           :label="inputLabels.household_average"
                           :popoverText="inputPopovers.household_average"/>

                    <Input id="household_growth"
                           type="number"
                           v-model="householdGrowth"
                           :label="inputLabels.household_growth"
                           :popoverText="inputPopovers.household_growth"/>

                    <Input id="variable_household_income"
                           type="number"
                           v-model="variableHouseholdIncome"
                           :label="inputLabels.variable_household_income"
                           :popoverText="inputPopovers.variable_household_income"/>

                    <Input id="amount_of_savings"
                           type="number"
                           v-model="amountOfSavings"
                           :label="inputLabels.amount_of_savings"
                           :popoverText="inputPopovers.amount_of_savings"/>

                    <Input id="disposable_resources"
                           type="number"
                           v-model="disposableResources"
                           :label="inputLabels.disposable_resources"
                           :popoverText="inputPopovers.disposable_resources"/>

                    <Input id="lump_sum_taxes"
                           type="number"
                           v-model="lumpSumTaxes"
                           :label="inputLabels.lump_sum_taxes"
                           :popoverText="inputPopovers.lump_sum_taxes"/>
                </fieldset>

                <fieldset class="border-2 border-solid rounded p-5 mb-5">
                    <legend class="text-gray-900 font-medium dark:text-white">Опционально для заполнения. При отсутствии
                        будет взят средний показатель.
                    </legend>

                    <Input id="essential_items_share"
                           type="number"
                           v-model="essentialItemsShare"
                           :label="inputLabels.essential_items_share"/>

                    <Input id="durable_goods_share"
                           type="number"
                           v-model="durableGoodsShare"
                           :label="inputLabels.durable_goods_share"/>

                    <Input id="luxury_goods_share"
                           type="number"
                           v-model="luxuryGoodsShare"
                           :label="inputLabels.luxury_goods_share"/>

                    <Input id="consumer_spending_essentials"
                           type="number"
                           v-model="consumerSpendingEssentials"
                           :label="inputLabels.consumer_spending_essentials"
                           :popoverText="inputPopovers.consumer_spending_essentials"/>

                    <Input id="consumer_spending_durable"
                           type="number"
                           v-model="consumerSpendingDurable"
                           :label="inputLabels.consumer_spending_durable"
                           :popoverText="inputPopovers.consumer_spending_durable"/>

                    <Input id="consumer_spending_luxury"
                           type="number"
                           v-model="consumerSpendingLuxury"
                           :label="inputLabels.consumer_spending_luxury"
                           :popoverText="inputPopovers.consumer_spending_luxury"/>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
