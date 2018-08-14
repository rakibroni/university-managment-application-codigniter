<form id="frmContent" method="post">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content">
                    <form id="applicant">
                        <?php $this->load->view("common/faculty_dept_program"); ?>
                        <?php $this->load->view("common/semester_session"); ?>
                        <div class="col-md-12">
                            <div class="form-group col-md-4" style="padding-top: 5px;">
                                <span class="modal_msg pull-left"></span>
                                <input type="button" class="btn btn-primary btn-sm formOffer" value="submit">
                                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <?php if (!empty($appList)): ?>
                        <div class="ibox-title">
                            <h5>All Students List</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="table-responsive">
                                    <div class="ibox-tools">
                                        <span id="approve_success" class="text-success"></span>
                                        <input type="button" class="btn btn-primary btn-sm formExamapprov"
                                               value="Approved">
                                    </div>
                                    <form action="" id="ApplicantList">
                                        <div class="table-responsive contentArea" id="academicList">
                                            <?php $this->load->view("admin/coe/applicant_list_view"); ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {

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
                var action_url = '<?php echo site_url('Coe/searchApplicant') ?>';
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
                        $('#academicList').html(data);
                    }
                });
            }
        });
        $(document).on("click", ".formExamapprov", function () {
            if (!$('#ApplicantList input[type="checkbox"]').is(':checked')) {
                alert("Please Select at least one Student.");
                return false;
            } else {
                if (confirm("Are You Sure?")) {
                    var faculty = $("#ApplicantList").serialize();
                    var action_url = '<?php echo site_url('Coe/approveApplication') ?>';
                    $.ajax({
                        type: "POST",
                        url: action_url,
                        data: faculty,
                        beforeSend: function () {
                            $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $(".loadingImg").html("");
                            $('#approve_success').html(data);
                        }
                    });
                }
            }
        });
    });
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>