$(document).ready(function() {
    function comment_edit_click(e) {
        e.preventDefault();
        let comment = $(this).closest(".comment");
        console.log($(this), comment);

        let edit_str = comment.attr('data-edit');
        let edit = edit_str == "true" ? true : false;

        edit = !edit;

        comment.attr('data-edit', edit);
    }

    $(".comment__actions .action__edit img").on("click", comment_edit_click);
    $(".comment-form .action__edit img").on("click", comment_edit_click);
});
