$(document).ready(function()
{
    let brand_choice, b_page = 1; //assign the action to php

    //brand add modal
    $("#brand-add").click(function()
    {
        $("#brand-modal").css({"visibility":"visible", "opacity":"1"});
    });

    //brand close modal
    $("#brand-modal .modal-head button").click(function()
    {
        $("#brand-modal").css({"visibility":"hidden", "opacity":"0"});
        $("#brand-modal input[type = 'text']").val("");
    });

    //brand submit
    $("#brand-modal input[type = 'button']").click(function()
    {
        brand_choice = 0;
        let brand = $("#brand-modal input[type = 'text']").val();
        $("#b-category-body").load("category/brand_ajax.php",
        {
            c:brand_choice, b:brand, p:b_page
        });
    });

    //brand edit dunction
    $(document).on("click", "#b-category-body .edit", function()
    {
        let brand_name = $(this).parent().siblings(".brands_name").text();
        $(this).parent().siblings(".brands_name").html("<input type = 'text' value = '"+brand_name+"' name = 'brands_name'>");
        $(this).parent().html("<button class = 'save'><i class='far fa-save'></i></button>");
    });

    $(document).on("click", "#b-category-body .save", function()
    {
        brand_choice = 1;
        let id = parseInt($(this).parent().siblings(".id").text());
        let brand_name = $(this).parent().siblings(".brands_name").children().val();
        $(this).parent().siblings(".brands_name").html(brand_name);
        $(this).parent().load("category/brand_ajax.php",
        {
            c:brand_choice, b:brand_name, id:id, p:b_page
        });
    });

    //open brand delete function
    let brands_del_id;
    $(document).on("click", "#b-category-body .delete", function()
    {
        brands_del_id = parseInt($(this).parent().siblings(".id").text());
        $("#del-brand-modal").css({"visibility":"visible", "opacity":"1"});
        console.log(brands_del_id);
    });

    //brands delete function
    $(document).on("click", "#del-brand-modal .delete-btn", function()
    {
        brand_choice = 2;

        $("#del-brand-modal").css({"visibility":"hidden", "opacity":"0"});
        $("#b-category-body").load("category/brand_ajax.php",
        {
            c:brand_choice, id:brands_del_id, p:b_page
        });
    });

    //close brand delete function
    $(document).on("click", "#del-brand-modal .cancel-btn", function()
    {
        $("#del-brand-modal").css({"visibility":"hidden", "opacity":"0"});
    });

    //brand pagination
    $(document).on("click", "#b-category-body .page button", function()
    {
        b_page = $(this).val();
        brand_choice = 3;

        $("#b-category-body").load("category/brand_ajax.php",
        {
            c:brand_choice, p:b_page
        });
    });
    //end brand

    let type_choice, tpage = 1;
    //type add modal
    $("#type-add").click(function()
    {
        $("#type-modal").css({"visibility":"visible", "opacity":"1"});
    });

    //type close modal
    $("#type-modal .modal-head button").click(function()
    {
        $("#type-modal").css({"visibility":"hidden", "opacity":"0"});
        $("#type-modal input[type = 'text']").val("");
    });

     //type submit
     $("#type-modal input[type = 'button']").click(function()
     {
         type_choice = 0;
         let type = $("#type-modal input[type = 'text']").val();
         $("#t-category-body").load("category/type_ajax.php",
         {
             c:type_choice, t:type, p:tpage
         });
     });

     //type edit dunction
    $(document).on("click", "#t-category-body .edit", function()
    {
        let type_name = $(this).parent().siblings(".types_name").text();
        $(this).parent().siblings(".types_name").html("<input type = 'text' value = '"+type_name+"' name = 'types_name'>");
        $(this).parent().html("<button class = 'save'><i class='far fa-save'></i></button>");
    });

    $(document).on("click", "#t-category-body .save", function()
    {
        type_choice = 1;
        let id = parseInt($(this).parent().siblings(".id").text());
        let type_name = $(this).parent().siblings(".types_name").children().val();
        $(this).parent().siblings(".types_name").html(type_name);
        $(this).parent().load("category/type_ajax.php",
        {
            c:type_choice, t:type_name, id:id, p:tpage
        });
    });

    //open type delete function
    let types_del_id;
    $(document).on("click", "#t-category-body .delete", function()
    {
        types_del_id = parseInt($(this).parent().siblings(".id").text());
        $("#del-type-modal").css({"visibility":"visible", "opacity":"1"});
    });

     //types delete function
     $(document).on("click", "#del-type-modal .delete-btn", function()
     {
         type_choice = 2;
 
         $("#del-type-modal").css({"visibility":"hidden", "opacity":"0"});
         $("#t-category-body").load("category/type_ajax.php",
         {
             c:type_choice, id:types_del_id, p:tpage
         });
     });

     //close type delete function
    $(document).on("click", "#del-type-modal .cancel-btn", function()
    {
        $("#del-type-modal").css({"visibility":"hidden", "opacity":"0"});
    });

    //brand pagination
    $(document).on("click", "#t-category-body .page button", function()
    {
        tpage = $(this).val();
        type_choice = 3;

        $("#t-category-body").load("category/type_ajax.php",
        {
            c:type_choice, p:tpage
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