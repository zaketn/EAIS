<script setup>
import Input from "@/Components/Partials/Input.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import {ref} from "vue";
import {useRoute} from "vue-router";
import { computed } from "vue";

const route = useRoute()

const isHistoryPage = ref(false)
const historyDate = ref()


//Инвестиции
const equipmentAndMachinery = ref("500000") //2 Оборудование и техника (офисное, торговое, кассовое, компьтеры и т.п.)
const technologyDevelopment = ref("500000") //4 Разработка технологий
const buyingProperty = ref("0") //5 Покупка собственной недвижимости
const stock = ref("300000") //7 Складской запас (товары, материалы)
const workingCapital = computed(() => {  //11 Оборотный капитал
    return (
        parseFloat(totalVariableCosts.value) +
        parseFloat(totalFixedCostsIncludingAllEmployeeTaxes.value)
    ).toFixed(0);
});
const totalInvestmentVolume = computed(() => {  //10 Итого, объем инвестиций:
    return (
        parseFloat(equipmentAndMachinery.value) +
        parseFloat(technologyDevelopment.value) +
        parseFloat(buyingProperty.value) +
        parseFloat(stock.value) +
        parseFloat(workingCapital.value)
    ).toFixed(0);
});

//Постоянные затраты
const salariesEmployees = ref("500000") //14 ФОТ - все оклады сотрудникам, без учета налогов
const communicationSoftwareRental = ref("200000")   //17 Связь и интернет, аренда ПО и софта
const officeOrRetailSpaceRental = ref("200000") //18 Аренда офиса или торговой точки
const loanInterestExpenses = ref("25000")   //25 Сумма процентов переплаты по кредиту
const otherAdministrativeExpenses = ref("40000")    //21 Прочие административные расходы
const totalFixedCostsIncludingAllEmployeeTaxes = computed(() => {   //23 Итого постоянные затраты, с учетом всех налогов на ФОТ
    return (
        parseFloat(salariesEmployees.value) * 1.46 +
        parseFloat(communicationSoftwareRental.value) +
        parseFloat(officeOrRetailSpaceRental.value) +
        parseFloat(loanInterestExpenses.value) +
        parseFloat(otherAdministrativeExpenses.value)
    ).toFixed(0);
});

//Переменные затраты
const monthlyAdvertisingExpenses = ref("200000")    //29 Сумма затрат на рекламу за месяц
const customerRetentionExpenses = ref("100000") //35 Сумма на удержание (возврат) клиентов
const managerBonusPercentage = ref("10")  //37 Процент премии менеджерам, % (0, если не платите процент с продаж)
const deliveryCostPerTransaction = ref("500")   //38 Стоимость доставки покупки до клиента, на один чек
const acquiringFeePercentage = ref("2") //39 Эквайринг %
const totalVariableCosts = computed(() => {  //58 Итого переменные затраты:
    return (
        parseFloat(variableCostsPerSale.value) *
        parseFloat(totalNumberOfSales.value)
    ).toFixed(0);
});

//Себестоимость и наценка
const averagePurchasePricePerUnit = ref("650")  //19 Средняя закупочная цена одного товара/услуги
const supplierDeliveryCostPerUnit = ref("125")  //26 Стоимость доставки товара/материалов от поставщика, на одну единицу
const totalCostPricePerUnit = computed(() => {  //28 Итого себестоимость единицы товара/услуги:
    return (
        parseFloat(averagePurchasePricePerUnit.value) +
        parseFloat(supplierDeliveryCostPerUnit.value)
    ).toFixed(0);
});
const averageRetailPricePerUnit = ref("3840")   //42 Средняя розничная цена единицы товара/услуги, руб
const markupPercentage = computed(() => {   //61 Наценка в %:
    return (
        ((parseFloat(averageRetailPricePerUnit.value) -
                parseFloat(totalCostPricePerUnit.value)) /
            parseFloat(totalCostPricePerUnit.value)) * 100
    ).toFixed(0);
});

//Управление воронкой
const advertisingCampaignCoverage = ref("100000")   //30 Охват рекламной кампании
const websiteStoreConversionRate = ref("7") //31 Конверсия на сайт / магазин, %
const conversionToCartLeadConsultationRate = ref("2")   //32 Конверсия в оформленную корзину, лид, консультацию с менеджером %
const paymentConversionRate = ref("80") //33 Конверсия в оплату, %
const numberOfPastCustomers = ref("5000")   //34 Количество тех, кто у вас уже покупал в прошлом
const repeatPurchaseConversionRate = ref("5")   //36 Конверсия в повторные покупки, %
const averageNumberOfItemsPerTransaction = ref("1.9")   //43 Среднее количество товаров/услуг в чеке, шт.

//Показатели воронки
const websiteOrOfflineStoreVisitors = computed(() => {  //48 Посетители сайта или офлайн магазина
    return (
        parseFloat(advertisingCampaignCoverage.value) *
        parseFloat(websiteStoreConversionRate.value) / 100
    ).toFixed(0);
});
const abandonedCartsLeadsConsultationsInOfflineStore = computed(() => { //49 Количество корзин без оплаты, лидов, консультаций в офлайн магазине
    return (
        parseFloat(websiteOrOfflineStoreVisitors.value) *
        parseFloat(conversionToCartLeadConsultationRate.value) / 100
    ).toFixed(0);
});
const numberOfSalesToNewCustomers = computed(() => { //50 Количество продаж (чеков) новым клиентам
    return (
        parseFloat(paymentConversionRate.value) *
        parseFloat(abandonedCartsLeadsConsultationsInOfflineStore.value) / 100
    ).toFixed(0);
});
const numberOfRepeatSales = computed(() => { //51 Количество повторных продаж (чеков)
    return (
        parseFloat(numberOfPastCustomers.value) *
        parseFloat(repeatPurchaseConversionRate.value) / 100
    ).toFixed(0);
});
const totalNumberOfSales = computed(() => { //53 Общее количество продаж (чеков)
    return (
        parseFloat(numberOfSalesToNewCustomers.value) +
        parseFloat(numberOfRepeatSales.value)
    ).toFixed(0);
});
const averageTransactionValue = computed(() => { //55 Средний чек, руб.
    return (
        parseFloat(averageRetailPricePerUnit.value) *
        parseFloat(averageNumberOfItemsPerTransaction.value)
    ).toFixed(0);
});

//Юнит-экономика
const customerAcquisitionRetentionCostPerBuyer = computed(() => { //54 Стоимость привлечения + удержания, на одного покупателя, руб.
    return (
        (parseFloat(monthlyAdvertisingExpenses.value) +
            parseFloat(customerRetentionExpenses.value)) /
        parseFloat(totalNumberOfSales.value)
    ).toFixed(0);
});
const salesBonusEmployeeCostsPerSaleIncludingTaxes = computed(() => { //62 ФОТ премиальной части за продажи, на одну продажу (чек), с учетом налогов
    return (
        parseFloat(averageTransactionValue.value) *
        parseFloat(managerBonusPercentage.value) * 1.46 / 100
    ).toFixed(0);
});
const variableCostsPerSale = computed(() => { //44 Переменные затраты на одну продажу (чек):
    return (
        parseFloat(customerAcquisitionRetentionCostPerBuyer.value) +
        parseFloat(salesBonusEmployeeCostsPerSaleIncludingTaxes.value) +
        parseFloat(deliveryCostPerTransaction.value) +
        parseFloat(totalCostPricePerUnit.value) +
        (parseFloat(averageTransactionValue.value) *
            parseFloat(acquiringFeePercentage.value) / 100)
    ).toFixed(0);
});
const marginPerSale = computed(() => { //68 Маржинальность на один продажу (чек)
    return (
        parseFloat(averageTransactionValue.value) -
        parseFloat(variableCostsPerSale.value)
    ).toFixed(0);
});
const breakEvenPointInNumberOfSales = computed(() => { //71 Точка безубыточности, количество продаж (чеков)
    return (
        parseFloat(totalFixedCostsIncludingAllEmployeeTaxes.value) /
        parseFloat(marginPerSale.value)
    ).toFixed(0);
});
const breakEvenRevenueInRubles = computed(() => { //73 Точка безубыточности, выручка в рублях
    return (
        parseFloat(breakEvenPointInNumberOfSales.value) *
        parseFloat(averageTransactionValue.value)
    ).toFixed(0);
});
const numberOfSalesNeededToReach1MillionRublesProfit = computed(() => { //72 Чтобы выйти на 1 млн. руб. прибыли до налогов, нужно делать продаж (чеков)
    return (
        parseFloat(breakEvenPointInNumberOfSales.value) +
        (1000000 / parseFloat(marginPerSale.value))
    ).toFixed(0);
});

//Итоговые результаты
const revenueInRubles = computed(() => { //64 Выручка, рубли
    return (
        parseFloat(totalNumberOfSales.value) *
        parseFloat(averageTransactionValue.value)
    ).toFixed(0);
});
const grossProfitInRubles = computed(() => { //67 Маржинальная прибыль, рубли
    return (
        parseFloat(revenueInRubles.value) -
        parseFloat(totalVariableCosts.value)
    ).toFixed(0);
});
const profitBeforeTaxesInRubles = computed(() => { //69 Прибыль до налогов, рубли
    return (
        parseFloat(grossProfitInRubles.value) -
        parseFloat(totalFixedCostsIncludingAllEmployeeTaxes.value)
    ).toFixed(0);
});
const investmentPaybackPeriodInMonths = computed(() => { //66 Сроки окупаемости инвестиций, месяцев (без учета налогов на прибыль)
    return (
        parseFloat(totalInvestmentVolume.value) /
        parseFloat(profitBeforeTaxesInRubles.value)
    ).toFixed(0);
});
const returnOnInvestmentAnnualizedWithoutTax = computed(() => { //65 ROI (возврат инвестиций за год, без учета налогов), %
    return (
        (parseFloat(profitBeforeTaxesInRubles.value) * 12 /
            parseFloat(totalInvestmentVolume.value)) * 100
    ).toFixed(0);
});




const inputLabels = {
    equipment_and_machinery: 'Оборудование и техника (офисное, торговое, кассовое, компьтеры)',
    technology_development: 'Разработка технологий',
    buying_property: 'Покупка собственной недвижимости',
    stock: 'Складской запас (товары, материалы)',
    working_capital: 'Оборотный капитал',
    total_investment_volume: 'Итого, объем инвестиций',

    salaries_employees: 'ФОТ - все оклады сотрудникам, без учета налогов',
    communication_software_rental: 'Связь и интернет, аренда ПО и софта',
    office_or_retail_space_rental: 'Аренда офиса или торговой точки',
    loan_interest_expenses: 'Сумма процентов переплаты по кредиту',
    other_administrative_expenses: 'Прочие административные расходы',
    total_fixed_costs_including_all_employee_taxes: 'Итого постоянные затраты, с учетом всех налогов на ФОТ',

    monthly_advertising_expenses: 'Сумма затрат на рекламу за месяц',
    customer_retention_expenses: 'Сумма на удержание (возврат) клиентов',
    manager_bonus_percentage: 'Процент премии менеджерам, % (0, если нет процента с продаж)',
    delivery_cost_per_transaction: 'Стоимость доставки покупки до клиента, на один чек',
    acquiring_fee_percentage: 'Эквайринг %',
    total_variable_costs: 'Итого переменные затраты',

    average_purchase_price_per_unit: 'Средняя закупочная цена одного товара/услуги',
    supplier_delivery_cost_per_unit: 'Стоимость доставки товара от поставщика, на одну единицу',
    total_cost_price_per_unit: 'Итого себестоимость единицы товара/услуги',
    average_retail_price_per_unit: 'Средняя розничная цена единицы товара/услуги, руб',
    markup_percentage: 'Наценка в %',

    advertising_campaign_coverage: 'Охват рекламной кампании',
    website_store_conversion_rate: 'Конверсия на сайт / магазин, %',
    conversion_to_cart_lead_consultation_rate: 'Конверсия в оформленную корзину, лид, консультацию %',
    payment_conversion_rate: 'Конверсия в оплату, %',
    number_of_past_customers: 'Количество тех, кто у вас уже покупал в прошлом',
    repeat_purchase_conversion_rate: 'Конверсия в повторные покупки, %',
    average_number_of_items_per_transaction: 'Среднее количество товаров/услуг в чеке, шт.',

    website_or_offline_store_visitors: 'Посетители сайта или офлайн магазина',
    abandoned_carts_leads_consultations_in_offline_store: 'Количество корзин без оплаты, лидов, консультаций',
    number_of_sales_to_new_customers: 'Количество продаж (чеков) новым клиентам',
    number_of_repeat_sales: 'Количество повторных продаж (чеков)',
    total_number_of_sales: 'Общее количество продаж (чеков)',
    average_transaction_value: 'Средний чек, руб.',

    customer_acquisition_retention_cost_per_buyer: 'Стоимость привлечения + удержания, на одного покупателя, руб.',
    sales_bonus_employee_costs_per_sale_including_taxes: 'ФОТ премиальной части за продажи, на одну продажу (чек), с учетом налогов',
    variable_costs_per_sale: 'Переменные затраты на одну продажу (чек)',
    margin_per_sale: 'Маржинальность на один продажу (чек)',
    break_even_point_in_number_of_sales: 'Точка безубыточности, количество продаж (чеков)',
    break_even_revenue_in_rubles: 'Точка безубыточности, выручка в рублях',
    number_of_sales_needed_to_reach_1_million_rubles_profit: 'Чтобы выйти на 1 млн. руб. прибыли до налогов, нужно делать продаж (чеков)',

    revenue_in_rubles: 'Выручка, рубли',
    gross_profit_in_rubles: 'Маржинальная прибыль, рубли',
    profit_before_taxes_in_rubles: 'Прибыль до налогов, рубли',
    investment_payback_period_in_months: 'Сроки окупаемости инвестиций, месяцев (без учета налогов на прибыль)',
    return_on_investment_annualized_without_tax: 'ROI (возврат инвестиций за год, без учета налогов)'
}

const inputPopovers = {
    technology_development: 'Изобретения, патенты или например просто запуск сайта или приложения.',
    working_capital: 'Переменные + постоянные затраты (без учета дебиторки и складских запасов) доход домашнего хозяйства',

    salaries_employees: 'Сумма всех окладов без учета премий',
    loan_interest_expenses: 'Не ежемесячный платеж! А сумма ежемесячной переплаты банку',
    customer_retention_expenses: 'Разовые скидки, списанные бонусы за повторную покупку, звонки клиентам от менеджеров, расходы на CRM маркетинг, ретаргетинг на тех, кто уже покупал',
    delivery_cost_per_transaction: 'Если не доставляете клиенту, или он оплачивает отдельно, то укажите 0',
    acquiring_fee_percentage: 'Около 2%, можно указать 1%, если половина выручки наличными',
    average_purchase_price_per_unit: 'Для услуги умножьте себестоимость часа вашего работника на кол-во часов в одной услуге',
    supplier_delivery_cost_per_unit: 'Разделите сумму расходов за доставку от поставщика на кол-во всех товаров (для производства так же, но про поставку материалов)',

    advertising_campaign_coverage: 'Или трафик в ТЦ для офлайн магазина, или количество контактов (звонков) менеджеров',
    website_store_conversion_rate: 'Или конверсия в "успешный контакт (звонок)"',
    conversion_to_cart_lead_consultation_rate: 'Или в назначенную встречу',
    payment_conversion_rate: 'Или подписанный договор и оплаченный счет',
    number_of_past_customers: 'Сколько постоянных или лояльных клиентов, или например "оставленных" корзин или "пользователей"',
    repeat_purchase_conversion_rate: 'Конверсия в оплату для постоянных клиентов, те кто продлил подписку, сделал очередной заказ, оплатил ежемесячный счет',
    average_number_of_items_per_transaction: 'Продажи в штуках/на количество чеков\n' +
        'Общее для всех и новых и постоянных клиентов',

    website_or_offline_store_visitors: 'Успешных контактов или звонков',
    abandoned_carts_leads_consultations_in_offline_store: 'Количество корзин без оплаты, лидов, консультаций',
    total_number_of_sales: 'Количество продаж новым клиентам + повторные продажи',
    average_transaction_value: 'Средняя розничная цена * количество товаров в чеке',

    customer_acquisition_retention_cost_per_buyer: 'Общая сумма на привлечение и удержание на каждого клиента',
    sales_bonus_employee_costs_per_sale_including_taxes: 'Расходы на премии за продажи на каждую сделку',
    variable_costs_per_sale: 'Привлечение и удержание + премии за продажу + доставка до клиента + проценты за эквайринг',
    margin_per_sale: 'Средний чек - переменные затраты на один чек',
    break_even_point_in_number_of_sales: 'Постоянные затраты / маржинальность одной продажи (чека)',
    break_even_revenue_in_rubles: 'Точка безубыточности в чеках * средний чек',
    number_of_sales_needed_to_reach_1_million_rubles_profit: 'Количество продаж (чеков) в точке безубыточности + 1млн./маржинальность одной продажи',

    revenue_in_rubles: 'Количество чеков*средний чек',
    gross_profit_in_rubles: 'Выручка - переменные затраты',
    profit_before_taxes_in_rubles: 'Маржинальная прибыль - постоянные затраты',
    investment_payback_period_in_months: 'Инвестиции/прибыль до налогов',
    return_on_investment_annualized_without_tax: 'Прибыль до налогов за год/объем инвестиций'
}

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto mt-3 px-3">
        <div class="container flex flex-wrap justify-between">
            <form class="flex flex-wrap w-full" >
                <!-- Первая строка блоков -->
                <div class="flex w-full">
                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Инвестиции</legend>
                        <Input id="equipment_and_machinery"
                               type="number"
                               v-model.float="equipmentAndMachinery"
                               :label="inputLabels.equipment_and_machinery"/>

                        <Input id="household_average"
                               type="number"
                               v-model="technologyDevelopment"
                               :label="inputLabels.technology_development"
                               :popoverText="inputPopovers.technology_development"/>

                        <Input id="household_growth"
                               type="number"
                               v-model="buyingProperty"
                               :label="inputLabels.buying_property"/>

                        <Input id="variable_household_income"
                               type="number"
                               v-model="stock"
                               :label="inputLabels.stock"/>

                        <Input id="amount_of_savings"
                               type="number"
                               v-model="workingCapital"
                               :label="inputLabels.working_capital"
                               :popoverText="inputPopovers.working_capital"
                               :readonly="true"/>

                        <Input id="disposable_resources"
                               type="number"
                               v-model="totalInvestmentVolume"
                               :label="inputLabels.total_investment_volume"
                               :readonly="true"/>
                    </fieldset>

                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Постоянные затраты</legend>
                        <Input id="salaries_employees"
                               type="number"
                               v-model.float="salariesEmployees"
                               :label="inputLabels.salaries_employees"
                               :popoverText="inputPopovers.salaries_employees"/>

                        <Input id="communication_software_rental"
                               type="number"
                               v-model="communicationSoftwareRental"
                               :label="inputLabels.communication_software_rental"
                               :popoverText="inputPopovers.communication_software_rental"/>

                        <Input id="office_or_retail_space_rental"
                               type="number"
                               v-model="officeOrRetailSpaceRental"
                               :label="inputLabels.office_or_retail_space_rental"
                               :popoverText="inputPopovers.office_or_retail_space_rental"/>

                        <Input id="loan_interest_expenses"
                               type="number"
                               v-model="loanInterestExpenses"
                               :label="inputLabels.loan_interest_expenses"
                               :popoverText="inputPopovers.loan_interest_expenses"/>

                        <Input id="other_administrative_expenses"
                               type="number"
                               v-model="otherAdministrativeExpenses"
                               :label="inputLabels.other_administrative_expenses"
                               :popoverText="inputPopovers.other_administrative_expenses"/>

                        <Input id="total_fixed_costs_including_all_employee_taxes"
                               type="number"
                               v-model="totalFixedCostsIncludingAllEmployeeTaxes"
                               :label="inputLabels.total_fixed_costs_including_all_employee_taxes"
                               :popoverText="inputPopovers.total_fixed_costs_including_all_employee_taxes"
                               :readonly="true"/>
                    </fieldset>

                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Переменные затраты</legend>
                        <Input id="monthly_advertising_expenses"
                               type="number"
                               v-model.float="monthlyAdvertisingExpenses"
                               :label="inputLabels.monthly_advertising_expenses"
                               :popoverText="inputPopovers.monthly_advertising_expenses"/>

                        <Input id="customer_retention_expenses"
                               type="number"
                               v-model="customerRetentionExpenses"
                               :label="inputLabels.customer_retention_expenses"
                                :popoverText="inputPopovers.customer_retention_expenses"/>

                        <Input id="manager_bonus_percentage"
                               type="number"
                               v-model="managerBonusPercentage"
                               :label="inputLabels.manager_bonus_percentage"
                                :popoverText="inputPopovers.manager_bonus_percentage"/>

                        <Input id="delivery_cost_per_transaction"
                               type="number"
                               v-model="deliveryCostPerTransaction"
                               :label="inputLabels.delivery_cost_per_transaction"
                                :popoverText="inputPopovers.delivery_cost_per_transaction"/>

                        <Input id="acquiring_fee_percentage"
                               type="number"
                               v-model="acquiringFeePercentage"
                               :label="inputLabels.acquiring_fee_percentage"
                                :popoverText="inputPopovers.acquiring_fee_percentage"/>

                        <Input id="total_variable_costs"
                               type="number"
                               v-model="totalVariableCosts"
                               :label="inputLabels.total_variable_costs"
                               :popoverText="inputPopovers.total_variable_costs"
                               :readonly="true"/>
                    </fieldset>
                </div>

                <!-- Вторая строка блоков -->
                <div class="flex w-full">
                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Себестоимость и наценка</legend>
                        <Input id="average_purchase_price_per_unit"
                               type="number"
                               v-model.float="averagePurchasePricePerUnit"
                               :label="inputLabels.average_purchase_price_per_unit"
                               :popoverText="inputPopovers.average_purchase_price_per_unit"/>

                        <Input id="supplier_delivery_cost_per_unit"
                               type="number"
                               v-model="supplierDeliveryCostPerUnit"
                               :label="inputLabels.supplier_delivery_cost_per_unit"
                               :popoverText="inputPopovers.supplier_delivery_cost_per_unit"/>

                        <Input id="total_cost_price_per_unit"
                               type="number"
                               v-model="totalCostPricePerUnit"
                               :label="inputLabels.total_cost_price_per_unit"
                               :popoverText="inputPopovers.total_cost_price_per_unit"
                               :readonly="true"/>

                        <Input id="average_retail_price_per_unit"
                               type="number"
                               v-model="averageRetailPricePerUnit"
                               :label="inputLabels.average_retail_price_per_unit"
                               :popoverText="inputPopovers.average_retail_price_per_unit"/>

                        <Input id="markup_percentage"
                               type="number"
                               v-model="markupPercentage"
                               :label="inputLabels.markup_percentage"
                               :popoverText="inputPopovers.markup_percentage"
                               :readonly="true"/>
                    </fieldset>

                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Управление воронкой</legend>
                        <Input id="advertising_campaign_coverage"
                               type="number"
                               v-model.float="advertisingCampaignCoverage"
                               :label="inputLabels.advertising_campaign_coverage"
                               :popoverText="inputPopovers.advertising_campaign_coverage"/>

                        <Input id="website_store_conversion_rate"
                               type="number"
                               v-model="websiteStoreConversionRate"
                               :label="inputLabels.website_store_conversion_rate"
                               :popoverText="inputPopovers.website_store_conversion_rate"/>

                        <Input id="conversion_to_cart_lead_consultation_rate"
                               type="number"
                               v-model="conversionToCartLeadConsultationRate"
                               :label="inputLabels.conversion_to_cart_lead_consultation_rate"
                               :popoverText="inputPopovers.conversion_to_cart_lead_consultation_rate"/>

                        <Input id="payment_conversion_rate"
                               type="number"
                               v-model="paymentConversionRate"
                               :label="inputLabels.payment_conversion_rate"
                               :popoverText="inputPopovers.payment_conversion_rate"/>

                        <Input id="number_of_past_customers"
                               type="number"
                               v-model="numberOfPastCustomers"
                               :label="inputLabels.number_of_past_customers"
                               :popoverText="inputPopovers.number_of_past_customers"/>

                        <Input id="repeat_purchase_conversion_rate"
                               type="number"
                               v-model="repeatPurchaseConversionRate"
                               :label="inputLabels.repeat_purchase_conversion_rate"
                               :popoverText="inputPopovers.repeat_purchase_conversion_rate"/>

                        <Input id="average_number_of_items_per_transaction"
                               type="number"
                               v-model="averageNumberOfItemsPerTransaction"
                               :label="inputLabels.average_number_of_items_per_transaction"
                               :popoverText="inputPopovers.average_number_of_items_per_transaction"/>
                    </fieldset>

                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Показатели воронки</legend>
                        <Input id="website_or_offline_store_visitors"
                               type="number"
                               v-model.float="websiteOrOfflineStoreVisitors"
                               :label="inputLabels.website_or_offline_store_visitors"
                               :popoverText="inputPopovers.website_or_offline_store_visitors"
                               :readonly="true"/>

                        <Input id="abandoned_carts_leads_consultations_in_offline_store"
                               type="number"
                               v-model="abandonedCartsLeadsConsultationsInOfflineStore"
                               :label="inputLabels.abandoned_carts_leads_consultations_in_offline_store"
                               :popoverText="inputPopovers.abandoned_carts_leads_consultations_in_offline_store"
                               :readonly="true"/>

                        <Input id="number_of_sales_to_new_customers"
                               type="number"
                               v-model="numberOfSalesToNewCustomers"
                               :label="inputLabels.number_of_sales_to_new_customers"
                               :popoverText="inputPopovers.number_of_sales_to_new_customers"
                               :readonly="true"/>

                        <Input id="number_of_repeat_sales"
                               type="number"
                               v-model="numberOfRepeatSales"
                               :label="inputLabels.number_of_repeat_sales"
                               :popoverText="inputPopovers.number_of_repeat_sales"
                               :readonly="true"/>

                        <Input id="total_number_of_sales"
                               type="number"
                               v-model="totalNumberOfSales"
                               :label="inputLabels.total_number_of_sales"
                               :popoverText="inputPopovers.total_number_of_sales"
                               :readonly="true"/>

                        <Input id="average_transaction_value"
                               type="number"
                               v-model="averageTransactionValue"
                               :label="inputLabels.average_transaction_value"
                               :popoverText="inputPopovers.average_transaction_value"
                               :readonly="true"/>
                    </fieldset>
                </div>

                <!-- Третья строка блоков -->
                <div class="flex w-full">
                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Юнит-экономика</legend>
                        <Input id="customer_acquisition_retention_cost_per_buyer"
                               type="number"
                               v-model.float="customerAcquisitionRetentionCostPerBuyer"
                               :label="inputLabels.customer_acquisition_retention_cost_per_buyer"
                               :popoverText="inputPopovers.customer_acquisition_retention_cost_per_buyer"
                               :readonly="true"/>

                        <Input id="sales_bonus_employee_costs_per_sale_including_taxes"
                               type="number"
                               v-model="salesBonusEmployeeCostsPerSaleIncludingTaxes"
                               :label="inputLabels.sales_bonus_employee_costs_per_sale_including_taxes"
                               :popoverText="inputPopovers.sales_bonus_employee_costs_per_sale_including_taxes"
                               :readonly="true"/>

                        <Input id="variable_costs_per_sale"
                               type="number"
                               v-model="variableCostsPerSale"
                               :label="inputLabels.variable_costs_per_sale"
                               :popoverText="inputPopovers.variable_costs_per_sale"
                               :readonly="true"/>

                        <br>
                        <Input id="margin_per_sale"
                               type="number"
                               v-model="marginPerSale"
                               :label="inputLabels.margin_per_sale"
                               :popoverText="inputPopovers.margin_per_sale"
                               :readonly="true"/>

                        <Input id="break_even_point_in_number_of_sales"
                               type="number"
                               v-model="breakEvenPointInNumberOfSales"
                               :label="inputLabels.break_even_point_in_number_of_sales"
                               :popoverText="inputPopovers.break_even_point_in_number_of_sales"
                               :readonly="true"/>

                        <Input id="break_even_revenue_in_rubles"
                               type="number"
                               v-model="breakEvenRevenueInRubles"
                               :label="inputLabels.break_even_revenue_in_rubles"
                               :popoverText="inputPopovers.break_even_revenue_in_rubles"
                               :readonly="true"/>

                        <Input id="number_of_sales_needed_to_reach_1_million_rubles_profit"
                               type="number"
                               v-model="numberOfSalesNeededToReach1MillionRublesProfit"
                               :label="inputLabels.number_of_sales_needed_to_reach_1_million_rubles_profit"
                               :popoverText="inputPopovers.number_of_sales_needed_to_reach_1_million_rubles_profit"
                               :readonly="true"/>
                    </fieldset>

                    <fieldset class="flex-auto border-2 border-solid rounded p-5 mr-3 mb-3">
                        <legend class="text-gray-900 font-medium dark:text-white">Итоговые результаты</legend>
                        <Input id="revenue_in_rubles"
                               type="number"
                               v-model.float="revenueInRubles"
                               :label="inputLabels.revenue_in_rubles"
                               :popoverText="inputPopovers.revenue_in_rubles"
                               :readonly="true"/>
                        <br>
                        <Input id="gross_profit_in_rubles"
                               type="number"
                               v-model="grossProfitInRubles"
                               :label="inputLabels.gross_profit_in_rubles"
                               :popoverText="inputPopovers.gross_profit_in_rubles"
                               :readonly="true"/>

                        <Input id="profit_before_taxes_in_rubles"
                               type="number"
                               v-model="profitBeforeTaxesInRubles"
                               :label="inputLabels.profit_before_taxes_in_rubles"
                               :popoverText="inputPopovers.profit_before_taxes_in_rubles"
                               :readonly="true"/>

                        <Input id="investment_payback_period_in_months"
                               type="number"
                               v-model="investmentPaybackPeriodInMonths"
                               :label="inputLabels.investment_payback_period_in_months"
                               :popoverText="inputPopovers.investment_payback_period_in_months"
                               :readonly="true"/>

                        <Input id="return_on_investment_annualized_without_tax"
                               type="number"
                               v-model="returnOnInvestmentAnnualizedWithoutTax"
                               :label="inputLabels.return_on_investment_annualized_without_tax"
                               :popoverText="inputPopovers.return_on_investment_annualized_without_tax"
                               :readonly="true"/>
                    </fieldset>

                    <fieldset class="flex-auto border-solid rounded p-5 mb-3">
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</template>


<style scoped>
fieldset {
    width: calc(33.33% - 10px);
}
</style>
