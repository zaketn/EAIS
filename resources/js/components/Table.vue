<template>
    <hot-table :data="data" :width="width" :height="height" :rowHeaders="true" stretchH="all"></hot-table>
</template>

<script>
import {defineComponent} from 'vue';
import {HotTable} from '@handsontable/vue3';
import {registerAllModules} from 'handsontable/registry';
import 'handsontable/dist/handsontable.full.css';

registerAllModules();

export default {
    props: {
        data: Array,
        width: String,
        height: String,
    },

    components: {
        HotTable,
    }
};

</script>


<style>
.hot-display-license-info {
    display: none;
}
</style>
