<script setup>
import Navbar from "@/Components/Partials/Navbar.vue";
import Button from "@/Components/Partials/Button.vue";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";
import InvestmentBlock from "../BusinessCalculator/InvestmentBlock.vue";
import FixedCostsBlock from "../BusinessCalculator/FixedCostsBlock.vue";
import VariableCostsBlock from "../BusinessCalculator/VariableCostsBlock.vue";
import CostpriceBlock from "../BusinessCalculator/CostpriceBlock.vue";
import FunnelControlBlock from "../BusinessCalculator/FunnelControlBlock.vue";
import FunnelMetricsBlock from "../BusinessCalculator/FunnelMetricsBlock.vue";
import UnitEconomyBlock from "../BusinessCalculator/UnitEconomyBlock.vue";
import TotalResultsBlock from "../BusinessCalculator/TotalResultsBlock.vue";
import ComentBlock from "../BusinessCalculator/ComentBlock.vue";
import {useInvestmentStore} from "@/Stores/BusinessCalculator/InvestmentStore";
import {useFixesCostsStore} from "@/Stores/BusinessCalculator/FixedCostsStore";
import {useVariableCostsStore} from "@/Stores/BusinessCalculator/VariableCostsStore";
import {useCostPriceStore} from "@/Stores/BusinessCalculator/CostpriceStore";
import {useFunnelControlStore} from "@/Stores/BusinessCalculator/FunnelControlStore";
import {useComentStore} from "@/Stores/BusinessCalculator/ComentStore";

const route = useRoute()

const isHistoryPage = ref(false)
const historyDate = ref()

const investment = useInvestmentStore()
const fixedCosts = useFixesCostsStore()
const variableCosts = useVariableCostsStore()
const costPrice = useCostPriceStore()
const funnelControl = useFunnelControlStore()
const commentary = useComentStore()

onMounted(async () => {
    if (route.path.includes('history')) {
        await getHistory()
        isHistoryPage.value = true

        investment.equipmentAndMachinery = history.value.equipmentAndMachinery
        investment.technologyDevelopment = history.value.technologyDevelopment
        investment.buyingProperty = history.value.buyingProperty
        investment.stock = history.value.stock

        fixedCosts.salariesEmployees = history.value.salariesEmployees
        fixedCosts.communicationSoftwareRental = history.value.communicationSoftwareRental
        fixedCosts.officeOrRetailSpaceRental = history.value.officeOrRetailSpaceRental
        fixedCosts.loanInterestExpenses = history.value.loanInterestExpenses
        fixedCosts.otherAdministrativeExpenses = history.value.otherAdministrativeExpenses

        variableCosts.monthlyAdvertisingExpenses = history.value.monthlyAdvertisingExpenses
        variableCosts.customerRetentionExpenses = history.value.customerRetentionExpenses
        variableCosts.managerBonusPercentage = history.value.managerBonusPercentage
        variableCosts.deliveryCostPerTransaction = history.value.deliveryCostPerTransaction
        variableCosts.acquiringFeePercentage = history.value.acquiringFeePercentage

        costPrice.averagePurchasePricePerUnit = history.value.averagePurchasePricePerUnit
        costPrice.supplierDeliveryCostPerUnit = history.value.supplierDeliveryCostPerUnit
        costPrice.averageRetailPricePerUnit = history.value.averageRetailPricePerUnit

        funnelControl.advertisingCampaignCoverage = history.value.advertisingCampaignCoverage
        funnelControl.websiteStoreConversionRate = history.value.websiteStoreConversionRate
        funnelControl.conversionToCartLeadConsultationRate = history.value.conversionToCartLeadConsultationRate
        funnelControl.paymentConversionRate = history.value.paymentConversionRate
        funnelControl.numberOfPastCustomers = history.value.numberOfPastCustomers
        funnelControl.repeatPurchaseConversionRate = history.value.repeatPurchaseConversionRate
        funnelControl.averageNumberOfItemsPerTransaction = history.value.averageNumberOfItemsPerTransaction

        commentary.coment = history.value.coment
    }
})

const getHistory = async () => {
    try {
        const response = await axios.get('/api/history/buisness-calculator/' + route.params.id);
        if (response.status >= 200 && response.status < 300) {
            if (response.data.data) {
                historyDate.value = response.data.data.created_at;
                history.value = JSON.parse(response.data.data.variables);
            } else {
                console.error('Ошибка: Не удалось получить данные из истории');
            }
        } else {
            console.error('Ошибка: Не удалось получить данные из истории');
        }
    } catch (error) {
        console.error('Ошибка: ', error);
    }
};

const saveDataToDatabase = async () => {
    const dataToSave = {
        equipmentAndMachinery: investment.equipmentAndMachinery,
        technologyDevelopment: investment.technologyDevelopment,
        buyingProperty: investment.buyingProperty,
        stock: investment.stock,

        salariesEmployees: fixedCosts.salariesEmployees,
        communicationSoftwareRental: fixedCosts.communicationSoftwareRental,
        officeOrRetailSpaceRental: fixedCosts.officeOrRetailSpaceRental,
        loanInterestExpenses: fixedCosts.loanInterestExpenses,
        otherAdministrativeExpenses: fixedCosts.otherAdministrativeExpenses,

        monthlyAdvertisingExpenses: variableCosts.monthlyAdvertisingExpenses,
        customerRetentionExpenses: variableCosts.customerRetentionExpenses,
        managerBonusPercentage: variableCosts.managerBonusPercentage,
        deliveryCostPerTransaction: variableCosts.deliveryCostPerTransaction,
        acquiringFeePercentage: variableCosts.acquiringFeePercentage,

        averagePurchasePricePerUnit: costPrice.averagePurchasePricePerUnit,
        supplierDeliveryCostPerUnit: costPrice.supplierDeliveryCostPerUnit,
        averageRetailPricePerUnit: costPrice.averageRetailPricePerUnit,

        advertisingCampaignCoverage: funnelControl.advertisingCampaignCoverage,
        websiteStoreConversionRate: funnelControl.websiteStoreConversionRate,
        conversionToCartLeadConsultationRate: funnelControl.conversionToCartLeadConsultationRate,
        paymentConversionRate: funnelControl.paymentConversionRate,
        numberOfPastCustomers: funnelControl.numberOfPastCustomers,
        repeatPurchaseConversionRate: funnelControl.repeatPurchaseConversionRate,
        averageNumberOfItemsPerTransaction: funnelControl.averageNumberOfItemsPerTransaction,

        coment: commentary.coment,
    };

    const jsonDataToSave = JSON.stringify(dataToSave);

    try {
        const response = await axios.post('/api/calculator-history/save-history', { variables: jsonDataToSave, type:'2' });
        if (response.status >= 200 && response.status < 300) {
            console.log('Сохранено');
        }
    } catch (error) {
        console.error('Ошибка: ', error);
    }
};
</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto mt-3 px-3">
        <h1 v-if="isHistoryPage" class="text-4xl mb-4 font-extrabold dark:text-white">История: {{ historyDate }}</h1>
        <div class="container flex flex-wrap justify-between">
            <form class="flex flex-wrap w-full">
                <!-- Первая строка блоков -->
                <div class="flex w-full">
                    <InvestmentBlock/>
                    <FixedCostsBlock/>
                    <VariableCostsBlock/>
                </div>

                <!-- Вторая строка блоков -->
                <div class="flex w-full">
                    <CostpriceBlock/>
                    <FunnelControlBlock/>
                    <FunnelMetricsBlock/>
                </div>

                <!-- Третья строка блоков -->
                <div class="flex w-full">
                    <UnitEconomyBlock/>
                    <TotalResultsBlock/>
                    <ComentBlock/>
                </div>
                <Button @click.prevent="saveDataToDatabase" v-if="!isHistoryPage" text="Сохранить в историю"/>
            </form>
        </div>
    </div>
</template>


<style scoped>
fieldset {
    width: calc(33.33% - 10px);
}
</style>
