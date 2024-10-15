$(document).ready(function() {
    $(".form__pill").click(function () {
        let clicked_pill = $(this);
        $(this).parent().children("").map(function(key, elem) {
            console.log($(elem), $(elem).is(clicked_pill));
            $(elem).find("input").attr("checked", $(elem).is(clicked_pill));
        });
    });
});
