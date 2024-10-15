$(document).ready(function() {
    $(".menu-button").click(function(e) {
        let clicked_str = $(this).attr('data-clicked');
        let clicked = clicked_str == "true" ? true : false;

        clicked = !clicked;

        $(this).attr('data-clicked', clicked);

        let to_open = $(this).attr("data-menu-id");

        if (to_open == null) {
            console.warn("data-menu-id not set on .menu__button");
        } else {
            $(`#${to_open}`).attr('data-open', clicked);
            $("body").attr('data-menu-open', clicked);
        }
    });
});
