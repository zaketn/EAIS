<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import {useInvestmentStore} from "../../Stores/BusinessCalculator/InvestmentStore";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import Input from "../Partials/Input.vue";


const investment = useInvestmentStore()
const labels = useLabelsStore()
</script>

<template>
    <CalculationsBlock name="Инвестиции">
        <Input id="equipment_and_machinery"
               type="number"
               v-model.float="investment.equipmentAndMachinery"
               :label="labels.inputLabels.equipment_and_machinery"/>

        <Input id="household_average"
               type="number"
               v-model="investment.technologyDevelopment"
               :label="labels.inputLabels.technology_development"
               :popoverText="labels.inputPopovers.technology_development"/>

        <Input id="household_growth"
               type="number"
               v-model="investment.buyingProperty"
               :label="labels.inputLabels.buying_property"/>

        <Input id="variable_household_income"
               type="number"
               v-model="investment.stock"
               :label="labels.inputLabels.stock"/>

        <Input id="amount_of_savings"
               type="number"
               v-model="investment.workingCapital"
               :label="labels.inputLabels.working_capital"
               :popoverText="labels.inputPopovers.working_capital"
               :readonly="true"/>

        <Input id="disposable_resources"
               type="number"
               v-model="investment.totalInvestmentVolume"
               :label="labels.inputLabels.total_investment_volume"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
