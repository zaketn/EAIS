import {defineStore} from "pinia";
import {computed} from "vue";
import {useVariableCostsStore} from "./VariableCostsStore";
import {useFunnelMetricsStore} from "./FunnelMetricsStore";
import {useCostPriceStore} from "./CostpriceStore";
import {useFixesCostsStore} from "./FixedCostsStore";

export const useUnitEconomyStore = defineStore('bcUnitEconomyStore', () => {
    const fixedCosts = useFixesCostsStore()
    const variableCosts = useVariableCostsStore()
    const funnelMetrics = useFunnelMetricsStore()
    const costpriceStore = useCostPriceStore()

    //Юнит-экономика
    const customerAcquisitionRetentionCostPerBuyer = computed(() => { //54 Стоимость привлечения + удержания, на одного покупателя, руб.
        return (
            (parseFloat(variableCosts.monthlyAdvertisingExpenses) +
                parseFloat(variableCosts.customerRetentionExpenses)) /
            parseFloat(funnelMetrics.totalNumberOfSales)
        ).toFixed(0);
    });
    const salesBonusEmployeeCostsPerSaleIncludingTaxes = computed(() => { //62 ФОТ премиальной части за продажи, на одну продажу (чек), с учетом налогов
        return (
            parseFloat(funnelMetrics.averageTransactionValue) *
            parseFloat(variableCosts.managerBonusPercentage) * 1.46 / 100
        ).toFixed(0);
    });
    const variableCostsPerSale = computed(() => { //44 Переменные затраты на одну продажу (чек):
        return (
            parseFloat(customerAcquisitionRetentionCostPerBuyer.value) +
            parseFloat(salesBonusEmployeeCostsPerSaleIncludingTaxes.value) +
            parseFloat(variableCosts.deliveryCostPerTransaction) +
            parseFloat(costpriceStore.totalCostPricePerUnit) +
            (parseFloat(funnelMetrics.averageTransactionValue) *
                parseFloat(variableCosts.acquiringFeePercentage) / 100)
        ).toFixed(0);
    });
    const marginPerSale = computed(() => { //68 Маржинальность на один продажу (чек)
        return (
            parseFloat(funnelMetrics.averageTransactionValue) -
            parseFloat(variableCostsPerSale.value)
        ).toFixed(0);
    });
    const breakEvenPointInNumberOfSales = computed(() => { //71 Точка безубыточности, количество продаж (чеков)
        return (
            parseFloat(fixedCosts.totalFixedCostsIncludingAllEmployeeTaxes) /
            parseFloat(marginPerSale.value)
        ).toFixed(0);
    });
    const breakEvenRevenueInRubles = computed(() => { //73 Точка безубыточности, выручка в рублях
        return (
            parseFloat(breakEvenPointInNumberOfSales.value) *
            parseFloat(funnelMetrics.averageTransactionValue)
        ).toFixed(0);
    });
    const numberOfSalesNeededToReach1MillionRublesProfit = computed(() => { //72 Чтобы выйти на 1 млн. руб. прибыли до налогов, нужно делать продаж (чеков)
        return (
            parseFloat(breakEvenPointInNumberOfSales.value) +
            (1000000 / parseFloat(marginPerSale.value))
        ).toFixed(0);
    });

    return {
        customerAcquisitionRetentionCostPerBuyer,
        salesBonusEmployeeCostsPerSaleIncludingTaxes,
        variableCostsPerSale,
        marginPerSale,
        breakEvenPointInNumberOfSales,
        breakEvenRevenueInRubles,
        numberOfSalesNeededToReach1MillionRublesProfit
    }
})
