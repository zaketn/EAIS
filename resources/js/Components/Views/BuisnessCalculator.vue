<script setup>
import Navbar from "@/Components/Partials/Navbar.vue";
import {useRoute} from "vue-router";
import InvestmentBlock from "../BusinessCalculator/InvestmentBlock.vue";
import FixedCostsBlock from "../BusinessCalculator/FixedCostsBlock.vue";
import VariableCostsBlock from "../BusinessCalculator/VariableCostsBlock.vue";
import CostpriceBlock from "../BusinessCalculator/CostpriceBlock.vue";
import FunnelControlBlock from "../BusinessCalculator/FunnelControlBlock.vue";
import FunnelMetricsBlock from "../BusinessCalculator/FunnelMetricsBlock.vue";
import UnitEconomyBlock from "../BusinessCalculator/UnitEconomyBlock.vue";
import TotalResultsBlock from "../BusinessCalculator/TotalResultsBlock.vue";

const route = useRoute()
</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto mt-3 px-3">
        <div class="container flex flex-wrap justify-between">
            <form class="flex flex-wrap w-full">
                <!-- Первая строка блоков -->
                <div class="flex w-full">
                    <InvestmentBlock/>
                    <FixedCostsBlock/>
                    <VariableCostsBlock/>
                </div>

                <!-- Вторая строка блоков -->
                <div class="flex w-full">
                    <CostpriceBlock/>
                    <FunnelControlBlock/>
                    <FunnelMetricsBlock/>
                </div>

                <!-- Третья строка блоков -->
                <div class="flex w-full">
                    <UnitEconomyBlock/>
                    <TotalResultsBlock/>
                    <fieldset class="flex-auto border-solid rounded p-5 mb-3"></fieldset>
                </div>
            </form>
        </div>
    </div>
</template>


<style scoped>
fieldset {
    width: calc(33.33% - 10px);
}
</style>
