$(document).ready(function() {

    $(".list input[type=checkbox]").click(function() {
        if ($(this).is(":checked")) {
            parentChecked($(this));
        }
        else {
            parentUnchecked($(this));
        }
    });


    function parentChecked(main) {
        $(".list input[parent=" + main.attr('aco-id') + "]").each(function() {
            $(this).prop('disabled', 'disabled');
            $(this).prop('checked', false);
            parentChecked($(this));
        });
    }

    function parentUnchecked(main) {
        $(".list input[parent=" + main.attr('aco-id') + "]").each(function() {
            $(this).prop('disabled', false);
            parentUnchecked($(this));
        });
    }

});
