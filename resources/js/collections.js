$(document).ready(function () {
    $(".collection__list-item > .collection__actions > .action--edit").on("click", function () {
            console.log($(this));
            let clicked_str = $(this).parent().parent().attr("data-edit");
            let clicked = clicked_str == "true";

            clicked = !clicked;

            $(this).parent().parent().attr("data-edit", clicked);
        },
    );

    $(".collection__form--edit > .collection__actions > .action--edit").on("click", function () {
            console.log($(this));
            let clicked_str = $(this).parent().parent().prev().attr("data-edit");
            let clicked = clicked_str == "true";

            clicked = !clicked;

            $(this).parent().parent().prev().attr("data-edit", clicked);
        },
    );
});
