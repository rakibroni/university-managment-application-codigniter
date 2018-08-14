<link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
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
        <?php $notice=$this->db->query("SELECT *
                                                FROM notice
                                                ORDER BY NOTICE_ID DESC
                                                LIMIT 3")->result(); if(!empty($notice)) foreach($notice as $row): ?>
        <a class="openModal" reg=""><?php echo $row->N_TITLE .'. <b>'. date('d-M-y',strtotime($row->START_DATE)).' To '.date('d-M-y',strtotime($row->END_DATE)).'</b>' ?> </a>&nbsp;&nbsp;| &nbsp;
        <?php endforeach; ?>

    </div>
</div><br/>
<!-- <button class="btn btn-primary dim btn-large-dim" type="button"><i class="fa fa-money"></i></button>
<button class="btn btn-warning dim btn-large-dim" type="button"><i class="fa fa-warning"></i></button>
<button class="btn btn-danger  dim btn-large-dim" type="button"><i class="fa fa-heart"></i></button>
<button class="btn btn-primary  dim btn-large-dim" type="button"><i class="fa fa-dollar"></i>6</button>
<button class="btn btn-info  dim btn-large-dim btn-outline" type="button"><i class="fa fa-ruble"></i></button> -->
<div class="wrapper wrapper-content animated fadeIn">

    <div class="p-w-md m-t-sm">
        <div class="row">
            <br>


            <div class="col-lg-4">

            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="col-md-6">
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
                                width: 80px;">Faculty
                            </div>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <span style="color:white"><b>Total :</b> 70 </span>
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

                                    <th>Department</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>CSE</td>
                                    <td> 30</td>
                                </tr>
                                <tr>

                                    <td>BBA</td>
                                    <td> 30</td>
                                </tr>
                                <tr>

                                    <td>EEE</td>
                                    <td>10</td>
                                </tr>
                                </tbody>
                            </table>
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
                                <th width="10%" class="text-center">SAT</th>
                                <th width="10%" class="text-center">SUN</th>
                                <th width="10%" class="text-center">MON</th>
                                <th width="10%" class="text-center">TUE</th>
                                <th width="10%" class="text-center">WED</th>
                                <th width="10%" class="text-center">THU</th>
                                <th width="10%" class="text-center">FRI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="background-color:">Computer fundamental</td>
                                <td style="background-color:lightgoldenrodyellow"><span style="font-size: 9px">9:00 am - 10:00 am  <br>Room : 201</span>
                                </td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>

                            </tr>
                            <tr>
                                <td style="background-color:">Math</td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:lightgoldenrodyellow"><span style="font-size: 9px">9:00 am - 10:00 am  <br>Room : 201</span>
                                </td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>

                            </tr>
                            <tr>
                                <td style="background-color:">Electronics</td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:lightgoldenrodyellow"><span style="font-size: 9px">9:00 am - 10:00 am  <br>Room : 201</span>
                                </td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>

                            </tr>
                            <tr>
                                <td style="background-color:">English</td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:"></td>
                                <td style="background-color:lightgoldenrodyellow"><span style="font-size: 9px">9:00 am - 10:00 am  <br>Room : 201</span>
                                </td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
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
                            ">Student
                        </div>
                        <div class="ibox-tools ">
                            <a class="collapse-link">
                                <span style="color:white"> <b>Total:</b></span><span style="color:white"> 550</span>
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

                                <th>Department</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td>CSE</td>
                                <td> 300</td>
                            </tr>
                            <tr>

                                <td>BBA</td>
                                <td> 150</td>
                            </tr>
                            <tr>

                                <td>EEE</td>
                                <td>100</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ibox float-e-margins border-bottom">
                    <div class="ibox-title bg-chg">
                        <h5>Parents</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <span class="fees_pays" style="color:"><b>Total :</b> 500</span>
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
                <br><br><br>
                <button class="cn-button" id="cn-button">Open</button>
                <div class="cn-wrapper" id="cn-wrapper">
                    <ul>
                        <li><a href="<?php echo base_url() ?>student/stuProfile"
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
    $(".openModal").on('click', function () {

    });
</script>


