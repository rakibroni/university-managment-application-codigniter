<div class="table-responsive">
    <?php
    /*$pre_courseId[] = '';
    foreach ($prerequises as $key => $value) {
         $pre_courseId[$key] = $value->PRE_COURSE_ID;
     }*/
    // echo '<pre>';
    // print_r($prerequises);
    // exit();
     ?>
     <?php if (!empty($courses)): ?>
        <form id="txtPrequisite">
            <table class="table table-striped table-bordered table-hover gridTable  nowrap" cellspacing="0">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th><input type="checkbox" id="PreqCheckAll"></th>
                        <th>Title</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
                 $pre_courses_arr = array();
                 foreach ($pre_courses as $pre_courses_row) {                    
                    array_push($pre_courses_arr, $pre_courses_row->PRE_COURSE_ID);
                }

                $sl=1; foreach ($courses as $row) { 

                    $checked = (in_array($row->COURSE_ID, $pre_courses_arr) ? "checked='checked'" : "");
                    ?>
                    <tr>
                        <td><?php echo $sl++ ?></td>
                        <td><input type="checkbox" value="<?php echo $row->COURSE_ID ?>" name="PRE_COURSE_ID[]" class="checkPrequisit" <?php echo  $checked ?> ></td>
                        <td><?php echo $row->COURSE_TITLE ?></td>
                        <td><?php echo $row->CREDIT ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr>
            <div class="row">

                <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>">
                <input type="hidden" id="program" name="program" value="<?php echo $program; ?>">   
                <input type="hidden" id="offer_type" name="offer_type" value="<?php echo $offer_type; ?>">   
                <span title="Add Prerequisite" id="btnPrerequisite" class="btn btn-primary btn-sm">Add Course</span>
                <input type="reset" class="btn btn-default btn-sm" value="Reset"><span class="frmMsg"></span>
            </div>

        </form>
        <?php
        else:
            echo "<div class='alert alert-danger'> No Course Found </div>";
        endif;
        ?>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".gridTable").dataTable();
        });
        $("#PreqCheckAll").click(function () {
            $(".checkPrequisit").prop('checked', $(this).prop('checked')); 
        });
    </script>
    <style>
        .commonCourseModal {
            z-index: 99999999 !important;
        }
    </style>