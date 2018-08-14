<style>
    .table td {
        padding: 3px !important;
    }

    .modal-dialog {
        left: 0% !important;

    }

</style>
<div class="col-md-12">
    <div class="widget-main">
        <div class="widget-inner shortcode-typo">
            <div class="row">
                <div style="text-align: center">
                    <?php foreach ($info as $row): ?>
                        <h3>Faculty of <?php echo $row->FACULTY_NAME; ?></h3>
                        <h5>Department of <?php echo $row->DEPT_NAME; ?></h5>
                        <h6><?php echo $row->PROGRAM_NAME; ?></h6>
                        <h6><?php echo $row->DEGREE_NAME; ?></h6>
                        <?php
                        $faculty = $row->FACULTY_ID;
                        $dept = $row->DEPT_ID;
                        $program = $row->PROGRAM_ID;
                        ?>
                    <?php endforeach; ?>
                </div>

                <center>
                    <?php if (!empty($courses)): ?>
                        <table class="table table-striped table-bordered" style="width: 70% !important;">
                            <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Title</th>
                                <th>Credit</th>
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
                                                            WHERE a.SEMESTER_ID = $row->SEMESTER_ID AND a.PROGRAM_ID = $row->PROGRAM_ID
                                                            ORDER BY a.SEMESTER_ID")->result();
                                    foreach ($cc as $count) {
                                        $c = $count->count_c;
                                    }
                                    echo "<td rowspan=" . $c . "><span class='text-info' >" . $row->LKP_NAME . "</span></td>";

                                } else {
                                    //echo "<td>&nbsp;</td>"; # insert empty cell
                                }
                                $Credit += $row->CREDIT;
                                ?>
                            <td><a data-action="portal/courseDetails" course="<?php echo $row->COURSE_ID; ?>" class="openCourseDetailsModal" title="Course Details" data-toggle="modal" data-target="#myModal"><?php echo "<b>" . $row->COURSE_CODE . "</b>&nbsp;: " . $row->COURSE_TITLE . "<br>"; ?></a></td>
                        <?php echo "<td>$row->CREDIT</td>";

                                ?>

                                <?php
                                if ($current_semester != $row->LKP_NAME) {
                                    $cre = $this->db->query("SELECT SUM(ac.CREDIT) Total_Credit FROM aca_semester_course a
                                                                    LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
                                                                    WHERE a.SEMESTER_ID = $row->SEMESTER_ID AND a.PROGRAM_ID = $row->PROGRAM_ID
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
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary">Apply Now</button>

                    <?php
                    else:
                        echo "<div class='alert alert-danger'> No Course Assign !! </div>";
                    endif;
                    ?>
                </center>


            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Course Details</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.openCourseDetailsModal', function () {
            var url = $(this).attr('data-action'),
                course_id = $(this).attr('course');

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>' + url,
                data: {course_id: course_id},
                success: function (data) {
                    if (data) {
                        $('.modal-body').html(data);
                    }
                }
            });
        });
    });
</script>