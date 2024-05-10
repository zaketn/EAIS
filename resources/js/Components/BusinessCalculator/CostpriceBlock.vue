<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import Input from "@/Components/Partials/Input.vue";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import {useCostPriceStore} from "../../Stores/BusinessCalculator/CostpriceStore";


const labels = useLabelsStore()
const costprice = useCostPriceStore()
</script>

<template>
    <CalculationsBlock name="Себестоимость и наценка">
        <Input id="average_purchase_price_per_unit"
               type="number"
               v-model.float="costprice.averagePurchasePricePerUnit"
               :label="labels.inputLabels.average_purchase_price_per_unit"
               :popoverText="labels.inputPopovers.average_purchase_price_per_unit"/>

        <Input id="supplier_delivery_cost_per_unit"
               type="number"
               v-model="costprice.supplierDeliveryCostPerUnit"
               :label="labels.inputLabels.supplier_delivery_cost_per_unit"
               :popoverText="labels.inputPopovers.supplier_delivery_cost_per_unit"/>

        <Input id="total_cost_price_per_unit"
               type="number"
               v-model="costprice.totalCostPricePerUnit"
               :label="labels.inputLabels.total_cost_price_per_unit"
               :popoverText="labels.inputPopovers.total_cost_price_per_unit"
               :readonly="true"/>

        <Input id="average_retail_price_per_unit"
               type="number"
               v-model="costprice.averageRetailPricePerUnit"
               :label="labels.inputLabels.average_retail_price_per_unit"
               :popoverText="labels.inputPopovers.average_retail_price_per_unit"/>

        <Input id="markup_percentage"
               type="number"
               v-model="costprice.markupPercentage"
               :label="labels.inputLabels.markup_percentage"
               :popoverText="labels.inputPopovers.markup_percentage"
               :readonly="true"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
