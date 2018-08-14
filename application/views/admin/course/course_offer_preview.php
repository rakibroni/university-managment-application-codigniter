<?php
//if(!empty($CheckCourseOffered)) /* check the  condition course offered already exit or not */
//    echo "<span class = 'alert alert-danger alert-dismissable'> Course Offered of <strong>".$program->PROGRAM_NAME." </strong> Already Exit </span>";
//else{

?>
<div class="wrapper wrapper-content animated fadeInRight">
    <form class="form-horizontal frmContent" id="course_offer" method="post">
        <span class="frmMsg"></span>

        <div class="row">
            <div class="col-md-12 text-center wow fadeInRight animated"
                 style="visibility: visible; animation-name: fadeInRight; top:-30px;">

                <h2>Faculty of <?php echo $faculty->FACULTY_NAME; ?></h2>

                <h3>Department of <?php echo $department->DEPT_NAME; ?></h3>
                <h4><?php echo $program->PROGRAM_NAME; ?></h4>
                <h4>
                    <?php
                    foreach ($degree as $deg) {
                        echo $deg->DEGREE_NAME;
                    }
                    ?>
                </h4>

                <p><?php
                    if ($OfferType == "F")
                        echo "Fixed Credit";
                    else
                        echo "Open Credit";
                    ?>
                </p>
                <input type="hidden" name="faculty" value="<?php echo $faculty->FACULTY_ID; ?>"/>
                <input type="hidden" name="department" value="<?php echo $department->DEPT_ID; ?>"/>
                <input type="hidden" name="program" value="<?php echo $program->PROGRAM_ID; ?>"/>
                <input type="hidden" name="offerType" value="<?php echo $OfferType; ?>"/>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover gridTable ">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Credit</th>
                            <th>Duration</th>
                            <th>Min Credit</th>
                            <th>Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sn = 1;
                        $i = 0;
                        $credit = 0;
                        $id = 100; ?>
                        <?php foreach ($chkCourses as $row) {
                            $course = $this->db->query("SELECT c.* FROM aca_course c WHERE c.COURSE_ID = $row")->row();
                            $id = $category[$i];
                            $categorys = $this->db->query("SELECT cc.* FROM aca_course_category cc WHERE cc.C_CAT_ID = $id ")->row();

                            ?>
                            <tr>
                                <!-- <input type="hidden" name="totalSemester" value="<?php echo $totalSemester; ?>" />
                                        <input type="hidden" name="totalDuration" value="<?php echo $totalDuration; ?>" /> -->
                                <input type="hidden" id="CatId" name="category[]" value="<?php echo $id; ?>"/>
                                <input type="hidden" id="CrsDuration" name="CrsDuration[]"
                                       value="<?php echo $duration[$i]; ?>"/>
                                <input type="hidden" id="CrsMinCredit" name="CrsMinCredit[]"
                                       value="<?php echo $minCredit[$i]; ?>"/>
                                <input type="hidden" id="courseId" name="courseId[]"
                                       value="<?php echo $course->COURSE_ID; ?>"/>
                                <td><?php echo $sn++; ?></td>
                                <td>
                                    <a data-action="course/courseDetails" course="<?php echo $course->COURSE_ID; ?>"
                                       class="openCourseDetailsModal"
                                       title="Course Details"><?php echo "<b>" . $course->COURSE_CODE . "</b>&nbsp;: " . $course->COURSE_TITLE . "<br>"; ?></a>
                                    <?php
                                    $cc = $this->db->query("SELECT ac.COURSE_TITLE
                                                                        FROM aca_crs_temp_prerequisite actp
                                                                        LEFT JOIN aca_course ac on ac.COURSE_ID = actp.PRE_COURSE_ID
                                                                        WHERE actp.COURSE_ID = $course->COURSE_ID")->result();
                                    $count = sizeof($cc);
                                    $j = 1;
                                    if ($count) {
                                        echo "<i><b>Prerequisite: </b></i>";
                                        foreach ($cc as $row):
                                            echo "<i>" . $row->COURSE_TITLE . "</i>";
                                            if ($count == $j) {
                                                echo '.';
                                            } else {
                                                echo ', ';
                                            }
                                            $j++;
                                        endforeach;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <span><?php echo $course->CREDIT; ?></span>
                                    <?php
                                    $credit += $course->CREDIT;
                                    ?>
                                </td>
                                <td><?php echo $duration[$i] ?>&nbsp; min</td>
                                <td><?php echo $minCredit[$i] ?></td>
                                <td>
                                            <span><i class="fa fa-square"
                                                     style="color: <?php echo $categorys->CAT_COLOR; ?>"></i>
                                                <?php echo $categorys->CAT_NAME; ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        } ?>
                        <tr class="alert alert-info">
                            <td></td>
                            <td colspan="1">Total Credit</td>
                            <td><span class="badge badge-primary"><?php echo $credit; ?></span></td>
                            <td colspan="3"></td>

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
            <input type="button" Title="Success Message" class="btn btn-primary btn-sm PreviewSubmit"
                   data-action="Course/courseOfferCreate" value="submit">
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </form>
</div>
<?php //}  ?>