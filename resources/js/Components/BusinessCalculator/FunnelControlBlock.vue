<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useFunnelControlStore} from "../../Stores/BusinessCalculator/FunnelControlStore";


const labels = useLabelsStore()
const funnelControl = useFunnelControlStore()
</script>

<template>
    <CalculationsBlock name="Управление воронкой">
        <Input id="advertising_campaign_coverage"
               type="number"
               v-model.float="funnelControl.advertisingCampaignCoverage"
               :label="labels.inputLabels.advertising_campaign_coverage"
               :popoverText="labels.inputPopovers.advertising_campaign_coverage"/>

        <Input id="website_store_conversion_rate"
               type="number"
               v-model="funnelControl.websiteStoreConversionRate"
               :label="labels.inputLabels.website_store_conversion_rate"
               :popoverText="labels.inputPopovers.website_store_conversion_rate"/>

        <Input id="conversion_to_cart_lead_consultation_rate"
               type="number"
               v-model="funnelControl.conversionToCartLeadConsultationRate"
               :label="labels.inputLabels.conversion_to_cart_lead_consultation_rate"
               :popoverText="labels.inputPopovers.conversion_to_cart_lead_consultation_rate"/>

        <Input id="payment_conversion_rate"
               type="number"
               v-model="funnelControl.paymentConversionRate"
               :label="labels.inputLabels.payment_conversion_rate"
               :popoverText="labels.inputPopovers.payment_conversion_rate"/>

        <Input id="number_of_past_customers"
               type="number"
               v-model="funnelControl.numberOfPastCustomers"
               :label="labels.inputLabels.number_of_past_customers"
               :popoverText="labels.inputPopovers.number_of_past_customers"/>

        <Input id="repeat_purchase_conversion_rate"
               type="number"
               v-model="funnelControl.repeatPurchaseConversionRate"
               :label="labels.inputLabels.repeat_purchase_conversion_rate"
               :popoverText="labels.inputPopovers.repeat_purchase_conversion_rate"/>

        <Input id="average_number_of_items_per_transaction"
               type="number"
               v-model="funnelControl.averageNumberOfItemsPerTransaction"
               :label="labels.inputLabels.average_number_of_items_per_transaction"
               :popoverText="labels.inputPopovers.average_number_of_items_per_transaction"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
