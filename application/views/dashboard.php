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

 

    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Dashboard</h5>

      </div>
    <div id="event_modal" class="ibox-content">



















<div class="row" style="width: 99%;margin-left: 1%;">
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-success pull-right">Monthly</span>
              <h5>Total Income</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">40,8869</h1>
              <div class="stat-percent font-bold text-success">15% <i class="fa fa-bolt"></i></div>
              <small>BDT</small>
          </div>
      </div>
  </div>
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-info pull-right">Annual</span>
              <h5>Number of Student</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">430</h1>
              <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
              <small>students</small>
          </div>
      </div>
  </div>
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-primary pull-right">Today</span>
              <h5>Number of Employee</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">90</h1>
              <div class="stat-percent font-bold text-navy">8% <i class="fa fa-level-up"></i></div>
              <small>New Employee</small>
          </div>
      </div>
  </div>
  <div class="col-lg-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title" style="background-color: #f3f3f3; border-width: 3px 0 0;">
              <span class="label label-danger pull-right">Annual</span>
              <h5>New Admission Student</h5>
          </div>
          <div class="ibox-content" style="background-color: #f3f3f3;">
              <h1 class="no-margins">80</h1>
              <div class="stat-percent font-bold text-danger">4% <i class="fa fa-level-down"></i></div>
              <small>New Admission</small>
          </div>
      </div>
  </div>
</div>
<!-- End summery section -->
<!-- start chart section -->
<div class="row" style="margin-top: 20px;">

  <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Total Payment Status</h5>

              <div ibox-tools=""></div>
          </div>
          <div class="ibox-content">
              <div>
                  <canvas id="doughnutChart" height="226" style="width: 485px; height: 226px;" width="485"></canvas>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title" >
              <h5>Yearly Student Admission </h5>
              <div ibox-tools=""></div>
          </div>
          <div class="ibox-content">
              <div>
                  <canvas id="barChart" height="226" style="width: 485px; height: 226px;" width="485"></canvas>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- End chart section -->
<div class="row" style="margin-top: 20px;">
      <div class="col-lg-6">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>Result</h5>

                  <div ibox-tools=""></div>
              </div>
              <div class="ibox-content">
                  <div class="text-center">
                      <canvas id="polarChart" height="226" style="width: 485px; height: 226px;" width="485"></canvas>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Total Income and Expense
                    <small>(Monthly).</small>
                </h5>
                <div ibox-tools=""></div>
            </div>
            <div class="ibox-content">
                <div>
                    <canvas id="lineChart" height="226" style="width: 485px; height: 226px;" width="485"></canvas>
                </div>
            </div>
          </div>

      </div>
  </div>


  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-6">
      <div class="ibox float-e-margins ">
        <div class="ibox-title info" style="background-color: #d9edf7">

          <b>Events</b>
        </div>
        <div class="ibox-content" style="padding: 3px !important">

          <div id='dashboard_calendar'></div>
        </div>
      </div>
    </div> 
    <div class="col-lg-6">   
     <div class="client-detail" style="height: 350px;">
      <div class="full-height-scroll">

       <table class="table table-striped table-bordered table-hover ">            
         <tbody>
          <tr class="info">
           <th class="col-md-1 text-center">#</th>
           <th class="col-md-7">Subject Wise Student</th>
           <th class="col-md-1">Male</th>
           <th class="col-md-1">Female</th>
           <th class="text-center col-md-2">Total Student</th>

         </tr>
         <!-- <?php 
         $SL=1;  
         $total_student=0; 
         $program_wise_tot_student=0;   
         foreach($programs  as $program): 
          ?>
          <tr>
           <td class="text-center"><?php echo $SL++; ?></td>
           <td><?php echo $program->PROGRAM_NAME ?></td>
           <td class="text-center">
             <?php

             $program_wise_tot_student=$this->utilities->countRowByAttribute("student_personal_info", array("PROGRAM_ID" => $program->PROGRAM_ID));

             $total_student +=$program_wise_tot_student; 
             echo ($program_wise_tot_student !='')? $program_wise_tot_student : '' ;
             ?>

           </td>
         </tr>
       <?php endforeach; ?>
       <tr> -->

         <tr>
             <td>1</td>
             <td> Doctor of Medicine by research (MD(Res), DM)</td>
             <td style="text-align:center;">45</td>
             <td style="text-align:center;">45</td>
             <td style="text-align:center;"> 90</td>
         </tr>
         <tr>
             <td>2</td>
         
             <td>  Doctor of Philosophy (PhD, DPhil)</td>
            <td style="text-align:center;">25</td>
             <td style="text-align:center;">10</td>
             <td style="text-align:center;"> 35</td>
         </tr>
         <tr>
             <td>3</td>

             <td> Doctor of Clinical Surgery (DClinSurg)</td>
             <td style="text-align:center;">15</td>
             <td style="text-align:center;">10</td>
             <td style="text-align:center;"> 25</td>
         </tr>
          <tr>
             <td>4</td>

             <td>  Doctor of Medical Science (DMSc, DMedSc)</td>

              <td style="text-align:center;">20</td>
             <td style="text-align:center;">10</td>
             <td style="text-align:center;"> 30</td>
         </tr>
          <tr>
             <td>5</td>
             <td> Doctor of Surgery (DS, DSurg)</td>
             <td style="text-align:center;">30</td>
             <td style="text-align:center;">25</td>
             <td style="text-align:center;"> 55</td>
         </tr>
                  <tr>
             <td>6</td>

             <td> Doctor of Clinical Surgery (DClinSurg)</td>
             <td style="text-align:center;">20</td>
             <td style="text-align:center;">16</td>
             <td style="text-align:center;"> 36</td>
         </tr>
          <tr>
             <td>7</td>
             <td>  Doctor of Medical Science (DMSc, DMedSc)</td>
              <td style="text-align:center;">30</td>
             <td style="text-align:center;">12</td>
             <td style="text-align:center;"> 42</td>
         </tr>
          <tr>
             <td>8</td>
             <td> Doctor of Surgery (DS, DSurg)</td>
             <td style="text-align:center;"> 52</td>
             <td style="text-align:center;">12</td>
             <td style="text-align:center;"> 40</td>
         </tr>
         <td class="text-right" colspan="2"><b>Total Student</b> </td>
         <td style="text-align:center;"><b></b> 198</td>
         <td style="text-align:center;"><b></b> 155 </td>
         <td class="text-center label-warning"><b>353</b></td>
       </tr>
     </tbody>
   </table>
 </div>
</div>
</div>
</div>

</div>




      <div class="row" style="margin-left: 1%;width: 99%;">
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-success pull-right">Current Session</span>
              <h5>Applicant</h5>
            </div>
            <div class="ibox-content" style="padding: 3px !important">
              <ul class="list-group">
                <li class="list-group-item">
                  <span class="badge badge-primary"><?php echo $tot_applicant; ?></span>
                  Total
                </li>
                <li class="list-group-item ">
                  <span class="badge badge-info"><?php echo $tot_applicant_male; ?></span>
                  Male
                </li>
                <li class="list-group-item">
                  <span class="badge badge-danger"><?php echo $tot_applicant_female; ?></span>
                  Female
                </li>

              </ul>

            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-info pull-right">Applicant</span>
              <h5>Degree wise</h5>
            </div>
            <div class="ibox-content" style="padding: 3px !important">
             <ul class="list-group">
              <li class="list-group-item">
                <span class="badge badge-primary"><?php echo $tot_applicant_bsc; ?></span>
                Undergraduate
              </li>
              <li class="list-group-item ">
                <span class="badge badge-info"><?php echo $tot_applicant_msc; ?></span>
                Graduate
              </li>
              <li class="list-group-item">
                <span class="badge badge-danger"><?php echo $tot_applicant_diploma; ?></span>
                Diploma
              </li>

            </ul>
          </div>
        </div>
      </div>


      <div class="col-lg-3">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <span class="label label-success pull-right">Total</span>
            <h5>Student</h5>
          </div>
          <div class="ibox-content" style="padding: 3px !important">
            <ul class="list-group">
              <li class="list-group-item">
                <span class="badge badge-primary"><?php echo $tot_stu; ?></span>
                Total
              </li>
              <li class="list-group-item ">
                <span class="badge badge-info"><?php echo $tot_stu_male; ?></span>
                Male
              </li>
              <li class="list-group-item">
                <span class="badge badge-danger"><?php echo $tot_stu_female; ?></span>
                Female
              </li>

            </ul>

          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <span class="label label-info pull-right">Student</span>
            <h5>Degree wise</h5>
          </div>
          <div class="ibox-content" style="padding: 3px !important">
           <ul class="list-group">
            <li class="list-group-item">
              <span class="badge badge-primary"><?php echo $tot_stu_bsc; ?></span>
              Undergraduate
            </li>
            <li class="list-group-item ">
              <span class="badge badge-info"><?php echo $tot_stu_msc; ?></span>
              Graduate
            </li>
            <li class="list-group-item">
              <span class="badge badge-danger"><?php echo $tot_stu_diploma; ?></span>
              Diploma
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
<div style="margin-top: 17%;">
    <button style="background-color:#1a7bb9 !important; color: #fff;" class="cn-button" id="cn-button"><span style=" font-size: 15px; ">Other's  </span><br> <span style=" font-size: 10px; ">Dashboard</span></button>
</div>
<div class="cn-wrapper" id="cn-wrapper" style="margin-top: -21%;">
    <ul>
        <li><a href="<?php echo base_url() ?>student/studentDetails"
         target="_blank"><span>Accounts</span></a></li>
         <li><a href="#"><span>Inventory</a></li>
         <li><a href="<?php echo base_url();?>admin/hrDashboard" ><span>HR</a></li>
         <li><a href="<?php echo base_url();?>library/dashboard"><span>Library</a></li>
         <li><a href="#"><span>Hostel</span></a></li>
         <li><a href="#"><span>Transport</span></a></li>
         <li><a href="#"><span>Payments</span></a></li>
     </ul>
 </div>
 </div>
  

</div>
<div class="clearfix"> </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/plugins/chartJs/Chart.min.js"></script>
<script type="text/javascript">

  /*$(function(){*/
$(document).ready(function () {
    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event

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


    var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July "],
        datasets: [
            {
                label: "Example dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Example dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data: [35, 41, 20, 19, 44, 35, 60]
            }
        ]
    };

    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

    var barData = {
        labels: ["2018", "2017", "2016", "2015", "2014", "2013", "2012"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: [570, 550, 450, 300, 350, 330, 320]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.8)",
                highlightFill: "rgba(26,179,148,0.75)",
                highlightStroke: "rgba(26,179,148,1)",
                data: [330, 320, 280, 210, 230, 190, 200]
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

    var polarData = [
        {
            value: 65,
            color: "#a3e1d4",
            highlight: "#1ab394",
            label: "Pass"
        },
        {
            value: 30,
            color: "#dedede",
            highlight: "#1ab394",
            label: "Fail"
        },
        {
            value: 5,
            color: "#b5b8cf",
            highlight: "#1ab394",
            label: "Absence" 
        }
    ];

    var polarOptions = {
        scaleShowLabelBackdrop: true,
        scaleBackdropColor: "rgba(255,255,255,0.75)",
        scaleBeginAtZero: true,
        scaleBackdropPaddingY: 1,
        scaleBackdropPaddingX: 1,
        scaleShowLine: true,
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,

    };

    var ctx = document.getElementById("polarChart").getContext("2d");
    var myNewChart = new Chart(ctx).PolarArea(polarData, polarOptions);

    var doughnutData = [
        {
            value: 100,
            color: "#a3e1d4",
            highlight: "#1ab394",
            label: "Payable"
        },
        {
            value: 60,
            color: "#dedede",
            highlight: "#1ab394",
            label: "Payment"
        },
        {
            value: 40,
            color: "#b5b8cf",
            highlight: "#1ab394",
            label: "Due"
        }
    ];

    var doughnutOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        percentageInnerCutout: 45, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
    };


    var ctx = document.getElementById("doughnutChart").getContext("2d");
    var myNewChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

 });

</script>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/polyfills.js"></script>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/demo2.js"></script>
