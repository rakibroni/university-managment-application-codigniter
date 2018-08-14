
<style>
    .select2-container {
        z-index: 9001;
    }

    .pop-width {
        width: 25% !important;
    }
</style>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Course Mapping</h5> 
    </div>
    <div class="ibox-content">
        <form class="frmContent" id="course_map_form" method="post">
            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label">Session</label>

                    <div class="form-group">
                        <select class="form-control" name="SESSION_ID" id="SESSION_ID">
                            <option value="">--Select--</option>
                            <?php foreach($aca_ses_list as $row): ?>
                                <option value="<?php echo $row->YSESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                            <?php endforeach; ?>

                        </select>
                        <span class="validation"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Department</label>

                    <div class="form-group">
                        <select class="form-control" name="DEPT_ID" id="DEPT_ID" >
                            <option value="">--Select--</option>                       
                            <?php foreach($dept_list as $row): ?>
                                <option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
                            <?php endforeach; ?>                   
                        </select>
                        <span class="validation"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Faculty Teacher</label>

                    <div class="form-group">
                        <select class="form-control" name="TEACHER_ID" id="TEACHER_ID">
                            <option value="">--Select--</option>                        
                        </select>
                        <span class="validation"></span>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="control-label">Courses</label>

                    <div class="form-group">
                        <select class="select2DropdownMulti form-control" name="COURSE_ID[]" id="COURSE_ID" data-tags="true" data-placeholder="Select Course"  multiple="multiple">
                            <option value="">--Select--</option>                        
                        </select>
                        <span class="validation"></span>
                    </div>
                </div>


                <div class="form-group">
                  <input type="button" class="btn btn-primary btn-sm form_submit" data-view-div="teacher_course_list"  data-action="course/createCourseMap" data-su-action="course/teacheSessionWiseCourseMap" data-type="list" value="Submit">
              </div>


          </div>
          <div class="col-md-8">
             <div id="teacher_course_list" class="loadingImg">


             </div>
         </div>
     </form>
     <div class="clearfix"></div>
 </div> 
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change','#TEACHER_ID', function(){

            var TEACHER_ID=$(this).val();
            SESSION_ID=$("#SESSION_ID").val();
            dept_id=$("#DEPT_ID").val();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('course/teacheSessionWiseCourseMap') ?>',
                data: {TEACHER_ID:TEACHER_ID,SESSION_ID:SESSION_ID},
                beforeSend: function () {
                    $("#teacher_course_list").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".teacher_course_list").html("");
                    $("#teacher_course_list").html(data);

                }
            });  
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('course/teacherSessWiseCourseMapList') ?>',
                data: {dept_id:dept_id,SESSION_ID:SESSION_ID,TEACHER_ID:TEACHER_ID},
                beforeSend: function () {
                    $("#COURSE_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    
                    $("#COURSE_ID").html(data);

                }
            });  
        });
        $(document).on('change','#DEPT_ID', function(){
            var session_id=$('#SESSION_ID').val();
            dept_id=$(this).val();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/deptWiseTeacherList') ?>',
                data: {dept_id:dept_id},
                beforeSend: function () {
                    $("#TEACHER_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $("#TEACHER_ID").html(data);

                }
            });  

        });


        $(".select2DropdownMulti").select2({
            tags: true
        });

    });
    
</script>
