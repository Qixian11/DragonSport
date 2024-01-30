$(document).ready(function(){
    $(".part3 .gear button").click(function(){
      $(".top .part3 .setting").fadeToggle();
    });
 
    $("#add").click(function()
    {
        product_dropdown();
    });

    function product_dropdown()
    {
        if($(".addproduct_form").css("display") === "none")
        {
          
            $(".addproduct_form").slideDown();
          
        }
        else
        {
            
            $(".addproduct_form").slideUp();
        
        }
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
            $(".actionfucntion").html("<button><i class='lnr lnr-pencil' style='color:#2B60DE'></i></button>");
        else if(d == 1)
			$(".actionfucntion").html("<button><i class='lnr lnr-trash' style='color:#d11a2a;'></i></button>");
        else
            $(".actionfucntion").html("");
    
    }

	
	 //page function
    let page = 1, choice = 0, search_content = "";
   $(document).on("click", ".page button", function()
   {
        page = $(this).val();
        choice = 0;
        search_content = $("input[type = 'search']").val();
        $(".tablerefresh").load("product_entry/product_entry_ajax.php", {
            page:page, c:choice, content:search_content
        });
   });
   
   //edit modal
   let id, choice_add, szid;
   localStorage.setItem("openandclose", 0);
   $(document).on("click", ".lnr-pencil, .modal-head button", function()
   {
        let edit_modal = localStorage.getItem("openandclose");
        choice_add = 0;
        szid = parseInt($(this).parents("td").siblings("#size_id").text());
        id = $(this).parent().parent().siblings("input[type = 'hidden']").val();
        console.log(szid);

        openandclose_editmodal(edit_modal);
        $(".modal-body").load("product_entry/display&update.php", {
            id:id, c:choice_add, szid:szid
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
   $(document).on("click", ".lnr-trash, #cancel-btn", function()
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

        $(".tablerefresh").load("product_entry/product_entry_ajax.php", {
            page:page, content:search_content, c:choice, id:id
        });
        $("#delete-modal").css({"visibility":"hidden", "opacity":"0"});
        localStorage.setItem("openandclose", "0");
   });
   
    //search item
   $(document).on("keyup", ".search-bar input", function()
   {
       if(choice == 0)
            page = 1;
        search_content = $(this).val();
        choice = 1;
        $(".tablerefresh").load("product_entry/product_entry_ajax.php", {
            page:page, content:search_content, c:choice
        });
   });
   
      //update information
   $(document).on("change", ".modal-body .paragraph .input input", function()
   {
        choice_add = 1;
       
        let sqty= $(".input input[name = 'sqty']").val();

        $(".modal-body").load("product_entry/display&update.php", {
            id:id, sqty:sqty, c:choice_add,
        });
        $(".table-content").load("product_entry/product_entry_ajax.php", {
            page:page, content:search_content, c:choice
        });
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