<h3>Courses List</h3>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="table-responsive">
        <?php if (!empty($courses)): ?>
            <form id="frmSemesterCourse">
                <table class="table table-striped table-bordered table-hover gridTable ">
                    <thead>
                        <tr>
                           <th></th>
                            <th>Title</th>
                           
                            <th>Credit</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($courses as $row) { ?>
                            <tr class="gradeX"  id="row_<?php echo $row->COURSE_ID; ?>">
                                <input  type="hidden" name="course_offer_id_<?php echo $row->COURSE_ID; ?>" value="<?php echo $row->OFFERED_COURSE_ID; ?>">
                                <td><span class="hidden" id="loader_<?php echo $row->COURSE_ID; ?>"></span><input type="checkbox" class="check courseClick" name="course_id" attr-course="1" value="<?php echo $row->COURSE_ID; ?>"></td>
                                <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>" class="openCourseDetailsModal" title="Course Details"><?php echo "<b>".$row->COURSE_CODE."&nbsp;: ".$row->COURSE_TITLE."</a></b>"; ?></td>      
                                                           
                                <td><?php echo $row->CREDIT; ?></td>                           
                                <td><span class="text-info"><span id="success-msg-<?php echo $row->COURSE_ID; ?>"></span></td>
                            </tr>
                        <?php
                        $i++;
                        } ?>
                    </tbody>
                </table>
                <div class="col-lg-offset-2 ">
                    <span class="modal_msg pull-left"></span>
                    <input  type="hidden" name="program" id="program" value="<?php echo $program; ?>">
                    <input  type="hidden" name="semester" id="semester" value="<?php echo $semester; ?>">
                    <input  type="hidden" name="offerType" id="offerType" value="<?php echo $offerType; ?>">   
                    <input  type="hidden" name="session" id="session" value="<?php echo $session; ?>">
                </div>
            </form>
            <?php
        else:
            echo "<div class='alert alert-danger'> No Course Found </div>";
        endif;
        ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".gridTable").dataTable({
            "iDisplayLength": 150
        });
        $('.courseClick').click(function() {               
            var frmSemesterCourse = $("#frmSemesterCourse").serialize();
            var semester = $("#semester").val();
            var program = $("#program").val();
            var offerType = $("#offerType").val();
            var session = $("#session").val();
            var course_id = $(this).val();
            if ($(this).is(':checked')) {
                var id = $(this).attr("attr-course");
            }else{
                var id = 0;
            }
            if(id == 1){
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('course/semesterCourseAdd') ?>',
                    data: frmSemesterCourse,
                    beforeSend: function () {
                        $("#course_" + semester).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $("#success-msg-"+course_id).html(data);
                        $.ajax({
                            type: "post",
                            data: {semester: semester, program:program, offerType:offerType, session:session},
                            url: '<?php echo site_url('course/CourseViewPerSemester') ?>',                   
                            success: function (data1) {                        
                                $("#course_" + semester).html(data1);
                            }
                        });            
                    }
                });                
            }else{
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('course/semesterCourseDelete') ?>',
                    data: {course_id:course_id, semester: semester, program:program, session:session},
                    beforeSend: function () {
                        $("#course_" + semester).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $("#success-msg-"+course_id).html(data);
                        $.ajax({
                            type: "post",
                            data: {semester: semester, program:program, offerType:offerType, session:session},
                            url: '<?php echo site_url('course/CourseViewPerSemester') ?>',                   
                            success: function (data1) {                        
                                $("#course_" + semester).html(data1);
                            }
                        });            
                    }
                });
            }
        });
    });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
