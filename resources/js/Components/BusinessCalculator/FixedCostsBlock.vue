<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useFixesCostsStore} from "../../Stores/BusinessCalculator/FixedCostsStore";


const labels = useLabelsStore()
const fixedCosts = useFixesCostsStore()
</script>

<template>
    <CalculationsBlock name="Постоянные затраты">
        <Input id="salaries_employees"
               type="number"
               v-model.float="fixedCosts.salariesEmployees"
               :label="labels.inputLabels.salaries_employees"
               :popoverText="labels.inputPopovers.salaries_employees"/>

        <Input id="communication_software_rental"
               type="number"
               v-model="fixedCosts.communicationSoftwareRental"
               :label="labels.inputLabels.communication_software_rental"
               :popoverText="labels.inputPopovers.communication_software_rental"/>

        <Input id="office_or_retail_space_rental"
               type="number"
               v-model="fixedCosts.officeOrRetailSpaceRental"
               :label="labels.inputLabels.office_or_retail_space_rental"
               :popoverText="labels.inputPopovers.office_or_retail_space_rental"/>

        <Input id="loan_interest_expenses"
               type="number"
               v-model="fixedCosts.loanInterestExpenses"
               :label="labels.inputLabels.loan_interest_expenses"
               :popoverText="labels.inputPopovers.loan_interest_expenses"/>

        <Input id="other_administrative_expenses"
               type="number"
               v-model="fixedCosts.otherAdministrativeExpenses"
               :label="labels.inputLabels.other_administrative_expenses"
               :popoverText="labels.inputPopovers.other_administrative_expenses"/>

        <Input id="total_fixed_costs_including_all_employee_taxes"
               type="number"
               v-model="fixedCosts.totalFixedCostsIncludingAllEmployeeTaxes"
               :label="labels.inputLabels.total_fixed_costs_including_all_employee_taxes"
               :popoverText="labels.inputPopovers.total_fixed_costs_including_all_employee_taxes"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
