$(document).ready(function() {
    $(".panel-category").click(function() {
        if ($(this).hasClass("panel-category-active")) {
            $(this).removeClass("panel-category-active");
        } else {
            $(this).addClass("panel-category-active");
        }
    });
});