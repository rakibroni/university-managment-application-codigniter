<h3>Courses List</h3>
<div class="wrapper wrapper-content animated fadeInRight">

    <?php
    /*echo "<pre>";
    print_r($courses);
    exit();*/
    ?>
    <div class="table-responsive">
        <?php if (!empty($courses)): ?>
            <table class="table table-striped table-bordered table-hover gridTable ">
                <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Title</th>
                    <th></th>
                    <th>Category</th>
                    <th>Credit</th>
                    <th>Duration</th>
                    <th>Min Credit Limit</th>
                    <th>Prerequisite</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($courses as $row) { ?>
                    <tr class="gradeX" id="row_<?php echo $row->COURSE_ID; ?>">

                        <td><span class="hidden" id="loader_<?php echo $row->COURSE_ID; ?>"></span><input
                                type="checkbox" class="check" id="course_id" name="course_id[]"
                                value="<?php echo $row->COURSE_ID; ?>"></td>
                        <?php if ($row->GLOBAL_FOR_INSTITUTE == 1) { ?>
                            <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                                   class="openCourseDetailsModal"
                                   title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b><br><i>Type: Global For Institute</i>"; ?>
                            </td>
                        <?php } else if ($row->GLOBAL_FOR_FACULTY == 1) { ?>
                            <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                                   class="openCourseDetailsModal"
                                   title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b><br><i>Type: Global For Faculty</i>"; ?>
                            </td>
                        <?php } else { ?>
                            <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                                   class="openCourseDetailsModal"
                                   title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b>"; ?>
                            </td>
                        <?php } ?>
                        <td><span><i class="fa fa-square" style="color: <?php echo $row->CAT_COLOR; ?>"></i></span></td>
                        <td>
                            <?php echo form_dropdown("cmbCategory$row->COURSE_ID", $category, $row->C_CAT_ID, "class='form-control'  nameid='cmbCategory' id ='course_id_$row->COURSE_ID'") ?>
                        </td>
                        <td><?php echo $row->CREDIT; ?></td>
                        <td style="width: 86px;"><input type="number" data-placement="left" data-toggle="tooltip"
                                                        title="Duration minimum 30 min" min="30" max="300" step="5"
                                                        name="duration<?php echo $row->COURSE_ID; ?>"
                                                        data-duration="duration_<?php echo $row->COURSE_ID; ?>"
                                                        style="width: 55px;"
                                                        id="course_du_<?php echo $row->COURSE_ID; ?>"><span>min*</span>
                        </td>
                        <td><input type="text" name="minCredit<?php echo $row->COURSE_ID; ?>" size="5px"></td>
                        <td>
                            <?php
                            $counter = $this->db->query("SELECT count(actp.COURSE_ID) as counter FROM aca_crs_temp_prerequisite actp WHERE actp.FACULTY_ID = $faculty AND actp.PROGRAM_ID = $program AND actp.DEPT_ID = $department AND actp.COURSE_ID = $row->COURSE_ID")->result();
                            foreach ($counter as $key => $value) {
                                if ($value->counter) {
                                    ?>
                                    <a class="label label-primary openBigModal"
                                       id="prequisite_<?php echo $row->COURSE_ID; ?>" data-placement="left"
                                       data-toggle="tooltip" title="Add Prerequisite Course"
                                       data-action="course/coursePrerequisite/<?php echo $row->COURSE_ID; ?>/<?php echo $faculty; ?>/<?php echo $department; ?>/<?php echo $program; ?>"
                                       data-type="edit"><i class="fa fa-plus"></i>&nbsp; Prerequisite*</a>&nbsp;&nbsp;
                                    <span id="course_<?php echo $row->COURSE_ID; ?>"></span>
                                    <span id='course_count_<?php echo $row->COURSE_ID ?>'
                                          class='badge badge-danger'><?php echo $value->counter; ?></span>
                                <?php } else { ?>
                                    <a class="label label-default openBigModal"
                                       id="prequisite_<?php echo $row->COURSE_ID; ?>" data-placement="left"
                                       data-toggle="tooltip" title="Add Prerequisite Course"
                                       data-action="course/coursePrerequisite/<?php echo $row->COURSE_ID; ?>/<?php echo $faculty; ?>/<?php echo $department; ?>/<?php echo $program; ?>"
                                       data-type="edit"><i class="fa fa-plus"></i>&nbsp; Prerequisite*</a>&nbsp;&nbsp;
                                    <span id="course_<?php echo $row->COURSE_ID; ?>"></span>
                                <?php
                                }
                            }
                            ?>
                        </td>

                    </tr>
                    <?php
                    $i++;
                } ?>
                </tbody>
            </table>
            <!-- <div class="form-inline">
                <div class="form-group">
                    <label for="totalSemester">Total Semester *</label> &nbsp;
                    <input id="totalSemester" name="totalSemester" class="form-control required" type="number" placeholder="Total semester" min="1" max="16" style="width: 120px;">
                    <span class="validation"></span>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-group">
                    <label for="totalDuration">Total Duration *</label>&nbsp;
                    <input id="totalDuration" name="totalDuration" class="form-control required" type="number" placeholder="Total Year" min="2" max="8" style="width: 120px;">&nbsp;<span>Years</span>
                    <span class="validation"></span>
                </div>
            </div> -->
            <div class="col-lg-offset-2 ">
                <span class="modal_msg pull-left"></span>
                <span title="Course Offer" id="btnSubmit" class="btn btn-primary btn-sm">submit</span>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">

            </div>
            <hr>
            <div class="row">
                <ul class="small-list" style="list-style:none;">
                    <?php foreach ($courseCat as $color): ?>
                        <span data-placement="top" data-toggle="tooltip" title="<?php echo $color->CAT_DESC; ?>"><i
                                class="fa fa-square" style="color: <?php echo $color->CAT_COLOR; ?>"></i><span
                                class="m-l-xs">&nbsp;&nbsp;<strong><?php echo $color->CAT_NAME; ?></strong></span>
                        </span>&nbsp;&nbsp;

                    <?php endforeach; ?>
                </ul>
            </div>
        <?php
        else:?>
        <a data-placement="top"
    data-toggle="tooltip"
    data-action="course/courseOfferAdd"
    offerType="<?php echo $offer_type; ?>"
    faculty="<?php echo $faculty; ?>"
    dept="<?php echo $department; ?>"
    program="<?php echo $program; ?>"
    data-title="Create course offer"
    class="btn btn-primary btn-sm pull-right openOfferModal">
    Add New </a>
        <?php
            echo "<div class='alert alert-danger'> No Course Found </div>";
        endif;
        ?>
    </div>
</div>
<style>
    .course {
        /* position:absolute; */
    }

    .crsDescription {
        display: none;
        position: absolute;
        border: 1px solid #000;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
