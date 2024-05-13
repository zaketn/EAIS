import {defineStore} from "pinia";
import {computed} from "vue";
import {useFunnelMetricsStore} from "./FunnelMetricsStore";
import {useFixesCostsStore} from "./FixedCostsStore";
import {useInvestmentStore} from "./InvestmentStore";
import {useVariableCostsStore} from "./VariableCostsStore";

export const useTotalResultsStore = defineStore('bcTotalResultsStore', () => {
    const fixedCosts = useFixesCostsStore()
    const variableCosts = useVariableCostsStore()
    const investment = useInvestmentStore()
    const funnelMetrics = useFunnelMetricsStore()

    //Итоговые результаты
    const revenueInRubles = computed(() => { //64 Выручка, рубли
        return (
            parseFloat(funnelMetrics.totalNumberOfSales) *
            parseFloat(funnelMetrics.averageTransactionValue)
        ).toFixed(0);
    });
    const grossProfitInRubles = computed(() => { //67 Маржинальная прибыль, рубли
        return (
            parseFloat(revenueInRubles.value) -
            parseFloat(variableCosts.totalVariableCosts)
        ).toFixed(0);
    });
    const profitBeforeTaxesInRubles = computed(() => { //69 Прибыль до налогов, рубли
        return (
            parseFloat(grossProfitInRubles.value) -
            parseFloat(fixedCosts.totalFixedCostsIncludingAllEmployeeTaxes)
        ).toFixed(0);
    });
    const investmentPaybackPeriodInMonths = computed(() => { //66 Сроки окупаемости инвестиций, месяцев (без учета налогов на прибыль)
        return (
            parseFloat(investment.totalInvestmentVolume) /
            parseFloat(profitBeforeTaxesInRubles.value)
        ).toFixed(0);
    });
    const returnOnInvestmentAnnualizedWithoutTax = computed(() => { //65 ROI (возврат инвестиций за год, без учета налогов), %
        return (
            (parseFloat(profitBeforeTaxesInRubles.value) * 12 /
                parseFloat(investment.totalInvestmentVolume)) * 100
        ).toFixed(0);
    });

    return {
        revenueInRubles,
        grossProfitInRubles,
        profitBeforeTaxesInRubles,
        investmentPaybackPeriodInMonths,
        returnOnInvestmentAnnualizedWithoutTax
    }
})
