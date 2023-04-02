$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const tables = $('table');
let tableHeader = $(tables[0]).prev().prev().find('span b').html();

tables.each(function () {
        $.post('process', {
            'header': tableHeader,
            'tables': this.outerHTML
        })
            .done(() => console.log('Данные успешно обработаны.'));
})
