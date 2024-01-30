$(document).ready(function(){
   
   $(document).on("blur", ".sizetable table .testtt", function()
   {
       let id = $(this).children("input[type = 'hidden']").val();
       let size=$(this).text();
       console.log(id);
       console.log(size);

       let size_choice=0;
       $(".sizetable").load("product_entry/size_ajax.php",{
           id:id,size:size,c:size_choice
       });

   })
 
   //add size modal
   $("#addsi").click(function()
   {
       $("#size-modals").css({"visibility":"visible", "opacity":"1"});
   });

   // close size modal
   $("#size-modals .modals-head button").click(function()
   {
       $("#size-modals").css({"visibility":"hidden", "opacity":"0"});
       $("#size-modals input[type = 'text']").val("");
   });

   //size submit
   $("#size-modals .submit input[type = 'button']").click(function()
   {
       size_choice = 1;
       let size = $("#size-modals input[type = 'text']").val();
       $("#sizetable").load("product_entry/size_ajax.php",
       {
           c:size_choice, size:size, 
       });
  
    });

  
    $("#delsi").click(function()
    {
        let check = $(".actsifunction").html();

        if(check != "<div>DEL</div>")
            $(".actsifunction").html("<div>DEL</div>");
        else
            $(".actsifunction").html("&nbsp;");
    });
    
   

      //open size delete function
      let size_del_id;
      $(document).on("click" , ".actsifunction", function() 
      {
          size_del_id = $(this).siblings("input[type = 'hidden']").val();
          $("#delete-size-modals").css({"visibility":"visible", "opacity":"1"});
      });
  
      //brands delete function
      $(document).on("click", "#delete-size-modals .delete-btn", function()
      {
          size_choice = 2;
  
          $("#delete-size-modals").css({"visibility":"hidden", "opacity":"0"});
          $("#sizetable").load("product_entry/size_ajax.php",
          {
              c:size_choice, id:size_del_id
          });
      });
  
      //close brand delete function
      $(document).on("click", "#delete-size-modals .cancel-btn", function()
      {
          $("#delete-size-modals").css({"visibility":"hidden", "opacity":"0"});
      });

    
});   
