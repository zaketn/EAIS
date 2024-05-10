import {defineStore} from "pinia";
import {computed, ref} from "vue";

export const useCostPriceStore = defineStore('bcCostPriceStore', () => {
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

    return {
        averagePurchasePricePerUnit,
        supplierDeliveryCostPerUnit,
        totalCostPricePerUnit,
        averageRetailPricePerUnit,
        markupPercentage
    }
})
