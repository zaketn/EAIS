<script setup>
import Line from '../Partials/LineChart.vue'
import Input from "@/Components/Partials/Input.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import Button from "@/Components/Partials/Button.vue";
import {ref} from "vue";
import {useRoute} from "vue-router";

const chartDataDemand = ref()
const chartDataIncome = ref()
const dataIntersection = ref([])

const chartData = ref({
    labels: Array.from(Array(120000).keys()),
    datasets: [
        {
            type: 'line',
            label: 'Величина(объем) спроса на предметы первой необходимости, предметы длительного пользования и предметы роскоши',
            data: chartDataDemand,
            borderColor: '#36A2EB',
            backgroundColor: '#9BD0F5',
            color: '#fff',
        },
        {
            type: 'line',
            label: 'Уровень дохода',
            data: chartDataIncome,
            borderColor: '#FF6384',
            backgroundColor: '#FFB1C1',
        }
    ],
})

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
const history = ref()


const route = useRoute()

const getHistory = async () => {
    await axios.get('/api/history/' + route.params.id)
        .then((response) => {
            console.log(response.data)
            //console.log(JSON.parse(response.data.variables))
            //history.value.variables = JSON.parse(response.data.variables)
        })
}




/*if (route.path.includes('history')) {
    consumerIncome.value =
    householdAverage.value =
    householdGrowth.value =
    variableHouseholdIncome.value =
    amountOfSavings.value =
    disposableResources.value =
    lumpSumTaxes.value =
    essentialItemsShare.value =
    durableGoodsShare.value =
    luxuryGoodsShare.value =
    consumerSpendingEssentials.value =
    consumerSpendingDurable.value =
    consumerSpendingLuxury.value =
}*/

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
    console.log(calculatorSettings.value)
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

    await saveDataToDatabase()
}

const calculateEssentials = (purchasingPower) => {
    return (parseFloat(calculatorSettings.value.living_wage) * purchasingPower) / (purchasingPower + parseFloat(householdGrowth.value))
}

const calculateLongTerm = (purchasingPower) => {
    let longTerm = 0
    if (purchasingPower > calculatorSettings.value.living_wage) {
        longTerm = calculated.saturationNeedsLimitForDurableGoods * (purchasingPower - parseFloat(calculatorSettings.value.living_wage)) / ((purchasingPower + parseFloat(householdGrowth.value)))
    }

    return longTerm;
}

const calculateLuxury = (purchasingPower) => {
    let luxuryItems = 0
    if (purchasingPower > calculatorSettings.value.luxury_lower_limit) {
        luxuryItems = purchasingPower * (purchasingPower - calculatorSettings.value.luxury_lower_limit) / (purchasingPower + parseFloat(householdGrowth.value))
    }

    return luxuryItems
}

const calculateIncomeLevel = (purchasingPower) => {
    return (parseFloat(variableHouseholdIncome.value) + purchasingPower * parseFloat(calculated.avgHouseholdPropensityToConsume)) *
        (1 - calculatorSettings.value.income_tax_rate) - parseFloat(lumpSumTaxes.value)
}

const calculate = async () => {
    await getCalculatedParameters()

    let dataDemand = []
    let dataIncome = []

    for (let purchasingPower = 0; purchasingPower < 120000; purchasingPower += 768) {
        const essentials = calculateEssentials(purchasingPower)
        const longTerm = calculateLongTerm(purchasingPower)
        const luxuryItems = calculateLuxury(purchasingPower)
        const demandEssentialsLuxury = essentials + longTerm + luxuryItems
        const incomeLevel = calculateIncomeLevel(purchasingPower)
        const P = incomeLevel - demandEssentialsLuxury

        // Если разница в значениях меньше 120 - ставим линию, линия может быть одна на 1200 точек
        if (Math.abs(demandEssentialsLuxury - incomeLevel) < 120) {
            if(dataIntersection.value.length === 0){
                dataIntersection.value.push(purchasingPower)
            } else if (Math.abs(purchasingPower - dataIntersection.value[dataIntersection.value.length - 1]) > 1200) {
                dataIntersection.value.push(purchasingPower)
            }
        }

        dataDemand.push({x: purchasingPower, y: demandEssentialsLuxury})
        dataIncome.push({x: purchasingPower, y: incomeLevel})
    }

    chartDataDemand.value = dataDemand
    chartDataIncome.value = dataIncome

    for (let intersectionPoint of dataIntersection.value) {
        const line = {
            type: 'line',
            axis: 'y',
            label: 'Пересечение',
            data: [{x: parseInt(intersectionPoint), y: 0}, {x: parseInt(intersectionPoint), y: 120000}],
            borderColor: '#FFA500',
            backgroundColor: '#FFA500',
        }

        chartData.value.datasets.push(line)
    }
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

const saveDataToDatabase = async () => {
    const dataToSave = {
        consumerIncome: consumerIncome.value,
        householdAverage: householdAverage.value,
        householdGrowth: householdGrowth.value,
        variableHouseholdIncome: variableHouseholdIncome.value,
        amountOfSavings: amountOfSavings.value,
        disposableResources: disposableResources.value,
        lumpSumTaxes: lumpSumTaxes.value,
        essentialItemsShare: essentialItemsShare.value,
        durableGoodsShare: durableGoodsShare.value,
        luxuryGoodsShare: luxuryGoodsShare.value,
        consumerSpendingEssentials: consumerSpendingEssentials.value,
        consumerSpendingDurable: consumerSpendingDurable.value,
        consumerSpendingLuxury: consumerSpendingLuxury.value,
        livingWage: calculatorSettings.value.living_wage,
        luxuryLowerLimit: calculatorSettings.value.luxury_lower_limit,
        incomeTaxRate: calculatorSettings.value.income_tax_rate,
    };

    const jsonDataToSave = JSON.stringify(dataToSave);

    try {
        const response = await axios.post('/api/calculator-history/save-history', { variables: jsonDataToSave });
        if (response.status >= 200 && response.status < 300) {
            console.log('Сохранено');
        }
    } catch (error) {
        console.error('Ошибка: ', error);
    }
};

console.log(route.params.id);

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto mt-3 px-3">
        <div class="container mb-5">
            <Line :chartData="chartData" v-if="chartDataDemand && chartDataIncome"/>
        </div>
        <div class="container">
            <form>
                <Button @click.prevent="calculate" text="Рассчитать"/>

                <fieldset class="border-2 border-solid rounded p-5 mb-5">
                    <legend class="text-gray-900 font-medium dark:text-white">Обязательные параметры.</legend>
                    <Input id="consumer_income"
                           type="number"
                           v-model.float="consumerIncome"
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
