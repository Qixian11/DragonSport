$(document).ready(function()
{   
    //pagination
    let page = 1;
    let id = 0;
    $(document).on("click", ".pagination button",function()
    {
        page = $(this).val();
        let choice = 0;
        $(".body-forth").load("dashboard/dashboard_ajax.php", {
            choice:choice, page:page
        });
    });
    //end pagination
   
    //pop out view modal
    $(document).on("click", ".view", function()
    {
        let choice = 1;
        id = $(this).siblings("input[type = 'hidden']").val();
        pop(choice, id);
    });

    function pop(choice, id)
    {
        $("body").css("overflow", "hidden");
        $("#view").css({"visibility":"visible", "opacity":"1"});
        $("#name").html(name[id]);
        $("#subject").html(subject[id]);
        $("#message").html(message[id]);
        $(".body-forth").load("dashboard/dashboard_ajax.php", {
            choice:choice, id:id, page:page
        });
    }

    //close view modal
    $(document).on("click", ".view-modal-head button", function()
    {
        $("body").css("overflow", "visible");
        $("#view").css({"visibility":"hidden", "opacity":"0"});
    });

    //pop out delete modal
    $(document).on("click", ".delete", function()
    {
        id = $(this).siblings("input[type = 'hidden']").val();
        $("body").css("overflow", "hidden");
        $("#delete").css({"visibility":"visible", "opacity":"1"});
    });

    //close view modal
    $(document).on("click", "#cancel-btn", function()
    {
        $("body").css("overflow", "visible");
        $("#delete").css({"visibility":"hidden", "opacity":"0"});
    });

    //delete message
    $(document).on("click", "#delete-btn", function()
    {
        let choice = 2;
        delete_message(id, choice);
    });

    function delete_message(i, c)
    {
        $(".body-forth").load("dashboard/dashboard_ajax.php", {
            choice:c, id:i, page:page
        });
        $("#delete").css({"visibility":"hidden", "opacity":"0"});
    }

    //sent message
    $(document).on("click", ".reply-submit button", function()
    {
        let choice = 3;
        let message = $("textarea[name = 'reply']").val();
        $(".body-forth").load("dashboard/dashboard_ajax.php", {
            choice:choice, id:id, page:page, message:message
        });
        $("#view").css({"visibility":"hidden", "opacity":"0"});
    });

    // profile pop out 
        $(".profile-content").hide();
    $(document).on("click","#view-profile", function()
    {
        $(".profile-content").show();
        $("body").css("overflow","hidden");
    
    });
    $(document).on("click","#btn123", function()
    {
        $(".profile-content").hide();
        $("body").css("overflow","visible");
    
    });
   
    $(".chgadmin").hide();  

    $("#btn1").click(function()
    {
        $(".chgadmin").show();
    });
    
    $(document).on("click",".close-btn", function(){
        $(".chgadmin").hide(); 
    });
    
    $(function () {
        //禁用“确认重新提交表单”
        window.history.replaceState(null, null, window.location.href);
        });


});