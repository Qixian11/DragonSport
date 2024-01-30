/*$(document).ready(function()
{   
     //chart1
    var salary_bar = document.getElementById("weekly-salary").getContext("2d");
    var chart = new Chart(salary_bar,
        {
            type:"bar",
            data:
             {
            labels: ["October", "November", "December", "January", "February"],
            datasets:
            [{
                label:"Salary",
                backgroundColor:"#F3F2F1",
                borderColor:"#8B8378",
                borderWidth:1,
                barThickness:9,
                data:["2000", "1500", "1700", "2100", "3000"]
            }]
        },

        options:
        {
            responsive:true,
            maintainAspectRatio:false,
            title: {
                display: true,
                text: 'AVERAGE WEEKLY SALES REVENUE'
              }, 
            layout:
            {
                padding:
                {
                    
                    bottom:50,
                    left:20,
                    right:30,
                }
            },
            scales: 
            {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax:4000,
                        stepSize: 1000,
                        fontSize:12
                    }
                }],
                xAxes:[{
                    ticks:
                    {
                        fontSize:12
                    }
                }]
            },
        }
    });

    //chart2
    var target_pie = document.getElementById("monthly-target").getContext("2d");
    var chart = new Chart(target_pie,
        {
            type:"pie",
            data:
             {
            labels: ["October", "November", "December", "January", "February"],
            datasets:
            [{
                label:"Target",
                backgroundColor: ["#C7BEFF", "#BFEAA3","#CCF2FF","#e8c3b9","#F18C92"],
                borderColor:"#8B8378",
                data:["2000", "1500", "1700", "2100", "3000"]
            }]
        },

        options:
        {
            title: {
                display: true,
                text: 'TARGET OF MONTHLY'
              }, 
         
        },  

    });

    //chart3
    var chart3 = document.getElementById("myChart").getContext("2d");
    var chart = new Chart(chart3,
        {
            type:"line",
            data:
             {
            labels: [ "November", "December", "January", "February"],
            datasets:
            [{
                label:"Sales",
                backgroundColor:"#B9DCFF",
                borderColor:"#1874CD",
                borderWidth:1,
                data:[ "1500", "1700", "2100", "3000"]
            }]
        },

        options:
        {
            responsive:true,
            maintainAspectRatio:false,
            layout:
            {
                padding:
                {
                    
                    bottom:50,
                    left:20,
                    right:30,
                }
            },
            scales: 
            {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax:4000,
                        stepSize: 1000,
                        fontSize:12
                    }
                }],
                xAxes:[{
                    ticks:
                    {
                        fontSize:12
                    }
                }]
            },
            
        },
    });

    //chart4
    var chart4= document.getElementById("yearly-sales").getContext("2d");
    var chart = new Chart(chart4,
        {
            type:"line",
            data:
             {
            labels: ["October", "November", "December", "January", "February"],
            datasets:
            [{
                label:"Salary",
                backgroundColor:"#FBE9E9",
                borderColor:"#EC8D8D",
                borderWidth:1,
                data:["2000", "1500", "1700", "2100", "3000"]
            }]
        },

        options:
        {
            responsive:true,
            maintainAspectRatio:false,
            layout:
            {
                padding:
                {
                    
                    bottom:50,
                    left:20,
                    right:30,
                }
            },
            scales: 
            {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax:4000,
                        stepSize: 1000,
                        fontSize:12
                    }
                }],
                xAxes:[{
                    ticks:
                    {
                        fontSize:12
                    }
                }]
            },
        }
    });

    var chart5= document.getElementById("yearly").getContext("2d");
    var chart = new Chart(chart5,
        {
        type: 'bar',
        data: {
          labels: ["2018", "2018", "2020", "2021"],
          datasets: [{
              label: "NIKE AIR",
              type: "line",
              borderColor: "#FEA500",
              backgroundColor:"#FFF6E5",
              barThickness:18,
              data: [408,1547,675,1234],
              fill: false
            }, {
              label: "Adidas",
              type: "bar",
              backgroundColor:"#2BF7FF",
              barThickness:25,
              data: [133,1500,783,2478],
              fill: false
            }, 
          ]
        },
        options: {
          legend: { display: false },
    
                layout:
                {
                    padding:
                    {
                        
                        bottom:0,
                        left:20,
                        right:30,
                    }
                },
             
          },
        
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
*/


