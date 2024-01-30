$(document).ready(function()
{
    //gear show and hide
    let gear = 0;
    $(".add-btn .gear").click(function()
    {
        gear = gearsnh(gear);
        
    });

    function gearsnh(g)
    {
        if(g == 0)
        {
            $(".add-btn div").css("visibility", "visible");
            $(".add-btn div").css("opacity", "1");
            g = 1;
        }
        else
        {
            $(".add-btn div").css("opacity", "0");
            g = 0;
        }

        return g;
    }

    //edit and delete
    localStorage.setItem("edit_and_delete", 2);
    $("#edit").click(function()
    {
        localStorage.setItem("edit_and_delete", 0);
        diplaybtn()
    })

    $("#delete").click(function()
    {
        localStorage.setItem("edit_and_delete", 1);
        diplaybtn()
    })

    $("#clear").click(function()
    {
        localStorage.setItem("edit_and_delete", 2);
        diplaybtn()
    })


    function diplaybtn()
    {
        let d = localStorage.getItem("edit_and_delete");

        if(d == 0)
            $(".operation").html("<button><i class='far fa-edit'></i></button>");
        else if(d == 1)
            $(".operation").html("<button><i class='far fa-trash-alt'></i></button>");
        else
            $(".operation").html("");
    }

    //page function
    let page = 1, choice = 0, search_content = "";
   $(document).on("click", ".page button", function()
   {
        page = $(this).val();
        choice = 0;
        search_content = $("input[type = 'search']").val();
        $(".table-content").load("edit_user/edit_user_ajax.php", {
            page:page, c:choice, content:search_content
        });
   });

   //search item
   $(document).on("keyup", ".search-bar input", function()
   {
       if(choice == 0)
            page = 1;
        search_content = $(this).val();
        choice = 1;
        $(".table-content").load("edit_user/edit_user_ajax.php", {
            page:page, content:search_content, c:choice
        });
   });

   //edit modal
   let id, choice_add;
   localStorage.setItem("openandclose", 0);
   $(document).on("click", ".fa-edit, .modal-head button", function()
   {
        let edit_modal = localStorage.getItem("openandclose");
        choice_add = 0;
        id = $(this).parent().parent().siblings("input[type = 'hidden']").val();

        openandclose_editmodal(edit_modal);
        $(".modal-body").load("edit_user/display_and_update.php", {
            id:id, c:choice_add
        });
   });

   function openandclose_editmodal(c)
   {
       if(c == 0)
       {
            $("#edit-modal").css({"visibility":"visible", "opacity":"1"});
            localStorage.setItem("openandclose", "1");
       }
       else
       {
            $("#edit-modal").css({"visibility":"hidden", "opacity":"0"});
            localStorage.setItem("openandclose", "0");
       }
   }

   //delete modal
   $(document).on("click", ".fa-trash-alt, #cancel-btn", function()
   {
        let delete_modal = localStorage.getItem("openandclose");
        id = $(this).parent().parent().siblings("input[type = 'hidden']").val();
        
        if(delete_modal == 0)
        {
            $("#delete-modal").css({"visibility":"visible", "opacity":"1"});
            localStorage.setItem("openandclose", "1");
        }
        else
        {
            $("#delete-modal").css({"visibility":"hidden", "opacity":"0"});
            localStorage.setItem("openandclose", "0");
        }
   });

   //delete function
   $(document).on("click", "#delete-btn", function()
   {
        choice = 2;
        search_content = $("input[type = 'search']").val();

        $(".table-content").load("edit_user/edit_user_ajax.php", {
            page:page, content:search_content, c:choice, id:id
        });
        $("#delete-modal").css({"visibility":"hidden", "opacity":"0"});
        localStorage.setItem("openandclose", "0");
   });

   //update information
   $(document).on("change", ".modal-body .paragraph .input input, select", function()
   {
        choice_add = 1;
        let un = $("input[name = 'username']").val();
        let fn = $("input[name = 'fullname']").val();
        let pn = $("input[name = 'phone']").val();
        let add = $("input[name = 'address']").val();
        let st = $("select[name = 'state']").val();
        let ct = $("input[name = 'city']").val();
        let pc = $("input[name = 'postal-code']").val();
        let ac = $("select[name = 'status']").val();

        $(".modal-body").load("edit_user/display_and_update.php", {
            id:id, un:un, fn:fn, pn,pn, add:add, st:st, ct:ct, pc:pc, ac:ac, c:choice_add
        });
        
        setTimeout(function()
        {
            $(".table-content").load("edit_user/edit_user_ajax.php", {
                page:page, content:search_content, c:choice
            });
        }, 1000);
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