<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useFunnelMetricsStore} from "../../Stores/BusinessCalculator/FunnelMetricsStore";


const labels = useLabelsStore()
const funnelMetrics = useFunnelMetricsStore()
</script>

<template>
    <CalculationsBlock name="Показатели воронки">
        <Input id="website_or_offline_store_visitors"
               type="number"
               v-model.float="funnelMetrics.websiteOrOfflineStoreVisitors"
               :label="labels.inputLabels.website_or_offline_store_visitors"
               :popoverText="labels.inputPopovers.website_or_offline_store_visitors"
               :readonly="true"/>

        <Input id="abandoned_carts_leads_consultations_in_offline_store"
               type="number"
               v-model="funnelMetrics.abandonedCartsLeadsConsultationsInOfflineStore"
               :label="labels.inputLabels.abandoned_carts_leads_consultations_in_offline_store"
               :popoverText="labels.inputPopovers.abandoned_carts_leads_consultations_in_offline_store"
               :readonly="true"/>

        <Input id="number_of_sales_to_new_customers"
               type="number"
               v-model="funnelMetrics.numberOfSalesToNewCustomers"
               :label="labels.inputLabels.number_of_sales_to_new_customers"
               :popoverText="labels.inputPopovers.number_of_sales_to_new_customers"
               :readonly="true"/>

        <Input id="number_of_repeat_sales"
               type="number"
               v-model="funnelMetrics.numberOfRepeatSales"
               :label="labels.inputLabels.number_of_repeat_sales"
               :popoverText="labels.inputPopovers.number_of_repeat_sales"
               :readonly="true"/>

        <Input id="total_number_of_sales"
               type="number"
               v-model="funnelMetrics.totalNumberOfSales"
               :label="labels.inputLabels.total_number_of_sales"
               :popoverText="labels.inputPopovers.total_number_of_sales"
               :readonly="true"/>

        <Input id="average_transaction_value"
               type="number"
               v-model="funnelMetrics.averageTransactionValue"
               :label="labels.inputLabels.average_transaction_value"
               :popoverText="labels.inputPopovers.average_transaction_value"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
