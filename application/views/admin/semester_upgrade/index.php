
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="">
                <form id="frmContent" method="post">
                    <div class="ibox-content">
                        <?php $this->load->view("common/faculty_dept_program"); ?>
                        <?php $this->load->view("common/semester_session"); ?>
                        <div class="col-md-12">
                            <div class="form-group" style="padding-top: 5px;">
                                <span class="modal_msg pull-left"></span>
                                <input type="button" class="btn btn-primary btn-sm formOffer" value="submit">
                                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                            </div>
                        </div><br clear="all" />
                    </div>
                </form>
            </div>
        <?php } ?>
        <div class="">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View All Students</h5>
                    <span class="loadingImg"></span>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea" id="applicantList">
                        <?php $this->load->view("admin/semester_upgrade/student_list"); ?>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(document).on("click", ".formOffer", function () {
        var is_valid = 0;
        var reg_period = $("#REG_PERIOD_ID").val();
        var session = $("#SESSION_ID").val();
        var semester = $("#SEMESTER_ID").val();
        var faculty = $("#FACULTY_ID").val();
        var dept = $("#DEPT_ID").val();
        var program = $("#PROGRAM_ID").val();
        if (reg_period == '' || session == '' || semester == '' || faculty == '' || dept == '' || program == '') {
            if (reg_period == '') {
                alert('Registration Period Select !!');
            } else if (faculty == '') {
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
            var frmContent = $("#frmContent").serialize();
            var action_url = '<?php echo site_url('admin/searchCurrentPaidStudent') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: frmContent,
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {

                    $(".loadingImg").html("");
                    $('#applicantList').html(data);
                }
            });
        }

    });
    $(document).on("click", ".semUpgrade", function () {
        var studentId = $(this).attr("data-student");
        var frmCourseOffer = $("#frmCourseOffer").serialize();
        if (confirm("Are You Sure?")) {
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('admin/semesterUpgradeConfirm') ?>/' + studentId,
                success: function (data1) {
                    $(".loadingImg").html("");
                    $('#row_'+studentId).html('');                          
                }
            });
        } else {
            return false;
        }
    });
    $(document).on("click", ".formUpgrade", function () {
        var frmContent = $("#semesterUp").serialize();
        if (!$('#semesterUp input[type="checkbox"]').is(':checked')) {
            alert("Please Select at least one Student.");
            return false;
        } else {
            if (confirm("Are You Sure?")) {
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('admin/semesterUpgradeAll') ?>',
                    data: frmContent,
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $('#upgrade_success').html(data);
                    }
                });
            } else {
                return false;
            }
        }
    });
</script>

