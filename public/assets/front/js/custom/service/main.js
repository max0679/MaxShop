// круглая картинка - высота = ширине
function circlePicture(classNames) {
    let images = document.getElementsByClassName(classNames);

    [].forEach.call(images, function (image) {
        let width = image.clientWidth;
        image.style.height = width + 'px';
    })
}

// одинаковая высота у блоков с определенным классом
function setEqualHeight(columns) {
    let tallestcolumn = 0;
    columns.each(function() {
        currentHeight = $(this).height();
        if(currentHeight > tallestcolumn) {
            tallestcolumn = currentHeight;
        }
    });
    columns.height(tallestcolumn);
}

// одинаковая ширина у блоков с определенным классом
function setEqualWidth(columns) {
    let widestColumn = 0;
    columns.each(function() {
        currentWidth = $(this).width();
        if(currentWidth > widestColumn) {
            widestColumn = currentWidth;
        }
    });
    columns.width(widestColumn);
}

// ширина блока поиска = ширина хедера - иконки справа от поиска
function setWidthForSearch() {

    let searchBlock = document.getElementById('search');
    let mainSubheaderBlockWidth = document.getElementById('main-subheader').clientWidth;
    let userNavbarBlockWidth = document.getElementById('user-navbar').clientWidth;

    let fraction = Math.round((mainSubheaderBlockWidth - userNavbarBlockWidth) / 20);

    searchBlock.style.width = mainSubheaderBlockWidth - userNavbarBlockWidth - fraction + 'px';
}

// выравнить логотип и элементы меню в хедере (самая верхняя строка)
function alignUserMenu() {

    let userMenu = document.getElementById('user-menu');
    let searchBlockWidth = document.getElementById('search').clientWidth;
    let logoWidth = document.getElementById('logo').clientWidth;

    userMenu.style.width = searchBlockWidth - logoWidth + 'px';
}

function openFirstAndCloseSecond(firstObjectId, secondObjectId) {

    let firstObject = $(firstObjectId);
    let secondObject = $(secondObjectId);

    if (secondObject.hasClass('d-block') || !secondObject.hasClass('d-none')) {
        secondObject.removeClass("d-block").addClass('d-none');
        secondObject.fadeOut('fast','swing');
    }

    if (firstObject.hasClass('d-none') || !firstObject.hasClass('d-block')) {
        firstObject.fadeIn('fast','swing');
        firstObject.removeClass("d-none").addClass('d-block');
    }

}
