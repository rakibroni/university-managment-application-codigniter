<form id="frmContent" method="post">
    <div class="wrapper wrapper-content">
        <div class=" ">
            <div class="col-lg-12 white-bg">
                <div class="ibox-content ">
                    <?php $this->load->view("common/faculty_dept_program"); ?>
                    <?php $this->load->view("common/semester_session"); ?>                    
                    <div class="col-md-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <span class="modal_msg pull-left"></span>
                            <input type="button" class="btn btn-primary btn-sm formOffer" value="submit">
                            <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox float-e-margins">
                <div class="listView"></div>
                <div class="printView pull-right"></div>

                <div class="ibox-content" id="report">
                    <span class="selected_course"></span>
                </div>
            </div>
        </div>


    </div>
</form>
<script type="text/javascript">
    $(document).on("click", ".formOffer", function () {
        var is_valid = 0;
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
            var frmContent = $("#frmContent").serialize();
            var action_url = '<?php echo site_url('Report/searchSemesterDue') ?>';
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
                    $(".listView").html("<div>").addClass('ibox-title');
                    $(".listView").html("<a href='<?php echo site_url('Report/semesterDue'); ?>/" + faculty + "/" + dept + "/" + program + "/" + session + "/" + semester + "' target='_blank' class='pull-right btn btn-primary btn-sm'><strong>PRINT</strong></a></div>");
                    //alert(program);
                    $('#report').html(data);
                }
            });
        }
    });
</script>