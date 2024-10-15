$(document).ready(function() {
    $(".menu-button").click(function(e) {
        let clicked_str = $(this).attr('data-clicked');
        let clicked = clicked_str == "true";

        clicked = !clicked;

        $(this).attr('data-clicked', clicked);

        let to_open = $(this).attr("data-menu-id");

        if (to_open == null) {
            console.warn("data-menu-id not set on .menu-button");
        } else {
            if ($(`#${to_open}`).hasClass('menu')) {
                $("body").attr('data-menu-open', clicked);
            }

            $(`#${to_open}`).attr('data-open', clicked);
        }
    });
});
