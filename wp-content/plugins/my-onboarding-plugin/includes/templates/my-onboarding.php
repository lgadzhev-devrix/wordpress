<h1>My Onboarding</h1>

<label for="filters_enabled">Filters Enabled</label>
<input id='filters_enabled' type="checkbox" name="filters_enabled" <?php echo get_option( 'my_onboarding_filter')?"checked":"";?> >
<button id="my_onboarding_filter_save">Save</button>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#my_onboarding_filter_save').click(function () {

            var checked = 0;

            if ($("#filters_enabled").is(":checked")) {
                checked = 1;
            }

            var data = {
                action: 'change_filter',
                filters_enabled: checked
            };
            $.post(ajaxurl, data);
        });

    });


</script>