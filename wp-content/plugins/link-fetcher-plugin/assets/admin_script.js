jQuery(document).ready(function ($) {
    $('#fetch_uri_fetch').click(function () {

        var uri = $('#fetch_uri').val();

        var data = {
            action: 'fetch_uri',
            fetch_uri: uri
        };
        $.post(ajaxurl, data, function (response, status) {
            var container = $("#response_container");

            container.html('');
            container.append(response);
        });
    });

});