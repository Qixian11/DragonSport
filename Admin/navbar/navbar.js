$(document).ready(function()
{
    //digital clock
    let trigger_time = setInterval(clock, 1000);

    function clock()
    {
        let time = new Date();

        $("#hour").html(time.getHours());
        $("#minute").html(time.getMinutes());
        $("#second").html(time.getSeconds());
    }

    //sidebar user dropdown
    $("#user").click(function()
    {
        user_dropdown(this);
    });

    function user_dropdown(a)
    {
        if($(".user-drop-section").css("display") === "none")
        {
            $(a).css("background", "#303c54");
            $(".user-drop-section").slideDown();
            $("#user .lni-chevron-left").css("transform", "rotate(-90deg)");
        }
        else
        {
            $(a).css("background", "#3c4b64");
            $(".user-drop-section").slideUp();
            $("#user .lni-chevron-left").css("transform", "rotate(0deg)");
        }
    }

    //sidebar staff dropdown
    $("#staff").click(function()
    {
        staff_dropdown(this);
    });

    function staff_dropdown(a)
    {
        if($(".staff-drop-section").css("display") === "none")
        {
            $(a).css("background", "#303c54");
            $(".staff-drop-section").slideDown();
            $("#staff .lni-chevron-left").css("transform", "rotate(-90deg)");
        }
        else
        {
            $(a).css("background", "#3c4b64");
            $(".staff-drop-section").slideUp();
            $("#staff .lni-chevron-left").css("transform", "rotate(0deg)");
        }
    }

    //side product dropdown
    $("#product").click(function()
    {
        product_dropdown(this);
    });

    function product_dropdown(a)
    {
        if($(".product-drop-section").css("display") === "none")
        {
            $(a).css("background", "#303c54");
            $(".product-drop-section").slideDown();
            $("#product .lni-chevron-left").css("transform", "rotate(-90deg)");
        }
        else
        {
            $(a).css("background", "#3c4b64");
            $(".product-drop-section").slideUp();
            $("#product .lni-chevron-left").css("transform", "rotate(0deg)");
        }
    }

    //Hide and Show side bar
    let hideshow_sidebar = 0;
    $(".body-head button").click(function()
    {
        hideshow_sidebar = showandhide_sidebar(hideshow_sidebar);
    });

    function showandhide_sidebar(a)
    {
        if(a === 0)
        {
            $(".body-head").css({"margin-left":"0", "max-width":"100vw"});
            $(".body").css({"margin-left":"0", "max-width":"100vw"});
            $("nav").css("left", "-13vw");
            a = 1;
        }
        else
        {
            $(".body-head").css({"margin-left":"13vw", "max-width":"87vw"});
            $(".body").css({"margin-left":"13vw", "max-width":"87vw"});
            $("nav").css("left", "0");
            a = 0;
        }
    
        return a;
    }

    //profile dropdown
    $(".body-head .admin-profile").click(function()
    {
        $(".body-head .admin-profile div").toggle();
    });
});