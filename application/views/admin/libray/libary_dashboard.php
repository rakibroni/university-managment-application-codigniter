<!-- orris -->
<link href="<?php echo base_url(); ?>assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">    

<link href='<?php echo base_url();?>assets/calendar/css/fullcalendar.css' rel='stylesheet' /> 
<!-- Custom css  -->
<script src='<?php echo base_url();?>assets/calendar/js/moment.min.js'></script>  
<script src="<?php echo base_url();?>assets/calendar/js/fullcalendar.min.js"></script>
<script src='<?php echo base_url();?>assets/calendar/js/bootstrap-colorpicker.min.js'></script>


<link href="<?php echo base_url(); ?>assets/css/plugins/contextMenu/jquery-ui.css" type="text/css" rel='stylesheet'>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/CircularNavigation/css/component2.css"/>


<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/modernizr-2.6.2.min.js"></script>



<script src='<?php echo base_url();?>assets/calendar/js/main.js'></script>

<link href="<?php echo base_url(); ?>assets/css/plugins/contextMenu/jquery-ui.css" type="text/css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/CircularNavigation/css/component2.css"/>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/modernizr-2.6.2.min.js"></script>

<?php //var_dump($programs); ?>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Dashboard</h5>

  </div>
<?php

//echo $currentTotalActiveBorrowItem;

//var_dump($finalAffectedDataForTodayItem);  ?>
<div id="event_modal" class="ibox-content">
<div class="row">

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-info pull-right">Current Total</span>
              <h5>Number of Books</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $currentTotalItem; ?></h1>
             
              <small>Books</small></br>
               <a href="#">See More</a>
          </div>
      </div>
  </div>

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-success pull-right">Current Total</span>
              <h5>Total Borrow Books</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $currentTotalActiveBorrowItem; ?></h1>
             
              <small>Books</small>
              </br>
               <a href="#">See More</a>
          </div>
      </div>
  </div>

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-primary pull-right">Current Total</span>
              <h5>Libary Member</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $currentTotalActiveMember; ?></h1>
              
              <small> Member</small>
              </br>
               <a href="#">See More</a>
          </div>

      </div>
  </div>
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-danger pull-right">Current Total</span>
              <h5>Amount of Due</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">300</h1>
            
              <small>TK </small>
              </br>
               <a href="#">See More</a>
          </div>
      </div>
  </div>
</div>



<!-- End summery section -->
<!-- start chart section -->
<div class="row" style="margin-top: 20px;">

  <div class="col-lg-6">
  <!-- Start Collespane for table -->
          <div class="ibox-title" >
              <h5>Report  Of Due </h5>
              <div ibox-tools=""></div>
          </div>
    <div class="bs-example">
    <div class="panel-group" id="accordion1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">1. Today Due</a>
                </h4>
            </div>
            <div id="collapseOne1" class="panel-collapse collapse in">
                <div class="panel-body">
                   
                               <div class="ibox-content">
        
            <table class="table table-striped table-bordered table-hover " id="editable" >
            <thead>
            <tr>
                <th>Book Name</th>
                <th>Borrower Name</th>
                <th>Date Borrow</th>
                <th>Contact</th>
            
            </tr>
            </thead>
            <tbody>
            <tr class="gradeX">
                <td>Math II</td>
                <td>Md . Asad Ahmed
                </td>
                <td>2018-03-23</td>
                <td class="center">01827328014</td>
             
            </tr>
            <tr class="gradeC">
                <td>English I</td>
                <td>Toukir Ahmed</td>
                <td>2018-03-23</td>
                <td class="center">017654654</td>
              
            </tr>
            <tr class="gradeA">
                <td>MAth I</td>
                <td>Md. Abu Nawim</td>
                <td>2018-03-23</td>
                <td class="center">0182735460</td>
               
            </tr>
 

            </tbody>
     
            </table>

            </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseThree3">3. Tommorow Due</a>
                </h4>
            </div>
            <div id="collapseThree3" class="panel-collapse collapse">
                <div class="panel-body">
                   <table class="table table-striped table-bordered table-hover " id="editable" >
            <thead>
            <tr>
                <th>Book Name</th>
                <th>Borrower Name</th>
                <th>Date Borrow</th>
                <th>Contact</th>
            </tr>
            </thead>
            <tbody>
            <tr class="gradeX">
                <td>Math II</td>
                <td>Md . Asad Ahmed
                </td>
                <td>2018-03-23</td>
                <td class="center">01827328014</td>
             
            </tr>
            <tr class="gradeC">
                <td>English I</td>
                <td>Toukir Ahmed</td>
                <td>2018-03-23</td>
                <td class="center">017654654</td>
              
            </tr>
            <tr class="gradeA">
                <td>MAth I</td>
                <td>Md. Abu Nawim</td>
                <td>2018-03-23</td>
                <td class="center">0182735460</td>
               
            </tr>
 
            </tbody>
     
            </table>
                </div>
            </div>
        </div>
    </div>
    </div>   

  </div>
  <div class="col-lg-6">
      <div class="ibox float-e-margins">

          <div class="ibox-title" >
              <h5>Item Add and Item Borrow Report Last Six Month</h5>
              <div ibox-tools=""></div>
          </div>
          <div class="ibox-content">
              <div>

                  <canvas id="barChart" height="226" style="width: 485px; height: 226px;" width="485"></canvas> </br></br>
                  
                  <p>Note:&nbsp;&nbsp;&nbsp;<span style="height: 15px; width: 15px; background-color: #E5E5E5;
    border-radius: 50%;display: inline-block;"></span> Item Add &nbsp;&nbsp;&nbsp;
    <span style="height: 15px; width: 15px; background-color: #53C6AF;
    border-radius: 50%;display: inline-block;"></span> Item Borrow</p>

              </div>
          </div>
      </div>
  </div>
</div>

<div class="row" style="margin-top: 20px;">

  <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>At a Glance </h5>

              <div ibox-tools=""></div>
          </div>
          <div class="ibox-content">
              <div>
                  <canvas id="barChartGlance" height="226" style="width: 485px; height: 226px;" width="485"></canvas>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-6">
      <div class="ibox float-e-margins">

          <div class="ibox-title" >
              <h5>Requisition  And Complete Requisition Report Last Six Month</h5>
              <div ibox-tools=""></div>
          </div>
          <div class="ibox-content">
              <div>

                  <canvas id="barChartRequisition" height="226" style="width: 485px; height: 226px;" width="485"></canvas>

                  </br></br>
                  
                  <p>Note:&nbsp;&nbsp;&nbsp;<span style="height: 15px; width: 15px; background-color: #E5E5E5;
    border-radius: 50%;display: inline-block;"></span> Requisition  &nbsp;&nbsp;&nbsp;
    <span style="height: 15px; width: 15px; background-color: #53C6AF;
    border-radius: 50%;display: inline-block;"></span> Complete Requisition</p>
              </div>

          </div>
      </div>
  </div>
</div>



<!-- End chart section -->


<!-- Start Collapsend area-->
<div class="row" style="margin-top: 3%;">

<div class="bs-example">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Today Report</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                   
                <?php 

                 ?>

                <div id="event_modal" class="ibox-content">
                <div class="row">

                  <div class="col-lg-3">
                      <div class="ibox float-e-margins">
                          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
                           
                              <h5>Books Add</h5>
                          </div>
                          <div class="ibox-content" style="background-color: #f3f3f3;">
                              <h1 class="no-margins"><?php echo $finalAffectedDataForTodayItem; ?></h1>
                             
                              <small>Books</small></br>
                              
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-3">
                      <div class="ibox float-e-margins">
                          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
                           
                              <h5>Borrow Books</h5>
                          </div>
                          <div class="ibox-content" style="background-color: #f3f3f3;">
                              <h1 class="no-margins"><?php echo $finalAffectedDataForTodayBorrow; ?></h1>
                             
                              <small>Books</small>
                              </br>
                              
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-3">
                      <div class="ibox float-e-margins">
                          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
                            
                              <h5>Add Libary Member</h5>
                          </div>
                          <div class="ibox-content" style="background-color: #f3f3f3;">
                              <h1 class="no-margins"><?php echo $finalAffectedDataForTodayMember; ?></h1>
                              
                              <small> Member</small>
                              </br>
                              
                          </div>

                      </div>
                  </div>
                  <div class="col-lg-3">
                      <div class="ibox float-e-margins">
                          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
                              
                              <h5>Amount of Due</h5>
                          </div>
                          <div class="ibox-content" style="background-color: #f3f3f3;">
                              <h1 class="no-margins">50</h1>
                            
                              <small>TK </small>
                              </br>
                              
                          </div>
                      </div>
                  </div>
                </div>








                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Monthly Report</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                   


<div id="event_modal" class="ibox-content">
<div class="row">

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
           
              <h5>Books Add</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $finalAffectedDataForMonthItem; ?></h1>
             
              <small>Books</small></br>
              
          </div>
      </div>
  </div>

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
           
              <h5>Borrow Books</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $finalAffectedDataForMonthBorrow; ?></h1>
             
              <small>Books</small>
              </br>
              
          </div>
      </div>
  </div>

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
            
              <h5>Add Libary Member</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $finalAffectedDataForMonthMember; ?></h1>
              
              <small> Member</small>
              </br>
              
          </div>

      </div>
  </div>
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              
              <h5>Amount of Due</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">509</h1>
            
              <small>TK </small>
              </br>
              
          </div>
      </div>
  </div>
</div>








                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Yearly Report</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                   


<div id="event_modal" class="ibox-content">
<div class="row">

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
           
              <h5>Books Add</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $finalAffectedDataForYearItem; ?></h1>
             
              <small>Books</small></br>
              
          </div>
      </div>
  </div>

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
           
              <h5>Borrow Books</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $finalAffectedDataForYearBorrow; ?></h1>
             
              <small>Books</small>
              </br>
              
          </div>
      </div>
  </div>

  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
            
              <h5>Add Libary Member</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins"><?php echo $finalAffectedDataForYearMember; ?></h1>
              
              <small> Member</small>
              </br>
              
          </div>

      </div>
  </div>
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              
              <h5>Amount of Due</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">1590</h1>
            
              <small>TK </small>
              </br>
              
          </div>
      </div>
  </div>
</div>

                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- End Collapsend area-->



<div class="row" style="margin-top: 20px;">

  </div>

  

</div>

<?php 
for ($i = 1; $i <= 6; $i++) 
{
  $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));

  $fullMonth[]=date("m-y", strtotime( date( 'Y-m-01' )." -$i months"));
  $lastDate=end($fullMonth);

  //$data[]=$this->db->query("select * from lib_stock where DATE_FORMAT(CREATE_DATE,'m-%Y') = $lastDate")->result();
  $dataItem[]=$this->db->query("select * from lib_stock where DATE_FORMAT(CREATE_DATE,'%m-%y') = '$lastDate'")->result();

  $affectedDataDateWise[]= $this->db->affected_rows();

  $affectedDataDateWiseItem=json_encode($affectedDataDateWise);



  $dataBorrow[]=$this->db->query("select * from lib_borrowers where DATE_FORMAT(CREATE_DATE,'%m-%y') = '$lastDate'")->result();
  $affectedDataDateWiseBorrow[]= $this->db->affected_rows();
  $affectedDataDateWiseBorrowRow=json_encode($affectedDataDateWiseBorrow);


  $lastSixMonth=json_encode($months);

  $affectedDataDate[]=sizeof($affectedDataDateWise);
  




}



 ?>

<div class="clearfix"> </div>
</div>
</script>
   <script src="<?php echo base_url(); ?>assets/js/plugins/chartJs/Chart.min.js"></script>
<script type="text/javascript">

  /*$(function(){*/
$(document).ready(function () {
    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event
    var currentTotalItem = "<?php echo $currentTotalItem ?>";
    var currentTotalActiveMember = "<?php echo $currentTotalActiveMember ?>";
    var currentTotalActiveBorrowItem = "<?php echo $currentTotalActiveBorrowItem ?>";
    var currentTotalActiveMembertTEST = "<?php echo $currentTotalActiveMember ?>";
//
    var affectedDataDateWiseItem = <?php echo json_encode($affectedDataDateWiseItem); ?>;
    var affectedDataDateWiseItem = JSON.parse(affectedDataDateWiseItem); 


    var affectedDataDateWiseBorrowRow = <?php echo json_encode($affectedDataDateWiseBorrowRow); ?>;
    var affectedDataDateWiseBorrowRowData = JSON.parse(affectedDataDateWiseBorrowRow); 
   // console.log(affectedDataDateWiseBorrowRowData);

    
    

//
 
    var lastSixMonthJs = <?php echo json_encode($lastSixMonth); ?>;
    var lastSixMonthData = JSON.parse(lastSixMonthJs); 

    //var lastSixMonthData = JSON.parse(lastSixMonthJs); 

    var affectedRowData = <?php echo json_encode($affectedDataDate); ?>;

    var monthsix=lastSixMonthData;
    //var monthsix=["January", "February", "March", "April", "May", "June", "July "];
    var dataIssbook=affectedDataDateWiseItem;
    var returnBook=affectedDataDateWiseBorrowRowData;

    $('#color').colorpicker(); // Colopicker 
     var getUrl = window.location; 
    var base_url= getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/"; // Here i define the site_url

    // Fullcalendar
    $('#dashboard_calendar').fullCalendar({
      header: {
        left: 'prev, next, today',
        center: 'title',
        right: 'month, basicWeek, basicDay'
      },
        // Get all events stored in database
        eventLimit: true, // allow "more" link when too many events
        events: base_url+'calendar/getEvents',
        selectable: true,
        selectHelper: true,
        editable: false, // Make the event resizable true   
                // Event Mouseover
                eventMouseover: function(calEvent, jsEvent, view){

                 var tooltip = '<div class="tooltipevent" style="width:200px;height:auto;padding:5px;background:#d9edf7;position:absolute;z-index:10001;">' + calEvent.description + '</div>';
                 $("body").append(tooltip);
                 $(this).mouseover(function(e) {
                  $(this).css('z-index', 10000);
                  $('.tooltipevent').fadeIn('500');
                  $('.tooltipevent').fadeTo('10', 1.9);
                }).mousemove(function(e) {
                  $('.tooltipevent').css('top', e.pageY + 10);
                  $('.tooltipevent').css('left', e.pageX + 20);
                });
              },
              eventMouseout: function(calEvent, jsEvent) {
               $(this).css('z-index', 8);
               $('.tooltipevent').remove();
             },
           });


  
    var barData = {
        labels: monthsix,
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: dataIssbook
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.8)",
                highlightFill: "rgba(26,179,148,0.75)",
                highlightStroke: "rgba(26,179,148,1)",
                data: returnBook
            }
        ]
    };

    var barOptions = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        responsive: true,
    }


    var ctx = document.getElementById("barChart").getContext("2d");
    var myNewChart = new Chart(ctx).Bar(barData, barOptions);


    
    // Start barChartRequisition

    var barData = {
        labels: ["January", "February", "March", "April", "May", "June", "July "],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: [90 , 120, 250, 130, 190, 220, 270]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.8)",
                highlightFill: "rgba(26,179,148,0.75)",
                highlightStroke: "rgba(26,179,148,1)",
                data: [70, 100, 200, 150, 50, 190, 150]
            }
        ]
    };
    //console.log(barData.datasets);

   // alert(Object.values(barData));    

    var barOptions = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        responsive: true,
    }


    var ctx = document.getElementById("barChartRequisition").getContext("2d");
    var myNewChart = new Chart(ctx).Bar(barData, barOptions);



    // End barChartRequisition


    // Start barChartGlance

    var barData = { 
        labels: ["Total Book", "Borrow Books", "Libary Member", "Total Due"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "#53C6AF",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: [currentTotalItem , currentTotalActiveBorrowItem, currentTotalActiveMember,  30]
            }
        ]
    };

    var barOptions = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05) ",
        scaleGridLineWidth: 1,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        responsive: true,
    }


    var ctx = document.getElementById("barChartGlance").getContext("2d");
    var myNewChart = new Chart(ctx).Bar(barData, barOptions);

    // End barChartGlance


 });

</script>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/polyfills.js"></script>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/demo2.js"></script>
