<script setup>

import CalculationsBlock from "./CalculationsBlock.vue";
import {useComentStore} from "../../Stores/BusinessCalculator/ComentStore";
import {useLabelsStore} from "../../Stores/BusinessCalculator/LabelsStore";
import TextArea from "@/Components/Partials/TextArea.vue";

const labels = useLabelsStore()
const comentStore = useComentStore()

</script>

<template>
    <CalculationsBlock name="Комментарий">
        <TextArea id="coment"
               type="textarea"
               v-model.float="comentStore.coment"/>
    </CalculationsBlock>
</template>

<style scoped>

</style>
