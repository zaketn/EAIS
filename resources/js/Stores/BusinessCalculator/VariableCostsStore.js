import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {useUnitEconomyStore} from "./UnitEconomyStore";
import {useFunnelMetricsStore} from "./FunnelMetricsStore";

export const useVariableCostsStore = defineStore('bcVariableCostsStore', () => {
    const unitEconomy = useUnitEconomyStore()
    const funnelMetrics = useFunnelMetricsStore()

    //Переменные затраты
    const monthlyAdvertisingExpenses = ref("200000")    //29 Сумма затрат на рекламу за месяц
    const customerRetentionExpenses = ref("100000") //35 Сумма на удержание (возврат) клиентов
    const managerBonusPercentage = ref("10")  //37 Процент премии менеджерам, % (0, если не платите процент с продаж)
    const deliveryCostPerTransaction = ref("500")   //38 Стоимость доставки покупки до клиента, на один чек
    const acquiringFeePercentage = ref("2") //39 Эквайринг %
    const totalVariableCosts = computed(() => {  //58 Итого переменные затраты:
        return (
            parseFloat(unitEconomy.variableCostsPerSale) * parseFloat(funnelMetrics.totalNumberOfSales)
        ).toFixed(0);
    });

    return {
        monthlyAdvertisingExpenses,
        customerRetentionExpenses,
        managerBonusPercentage,
        deliveryCostPerTransaction,
        acquiringFeePercentage,
        totalVariableCosts
    }
})
