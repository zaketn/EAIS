$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const tables = $('table');

let tableHeader = $(tables[0]).prev().prev().find('span b').html();
let caption = tables[0].createCaption();
caption.textContent = $(tables[0]).prev().prev().find('span b').html();

tables.each(function () {
    let prevPrev = $(this).prev().prev().find('span');
    let prev = $(this).prev().find('span');

    if (prev.length > 0 && prevPrev > 0) {
        console.log(prevPrev);
        let isContinue = prev.html().includes('Продолжение') || prevPrev.html().includes('Продолжение');

        console.log(prevPrev.children('b').length > 0 || prev.children('b').length > 0);
        $.post('process', {
            'header': '',
            'tables': this.outerHTML
        })
            .done(() => console.log('Данные успешно обработаны.'));
    }
})
