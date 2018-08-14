<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<!-- Sparkline demo data  -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/chartJs/sparkline-demo.js"></script>
<!-- ChartJS-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chartJs/Chart.min.js"></script>
<div class="wrapper wrapper-content">

    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Current session</span>
                <h5>Applicants</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-xs-3">
                        <small class="stats-label">Total</small>
                        <h4><?php echo $applicantAll; ?></h4>
                    </div>
                    <div class="col-xs-3">
                        <small class="stats-label">Male</small>
                        <h4><?php echo $applicantMale; ?></h4>
                    </div>
                    <div class="col-xs-3">
                        <small class="stats-label">Female</small>
                        <h4><?php echo $applicantFemale; ?></h4>
                    </div>
                    <div class="col-xs-3">
                        <small class="stats-label">Status</small>
                        <h4 class="font-bold text-navy">50% <i class="fa fa-level-up"></i></h4>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Total</span>
                <h5>Students</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-xs-3">
                        <small class="stats-label">Total</small>
                        <h4><?php echo $studentAll; ?></h4>
                    </div>
                    <div class="col-xs-3">
                        <small class="stats-label">Male</small>
                        <h4><?php echo $studentMale; ?></h4>
                    </div>
                    <div class="col-xs-3">
                        <small class="stats-label">Female</small>
                        <h4><?php echo $studentFemale; ?></h4>
                    </div>
                    <div class="col-xs-3">
                        <small class="stats-label">Status</small>
                        <h4 class="font-bold text-info">80% <i class="fa fa-level-up"></i></h4>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Total</span>
                <h5>Teachers</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $teacher; ?></h1>
                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                <small>Total Teachers</small>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Academic Calendar </h5>
            </div>
            <div class="ibox-content" id="containers" style="overflow-y: auto;">
                <div id="calendar">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="fa fa-user fa-2x pull-left"></span><h5>Admission Status</h5>
                <div class="ibox-tools">
                    <a class="" id="loading-example-btn">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display: block;">
                <div>
                    <h1 class="m-b-xs">10,992</h1>
                    <small>Applicant.</small>
                </div>
                <div>
                    <canvas id="lineChart" height=""></canvas>
                </div>
                <div class="m-t-md">
                    <small class="pull-right">
                        <i class="fa fa-clock-o"> </i>
                        Update on 16.07.2015
                    </small>
                </div>

            </div>
        </div>
    </div>

<div class="clearfix"></div>
<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/plugins/contextMenu/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/contextMenu/jquery.ui-contextmenu.js"></script>
<!-- Full Calendar -->
<script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.pie.js"></script>

<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<style type="text/css">
    .ibox{
        margin-bottom: 20px;
    }
</style>

<script>
    $('.dropdown').hover(function () {
        $('.dropdown-toggle', this).trigger('click');
    });

    $(document).ready(function () {
        $('#loading-example-btn').click(function () {
            btn = $(this);
            simpleLoad(btn, true)
            simpleLoad(btn, false)
        });
    });
    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" ");
            }, 2000);
        }
    }
     $(document).ready(function() {
        var lineData = {
            labels: ["January", "March", "April", "May", "June", "July"],
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
                    data: [28, 48, 40, 19, 86, 27, 90]
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

    });
    $(document).ready(function () {
        $('#external-events div.external-event').each(function () {
            //alert($("#first-day").attr("first-day"));
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
        $('#calendar').fullCalendar({

            theme: false,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'year,month,agendaWeek,agendaDay',
            },
            defaultDate: Date.now(),
            defaultView: 'year',
            eventTextColor: '#000',
            weekends: true,
            yearColumns: 6,
            firstDay: $("#first-day").attr("first-day"), //$('start-date').attr("first-day"),
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            droppable: true, // this allows things to be dropped onto the calendar 

            dayClick: function (date, jsEvent, view) {

                var param_value = date.format();
                var action_uri = 'setup/eventTypeCalender';
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>/" + action_uri,
                    data: {param: param_value},
                    beforeSend: function () {
                        $(".loader").html("<img src='<?php echo base_url(); ?>assets/img/loader-small.gif' />");
                    },
                    success: function (data) {
                        $(".loader").html("");
                        $('#external-events').html(data);
                    }
                });
            },
            events: '<?php echo site_url('admin/calendarEvents'); ?>',
            eventClick: function (event) {
                $(".commonModal").modal();
                var action_uri = 'setup/eventInfo';
                var param_value = event.id;
                var action_type = 'edit';
                var title = 'Event Information';

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

            },
            eventRender: function (event, element, day, date) {
                element.bind('mousedown', function (e) {
                    if (e.which == 3) {
                        $("#containers").contextmenu({
                            delegate: "td.fc-day, td.fc-day-number, .fc-content", // or simply "tr"
                            menu: [],
                            preventSelect: true,
                            taphold: true,
                            uiMenuOptions: {// Additional options, used when UI Menu is created
                                position: {my: "left top", at: "right+10 top+10"}
                            },
                            beforeOpen: function (event, ui) {
                                var calDate = new Date(day);
                                var calDay = calDate.getDate();
                                var calMonth = calDate.getMonth();
                                var calYear = calDate.getFullYear();
                                var cmdDate = calDay + "/" + calMonth + "/" + calYear;
                                // replace the whole menu depending on click target type
                                if (ui.target.closest(".fc-content").length !== 0) {
                                    $("#containers").contextmenu("replaceMenu", [
                                        {title: "Update", data: {id: "2"}, cmd: cmdDate, uiIcon: "ui-icon-pencil"},
                                        //{title: "----"},
                                        {title: "Delete", data: {id: "3"}, cmd: cmdDate, uiIcon: "ui-icon-trash"},
                                        //{title: "----"},
                                        {
                                            title: "Active",
                                            data: {id: "4", status: "1"},
                                            cmd: cmdDate,
                                            uiIcon: "ui-icon-check"
                                        },
                                        //{title: "----"},
                                        {
                                            title: "Inactive",
                                            data: {id: "5", status: "1"},
                                            cmd: cmdDate,
                                            uiIcon: " ui-icon-minus"
                                        },
                                    ]);
                                }
                            },
                            select: function (events, ui) {

                                if (ui.item.data('id') == 2) {  //Event Update section;

                                    $(".commonModal").modal();
                                    var param_value = event.id;
                                    var action_uri = 'setup/eventFormUpdate';
                                    var title = 'Event Update';
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

                                } else if (ui.item.data('id') == 3) {  //Event Delete section;
                                    if (confirm("Are You Sure?")) {
                                        var item_id = event.id;
                                        var item_id = event.id;
                                        var data_field = "EVENT_ID";
                                        var data_tbl = "event";
                                        $.ajax({
                                            type: "post",
                                            url: "<?php echo site_url('setup/deleteItem'); ?>/",
                                            data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                                            success: function (data) {

                                                if (data == "Y") {
                                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                                } else {
                                                    alert("Row Delete Field");
                                                }
                                            }
                                        });
                                    } else {
                                        return false;
                                    }

                                }
                                if (ui.item.data('status') == '1') {  /*Event Active/Inaction section */

                                    if (confirm("Are You Sure?")) {
                                        var item_id = event.id;
                                        if (ui.item.data('id') == 4) { /*Event Active section;*/
                                            var status = 0;
                                        } else {                      /*Event Inaction section;*/
                                            var status = 1;
                                        }
                                        var data_tbl = "event";
                                        var data_field = "ACTIVE_STATUS";
                                        var data_fieldId = "EVENT_ID";
                                        var data_su_url = "setup/EventById";
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo site_url() ?>/setup/statusItem',
                                            data: {
                                                item_id: item_id,
                                                status: status,
                                                data_tbl: data_tbl,
                                                data_field: data_field,
                                                data_fieldId: data_fieldId
                                            },
                                            success: function (data) {
                                                if (data == "Y") {
                                                    $('#calendar').fullCalendar('refetchEvents');
                                                    /*Refresh the Full calendar and show the calendar view !!*/

                                                } else {
                                                    return false;
                                                }
                                            }
                                        });
                                    } else {
                                        return false;
                                    }

                                }

                            }
                        });
                    }
                });
                var dataToFind = moment(event.start).format('YYYY-MM-DD');
                $("td[data-date='" + dataToFind + "']").addClass('activeDay');

            },
            dayRender: function (day, cell) {
                //alert(cell);
                cell.bind('mousedown', function (e) {
                    if (e.which == 3) {
                        $("#containers").contextmenu({
                            delegate: "td.fc-day, td.fc-day-number, .fc-content", // or simply "tr"
                            menu: [],
                            preventSelect: true,
                            taphold: true,
                            uiMenuOptions: {// Additional options, used when UI Menu is created
                                position: {my: "left top", at: "right+10 top+10"}
                            },
                            beforeOpen: function (event, ui) {
                                var calDate = new Date(day);
                                var calDay = calDate.getDate();
                                var calMonth = calDate.getMonth() + 1;
                                var calYear = calDate.getFullYear();
                                var cmdDate = calDay + "/" + calMonth + "/" + calYear;
                                // replace the whole menu depending on click target type
                                if (ui.target.closest("td.fc-day, td.fc-day-number").length !== 0) {
                                    $("#containers").contextmenu("replaceMenu", [
                                        {title: "Add Event", data: {id: "1"}, cmd: cmdDate, uiIcon: "ui-icon-plus"},
                                    ]);
                                }
                            },
                            select: function (event, ui) {

                                if (ui.item.data('id') == 1) {    //Event add section;
                                    $(".commonModal").modal();
                                    var param_value = "";
                                    var action_uri = 'setup/eventFormInsert';
                                    var title = 'Event Create';
                                    $.ajax({
                                        type: "post",
                                        url: "<?php echo site_url(); ?>/" + action_uri,
                                        data: {param: param_value, date: ui.cmd},
                                        beforeSend: function () {
                                            $(".commonModal .modal-title").html(title);
                                            $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                                        },
                                        success: function (data) {
                                            $(".commonModal .modal-body").html(data);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            },
        });
        $(document).on("click", ".formSubmitEvent", function () {
            var isValid = 0;
            $('.required').each(function () {
                $(this).keyup(function () {
                    $(this).css("border", "1px solid #ccc");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    //alert(label + " Is Empty");
                    $(this).siblings(".validation").html(label + " is required");
                    $(this).css("border", "1px solid red");
                    isValid = 1;
                    //return false;
                } else {
                    $(this).siblings(".validation").html("");
                    $(this).css("border", "1px solid #ccc");
                }
            });
            if (isValid == 0) {
                if (confirm("Are You Sure?")) {
                    var frmContent = $(".frmContent").serialize();
                    var action_uri = $(this).attr("data-action");
                    var type = $(this).attr("data-type");
                    var success_action_uri = $(this).attr("data-su-action");
                    var ac_type = $(this).attr("");
                    var param = "";
                    if (type != "list") {
                        param = $(".rowID").val();
                    }
                    var sn = $("#loader_" + param).siblings("span").text();
                    $.ajax({
                        type: "post",
                        data: frmContent,
                        url: "<?php echo site_url(); ?>/" + action_uri,
                        beforeSend: function () {
                            $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $(".loadingImg").html("");
                            $(".frmMsg").html(data);
                            $.ajax({
                                type: "post",
                                data: {param: param},
                                url: "<?php echo site_url(); ?>/" + success_action_uri,
                                beforeSend: function () {
                                    //$(".gridTable").dataTable();
                                    if (type != "list") {
                                        $("#loader_" + param).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                    }
                                },
                                success: function (data1) {
                                    //$(".loadingImg").html("");
                                    $('#calendar').fullCalendar('refetchEvents');
                                    /*Refresh the Full calendar and show the calendar view !!*/
                                }
                            });
                        }
                    });
                } else {
                    return false;
                }
            } else {
                return false;
            }

        });
        $(document).on("click", ".openModal", function () {
            $(".commonModal").modal();
            var action_uri = 'setup/eventInfo';
            var param = $(this).attr("id");
            var title = 'Event Information';

            $.ajax({
                type: "post",
                url: "<?php echo site_url(); ?>/" + action_uri,
                data: {param: param},
                beforeSend: function () {
                    $(".commonModal .modal-title").html(title);
                    $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".commonModal .modal-body").html(data);
                }
            });
        });
    });
    $("#date_picker").datepicker({
        // While using year and month change I prefer to use inline  date picker  like (  <div id="datepicker"></div>   )
        changeMonth: true,
        changeYear: true,
        onChangeMonthYear: function (year, month, inst) {
            var date = new Date();
            $('#calendar').fullCalendar('gotoDate', year, month, date.getDate());
        },
        onSelect: function (dateText, inst) {
            var date = new Date(dateText);
            $('#calendar').fullCalendar('gotoDate', date.getFullYear(), date.getMonth(), date.getDate());
        }
    });
</script>
