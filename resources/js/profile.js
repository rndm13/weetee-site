$(document).ready(function() {
    $(".profile__actions .action--edit").on("click", function(e) {
        e.preventDefault();

        let comment = $(this).closest(".profile");
        console.log($(this), comment);

        let edit_str = comment.attr('data-edit');
        let edit = edit_str == "true" ? true : false;

        edit = !edit;

        comment.attr('data-edit', edit);
    });
});
