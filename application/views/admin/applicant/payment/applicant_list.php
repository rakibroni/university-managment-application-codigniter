<style type="text/css">
    hr{
        margin-bottom:0px !important ;
        margin-top:10px !important;
    }
</style>
<div class="ibox-content">
    <?php $this->load->view("common/faculty_dept_program"); ?>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-md-12">Session <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <select class="select2Dropdown form-control" name="SESSION_ID" id="SESSION_ID" data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                    <option value="">Select Session</option>
                    <?php foreach ($session as $row) { ?>
                        <option
                            value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                        <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <hr>
        <div class="form-group" style="padding-top: 5px;">
            <span class="modal_msg pull-left"></span>
            <input type="button" class="btn btn-primary btn-sm formOffer" value="Search">
<!--            <input type="reset" class="btn btn-default btn-sm" value="Reset">-->
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php // } ?>
<div class="">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>View All Applicant Information</h5>
            <span class="loadingImg"></span>
        </div>
        <div class="ibox-content">
            <div class="table-responsive contentArea" id="applicantList">
                <?php if (!empty($applicant)): ?>
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Student Name</th>
                                <th>Reg</th>
                                <th>Mobile No</th>
                                <th>Program Name</th>
                                <th>Session Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sn = 1;
                            foreach ($applicant as $row):
                                ?>
                                <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                                    <td><span><?php echo $sn++; ?></span></td>
                                    <td>
                                            <?php $stud_photo = ($row->PHOTO != '') ? 'upload/student/photo/' . $row->PHOTO : 'assets/img/default.png' ?>
                                            <img class="img-circle" src="<?php echo base_url($stud_photo); ?>" alt="" style="width: 30px;">
                                            <?php echo $row->FULL_NAME_EN ?>
                                    </td>
                                    <td><?php echo $row->REGISTRATION_NO ?></td>
                                    <td><?php echo $row->MOBILE_NO; ?></td>
                                    <td><?php echo $row->PROGRAM_SHORT_NAME; ?></td>
                                    <td>
                                        <?php echo $row->SEMESTER_NAME; ?><br/>
                                        <?php echo $row->SESSION_NAME; ?>
                                    </td>
                                    <td>
                                        <a class="label label-danger" href="<?php echo site_url('payment/applicant_payment/' . $row->STUDENT_ID); ?>" title="Click For Payment">payment</a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Student Name</th>
                                <th>Reg</th>
                                <th>Mobile No</th>
                                <th>Program Name</th>
                                <th>Session Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <h3 class="text-danger text-center ">No data found !!</h3>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".formOffer", function() {
            var is_valid = 0;
            $('.required').each(function() {
                $(this).keyup(function() {
                    $(this).css("border", "1px solid #ccc !important");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    //alert(label + " Is Empty");
                    $(this).siblings(".validation").html(label + " is required");
                    $(this).css("border", "1px solid red");
                    is_valid = 1;
                } else {
                    $(this).css("border", "1px solid #ccc");
                }
            });
            if (is_valid == 0) {
                var faculty = $("#FACULTY_ID").val();
                var department = $("#DEPT_ID").val();
                var program = $("#PROGRAM_ID").val();
                var session = $("#SESSION_ID").val();
                if (faculty == '' || department == '' || program == '' || session == '') {
                    if (faculty == '') {
                        alert('Faculty Select !!');
                    } else if (department == '') {
                        alert('Department Select !!');
                    } else if (program == '') {
                        alert('Program Select !!');
                    } else if (session == '') {
                        alert('Session Select !!');
                    }
                } else {
                    var action_url = '<?php echo site_url('Payment/searchNewApplicant') ?>';
                    $.ajax({
                        type: "POST",
                        url: action_url,
                        data: {
                            faculty: faculty,
                            department: department,
                            program: program,
                            session: session
                        },
                        dataType: 'html',
                        beforeSend: function() {
                            $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function(data) {
                            $(".loadingImg").html("");
                            $('#applicantList').html(data);
                        }
                    });
                }
            }
        });
    });
</script>
