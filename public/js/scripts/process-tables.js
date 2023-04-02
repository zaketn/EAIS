$('table').each(function () {
    let prevPrevPrev = $(this).prev().prev().prev().find('span');
    let prevPrev = $(this).prev().prev().find('span');
    let prev = $(this).prev().find('span');

    if (isContinue(prev.text()) || isContinue(prevPrev.text()) || isContinue(prevPrevPrev.text())) {
        let trs = $(this).find('tr');
        $(this).prevAll('table').first().find('tbody').append(trs);
        $(this).remove();

        if (isContinue(prev.text())) prev.parent().remove();
        if (isContinue(prevPrev.text())) prevPrev.parent().remove();
        if (isContinue(prevPrevPrev.text())) prevPrevPrev.parent().remove();
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

    let prevPrevPrev = $(this).prev().prev().prev().find('span');
    let prevPrev = $(this).prev().prev().find('span');
    let prev = $(this).prev().find('span');

    let isPrevPrevPrevCaption = false;
    let isPrevPrevCaption = false;
    let isPrevCaption = false;

    let isPrevPrevSubCaption = false;
    let isPrevSubCaption = false;

    let isPrevPrevContinue = false;
    let isPrevContinue = false;

    if (prevPrevPrev.text() !== undefined) {
        isPrevPrevPrevCaption = isValidCaption(prevPrevPrev.text())
    }

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

    let hasCaption = isPrevCaption || isPrevPrevCaption || isPrevPrevPrevCaption;
    let hasSubCaption = isPrevSubCaption || isPrevPrevSubCaption;

    if (hasCaption) {
        const shortCaptionRegex = /\d+\.\d+\.?\s/;
        let shortCaption = '';
        let longCaption = '';

        if (prevPrev.text() !== undefined && prevPrev.text().match(shortCaptionRegex) !== null) {
            longCaption = prevPrev.text();
            shortCaption = prevPrev.text().match(shortCaptionRegex)[0];
        } else if (prev.text() !== undefined && prev.text().match(shortCaptionRegex) !== null) {
            longCaption = prev.text();
            shortCaption = prev.text().match(shortCaptionRegex)[0];
        } else if (prevPrevPrev.text() !== undefined && prevPrevPrev.text().match(shortCaptionRegex) !== null) {
            longCaption = prevPrevPrev.text();
            shortCaption = prevPrevPrev.text().match(shortCaptionRegex)[0];
        }

        $.post('process', {
            'number': shortCaption,
            'header': longCaption,
            'tables': this.outerHTML
        })
            .done(() => console.log('Данные успешно обработаны.'));
    } else {
        console.log(this);
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
