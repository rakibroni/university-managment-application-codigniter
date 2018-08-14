<div class="wrapper wrapper-content animated fadeInRight">
    <form class="form-horizontal frmContent" id="course_offer" method="post">
        <span class="frmMsg"></span>

        <div class="row">

            <div class="row">
                <div class="col-md-12 text-center wow fadeInRight animated"
                     style="visibility: visible; animation-name: fadeInRight; top:-30px;">

                    <h2>Faculty of <?php echo $faculty->FACULTY_NAME; ?></h2>

                    <h3>Department of <?php echo $department->DEPT_NAME; ?></h3>
                    <h4><?php echo $program->PROGRAM_NAME; ?></h4>
                    <h5>
                        <?php
                        foreach ($degree as $deg) {
                            echo $deg->DEGREE_NAME;
                        }
                        ?>
                    </h5>

                    <p>Session: <?php echo $session->SESSION_NAME . " (" . $session->YEAR_SETUP_TITLE . ")"; ?>
                        <input type="hidden" name="session" value="<?php echo $session->SES_YEAR_ID; ?>"/>
                    </p>

                    <p>
                        <?php echo $semester->LKP_NAME; ?>
                        <input type="hidden" name="semester" value="<?php echo $semester->LKP_ID; ?>"/>
                    </p>
                    <input type="hidden" name="faculty" value="<?php echo $faculty->FACULTY_ID; ?>"/>
                    <input type="hidden" name="department" value="<?php echo $department->DEPT_ID; ?>"/>
                    <input type="hidden" name="program" value="<?php echo $program->PROGRAM_ID; ?>"/>
                </div>

            </div>
            <div class="col-lg-12">
                <?php //print_r($sequenceNo); ?>
                <div class="table-responsive">
                    <table class="table table-hover issue-tracker gridTable">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Credit</th>
                            <th>Sequence</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sn = 1;
                        $i = 0;
                        $credit = 0;
                        ?>
                        <?php
                        foreach ($chkCourses as $row) {
                            $course = $this->db->query("SELECT c.* FROM aca_course c WHERE c.COURSE_ID = $row")->row();
                            ?>
                            <tr>
                                <input type="hidden" name="course_id[]" value="<?php echo $course->COURSE_ID; ?>"/>
                                <input type="hidden" name="sequence[]" value="<?php echo $sequenceNo[$i]; ?>"/>
                                <td><?php echo $sn++; ?></td>
                                <td>
                                    <a data-action="course/courseDetails" course="<?php echo $course->COURSE_ID; ?>"
                                       class="openCourseDetailsModal"
                                       title="Course Details"><?php echo "<b>" . $course->COURSE_CODE . "</b>&nbsp;: " . $course->COURSE_TITLE . "<br>"; ?></a>
                                </td>
                                <td>
                                    <span><?php echo $course->CREDIT; ?></span>
                                    <?php
                                    $credit += $course->CREDIT;
                                    ?>
                                </td>
                                <td><?php echo $sequenceNo[$i]; ?></td>
                                <?php $i++; ?>
                            </tr>
                        <?php } ?>
                        <tr class="alert alert-info">
                            <td></td>
                            <td></td>
                            <td>Total Credit</td>
                            <td><span class="badge badge-primary"><?php echo $credit; ?></span></td>
                            <td></td>

                        </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
            </div>
            <br clear="all"/>
        </div>
        <div class="col-lg-offset-4 col-lg-10">
            <span class="modal_msg pull-left"></span>
            <input type="button" class="btn btn-primary btn-sm PreviewSubmit" Title="Message"
                   data-action="course/createSemesterCourse" value="submit">
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </form>
</div>
