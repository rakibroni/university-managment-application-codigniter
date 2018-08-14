<div class="wrapper wrapper-content animated fadeInRight g">
    <div class="row">
        <div class="col-md-12 text-center wow fadeInRight animated"
             style="visibility: visible; animation-name: fadeInRight; top:-30px;">
            <?php
            foreach ($course_offer as $row) {
                $faculty_id = $row->FACULTY_ID;
                $faculty_name = $row->FACULTY_NAME;
                $dept_id = $row->DEPT_ID;
                $dept_name = $row->DEPT_NAME;
                $program_id = $row->PROGRAM_ID;
                $progrm_name = $row->PROGRAM_NAME;
                $course_id = $row->COURSE_ID;
                $offered_course_id = $row->OFFERED_COURSE_ID;
            }
            ?>
            <h2>Faculty of <?php echo $row->FACULTY_NAME; ?></h2>
            <h3>Department of <?php echo $row->DEPT_NAME; ?></h3>
            <h4><?php echo $row->PROGRAM_NAME; ?></h4>
        </div>
        <form id="frmCourseOffer">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <strong>Course List </strong>
                    <span class="loadingImg"></span>
                </div>
                <div class="ibox-content" id="courseViews">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Prerequisite</th>
                            <th></th>
                            <th>Category</th>
                            <th>Credit</th>
                            <th>Duration</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        $credit = 0;
                        foreach ($course_offer as $row) { ?>
                            <tr class="gradeX" id="field_<?php echo $row->OFFERED_COURSE_ID; ?>">
                                <td><?php echo $i++;?></td>
                                <td><span class="hidden"
                                          id="courseLoad_<?php echo $row->OFFERED_COURSE_ID; ?>"></span><a
                                        data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                                        class="openCourseDetailsModal"
                                        title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "</b>&nbsp;: " . $row->COURSE_TITLE . "<br>"; ?></a>
                                </td>
                                <td>
                                    <?php
                                    $preC = $this->db->query("SELECT COUNT(CRS_PREREQUISITE_ID) as counter
                                                            FROM aca_crs_prerequisite
                                                            WHERE COURSE_ID = $row->COURSE_ID AND FACULTY_ID = $faculty_id AND DEPT_ID = $dept_id AND PROGRAM_ID = $program_id ")->result();
                                    foreach ($preC as $count) { ?>
                                        <a title="Prerequisite Course List "
                                           class="badge badge-primary openPrerequisiteModal"
                                           data-action="course/prerequisiteList" course="<?php echo $row->COURSE_ID; ?>"
                                           program="<?php echo $program_id; ?>" dept="<?php echo $dept_id; ?>"
                                           faculty="<?php echo $faculty_id; ?>"><?php echo $count->counter; ?></a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><span><i class="fa fa-square"
                                             style="color: <?php echo $row->CAT_COLOR; ?>"></i></span></td>
                                <td><?php echo $row->CAT_NAME; ?></td>
                                <td><span class="credit"><?php echo $row->CREDIT; ?></span></td>
                                <td><?php echo $row->CRS_DURATION; ?> min</td>
                                <?php $credit += $row->CREDIT; ?>
                                <td><a class="label label-danger deleteCourseOffered"
                                       id="<?php echo $row->OFFERED_COURSE_ID; ?>" data-type="delete"
                                       data-field="OFFERED_COURSE_ID" data-tbl="aca_course_offer"><i class="fa fa-times"></i></a></td>
                            </tr>
                        <?php } ?>
                        <tr class="alert alert-info">
                            <td></td>
                            <td colspan="4">Total Credit</td>
                            <td><span class="badge badge-primary totalCredit"><?php echo $credit; ?></span> <span
                                    id="newSum"></span></td>
                            <td colspan="2"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <ul class="small-list" style="list-style:none;">
                            <?php foreach ($courseCat as $color): ?>
                                <span data-placement="top" data-toggle="tooltip"
                                      title="<?php echo $color->CAT_DESC; ?>"><i class="fa fa-square"
                                                                                 style="color: <?php echo $color->CAT_COLOR; ?>"></i><span
                                        class="m-l-xs">&nbsp;&nbsp;<strong><?php echo $color->CAT_NAME; ?></strong></span>
                                </span>&nbsp;&nbsp;
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
