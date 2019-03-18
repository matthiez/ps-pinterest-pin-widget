$(document).ready(function () {
    $("#configuration_form").validate({
        rules: {
            "config[PINTEREST_PIN_WIDGET_URL]": {
                required: true
            }
        }
    });
});