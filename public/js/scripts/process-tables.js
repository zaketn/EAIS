$('table').each(function () {
    let prevPrev = $(this).prev().prev().find('span');
    let prev = $(this).prev().find('span');

    if (isContinue(prev.text()) || isContinue(prevPrev.text())) {
        let trs = $(this).find('tr');
        $(this).prevAll('table').first().find('tbody').append(trs);
        $(this).remove();
    }
})


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const tables = $('table');

// let tableHeader = $(tables[0]).prev().prev().find('span b').text();
// let caption = tables[0].createCaption();
// caption.textContent = $(tables[0]).prev().prev().find('span b').text();

tables.each(function () {
    let prevPrev = $(this).prev().prev().find('span');
    let prev = $(this).prev().find('span');

    console.log(this);
    console.log(`prevPrev: ${prevPrev.text()}`);
    console.log(`prev:  ${prev.text()}`);

    let isPrevPrevCaption = false;
    let isPrevCaption = false;

    let isPrevPrevSubCaption = false;
    let isPrevSubCaption = false;

    let isPrevPrevContinue = false;
    let isPrevContinue = false;

    if (prevPrev.text() !== undefined) {
        isPrevPrevContinue = isContinue(prevPrev.text());
        isPrevPrevCaption = isValidCaption(prevPrev.text())
        isPrevPrevSubCaption = isValidSubCaption(prevPrev.text())
    }

    if (prev.text() !== undefined) {
        isPrevContinue = isContinue(prev.text());
        isPrevCaption = isValidCaption(prev.text())
        isPrevSubCaption = isValidSubCaption(prev.text())
    }

    let hasCaption = isPrevCaption || isPrevPrevCaption;
    let hasSubCaption = isPrevSubCaption || isPrevPrevSubCaption;
    if (hasCaption) {
        const shortCaptionRegex = /\d\.\d+\.?\s/;
        let shortCaption = '';
        if (prevPrev.text() !== undefined && prevPrev.text().match(shortCaptionRegex) !== null) {
            shortCaption = prevPrev.text().match(shortCaptionRegex)[0]
        } else {
            shortCaption = prev.text().match(shortCaptionRegex)[0]
        }

        $.post('process', {
            'header': shortCaption,
            'tables': this.outerHTML
        })
            .done(() => console.log('Данные успешно обработаны.'));
    }
})

function isValidCaption(caption) {
    const results = caption.match(/\d\.\d/);

    return results !== null;
}

function isValidSubCaption(subCaption) {
    const results = subCaption.match(/\(\p{L}|\p{L}\)/u);

    return results !== null
}

function isContinue(caption) {
    return caption.includes('Продолжение');
}
