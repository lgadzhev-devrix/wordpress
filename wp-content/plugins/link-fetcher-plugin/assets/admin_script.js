jQuery(document).ready(function ($) {
    $('#fetch_uri_fetch').click(function () {

        var uri = $('#fetch_uri').val();
        var cache_duration = $('#cache_duration').val();

        var data = {
            action: 'fetch_uri',
            fetch_uri: uri,
            cache_duration: cache_duration
        };
        $.post(ajaxurl, data, function (response, status) {
            var container = $("#response_container");

            container.html('');
            container.append(response);
        });
    });

});