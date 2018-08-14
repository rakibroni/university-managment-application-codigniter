
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
        <h5>Class Schedule</h5> 
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
                    <label class="control-label">Program</label>

                    <div class="form-group">
                        <select class="form-control" name="PROGRAM_ID" id="PROGRAM_ID" >
                            <option value="">--Select--</option>                       
                            <?php foreach($prog_list as $row): ?>
                                <option value="<?php echo $row->PROGRAM_ID ?>"><?php echo $row->PROGRAM_NAME ?></option>
                            <?php endforeach; ?>                   

                        </select>
                        <span class="validation"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Batch</label>

                    <div class="form-group">
                        <select class="form-control" name="BATCH_ID" id="BATCH_ID" >
                            <option value="">--Select--</option>   
                        </select>
                        <span class="validation"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Section</label>

                    <div class="form-group">
                        <select class="form-control" name="SECTION_ID" id="SECTION_ID" >
                         <option value="">--Select--</option>                       
                         <?php foreach($section as $row): ?>
                            <option value="<?php echo $row->SECTION_ID ?>"><?php echo $row->NAME ?></option>
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
                        <?php foreach($teacher_list as $row): ?>
                            <option value="<?php echo $row->EMP_ID ?>"><?php echo $row->FULL_ENAME ?></option>
                        <?php endforeach; ?>                      

                    </select>
                    <span class="validation"></span>
                </div>
            </div>   
            <div class="form-group">
                <label class="control-label">Courses</label>

                <div class="form-group">
                    <select class="course_dropdown form-control" name="COURSE_ID" id="COURSE_ID" ">
                        <option value="">--Select--</option> 

                    </select>
                    <span class="validation"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Room</label>

                <div class="form-group">
                    <select class=" form-control" name="ROOM_ID" id="ROOM_ID" ">
                        <option value="">--Select--</option> 
                        <?php foreach($rooms as $row): ?>
                            <option value="<?php echo $row->ROOM_ID ?>"><?php echo $row->ROOM_NO ?></option>
                        <?php endforeach; ?>                         
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Day</label> 
                <div class="form-group">
                    <select class=" form-control" name="DAY" id="DAY" ">
                        <option value="">--Select--</option> 
                        <?php foreach($weeks as $row): ?>
                            <option value="<?php echo $row->ABBR ?>"><?php echo $row->DAY_NAME ?></option>
                        <?php endforeach; ?>                         
                    </select>
                    <span class="validation"></span>
                </div>

            </div>

            <div class="form-group">
                <label class="control-label">Time From</label>  
                <div class="input-group col-lg-3 clockpicker" data-autoclose="true">
                    <input class="form-control" name="START_TIME" id="START_TIME" value="" type="text">
                    <span class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                    </span>
                </div>  
            </div>
            <div class="form-group">
                <label class="control-label">Time To</label>  
                <div class="input-group col-lg-3 clockpicker" data-autoclose="true">
                    <input class="form-control" name="END_TIME" id="END_TIME" value="" type="text">
                    <span class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                    </span>
                </div>  
            </div>  
            <div class="form-group">
              <input type="button" class="btn btn-primary btn-sm form_submit" data-view-div="teacher_course_list"  data-action="course/createClassSchedule" data-su-action="" data-type="list" value="Submit">
          </div>


      </div>
      <div class="col-md-8">
       <div id="class_schedule_list" >
        <table class="table table-bodered gridTable common_table">
            <tr>
                <th>Course</th>
                <th>Teacher</th>
                <th>Program</th>
                <th>Batch</th>
                <th>Section</th>
                <th>Day</th>
                <th>Time</th>
            </tr>
            <?php 
            if(!empty($class_schedule)):
                foreach($class_schedule as $row): 
                    ?>
                    <tr>
                        <td><?php echo $row->COURSE_TITLE ?></td>
                        <td><?php echo $row->FULL_ENAME ?></td>
                        <td><?php echo $row->PROGRAM_SHORT_NAME ?></td>
                        <td><?php echo $row->BATCH_TITLE ?></td>
                        <td><?php echo $row->SECTION_NAME ?></td>
                        <td><?php echo $row->DAY ?></td>
                        <td><?php echo $row->START_TIME.'-'. $row->END_TIME ?></td>
                    </tr>
                <?php endforeach; endif;?>
            </table>

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
            
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('course/teacheSessionWiseCourseMapDropdown') ?>',
                data: {TEACHER_ID:TEACHER_ID,SESSION_ID:SESSION_ID},
                beforeSend: function () {
                    $("#COURSE_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {

                    $("#COURSE_ID").html(data);

                }
            });  

        }); 
        $(document).on('change','#PROGRAM_ID',function(){
            program_id=$(this).val();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/programWiseBatch') ?>',
                data: {program_id:program_id},
                beforeSend: function () {
                    $("#BATCH_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    //$(".loadingImg").html("");
                    $("#BATCH_ID").html(data);

                }
            });  
        });

    });
    
</script>
