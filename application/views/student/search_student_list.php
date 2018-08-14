
<?php if($student_list){?>
<table class="table table-striped table-bordered  " style="border-collapse:collapse;">
    <thead>
        <tr>
            <th><input type="checkbox" id="checkAllBox" > All</th>
            <th>Registration no</th>          
            <th>Name</th>          
            <th>Mobile</th>          

        </tr>
    </thead>
    <tbody>
        <?php  foreach($student_list as $row): ?>
            <tr style="background-color: rgb(217,237,247)" >
                <td><input type="checkbox" class="check" name="STUDENT_ID[]" value="<?php echo $row->STUDENT_ID ?>"></td>
                <td data-toggle="collapse" data-target="#student_<?php echo $row->STUDENT_ID ?>"><?php echo $row->REGISTRATION_NO ?></td> 
                <td data-toggle="collapse" data-target="#student_<?php echo $row->STUDENT_ID ?>"><?php echo $row->FULL_NAME_EN ?></td> 
                <td data-toggle="collapse" data-target="#student_<?php echo $row->STUDENT_ID ?>"><?php echo $row->MOBILE_NO ?></td> 
            </tr>
            <?php
            $enroll_course= $this->course_model->enrollmentCourse($program_id,$session_id,$semester,$offer_type);
        //echo "<pre>"; print_r($enroll_course);echo "</pre>";        
            ?>
            <tr>
                <td colspan="4" class="hiddenRow">
                    <div id="student_<?php echo $row->STUDENT_ID ?>" class="collapse">
                        <table class="table primary">
                            <tr>
                                <th>#</th>
                                <th>Course Code</th>
                                <th>Title</th>
                                <th>Credit</th>
                            </tr>
                            <?php foreach($enroll_course as $row_enroll): ?>
                                <tr>                     
                                    <td>
                                        <input type="checkbox" name="ENROLL_COURSE_ID_<?php echo $row->STUDENT_ID ?>[]" value="<?php echo $row_enroll->COURSE_ID ?>" checked="checked">
                                        <input type="hidden" name="OFFERED_COURSE_ID_<?php echo $row->STUDENT_ID ?>[]" value="<?php echo $row_enroll->OFFERED_COURSE_ID ?>">
                                    </td>
                                    <td><?php echo $row_enroll->COURSE_CODE ?></td>
                                    <td><?php echo $row_enroll->COURSE_TITLE ?></td>
                                    <td><?php echo $row_enroll->CREDIT ?></td>                    
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>


    <input type="button" id="course_enrollment_btn" name="submit" class="btn btn-warning" value="Submit">
<?php }else{ echo '<p class="text-warning">No Student Found</p>';} ?>

<script type="text/javascript">
    $('.collapse').on('show.bs.collapse', function () {
       // $('.collapse.in').collapse('hide');
   });
    $("#checkAllBox").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>