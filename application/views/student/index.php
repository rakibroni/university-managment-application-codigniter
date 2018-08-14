<link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet'
media='print'>
<link href="<?php echo base_url(); ?>assets/css/plugins/contextMenu/jquery-ui.css" type="text/css" rel='stylesheet'>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/CircularNavigation/css/component2.css"/>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/modernizr-2.6.2.min.js"></script>

<style type="text/css">
.bg-chg {
    transition: background-color ease-in-out .5s
}

.bg-chg:hover {
    background-color: #1AB394
}

.marquee {

    overflow: hidden;
    border: 1px solid #ccc;
    color: blue;
}

.notice_marquee {

    overflow: hidden;
    border: 1px solid #ccc;

}

a.two:link {
    color: #ff0000;
}

a.two:visited {
    color: #0000ff;
}

a.two:hover {
    text-decoration: underline;
    font-size: 110%;
}
</style>
<div class="row">
    <div class="ibox-title marquee">
        <a reg="">Fall - 2015 Registration Last date on 20-Oct-2015</a>&nbsp;&nbsp;| &nbsp;
        <a reg="">Summer - 2015 Registration Last date on 20-Jan-2015</a>&nbsp;&nbsp; | &nbsp;
        <a reg="">Spring - 2015 Registration Last date on 20-Aug-2015</a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">

    <div class="p-w-md m-t-sm">

        <div class="row">
            <br>

            <div class="col-lg-8">
                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title bg-chg" style="background-color: #18A689 !important ;">
                            <h5></h5>

                            <div style="  background: #3399FF;
                            border: 1px solid rgba(0, 0, 0, 0.2);
                            border-radius: 250px;

                            color: white;
                            float: left;
                            height: 80px;
                            line-height: 73px;
                            margin-top: -34px;
                            text-align: center;
                            width: 80px;
                            ">Attendance
                        </div>
                        <div class="ibox-tools ">
                            <a class="collapse-link">
                                <span style="color:white"> <b>Average Present:</b></span><span style="color:white"> 60%</span>
                            </a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="display:none">
                        <div class="">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="clients.html#tab-7" data-toggle="tab"
                                  aria-expanded="true"><i class="fa fa-envelope"></i>
                              Details</a></li>
                              <li class="spk"><a href="clients.html#tab-8" data-toggle="tab"
                                 aria-expanded="false"><i class="fa fa-eye"></i> Statistics </a>
                             </li>

                         </ul>
                         <div class="tab-content">
                            <div style="height: 200px;" class="tab-pane active" id="tab-7">

                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>Courses</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <small>Computer Science and engineering</small>
                                            </td>
                                            <td class="text-navy"> 60%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small>English</small>
                                            </td>
                                            <td class="text-navy"> 60%</td>
                                        </tr>


                                    </tbody>
                                </table>

                            </div>
                            <div style="height: 200px;" class="tab-pane" id="tab-8">
                                <div class="flot-chart">
                                    <div class="flot-chart-pie-content" id="flot-pie-chart"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-chg" style="background-color: #18A689 !important ;">
                    <div style="  background: orange none repeat scroll 0 0;
                    border: 1px solid rgba(0, 0, 0, 0.2);
                    border-radius: 250px;

                    color: white;
                    float: left;
                    height: 80px;
                    line-height: 73px;
                    margin-top: -34px;
                    text-align: center;
                    width: 80px;">Result
                </div>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <span style="color:white"><b>CGPA :</b> 3.48 </span>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display:none">
                <div class="">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="clients.html#tab-3" data-toggle="tab"
                          aria-expanded="true"><i class="fa fa-envelope"></i>
                      Details</a></li>
                      <li class=""><a href="clients.html#tab-4" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-eye"></i> Statistics </a></li>

                    </ul>
                    <div class="tab-content">
                        <div style="height: 200px;" class="tab-pane active" id="tab-3">


                            <table class="table table-hover no-margins">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>CGPA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <small>Fall - 2015</small>
                                        </td>
                                        <td><a title="Semester Result Details" class="pointer openModal two"
                                         data-action="student/reportSemResultDetails">4.00</a></td>
                                     </tr>
                                     <tr>
                                        <td>
                                            <small>Summer - 2015</small>
                                        </td>
                                        <td>3.22</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <small>Spring - 2015</small>
                                        </td>
                                        <td>3.21</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div style="height: 200px;" class="tab-pane" id="tab-4">

                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-bar-chart"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <h4>Class Schedule</h4>

        <div id="weekly_sch">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="30%" class="text-center">Subject</th>
                        <?php if(!empty($days)): foreach($days as $row): 
                        $days_abbr []=$row->ABBR;
                        ?>
                        <th width="10%" class="text-center"><?php echo $row->DAY_NAME ?></th>
                    <?php endforeach;endif; ?>

                </tr>
            </thead>
            <tbody>
                <?php if(!empty($registered_courses)):  foreach($registered_courses as $row): ?>
                    <tr>
                        <td><?php echo $row->COURSE_TITLE ?></td>
                        <?php  
                        foreach($days_abbr as $key=>$value):
                            $bc='';  
                            $class_schedule= $this->course_model->getStudentClassSchedule($student_info_data->PROGRAM_ID,$student_info_data->BATCH_ID,$student_info_data->SECTION_ID,$session_id,$row->COURSE_ID,$value);  
                             if(!empty($class_schedule)): $bc='lightgoldenrodyellow';endif;
                            ?>

                            <td style="background-color:<?php echo $bc; ?>">
                               <?php  
                                //backgroud color 
                               if(!empty($class_schedule)): 
                                ?>
                                <b><span style="font-size: 9px;"><?php echo  date("H:i", strtotime($class_schedule->START_TIME)) .' - ' . date("H:i", strtotime($class_schedule->END_TIME)) ;?>  <br>Room : <?php echo $class_schedule->ROOM_NO; ?><br><?php echo $class_schedule->SHORT_NAME; ?></span></b>
                            </td>
                        <?php endif; endforeach; ?> 

                    </tr>
                <?php endforeach;endif; ?>

            </tbody>
        </table>
    </div>
</div>
<br>


<br>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>University Activity</h5>

        <div class="ibox-tools">
            <a class="collapse-link binded">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#">Config option 1</a>
                </li>
                <li><a href="#">Config option 2</a>
                </li>
            </ul>
            <a class="close-link binded">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div style="padding-top:0px;" class="ibox-content ibox-heading">
        <h3><strong style="color:#A80000 ">You have debate today!</strong></h3>
        <small><i class="fa fa-map-marker"></i> Debate is on 6:00am. Check your schedule to see detail.
        </small>
    </div>
    <div class="ibox-content inspinia-timeline">


        <div class="timeline-item">
            <div class="row">
                <div class="col-xs-3 date">
                    <i class="fa fa-diamond"></i>
                    11:00 am
                    <br>
                    <small class="text-navy">21 hour ago</small>
                </div>
                <div class="col-xs-7 content">
                    <p class="m-b-xs"><strong>Debate Program</strong></p>

                    <p>
                        Elite's Debate Program is designed to teach students basic debate skills.
                    </p>
                </div>
            </div>

        </div>


    </div>
</div>

</div>
<div class="col-lg-4">
    <div class="ibox float-e-margins border-bottom">
        <div class="ibox-title bg-chg" style="background-color: #18A689 !important ;">
            <div style="  background: #04CF64;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 250px;

            color: white;
            float: left;
            height: 80px;
            line-height: 73px;
            margin-top: -34px;
            text-align: center;
            width: 80px;">Schedule
        </div>

        <div class="ibox-tools">
            <a class="collapse-link">
                <span style="color:white"><b>Next Exam : </b></span> <span style="color:white">19-Oct-2015 </span>
            </a>
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="display:none">
        <table class="table table-hover no-margins">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Subject</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <small>19-Oct-2015</small>
                    </td>
                    <td>Bangla</td>
                    <td><i class="fa fa-clock-o"></i> 11:20am</td>
                </tr>
                <tr>
                    <td>
                        <small>19-Oct-2015</small>
                    </td>
                    <td>Math</td>
                    <td><i class="fa fa-clock-o"></i> 11:20am</td>
                </tr>
                <tr>
                    <td><span class="label label-warning">Canceled</span></td>
                    <td>English</td>
                    <td><i class="fa fa-clock-o"></i> 11:20am</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="ibox float-e-margins border-bottom">
    <div class="ibox-title bg-chg">
        <h5>Fees & Payment</h5>

        <div class="ibox-tools">
            <a class="collapse-link">
                <span class="fees_pays" style="color:red"><b>Due :</b> 0.00</span>
            </a>
            <a class="collapse-link fees_pays">
                <i class="fa fa-chevron-down"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="display:none">
        <div class="ibox float-e-margins border-bottom" style="border-style: none !important;">
            <span id="f_p"></span>
        </div>
    </div>
</div>

<div class="ibox float-e-margins border-bottom">
    <div class="ibox-title bg-chg">
        <h5>Class Schedule</h5>

        <div class="ibox-tools">
            <a class="collapse-link reload">
                <span style="color:green"><b>Next Class: </b></span><span style="color:black">20-Oct-2015</span>
            </a>
            <a class="collapse-link reload">
                <i class="fa fa-chevron-down"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="display:none">

        <div class="calendar"></div>
        <a href="<?php echo base_url(); ?>student/calendar" target="_blank"
         class="pull-right">Details</a>
     </div>
 </div>


 <div class="ibox float-e-margins border-bottom">
    <div class="ibox-title bg-chg">
        <h5>Library Details</h5>

        <div class="ibox-tools">
            <a class="collapse-link">
                <span style="color:red"><b>Borrowed Books :</b> 2</span>
            </a>
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="display:none">
        <div class="ibox float-e-margins border-bottom" style="border-style: none !important;">

            <p class=""><b>Fine Amount :</b> <span class="  pull-right">10,00.00</p>

                <p class=""><b>Due Amount :</b> <span class="  pull-right">500.00</span></p>

                <p class=""><b>Balanced :</b> <span class="  pull-right">500.00</span></p>

                <p class=""><b></b> <a title="Library Details" class="pointer openModal two pull-right"
                 data-action="student/libraryDetials">Details</a></p>
             </div>
         </div>
     </div>
     <div class="ibox float-e-margins">
        <div class="ibox-title bg-chg">
            <h5>Course</h5>

            <div class="ibox-tools">
                <a class="collapse-link">
                    <span class="text-success"><b>Total Credit :</b> 150</span>
                </a>
                <a class="collapse-link">
                    <i class="fa fa-chevron-down"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content" style="display:none">
            <div class="">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="clients.html#tab-5" data-toggle="tab"
                      aria-expanded="true"><i class="fa fa-envelope"></i> Details</a>
                  </li>
                  <li class=""><a href="clients.html#tab-6" data-toggle="tab" aria-expanded="false"><i
                    class="fa fa-eye"></i> Statistics </a></li>

                </ul>
                <div class="tab-content">
                    <div style="height: 200px;" class="tab-pane active" id="tab-5">

                        <p class="text-success"><b>Total Earned Credit :</b> <span
                            class="  pull-right">50</span></p>

                            <p class=""><b>Due Credit :</b> <span class="  pull-right">100</span></p>

                            <p class="text-info"><b>CGPA :</b> <span class="  pull-right">3.48</span></p>

                        </div>
                        <div style="height: 200px;" class="tab-pane" id="tab-6">

                            <table style="position:absolute;right:20px;;font-size:smaller;color:#545454">
                                <tbody>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div
                                                style="width:4px;height:0;border:5px solid #1AB394;overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel">Completed : 45</td>
                                    </tr>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div
                                                style="width:4px;height:0;border:5px solid #D34331;overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel">Incomplete : 40</td>
                                    </tr>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div
                                                style="width:4px;height:0;border:5px solid #F8AC59;overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel">Enrolled : 15</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span id="sparkline77">

                                <canvas
                                style="display: inline-block; width: 150px; height: 150px; vertical-align: top;"
                                width="150" height="150"></canvas>
                            </span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins border-bottom">
            <div class="ibox-title bg-chg">
                <h5>Assignment</h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <span style="color:#1C84C6"><b>Todays :</b></span><span style="color:#1C84C6"> 3</span>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display:none">
                <ul class="todo-list m-t small-list">
                    <li>
                        <a class="check-link" href="#"><i class="fa fa-check-square"></i> </a>
                        <span class="m-l-xs todo-completed">Programming C lab</span>
                    </li>
                    <li>
                        <a class="check-link" href="#"><i class="fa fa-square-o"></i> </a>
                        <span class="m-l-xs">Data structure lab.</span>
                    </li>
                    <li>
                        <a class="check-link" href="#"><i class="fa fa-square-o"></i> </a>
                        <span class="m-l-xs">Algorithom </span>
                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                    </li>
                    <li>
                        <a class="check-link" href="#"><i class="fa fa-square-o"></i> </a>
                        <span class="m-l-xs">Discrete mathematics and its applications </span>
                    </li>
                    <li>
                        <a class="check-link" href="#"><i class="fa fa-check-square"></i> </a>
                        <span class="m-l-xs todo-completed">Artificial intelligence</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="ibox float-e-margins border-bottom">
            <div class="ibox-title bg-chg">
                <h5>Industrial Training</h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <span style="color:green"><b>Files :</b> <i class="fa fa-file-pdf-o"></i> </span>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display:none">
                <table class="table table-hover no-margins">
                    <thead>
                        <tr>
                            <th>Attachment</th>
                            <th>Uploaded Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <small><a href="">Data Processing</a></small>
                            </td>
                            <td>15-Oct-2015 &nbsp;&nbsp;1:45 PM</td>
                        </tr>
                        <tr>
                            <td>
                                <small><a href="">Image Processing</a></small>
                            </td>
                            <td>18-Oct-2015 &nbsp;&nbsp;1:45 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ibox float-e-margins border-bottom">
            <div class="ibox-title bg-chg">
                <h5>Industrial Attachment</h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <span style="color:green"><b>Files :</b> <i class="fa fa-file-pdf-o"></i> </span>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display:none">
                <table class="table table-hover no-margins">
                    <thead>
                        <tr>
                            <th>Attachment</th>
                            <th>Uploaded Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <small><a href="">Data Processing</a></small>
                            </td>
                            <td>15-Oct-2015 &nbsp;&nbsp;1:45 PM</td>
                        </tr>
                        <tr>
                            <td>
                                <small><a href="">Image Processing</a></small>
                            </td>
                            <td>18-Oct-2015 &nbsp;&nbsp;1:45 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title bg-chg">
                <h5>Announcements</h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <span class="notice_marque_fn text-success"><b>Todays :</b></span><span
                        style="color:#23C6C8"> 2</span>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display:none">
                <div class="clients-list">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="clients.html#tab-33" data-toggle="tab" aria-expanded="true"><i
                            class="fa fa-envelope"></i> News</a></li>
                            <li class=""><a href="clients.html#tab-34" data-toggle="tab" aria-expanded="false"><i
                                class="fa fa-eye"></i> Events</a></li>
                                <li class=""><a class="notice_marquee_fn" href="clients.html#tab-5" data-toggle="tab"
                                    aria-expanded="false"><i class="fa fa-clipboard"></i> Notice</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div style="height: 200px;" class="tab-pane active" id="tab-33">
                                        <div class="slimScrollDiv"
                                        style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                        <div class="full-height-scroll"
                                        style="overflow: hidden; width: auto; height: 100%;">
                                        <div class="table-responsive notice_marquee">
                                            <ul class="sortable-list connectList agile-list ui-sortable ">
                                                <li class="warning-element">
                                                    Classes and all offices of the Khwaja Yunus Ali university will
                                                    remain closed on & from 21 October to 26 October 2015 on account
                                                    of Durgapuja, Ashura & Laxmipuja.
                                                    <div class="agile-detail">
                                                        <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                                                        <i class="fa fa-clock-o"></i>2015-10-14
                                                    </div>
                                                </li>
                                                <li class="success-element">
                                                    Many desktop publishing packages and web page editors now use
                                                    Lorem Ipsum as their default.
                                                    <div class="agile-detail">
                                                        <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="slimScrollBar"
                                    style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 48.4848px;">

                                </div>
                                <div class="slimScrollRail"
                                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">
                            </div>
                        </div>
                    </div>
                    <div style="height: 200px;" class="tab-pane" id="tab-34">
                        <div class="slimScrollDiv"
                        style="position: relative; overflow: hidden; width: auto; height: 100%;">
                        <div class="full-height-scroll"
                        style="overflow: hidden; width: auto; height: 100%;">
                        <div class="table-responsive ">
                            <ul class="sortable-list connectList agile-list ui-sortable">
                                <p><strong><a href="#" target="_blank"> May Day on 1 May,
                                2015</a></strong></p>

                                <p><strong><a href="#" target="_blank">Buddha Purnima on 4 May,
                                2015 </a></strong></p>

                                <hr>

                            </ul>
                        </div>
                    </div>
                    <div class="slimScrollBar"
                    style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                    <div class="slimScrollRail"
                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">
                </div>
            </div>
        </div>
        <div style="height: 200px;" class="tab-pane notice_marquee" id="tab-5">
            <div class="slimScrollDiv "
            style="position: relative; overflow: hidden; width: auto; height: 100%;">
            <div class="full-height-scroll "
            style="overflow: hidden; width: auto; height: 100%;">
            <div class="table-responsive ">
                <ul class="sortable-list connectList agile-list ui-sortable ">
                    <li class="warning-element">

                        During the upcoming Holy month of ramadan, the office time of
                        KYAU will be from 9:00 AM to 3.30 PM with a break of half an
                        hour from 1.00 to 1.30 PM for Zohor prayer.
                        <div class="agile-detail">
                            <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                            <i class="fa fa-clock-o"></i>2015-06-15
                        </div>
                    </li>
                    <li class="success-element">

                        Classes and alt the officers of the Khwaja Yunus Ali University
                        remain closed from 13 July 2015 to 22 July 2015 on account of
                        Shabe Quader, Jumatul bida & Eid-ul-Fitre. Eid Mubarak! The
                        University reopens on Thursday, the 23 July 2015 at 09.00 hours.
                        All concerned are requested to resume their duties possibility
                        on time
                        <div class="agile-detail">
                            <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                            <i class="fa fa-clock-o"></i> 2015-07-08
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="slimScrollBar"
        style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 48.4848px;"></div>
        <div class="slimScrollRail"
        style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
    </div>
</div>
</div>
</div>
</div>
</div>
<br><br>
<!--testing-->

<button class="cn-button" id="cn-button">Open</button>
<div class="cn-wrapper" id="cn-wrapper">
    <ul>
        <li><a href="<?php echo base_url() ?>student/studentDetails"
         target="_blank"><span>Profile</span></a></li>
         <li><a href="#"><span style="font-size: 9px">Industrial <br> Attachment</span></a></li>
         <li><a href="#"><span style="font-size: 9px">Industrial <br> Training</span></a></li>
         <li><a href="#"><span>CGPA : 3.48</span></a></li>
         <li><a href="#"><span>Plugins</span></a></li>
         <li><a href="#"><span>Contact</span></a></li>
         <li><a href="#"><span>Follow</span></a></li>
     </ul>
 </div>
</div>
</div>
</div>
</div>


<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.marquee.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/demo/sparkline-demo.js"></script>

<!-- Flot -->
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.pie.js"></script>


<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/polyfills.js"></script>
<script src="<?php echo base_url(); ?>assets/CircularNavigation/js/demo2.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        var barOptions = {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.8
                        }, {
                            opacity: 0.8
                        }]
                    }
                }
            },
            xaxis: {
                min: 0,
                max: 7,
                mode: null,
                ticks: [
                [1, "1"],
                [2, "2"],
                [3, "3"],
                [4, "4"],
                [5, "5"],
                [6, "6"]

                ],
                tickLength: 0,
                axisLabel: "Sem",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                axisLabelPadding: 5
            },
            colors: ["#1ab394"],
            grid: {
                color: "#999999",
                hoverable: true,
                clickable: true,
                tickColor: "#D4D4D4",
                borderWidth: 0
            },
            legend: {
                show: false
            },
            tooltip: true,
            tooltipOpts: {
                content: "x: %x, y: %y"
            }
        };
        var barData = {
            label: "bar",
            data: [
            [1, 3.5],
            [2, 3.15],
            [3, 3.00],
            [4, 3.75],
            [5, 3.5],
            [6, 3.75]
            ]
        };
        $.plot($("#flot-bar-chart"), [barData], barOptions);


        var data = [{

            label: "Absence",
            data: 15,
            color: "#FF0000",
        }, {
            label: "Present",
            data: 52,
            color: "#058000",
        }];

        var plotObj = $.plot($("#flot-pie-chart"), data, {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        });

        /*!
         * Pause jQuery plugin v0.1
         *
         * Copyright 2010 by Tobia Conforto <tobia.conforto@gmail.com>
         *
         * Based on Pause-resume-animation jQuery plugin by Joe Weitzel
         *
         * This program is free software; you can redistribute it and/or modify it
         * under the terms of the GNU General Public License as published by the Free
         * Software Foundation; either version 2 of the License, or(at your option)
         * any later version.
         *
         * This program is distributed in the hope that it will be useful, but WITHOUT
         * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
         * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
         * more details.
         *
         * You should have received a copy of the GNU General Public License along with
         * this program; if not, write to the Free Software Foundation, Inc., 51
         * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
         */
        /* Changelog:
         *
         * 0.1    2010-06-13  Initial release
         */
         (function () {
            var $ = jQuery,
            pauseId = 'jQuery.pause',
            uuid = 1,
            oldAnimate = $.fn.animate,
            anims = {};

            function now() {
                return new Date().getTime();
            }

            $.fn.animate = function (prop, speed, easing, callback) {
                var optall = $.speed(speed, easing, callback);
                optall.complete = optall.old; // unwrap callback
                return this.each(function () {
                    // check pauseId
                    if (!this[pauseId])
                        this[pauseId] = uuid++;
                    // start animation
                    var opt = $.extend({}, optall);
                    oldAnimate.apply($(this), [prop, $.extend({}, opt)]);
                    // store data
                    anims[this[pauseId]] = {
                        run: true,
                        prop: prop,
                        opt: opt,
                        start: now(),
                        done: 0
                    };
                });
            };

            $.fn.pause = function () {
                return this.each(function () {
                    // check pauseId
                    if (!this[pauseId])
                        this[pauseId] = uuid++;
                    // fetch data
                    var data = anims[this[pauseId]];
                    if (data && data.run) {
                        data.done += now() - data.start;
                        if (data.done > data.opt.duration) {
                            // remove stale entry
                            delete anims[this[pauseId]];
                        } else {
                            // pause animation
                            $(this).stop();
                            data.run = false;
                        }
                    }
                });
            };

            $.fn.resume = function () {
                return this.each(function () {
                    // check pauseId
                    if (!this[pauseId])
                        this[pauseId] = uuid++;
                    // fetch data
                    var data = anims[this[pauseId]];
                    if (data && !data.run) {
                        // resume animation
                        data.opt.duration -= data.done;
                        data.done = 0;
                        data.run = true;
                        data.start = now();
                        oldAnimate.apply($(this), [data.prop, $.extend({}, data.opt)]);
                    }
                });
            };
        })();

        $('.marquee').marquee({
            direction: 'left',
            duration: 15000,
            pauseOnHover: true,
            allowCss3Support: false
        });
        $(document).on('click', '.notice_marque_fn', function () {
            $('.notice_marquee').marquee({
                delayBeforeStart: 0,
                direction: 'up',
                duration: 10000,
                pauseOnHover: true,
                allowCss3Support: false,
                duplicated: true
            });
        });

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });

    });

</script>

<script>

    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function () {
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });
        /* initialize the calendar
        -----------------------------------------------------------------*/

        $(document).on('click', '.reload', function () {
            $('.calendar').fullCalendar({
                theme: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                defaultDate: Date.now(),
                defaultView: 'month',
                eventTextColor: '#000',
                yearColumns: 4,
                firstDay: 0,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar

                events: '<?php echo site_url('student/calendarEvents'); ?>',
                eventClick: function (event) {
                    $(".commonModal").modal();
                    var action_uri = 'student/eventInfo';
                    var param_value = event.id;
                    var action_type = 'edit';
                    var title = 'Class Schedule';

                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url(); ?>/" + action_uri,
                        data: {param: param_value},
                        beforeSend: function () {
                            $(".commonModal .modal-title").html(title);
                            $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {

                            $(".commonModal .modal-body").html(data);
                        }
                    });

                }
            });
        });
    });

    $(document).on('click', '.fees_pays', function () {
        $.ajax({
            url: '<?php echo base_url(); ?>student/fee_report',
            success: function (data) {
                $('#f_p').html(data);
            }
        });
    });

</script>


