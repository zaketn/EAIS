<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useVariableCostsStore} from "../../Stores/BusinessCalculator/VariableCostsStore";


const labels = useLabelsStore()
const variableCosts = useVariableCostsStore()
</script>

<template>
    <CalculationsBlock name="Переменные затраты">
        <Input id="monthly_advertising_expenses"
               type="number"
               v-model.float="variableCosts.monthlyAdvertisingExpenses"
               :label="labels.inputLabels.monthly_advertising_expenses"
               :popoverText="labels.inputPopovers.monthly_advertising_expenses"/>

        <Input id="customer_retention_expenses"
               type="number"
               v-model="variableCosts.customerRetentionExpenses"
               :label="labels.inputLabels.customer_retention_expenses"
               :popoverText="labels.inputPopovers.customer_retention_expenses"/>

        <Input id="manager_bonus_percentage"
               type="number"
               v-model="variableCosts.managerBonusPercentage"
               :label="labels.inputLabels.manager_bonus_percentage"
               :popoverText="labels.inputPopovers.manager_bonus_percentage"/>

        <Input id="delivery_cost_per_transaction"
               type="number"
               v-model="variableCosts.deliveryCostPerTransaction"
               :label="labels.inputLabels.delivery_cost_per_transaction"
               :popoverText="labels.inputPopovers.delivery_cost_per_transaction"/>

        <Input id="acquiring_fee_percentage"
               type="number"
               v-model="variableCosts.acquiringFeePercentage"
               :label="labels.inputLabels.acquiring_fee_percentage"
               :popoverText="labels.inputPopovers.acquiring_fee_percentage"/>

        <Input id="total_variable_costs"
               type="number"
               v-model="variableCosts.totalVariableCosts"
               :label="labels.inputLabels.total_variable_costs"
               :popoverText="labels.inputPopovers.total_variable_costs"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
