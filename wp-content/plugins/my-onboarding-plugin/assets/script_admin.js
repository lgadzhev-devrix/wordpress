jQuery(document).ready(function ($) {

    //Disable student
    $('.disabled_student').click(function () {

        var post_id = $(this).attr('id');
        var checked = $(this).prop('checked');

        var data = {
            action: 'student_status',
            post_id: post_id,
            checked: checked
        };
        $.post(ajaxurl, data);
    })
});
