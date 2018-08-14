<style type="text/css">
    .ibox-content {
        padding: 5px 20px 23px !important;
    }
    .courseView ol {
        margin-left: -25px !important;
    }
</style>
<?php $this->load->view("student/common/student_common_js"); ?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="table-responsive">

        <h4><b><span style="color: green"><?php if (!empty($student_course_list)) { echo 'Enrolled Course List';} ?> </span></b>
        </h4>

        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content courseView contentArea" id="course_<?php // echo   $row->SL_NO; ?>">

                            <?php if (!empty($student_course_list)) : ?>
                            <div class="ibox-tools">
                                <a><span id="openCourseModal" title="Add Course" class="label label-primary label-sm pull-right glyphicon glyphicon-plus" data-program-id="<?php echo $program_id;?>" data-reg-id="<?php echo $stu_reg_no;?>"
                                         data-action="teacher/newCourseFormInsert" data-session-id="<?php echo $session_id;?>"> Add New </span></a>
                            </div>

                            <table id="academic_list" class="table table-bordered dataTable">
                                <tr class="info">
                                    <th>SL.</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th class="text-center">Credits</th>
                                    <th class="text-center">Course For</th>
                                    <th class="text-center">Action</th>
                                </tr>

                                <tbody>

                                <?php $sn = 1; ?>
                                <?php foreach ($student_course_list as $row) : ?>

                                        <tr class="gradeX" id="row_<?php echo $row->STU_CRS_ID; ?>">
                                            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                                                <span><?php echo $sn++; ?></span><span class="hidden"
                                                                                       id="loader_<?php echo $row->STU_CRS_ID; ?>"></span>
                                            </td>
                                            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_CODE; ?></td>
                                            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE; ?></td>
                                            <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CREDIT; ?></td>
                                            <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                                                <?php if ($row->COURSE_FOR == 'F'): ?>
                                                    <?php echo 'Final';?>
                                                <?php elseif ($row->COURSE_FOR == 'I') : ?>
                                                    <?php echo 'Improved'; ?>
                                                <?php elseif ($row->COURSE_FOR == 'R') : ?>
                                                    <?php echo 'Retake'; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                                                <a class="label label-danger deleteItem2" id="<?php echo $row->STU_CRS_ID; ?>"
                                                   title="Click For Delete" data-type="delete" data-field="STU_CRS_ID"
                                                   data-action="teacher/deleteItem"
                                                   data-tbl="student_courseinfo"><i
                                                            class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                   <?php endforeach; ?>
                                </tbody>
                            </table>

                            <?php else : ?>
                                <div class="text-warning">
                                    <span><b>No Student Found</b></span>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(".gridTable").dataTable();
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
    $(function() {
        $( ".sortable" ).sortable();
        $( ".sortable" ).disableSelection();
    });

    $(document).on("click", ".openOfferCourseModal", function () {
        $(".commonModal").modal();
        var title = $(this).attr("title");
        var action_uri = $(this).attr("data-action");
        var program_value = $(this).attr("data-program");
        var semester = $(this).attr("data-semester");
        var offerType = $(this).attr("offerType");
        var session = $(this).attr("session");

        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {program: program_value, semester: semester, offerType: offerType, session: session},
            beforeSend: function () {
                $(".commonModal .modal-title").html(title);
                $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".commonModal .modal-body").html(data);
            }
        });
    });




</script>