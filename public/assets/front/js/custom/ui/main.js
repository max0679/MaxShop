// вызовы, которые нужны на каждой странице
$(document).ready(function() {
    setWidthForSearch();

    alignUserMenu();

    let mainArea = $('#main-area');

    $(".close-user-form").click(function (e) {
        let userContainer = $(e.target).closest(".user-container");
        userContainer.fadeOut('fast','swing');
        userContainer.removeClass('d-block');

        mainArea.removeClass('dark-screen');

    })

    $(".open-log-form").click(function() {
        openFirstAndCloseSecond('#log-container', '#reg-container');
        mainArea.addClass('dark-screen');
    })

    $(".open-reg-form").click(function() {
        openFirstAndCloseSecond('#reg-container', '#log-container');
        mainArea.addClass('dark-screen');
    })

});

