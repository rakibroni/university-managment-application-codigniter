<?php
/*echo "<pre>";
print_r($students);
exit();*/
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="table-responsive">
        <div class="ibox-tools">
            <span id="approve_success" class="text-success"></span>
            <input type="button" class="btn btn-primary btn-sm formOfferapprov" data-action="academic/CourseAcademicPreview" data-su-action="academic/index" value="Approved">
        </div>
        <table class="table table-striped table-bordered table-hover gridTable">
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th >Name</th>
                <th>Semester</th>
                <th></th>
                <th style="width: 40% !important;">Course</th>
            </tr>
            </thead>    
            <tbody>
            <?php
            if (!empty($students)):
                $i = 1;
                foreach ($students as $row):
                    ?>
                    <tr class="gradeX"
                        id="row_<?php echo $row->STUDENT_ID; ?>" <?php echo ($row->ACTIVE_STATUS == 1) ? "style='background-color:#DFF0D8;'" : ""; ?>>
                        <td>
                            <?php if ($row->ACTIVE_STATUS == 0) {
                                ?>
                                <input type="checkbox" class="form-control required check" name="studentReqId[]"
                                       value="<?php echo $row->STUDENT_ID; ?>"/>
                            <?php
                            } else {
                                echo "<span class='glyphicon glyphicon-ok'></span>";
                            }
                            ?>
                        </td>
                        <td><?php echo $row->FULL_NAME_EN ."<br><i>".$row->ROLL_NO."</i>"; ?></td>
                        <td><?php echo $row->LKP_NAME; ?></td>
                        <td><?php echo $row->PROGRAM_NAME."<br><i>".$row->DEPT_NAME."</i><br><i>".$row->SESSION_NAME."</i>"; ?></td>
                        <td>
                            <?php
                            $cou = $this->db->query("SELECT ac.COURSE_ID, ac.COURSE_TITLE
                                            FROM aca_semester_course acs 
                                            INNER JOIN aca_course ac on ac.COURSE_ID = acs.COURSE_ID
                                            WHERE acs.PROGRAM_ID = $row->PROGRAM_ID AND acs.SEMESTER_ID = $row->SEMESTER_ID ")->result();
                            echo "<ul class='tag-list' style='padding: 0'>";
                            foreach ($cou as $cour) {
                                echo "<li> <a>". $cour->COURSE_TITLE."</a></li>";
                                ?>
                                <input type="hidden" name="courseId<?php echo $row->STUDENT_ID; ?>[]"
                                       value="<?php echo $cour->COURSE_ID; ?>"/>
                            <?php
                            }
                            echo "</ul>";
                            ?>
                        </td>
                    </tr>
                <?php
                endforeach;
            else:
                ?>
                <tr class="gradeX">
                    <td colspan="8">No Request Found</td>
                </tr>
            <?php
            endif;
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Student</th>
                <th>Semester</th>
                <th></th>
                <th>Course</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>




