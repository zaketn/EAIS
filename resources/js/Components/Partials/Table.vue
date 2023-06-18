<script>
import {onMounted, ref, watch} from 'vue';

import Handsontable from 'handsontable';
import {registerAllModules} from 'handsontable/registry';
import 'handsontable/dist/handsontable.full.css';

registerAllModules();

export default {
    props: {
        data: Array,
        width: String,
        height: String,
    },

    setup(props) {
        let container = null
        const table = ref(null)

        onMounted(() => {
            container = document.querySelector('#table-container')
            updateTable()
        })

        watch(() => props.data, () => updateTable())

        function updateTable() {
            console.log(props.data)
            table.value = new Handsontable(container, {
                data: props.data,
                width: props.width,
                height: props.height,
                rowHeaders: true,
                stretchH: 'all',
            })
        }

        return {table}
    }
};

</script>

<template>
    <div id="table-container">
        <div ref="table"></div>
    </div>
</template>

<style>
.hot-display-license-info {
    display: none;
}
</style>
