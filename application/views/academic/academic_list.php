<div class="wrapper wrapper-content ">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover gridTable">
            <thead>
            <tr>
                <th>Sl no.</th>
                <th>Name</th>
                <th>Roll</th>
                <th>Department</th>
                <th>Program</th>
                <th>Semester Name</th>
                <th style="width: 40% !important;">Course</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($academic)):
                $i = 1;
                foreach ($academic as $row):
                    ?>
                    <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->FULL_NAME_EN; ?></td>
                        <td><?php echo $row->ROLL_NO; ?></td>
                        <td><?php echo $row->DEPT_NAME; ?></td>
                        <td><?php echo $row->PROGRAM_NAME; ?></td>
                        <td><?php echo $row->LKP_NAME; ?></td>
                        <td>
                            <?php
                            $cou = $this->db->query("SELECT ac.COURSE_ID, ac.COURSE_TITLE
                                            FROM stu_courseinfo sc 
                                            INNER JOIN aca_course ac on sc.COURSE_ID = ac.COURSE_ID
                                            WHERE sc.STUDENT_ID = $row->STUDENT_ID AND sc.SEMISTER_ID = $row->LKP_ID ")->result();
                            foreach ($cou as $cour) {
                                echo "<a>". $cour->COURSE_TITLE."</a>, ";
                                ?>
                                <input type="hidden" name="courseId<?php echo $row->STUDENT_ID; ?>[]"
                                       value="<?php echo $cour->COURSE_ID; ?>"/>
                            <?php
                            }
                            ?>
                        </td>

                    </tr>
                    <?php
                    $i++;
                endforeach;
            endif;
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Roll</th>
                <th>Department</th>
                <th>Program</th>
                <th>Semester Name</th>
                <th>Course Name</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

