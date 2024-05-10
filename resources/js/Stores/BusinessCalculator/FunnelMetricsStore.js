import {defineStore} from "pinia";
import {computed} from "vue";
import {useFunnelControlStore} from "./FunnelControlStore";
import {useCostPriceStore} from "./CostpriceStore";

export const useFunnelMetricsStore = defineStore('bcFunnelMetricsStore', () => {
    const funnelControl = useFunnelControlStore()
    const costprice = useCostPriceStore()

    //Показатели воронки
    const websiteOrOfflineStoreVisitors = computed(() => {  //48 Посетители сайта или офлайн магазина
        return (
            parseFloat(funnelControl.advertisingCampaignCoverage) *
            parseFloat(funnelControl.websiteStoreConversionRate) / 100
        ).toFixed(0);
    });
    const abandonedCartsLeadsConsultationsInOfflineStore = computed(() => { //49 Количество корзин без оплаты, лидов, консультаций в офлайн магазине
        return (
            parseFloat(websiteOrOfflineStoreVisitors.value) *
            parseFloat(funnelControl.conversionToCartLeadConsultationRate) / 100
        ).toFixed(0);
    });
    const numberOfSalesToNewCustomers = computed(() => { //50 Количество продаж (чеков) новым клиентам
        return (
            parseFloat(funnelControl.paymentConversionRate) *
            parseFloat(abandonedCartsLeadsConsultationsInOfflineStore.value) / 100
        ).toFixed(0);
    });
    const numberOfRepeatSales = computed(() => { //51 Количество повторных продаж (чеков)
        return (
            parseFloat(funnelControl.numberOfPastCustomers) *
            parseFloat(funnelControl.repeatPurchaseConversionRate) / 100
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
            parseFloat(costprice.averageRetailPricePerUnit) *
            parseFloat(funnelControl.averageNumberOfItemsPerTransaction)
        ).toFixed(0);
    });

    return {
        websiteOrOfflineStoreVisitors,
        abandonedCartsLeadsConsultationsInOfflineStore,
        numberOfSalesToNewCustomers,
        numberOfRepeatSales,
        totalNumberOfSales,
        averageTransactionValue
    }
})
