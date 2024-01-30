$(document).ready(function()
{
    //page function
    let page = 1, choice;
   $(document).on("click", ".page button", function()
   {
        page = $(this).val();
        choice = 0;
        search_content = $("input[type = 'search']").val();

        $(".table-content").load("add_user/add_user_ajax.php", {
            page:page, c:choice, content:search_content
        });
   });

   //search item
   $(document).on("keyup", ".search-bar input", function()
   {
        if(choice == 0)
          page = 1;
        let search_content = $(this).val();
        choice = 1;

        $(".table-content").load("add_user/add_user_ajax.php", {
            page:page, content:search_content, c:choice
        });
   });

   //open modal
   localStorage.setItem("openandclose", 0);
   $(".add-btn button, .modal-head button").click(function()
   {
        let add_modal = localStorage.getItem("openandclose");
        openandclose_modal(add_modal);
   });

   function openandclose_modal(c)
   {
       if(c == 0)
       {
            $(".modal").css({"visibility":"visible", "opacity":"1"});
            localStorage.setItem("openandclose", "1");
       }
       else
       {
            $(".modal").css({"visibility":"hidden", "opacity":"0"});
            localStorage.setItem("openandclose", "0");
       }
   }

   //password strength
   $("input[name = 'password']").keyup(function()
   {
        let password = $(this).val();
        $("#e-password").html("<div id = 'weak'></div><div id = 'medium'></div><div id = 'strong'></div>");

        checkpassword(password);
   });

   function checkpassword(password)
   {
        let uppercase= RegExp('[A-Z]');
        let lowercase= RegExp('[a-z]');
        let numbers = RegExp('[0-9]');

        if(password.length > 0)
			$("#weak").css("visibility","visible");
		else
			$("#weak").css("visibility","hidden");
		if(password.match(uppercase) && password.match(lowercase) || password.match(uppercase) && password.match(numbers) || password.match(lowercase) && password.match(numbers))
			$("#medium").css("visibility","visible");
		else
			$("#medium").css("visibility","hidden");
		if(password.match(uppercase) && password.match(lowercase) && password.match(numbers))
			$("#strong").css("visibility","visible");
		else
			$("#strong").css("visibility","hidden");
   }

   //add function
   $("p button").click(function()
   {
       choice = 2;
       search_content = $("input[type = 'search']").val();
       let username = $("input[name = 'username']").val();
       let name = $("input[name = 'fullname']").val();
       let email = $("input[name = 'email']").val();
       let password = $("input[name = 'password']").val();
       let rpassword = $("input[name = 'repassword']").val();

        $(".table-content").load("add_user/add_user_ajax.php", {
            page:page, c:choice, u:username, n:name, e:email, p:password, rp:rpassword, content:search_content
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

     $(".lni-eye").mousedown(function()
	{
		$(this).siblings("input").attr("type", "text");
	});

	$(".lni-eye").mouseup(function()
	{
		$(this).siblings("input").attr("type", "password");
	});
     
     $(function () {
         //禁用“确认重新提交表单”
         window.history.replaceState(null, null, window.location.href);
         });
 
});