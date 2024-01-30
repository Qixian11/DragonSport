$(document).on("keyup", ".search-bar input", function()
{
    if(choice == 0)
     page = 1;
     search_content = $(this).val();
     choice = 1;
     $(".table").load("order_report/order_report_ajax.php", {
         page:page, content:search_content, c:choice
     });
});

	 //page function
    let page = 1, choice = 0, search_content = "";
   $(document).on("click", ".page button", function()
   {
        page = $(this).val();
        choice = 0;
        search_content = $("input[type = 'search']").val();
        $(".table").load("order_report/order_report_ajax.php", {
            page:page, c:choice, content:search_content
        });
   });