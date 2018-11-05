jQuery(document).ready(function ($) {

    //Filter AJAX
    var content = jQuery("#custom-page-content");

    content.before().prepend("<p id='onboardingFilter'>Onboarding Filter: </p>");

    var onboardingfilter = jQuery("#onboardingFilter");

    onboardingfilter.append("<p>by Lachezar</p>");

    content.append("<div style='display: none;'></div>");

});
