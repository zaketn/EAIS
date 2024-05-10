import {defineStore} from "pinia";
import {computed, ref} from "vue";

export const useFixesCostsStore = defineStore('bcFixedCostsStore', () => {
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

    return {
        salariesEmployees,
        communicationSoftwareRental,
        officeOrRetailSpaceRental,
        loanInterestExpenses,
        otherAdministrativeExpenses,
        totalFixedCostsIncludingAllEmployeeTaxes
    }
})
