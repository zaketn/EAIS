import {defineStore} from "pinia";
import {ref} from "vue";

export const useFunnelControlStore = defineStore('bcFunnelControlStore', () => {
    //Управление воронкой
    const advertisingCampaignCoverage = ref("100000")   //30 Охват рекламной кампании
    const websiteStoreConversionRate = ref("7") //31 Конверсия на сайт / магазин, %
    const conversionToCartLeadConsultationRate = ref("2")   //32 Конверсия в оформленную корзину, лид, консультацию с менеджером %
    const paymentConversionRate = ref("80") //33 Конверсия в оплату, %
    const numberOfPastCustomers = ref("5000")   //34 Количество тех, кто у вас уже покупал в прошлом
    const repeatPurchaseConversionRate = ref("5")   //36 Конверсия в повторные покупки, %
    const averageNumberOfItemsPerTransaction = ref("1.9")   //43 Среднее количество товаров/услуг в чеке, шт.

    return {
        advertisingCampaignCoverage,
        websiteStoreConversionRate,
        conversionToCartLeadConsultationRate,
        paymentConversionRate,
        numberOfPastCustomers,
        repeatPurchaseConversionRate,
        averageNumberOfItemsPerTransaction
    }
})
