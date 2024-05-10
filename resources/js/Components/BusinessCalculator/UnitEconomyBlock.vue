<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useUnitEconomyStore} from "../../Stores/BusinessCalculator/UnitEconomyStore";


const labels = useLabelsStore()
const unitEconomy = useUnitEconomyStore()
</script>

<template>
    <CalculationsBlock name="Юнит-экономика">
        <Input id="customer_acquisition_retention_cost_per_buyer"
               type="number"
               v-model.float="unitEconomy.customerAcquisitionRetentionCostPerBuyer"
               :label="labels.inputLabels.customer_acquisition_retention_cost_per_buyer"
               :popoverText="labels.inputPopovers.customer_acquisition_retention_cost_per_buyer"
               :readonly="true"/>

        <Input id="sales_bonus_employee_costs_per_sale_including_taxes"
               type="number"
               v-model="unitEconomy.salesBonusEmployeeCostsPerSaleIncludingTaxes"
               :label="labels.inputLabels.sales_bonus_employee_costs_per_sale_including_taxes"
               :popoverText="labels.inputPopovers.sales_bonus_employee_costs_per_sale_including_taxes"
               :readonly="true"/>

        <Input id="variable_costs_per_sale"
               type="number"
               v-model="unitEconomy.variableCostsPerSale"
               :label="labels.inputLabels.variable_costs_per_sale"
               :popoverText="labels.inputPopovers.variable_costs_per_sale"
               :readonly="true"/>

        <br>
        <Input id="margin_per_sale"
               type="number"
               v-model="unitEconomy.marginPerSale"
               :label="labels.inputLabels.margin_per_sale"
               :popoverText="labels.inputPopovers.margin_per_sale"
               :readonly="true"/>

        <Input id="break_even_point_in_number_of_sales"
               type="number"
               v-model="unitEconomy.breakEvenPointInNumberOfSales"
               :label="labels.inputLabels.break_even_point_in_number_of_sales"
               :popoverText="labels.inputPopovers.break_even_point_in_number_of_sales"
               :readonly="true"/>

        <Input id="break_even_revenue_in_rubles"
               type="number"
               v-model="unitEconomy.breakEvenRevenueInRubles"
               :label="labels.inputLabels.break_even_revenue_in_rubles"
               :popoverText="labels.inputPopovers.break_even_revenue_in_rubles"
               :readonly="true"/>

        <Input id="number_of_sales_needed_to_reach_1_million_rubles_profit"
               type="number"
               v-model="unitEconomy.numberOfSalesNeededToReach1MillionRublesProfit"
               :label="labels.inputLabels.number_of_sales_needed_to_reach_1_million_rubles_profit"
               :popoverText="labels.inputPopovers.number_of_sales_needed_to_reach_1_million_rubles_profit"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
