import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {useVariableCostsStore} from "./VariableCostsStore";
import {useFixesCostsStore} from "./FixedCostsStore";

export const useInvestmentStore = defineStore('bcInvestmentStore', () => {
    const variableCosts = useVariableCostsStore()
    const fixedCosts = useFixesCostsStore()

    //Инвестиции
    const equipmentAndMachinery = ref("500000") //2 Оборудование и техника (офисное, торговое, кассовое, компьтеры и т.п.)
    const technologyDevelopment = ref("500000") //4 Разработка технологий
    const buyingProperty = ref("0") //5 Покупка собственной недвижимости
    const stock = ref("300000") //7 Складской запас (товары, материалы)
    const workingCapital = computed(() => {  //11 Оборотный капитал
        return (
            parseFloat(variableCosts.totalVariableCosts) +
            parseFloat(fixedCosts.totalFixedCostsIncludingAllEmployeeTaxes)
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

    return {
        equipmentAndMachinery,
        technologyDevelopment,
        buyingProperty,
        stock,
        workingCapital,
        totalInvestmentVolume
    }
})
