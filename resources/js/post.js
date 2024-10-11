$(document).ready(function() {
    $(".form__select2").select2({
        templateResult: function(data) {
            var result = $(
                '<div class="select2-row">' +
                data.text +
                '</div>'
            );

            return result;
        },
        templateSelection: function(data) {
            var result = $(
                '<div class="select2-row_result">' +
                data.text +
                '</div>'
            );

            return result;
        }
    });

    $(".comment__actions .action__edit").on("click", function(e) {
        e.preventDefault();

        let comment = $(this).closest(".comment");
        console.log($(this), comment);

        let edit_str = comment.attr('data-edit');
        let edit = edit_str == "true" ? true : false;

        edit = !edit;

        comment.attr('data-edit', edit);
    });
});
