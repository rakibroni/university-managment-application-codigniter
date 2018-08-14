<link href="<?php echo base_url(); ?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<style type="text/css">
    #scroll-box-div.affix {
        position: fixed;
        top: 0;
        width: 40%;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
<div class=" ">
    <form class="form-horizontal" id="frmSchedule" action="<?php echo base_url('admin/saveClassSch'); ?>" method="post">
        <div class="col-md-6">
            <div class="ibox-title">
                <h5><i class="fa fa-calendar"></i> Scheduler </h5>
            </div>
            <div class="ibox-content">
                <span class="frmMsg"></span>
                <?php $this->load->view("common/faculty_dept_program"); ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Course <span class="text-danger">*</span></label>

                    <div class="col-lg-7">
                        <select class="select2DropdownAjax form-control" name="COURSE_ID" id="COURSE_ID"
                                data-action="<?php echo base_url('common/getCourseList') ?>" data-tags="true"
                                data-placeholder="Select Course" data-allow-clear="true">
                            <option>Select Course</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <input value="<?php echo $session->SESSION_ID ?>" name="SESSION_ID" id="SESSION_ID" type="hidden">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Date Range <span class="text-danger">*</span></label>

                    <div class="col-lg-7">
                        <input class="form-control required" type="text" name="daterange" id="daterange"
                               placeholder="Select A Daterange"/>

                        <div class="form-control-message"></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Start Time</label>

                    <div class="col-lg-8">
                        <div class="input-group col-lg-3 clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="START_TIME" id="START_TIME" value="">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                        <div class="form-control-message"></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">End Time</label>

                    <div class="col-lg-8">
                        <div class="input-group col-lg-3 clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="END_TIME" id="END_TIME" value="">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                        <div class="form-control-message"></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Room</label>

                    <div class="col-lg-7">
                        <select class="select2Dropdown form-control" name="ROOM_ID" id="ROOM_ID" data-tags="true"
                                data-placeholder="Select Room" data-allow-clear="true">
                            <option>Select Room</option>
                            <?php foreach ($rooms as $row): ?>
                                <option value="<?php echo $row->BR_ID; ?>"><?php echo $row->BR_NAME; ?>
                                    <div>Room No: <?php echo $row->BR_CODE; ?></div>
                                    <div>Type: <?php echo $row->BR_TYPE_NAME; ?></div>
                                    <div>Total Capacity: <?php echo $row->CAPACITY; ?></div>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div id="room_sc_details"></div>
                    </div>
                    <span class="loading_img"></span>
                    <br clear="left"/>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Week Day <span class="text-danger">*</span></label>

                    <div class="col-lg-8" id="week_days">
                        <?php $this->load->view("common/week_days"); ?>
                        <div class="form-control-message"></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Moderator/Teacher <span class="text-danger">*</span></label>

                    <div class="col-lg-8">
                        <select class="select2Dropdown form-control" name="MODERATOR_ID" id="MODERATOR_ID"
                                data-tags="true" data-placeholder="Select Moderator" data-allow-clear="true">
                            <option>Select Teacher</option>
                            <?php foreach ($teachers as $row): ?>
                                <option value="<?php echo $row->USER_ID ?>"><?php echo $row->FULL_NAME ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div>
                            <span id="moderator_schedulte"></span>&nbsp;&nbsp;<span
                                id="moderator_schedulte_view"></span>
                        </div>
                    </div>
                    <span class="loading_img"></span>
                    <br clear="left"/>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label"></label>

                    <div class="col-lg-8">
                        <div class="checkbox checkbox-success">
                            <input id="txtEmailModerator" type="checkbox" name="txtEmailModerator"/>
                            <label for="txtEmailModerator"><strong>Send Eamil Notification To
                                    Moderator?</strong></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label"></label>

                    <div class="col-lg-8">
                        <div class="checkbox checkbox-success">
                            <input id="txtSmsModerator" type="checkbox" name="txtSmsModerator"/>
                            <label for="txtSmsModerator"><strong>Send SMS Notification To Moderator?</strong><br/>
                                <small>( SMS will be sent before 15 minutes of class )</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Semester</label>

                    <div class="col-lg-7">
                        <select class="select2Dropdown form-control" multiple="multiple" name="SEMESTER_ID"
                                id="SEMESTER_ID" data-tags="true" data-placeholder="Select Semester"
                                data-allow-clear="true">
                            <option>Select Semester</option>
                            <?php foreach ($semester as $row): ?>
                                <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="BATCH_ID">Batch</label>

                    <div class="col-lg-7">
                        <select class="select2Dropdown form-control" multiple="multiple" name="BATCH_ID" id="BATCH_ID"
                                data-tags="true" data-placeholder="Select Batch" data-allow-clear="true">
                            <option>Select Batch</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-lg-4 control-label" for="checkboxActive"></label>

                    <div class="col-lg-5">
                        <div class="checkbox checkbox-success">
                            <input id="checkboxActive" type="checkbox" name="checkboxActive"/>
                            <label for="checkboxActive"><strong>Publish</strong>
                            </label>
                        </div>
                        <label class="control-label">
                            <div class="checkbox checkbox-success">
                                <input id="checkboxActive" type="checkbox"/>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-lg-offset-4 col-lg-10">
                        <span class="modal_msg pull-left"></span>
                        <input type="submit" class="btn btn-primary btn-sm" value="submit">
                        <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        <span class="loadingImg"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="scroll-box-div">
                <div id="scroll-box-di">
                    <div class="ibox-title">
                        <h5><i class="fa fa-calendar"></i> Viewer </h5>
                    </div>
                    <div class="ibox-content" id="schedule_view"></div>
                </div>
                <!-- navbar -->
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
</div>
<!-- Clockpicker -->
<!-- Date range use moment.js same as full calendar plugin -->
<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/moment.min.js"></script>
<!-- Date range picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $(document).ready(function () {
        // Some Generic Libraries used, are initialized in js_lib.php file located in admin/common/

        $('#scroll-box-div').affix();
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        // Schedule daterange picker
        $('input[name="daterange"]').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2015',
            maxDate: '12/31/2016',
            dateLimit: {days: 60},
            showDropdowns: true,
            showWeekNumbers: true,
            ranges: {
                'Today': [moment(), moment()],
                'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
                'Next 7 Days': [moment().add(0, 'days'), moment().add(6, 'days')],
                'Next 30 Days': [moment().add(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'This Year': [moment(), moment().endOf('year')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-xs'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Select Date',
                cancelLabel: 'Close',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Select Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 6
            }
        }, function (start, end, label) {
            //console.log(start.toISOString(), end.toISOString(), label);
            $('input[name="daterange"]').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        // getting Batch By Semester
        $(document).on('change', '#SEMESTER_ID', function () {
            $('#BATCH_ID').html("");
            var FACULTY_ID = $(".faculty_dropdown").val();
            var DEPT_ID = $(".dept_dropdown").val();
            var PROGRAM_ID = $(".program_dropdown").val();
            var SESSION_ID = $("#SESSION_ID").val();
            var SEMESTER_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>common/getBatchBySemester',
                data: {
                    FACULTY_ID: FACULTY_ID,
                    DEPT_ID: DEPT_ID,
                    PROGRAM_ID: PROGRAM_ID,
                    SEMESTER_ID: SEMESTER_ID,
                    SESSION_ID: SESSION_ID
                },
                beforeSend: function () {
                    $("#BATCH_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $('#BATCH_ID').html(data);
                }
            });
        });

        // checking room schedule
        $(document).on('change', '#ROOM_ID', function () {
            var all_ok = 0;
            $('.required').each(function () {
                $(this).keyup(function () {
                    $(this).css("border", "1px solid #ccc");
                });
                if ($(this).val() == "") {
                    var label = $(this).parents(".form-group").find("label").text();
                    $(this).parents(".form-group").find(".form-control-message").html(label + " is required").addClass("text-danger");
                    $(this).css("border", "1px solid red");
                    all_ok = 1;
                } else {
                    $(this).parents(".form-group").find(".form-control-message").html("").removeClass("text-danger");
                    $(this).css("border", "1px solid #ccc");
                }
            });
            //  if (!$('input.week_day_dr_down[type="checkbox"]').is(':checked')) {
            //  //$('.week_day_dr_down:checkbox').each(function () {
            //      //if ($(this).is(':checked')) {
            //            $(this).parents(".form-group").find(".form-control-message").html("").removeClass("text-danger");
            //            all_ok = 0;
            //        }else{
            //          $(this).parents(".form-group").find(".form-control-message").html("Minimum One Week Day is required").addClass("text-danger");
            //          $(this).css("border", "1px solid red");
            //          all_ok = 1;
            //      }
            // // });
            if (all_ok == 0) {
                var frmSchedule = $("#frmSchedule").serialize();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin/viewRoomSchedule',
                    data: frmSchedule,
                    // beforeSend: function () {
                    //     $(".loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:12px;' />");
                    // },
                    success: function (data) {
                        $(".loading_img").html("");
                        $('#schedule_view').html(data);
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin/checkRoomSchedule',
                    data: frmSchedule,
                    beforeSend: function () {
                        $(".loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:12px;' />");
                    },
                    success: function (data) {
                        $(".loading_img").html("");
                        $('#week_days').html(data);
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin/roomDetails',
                    data: frmSchedule,
                    beforeSend: function () {
                        $(".loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:12px;' />");
                    },
                    success: function (data) {
                        $(".loading_img").html("");
                        $('#room_sc_details').html(data);
                    }
                });

            } else {
                return false;
            }
        });
        // checking modarator schedule
        $(document).on('change', '#MODERATOR_ID', function () {
            var frmSchedule = $("#frmSchedule").serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>admin/moderatorSchedule',
                data: frmSchedule,
                beforeSend: function () {
                    $("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $('#moderator_schedulte').html(data);
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>admin/moderatorScheduleView',
                data: frmSchedule,
                beforeSend: function () {
                    $("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $('#moderator_schedulte_view').html(data);
                }
            });
        });
        // checking room schedule
        $(document).on('change', '#COURSE_ID', function () {

            var data = $(this).attr("data-action");
            var c_id = $(this).val();
            var session = $("#SESSION_ID").val();
            if (c_id  != null) {
                var frmSchedule = $("#frmSchedule").serialize();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin/courseSchedule',
                    data: {COURSE_ID : c_id, SESSION_ID : session},
                    success: function (data) {
                        $(".loading_img").html("");
                        $('#schedule_view').html(data);
                    }
                });                
            } else {
                return false;
            }
        });
    });
</script>