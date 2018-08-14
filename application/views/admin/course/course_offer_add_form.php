<?php
$offerCourse = array();
foreach ($offered_courses as $key => $value) {
    array_push($offerCourse, $value->COURSE_ID);
}
?>
<div class="row">
    <form class="frmContent" id="CourseOfferNewAdd" method="post">
        <input type="hidden" name="faculty" id="faculty" value="<?php echo $faculty; ?>">
        <input type="hidden" name="department" id="departmenet" value="<?php echo $department; ?>">
        <input type="hidden" name="program" id="program" value="<?php echo $program; ?>">
        <input type="hidden" name="courseType" id="courseType" value="<?php echo $offerType; ?>">

        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="table-responsive contentArea">
                                <?php if (!empty($courses)): ?>
                                    <table class="table table-striped table-bordered table-hover gridTable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="checkAllBox"></th>
                                                <th>Title</th> 
                                                <th>Credit</th>
                                                <th>Duration</th>
                                                <th>Min Credit Limit</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn = 1; ?>
                                            <?php foreach ($courses as $row) {
                                                $checked = (in_array($row->COURSE_ID, $offerCourse) ? "0" : "1");
                                                if ($checked == 1) {
                                                    ?>
                                                    <tr class="gradeX" id="row_<?php echo $row->COURSE_ID; ?>">
                                                        <td>
                                                            <span class="hidden"
                                                            id="loader_<?php echo $row->COURSE_ID; ?>"></span><input
                                                            type="checkbox" class="check" id="course" name="course[]"
                                                            value="<?php echo $row->COURSE_ID; ?>">
                                                        </td> 
                                                        <td>
                                                        <a data-action="course/courseDetails"
                                                           course="<?php echo $row->COURSE_ID; ?>"
                                                           class="openCourseDetailsModal"
                                                           title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b>"; ?>
                                                       </td>  
                                                       <td><?php echo $row->CREDIT; ?></td>
                                                       <td>
                                                       <input type="number" data-placement="left"
                                                        
                                                        
                                                        min="30" max="300" step="5"
                                                        name="duration<?php echo $row->COURSE_ID; ?>"
                                                        data-duration="duration_<?php echo $row->COURSE_ID; ?>"
                                                       
                                                        id="c_course_du_<?php echo $row->COURSE_ID; ?>"><span>min*</span>
                                                    </td>
                                                    <td>
                                                    <input type="text"
                                                       name="minCredit<?php echo $row->COURSE_ID; ?>" size="5px"
                                                       data-placement="left" 
                                                      >
                                                       </td>


                                                   </tr>
                                                   <?php
                                               }
                                           }
                                           ?>
                                       </tbody>
                                     
                                </table>
                                <?php
                                else:
                                    echo "<span class='text-danger'>No Course Found.</span>";
                                endif;
                                ?>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <span class="modal_msg pull-left"></span>
                                    <span title="Course Offer" id="btnSubmitAdd"
                                    class="btn btn-primary btn-sm">submit</span>
                                    <input type="reset" class="btn btn-default btn-sm" value="Reset">
                                    <span class="loadingImg1"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br clear="all"/>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $("#checkAllBox").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });

</script>

