$(document).ready(function() {
    $(".comment__actions .action__edit img").on("click", function(e) {
        let comment = $(this).closest(".comment");
        console.log($(this), comment);

        let edit_str = comment.attr('data-edit');
        let edit = edit_str == "true" ? true : false;

        edit = !edit;

        comment.attr('data-edit', edit);
    });
});
