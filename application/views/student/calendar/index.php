<link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet'
      media='print'>
<link href="<?php echo base_url(); ?>assets/css/plugins/contextMenu/jquery-ui.css" type="text/css" rel='stylesheet'>
<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet"/>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <!--        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Event List</h5><span class="hidden" id="loadering"></span>
                </div>
                <div class="ibox-content">
                    <div id='external-events'>
                        <p>Drag a event and drop into calendar.</p>
                        <?php
        foreach ($event as $row):
            ?>
                            <div class='external-event alert alert-info'><?php echo $row->E_TITLE; ?></div>
                            <?php
        endforeach;
        ?>
                        <p class="m-t">
                            <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label for='drop-remove'>remove after drop</label>
                        </p>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Academic Calendar </h5>
                </div>
                <div class="ibox-content" id="containers">
                    <div id="calendar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Mainly scripts -->

<script src="<?php echo base_url(); ?>assets/js/plugins/contextMenu/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/contextMenu/jquery.ui-contextmenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/contextMenu/jquery.themeswitcher.js"></script>

<!-- jQuery UI custom -->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>

<!-- Full Calendar -->
<script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>

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
        $('#calendar').fullCalendar({
            theme: false,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'year,month,agendaWeek,agendaDay'
            },
            defaultDate: Date.now(),
            defaultView: 'year',
            eventTextColor: '#000',
            yearColumns: 4,
            firstDay: 0,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function (event, ui) {
                alert(event.id);
                if (!confirm("Are you sure about this change?")) {
                    $('#calendar').fullCalendar('removeEvents', event.id);
                }
                // is the "remove after drop" checkbox checked?
                //if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                //$(this).remove();
                //}
            },
            dayClick: function (date, jsEvent, view) {

                var param_value = date.format();
                var action_uri = 'student/eventTypeCalender';
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


            },
            dayRender: function (day, cell) {
                cell.bind('mousedown', function (e) {
                    if (e.which == 3) {
                        $("#switcher").themeswitcher({
                            jqueryuiversion: "1.11.2"
                        });
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
    });
</script>
<style>
    .pointer {
        cursor: pointer;
    }

    .ui-menu {
        z-index: 99999;
    }
</style>