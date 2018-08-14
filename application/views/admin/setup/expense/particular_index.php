<form class="frmContent" id="search" method="post">
    <div class="">
        <div class="">
            <div class="ibox-content">
                <div class="row">
                    <?php $this->load->view("common/faculty_dept_program"); ?>
                    <?php $this->load->view("common/semester_session"); ?>
                </div>
                <div class="row"></br>
                    <div class="form-group ">
                        <div class="col-md-5">
                            <span class="modal_msg pull-left"></span>
                            <input type="button" class="btn btn-primary btn-sm formOffer text-left" value="Search">
                            <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="">
    <div class="">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Program Wise Perticular List</h5>

                <div class="ibox-tools">
                    <?php if ($previlages->CREATE == 1) { ?>


                    <span title="Create Particular " class="btn btn-primary btn-xs pull-right openModal"
                          data-action="setup/particularFormInsert"> Add New </span>

                    <?php } ?>
                </div>
            </div>

            <div class="ibox-content" id="particular_list">
                <div class="table-responsive contentArea contentArea_charge">
                    <?php $this->load->view("admin/setup/expense/particular_list"); ?>
                </div>
            </div>
            <div class="ibox-content" id="particularList">
                <div class="table-responsive contentArea">
                    <div class="ibox-content" id="particularCharge">
                        <span class="contentArea"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".formOffer", function () {
        var session = $("#SESSION_ID").val();
        var semester = $("#SEMESTER_ID").val();
        var faculty = $("#FACULTY_ID").val();
        var dept = $("#DEPT_ID").val();
        var program = $("#PROGRAM_ID").val();
        if (session == '' || semester == '' || faculty == '' || dept == '' || program == '') {
            if (faculty == '') {
                alert('Faculty Select !!');
            } else if (dept == '') {
                alert('Department Select !!');
            } else if (program == '') {
                alert('Program Select !!');
            } else if (semester == '') {
                alert('Semester Select !!');
            } else if (session == '') {
                alert('Session Select !!');
            }

        } else {
            $("#particular_list").hide();
            $("#particularList").show();
            var url = '<?php echo site_url('setup/ajax_get_particular_charge') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {faculty: faculty, department: dept, program: program, session: session, semester: semester},
                dataType: 'html',
                success: function (data) {
                    $('#particularCharge').html(data);
                }
            });
        }

    });
    $(document).on("click", ".ParSubmit", function () {

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
        if (isValid == 1) {
            if (($("input[name*='charge_id[]']:checked").length) <= 0) {
                alert("You must check at least one Charge");
            } else if (confirm("Are You Sure?")) {
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
                                if (type != "list") {
                                    $("#loader_" + param).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                }
                            },
                            success: function (data1) {
                                //$(".loadingImg").html("");
                                if (type == "list") {
                                    $(".contentArea_charge").html(data1);
                                    $(".gridTable").dataTable();
                                } else if (type == "msg") {
                                    $('#rinci').html(response).modal();
                                } else {
                                    $("#loader_" + param).addClass("hidden").html("").siblings("span").removeClass("hidden");
                                    $("#row_" + param).html(data1);
                                    $("#loader_" + param).siblings("span").html(sn);
                                }
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

</script>
