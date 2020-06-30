
$(document).ready(function () {
    $("#menu_open_img").on("click", function () {
        $("#menu_List").removeClass("hide").addClass("translateX")
    });
    $("#menu_close").on("click", function () {
        $("#menu_List").removeClass("translateX").addClass("hide")
    });
    $(document).click(function(e) {
        var dt_cl = $(".dt_cl");
        var container = $(".dt");
        var container = $(".dt");
        if(!container.is(e.target) &&
            container.has(e.target).length === 0
            && !dt_cl.is(e.target)
            && dt_cl.has(e.target).length === 0) {
            $("#menu_List").removeClass("translateX").addClass("hide")
        }
    });

    $(".click_to_logou_open").on("click", function () {
        $(".show_logout_div").removeClass("hide").addClass("show")
    });
    $("#menu_close").on("click", function () {
        $("#menu_List").removeClass("translateX").addClass("hide")
    });
    $(document).click(function(e) {
        var dt_cl = $(".dt_cl");
        var container = $(".dt");
        var container = $(".dt");
        if(!container.is(e.target) &&
            container.has(e.target).length === 0
            && !dt_cl.is(e.target)
            && dt_cl.has(e.target).length === 0) {
            $("#menu_List").removeClass("translateX").addClass("hide")
        }
    });
    $(document).click(function(e) {
        var dt_cl = $(".dt2cl");
        var container = $(".dt2");
        var container = $(".dt2");
        if(!container.is(e.target) &&
            container.has(e.target).length === 0
            && !dt_cl.is(e.target)
            && dt_cl.has(e.target).length === 0) {
            $(".show_logout_div").removeClass("show").addClass("hide");
            $(".multi_select_div").addClass("hide");
            $(".custom_select2").addClass("hide");
        }
    });
});