<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useTotalResultsStore} from "../../Stores/BusinessCalculator/TotalResultsStore";


const labels = useLabelsStore()
const totalResults = useTotalResultsStore()
</script>

<template>
    <CalculationsBlock name="Итоговые результаты">
        <Input id="revenue_in_rubles"
               type="number"
               v-model.float="totalResults.revenueInRubles"
               :label="labels.inputLabels.revenue_in_rubles"
               :popoverText="labels.inputPopovers.revenue_in_rubles"
               :readonly="true"/>
        <br>
        <Input id="gross_profit_in_rubles"
               type="number"
               v-model="totalResults.grossProfitInRubles"
               :label="labels.inputLabels.gross_profit_in_rubles"
               :popoverText="labels.inputPopovers.gross_profit_in_rubles"
               :readonly="true"/>

        <Input id="profit_before_taxes_in_rubles"
               type="number"
               v-model="totalResults.profitBeforeTaxesInRubles"
               :label="labels.inputLabels.profit_before_taxes_in_rubles"
               :popoverText="labels.inputPopovers.profit_before_taxes_in_rubles"
               :readonly="true"/>

        <Input id="investment_payback_period_in_months"
               type="number"
               v-model="totalResults.investmentPaybackPeriodInMonths"
               :label="labels.inputLabels.investment_payback_period_in_months"
               :popoverText="labels.inputPopovers.investment_payback_period_in_months"
               :readonly="true"/>

        <Input id="return_on_investment_annualized_without_tax"
               type="number"
               v-model="totalResults.returnOnInvestmentAnnualizedWithoutTax"
               :label="labels.inputLabels.return_on_investment_annualized_without_tax"
               :popoverText="labels.inputPopovers.return_on_investment_annualized_without_tax"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
