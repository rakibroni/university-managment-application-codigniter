
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <input type="hidden" id="SESSION_ID" name="SESSION_ID" value="<?php echo $session; ?>">

        <div class="form-group col-md-12">
            <div class="col-md-6">
                <label class="pull-right"> Student Registration No. :</label>
            </div>
            <div class="col-md-2">
                <input name="STU_ROLL_NO" id="STU_ROLL_NO" class="form-control" placeholder="Roll No." >
            </div>


        </div>
        <div class="clearfix"></div>
    </div>
    <div class="ibox-content">
        <div id="studentList"></div>
    </div>

</div>

<script>

    $(document).on("keyup blur",  "#STU_ROLL_NO", function (e) {

        if (e.type == 'focusout' || e.keyCode == 13) {

            var STU_ROLL_NO = $("#STU_ROLL_NO").val();
            var SESSION_ID = $("#SESSION_ID").val();


                $.ajax({
                    type: "POST",
                    data:  {SESSION_ID: SESSION_ID, STU_ROLL_NO: STU_ROLL_NO},
                    url: "<?php echo site_url() ?>/teacher/findThisStudentCourses",
                    beforeSend: function () {
                        $("#studentList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $("#studentList").html(data);
                    }
                });
            }


    });

    $(document).on("click", "#openCourseModal", function () {
        $(".commonModal").modal();
        var param_value = "";
        var action_type = $(this).attr("data-type");
        var action_uri = $(this).attr("data-action");
        var session_id = $(this).attr("data-session-id");
        var program_id = $(this).attr("data-program-id");
        var stu_reg_id = $(this).attr("data-reg-id");
        var title = $(this).attr("title");
        if (action_type == "edit") {
            param_value = $(this).attr("id");
        }
        if (action_type == "delete") {
            param_value = $(this).attr("id");
        }
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {param: param_value, session_id: session_id, program_id: program_id, stu_reg_id: stu_reg_id},
            beforeSend: function () {
                $(".commonModal .modal-title").html(title);
                $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".commonModal .modal-body").html(data);
                $(".select2Dropdown").select2();
            }
        });
    });


    $(document).on("click", ".courseFormSubmit", function () {
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

                //console.log(frmContent);

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
                            data: frmContent,
                            url: "<?php echo site_url(); ?>/" + success_action_uri,
                            beforeSend: function () {
                                if (type != "list") {
                                    $("#loader_" + param).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                }
                            },
                            success: function (data1) {
                                //$(".loadingImg").html("");
                                if (type == "list") {
                                    $(".contentArea").html(data1);
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
    })
</script>
