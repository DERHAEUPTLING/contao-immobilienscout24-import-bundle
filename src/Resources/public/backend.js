document.addEventListener('DOMContentLoaded', () => {
    const filter = document.querySelector('#ctrl_immoscout24_filter');
    const tags = document.querySelectorAll('.immoscout24_filter_explanation li');

    if(null !== filter && null !== tags) {
        filter.autocomplete = 'off';

        tags.forEach(tag => {
            tag.addEventListener('click', () => insertAtCursor(tag.innerText))
        });
    }

    function insertAtCursor(value) {
        // append with space padding
        value = ' ' + value + ' ';

        if (filter.selectionStart || filter.selectionStart === '0') {
            const startPos = filter.selectionStart;
            const endPos = filter.selectionEnd;
            filter.value = filter.value.substring(0, startPos) + value + filter.value.substring(endPos, filter.value.length);
            filter.selectionStart = startPos + value.length;
            filter.selectionEnd = startPos + value.length;
        } else {
            filter.value += value;
        }

        // strip multiple spaces
        filter.value.replace(/ +(?= )/g,'');
        filter.focus();
    }
});
