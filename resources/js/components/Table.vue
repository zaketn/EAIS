<template>
    <hot-table :height="height" :width="width" :data="data" :rowHeaders="true" :colHeaders="true"></hot-table>
</template>

<script>
import {defineComponent} from 'vue';
import {HotTable} from '@handsontable/vue3';
import {registerAllModules} from 'handsontable/registry';
import 'handsontable/dist/handsontable.full.css';

registerAllModules();

export default defineComponent({
    props: {
        data: Array,
        width: Number,
        height: Number,
    },

    components: {
        HotTable,
    }
});

</script>


<style>
.hot-display-license-info {
    display: none;
}
</style>
