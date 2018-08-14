<div class="wrapper wrapper-content ">
    <div class="col-md-12 text-center " style="visibility: visible; animation-name: fadeInRight; top:-20px;">
        <?php foreach ($info as $row): ?>

            <?php
            $faculty = $row->FACULTY_ID;
            $dept = $row->DEPT_ID;
            $program = $row->PROGRAM_ID;
            $session = $row->SESSION_ID;
            ?>
        <?php endforeach; ?>
    </div>


    <div class="table-responsive ">

        <?php if (!empty($courses)): ?>
            <table class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <th>Semester</th>
                    <th>Title</th>
                    <th>Credit</th>
                    <th>Prerequisite</th>
                    <th>Total Credit</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $current_semester = '';
                $i = 1;
                $Credit = 0;
                $row_span = count($courses);
                ?>

                <?php foreach ($courses as $row) { ?>
                    <?php
                    $c = 0;
                    echo "<tr>";
                    if ($current_semester != $row->LKP_NAME) {
                        $cc = $this->db->query("SELECT COUNT(a.SEM_COURSE_ID) count_c FROM aca_semester_course a
                                                    LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
                                                    WHERE a.SEMESTER_ID = $row->SEMESTER_ID AND a.PROGRAM_ID = $row->PROGRAM_ID AND a.SESSION_ID = $row->SESSION_ID
                                                    ORDER BY a.SEMESTER_ID")->result();
                        foreach ($cc as $count) {
                            $c = $count->count_c;
                        }
                        echo "<td rowspan=" . $c . "><span class='text-info'>" . $row->LKP_NAME . "</span></td>";

                    } else {
                        //echo "<td>&nbsp;</td>"; # insert empty cell
                    }
                    $Credit += $row->CREDIT;
                    ?>
                            <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>" class="openCourseDetailsModal" title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "</b>&nbsp;: " . $row->COURSE_TITLE . "<br>"; ?></a></td>
                        <?php echo "<td>$row->CREDIT</td>";

                    ?>
                            <td>
                                <?php
                    $pre = $this->db->query("SELECT ac.COURSE_CODE, ac.COURSE_ID
                                                            FROM aca_crs_prerequisite acp
                                                            LEFT JOIN aca_course ac on ac.COURSE_ID = acp.PRE_COURSE_ID
                                                            WHERE acp.COURSE_ID = $row->COURSE_ID AND acp.FACULTY_ID = $faculty AND acp.DEPT_ID = $dept AND acp.PROGRAM_ID = $program ")->result();
                    $count = sizeof($pre);
                    $i = 1;
                    foreach ($pre as $code) { ?>
                        <a data-action="course/courseDetails" course="<?php echo $code->COURSE_ID; ?>"
                           class="openCourseDetailsModal" title="Course Details"><?php echo $code->COURSE_CODE; ?></a>
                        <?php
                        if ($count == $i) {
                            echo '';
                        } else {
                            echo ', ';
                        }
                        $i++;
                    }
                    ?>
                            </td>
                        <?php
                    if ($current_semester != $row->LKP_NAME) {
                        $cre = $this->db->query("SELECT SUM(ac.CREDIT) Total_Credit FROM aca_semester_course a
                                            LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
                                            WHERE a.SEMESTER_ID = $row->SEMESTER_ID AND a.PROGRAM_ID = $row->PROGRAM_ID AND a.SESSION_ID = $row->SESSION_ID
                                            ORDER BY a.SEMESTER_ID")->result();
                        foreach ($cre as $semester_credit) {
                            $total_cr = $semester_credit->Total_Credit;
                        }

                        echo "<td rowspan=" . $c . "><span class='badge badge-primary'>" . $total_cr . "</span></td>";
                        $current_semester = $row->LKP_NAME;
                        $i++;
                    } else {
                        //echo "<td>&nbsp;</td>"; # insert empty cell
                    }

                    ?>
                        </tr>
                    <?php } ?>
                <tr class="alert alert-info">
                    <td></td>
                    <td>Total Credits</td>
                    <td><span class="badge badge-primary"><?php echo $Credit; ?></span></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        <?php
        else:
            echo "<div class='alert alert-danger'> No Course Assign !! </div>";
        endif;
        ?>
    </div>
</div>
