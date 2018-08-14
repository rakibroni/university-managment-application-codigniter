<div class="wrapper wrapper-content animated fadeInRight">
    <div class="table-responsive">
        <div class="ibox-tools">
            <input type="button" class="btn btn-primary btn-sm formOfferapprov"
                   data-action="academic/CourseAcademicPreview" data-su-action="academic/index" value="Approved">

        </div>
        <table class="table table-striped table-bordered table-hover gridTable">
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Student Name</th>
                <th>Roll</th>
                <th>Faculty</th>
                <th>Department</th>
                <th>Program</th>
                <th>Semester</th>
                <th>Course Name</th>
                <!--th>Action</th-->
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($srcAcademy)):
                foreach ($srcAcademy as $row):
                    ?>
                    <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">

                        <td><input type="checkbox" class="form-control required check" name="studentId[]"
                                   value="<?php echo $row->STU_CRS_ID; ?>"></td>
                        <td><?php echo $row->FULL_NAME_EN; ?></td>
                        <td><?php echo $row->ROLL_NO; ?></td>
                        <td><?php echo $row->FACULTY_NAME; ?></td>
                        <td><?php echo $row->DEPT_NAME; ?></td>
                        <td><?php echo $row->PROGRAM_NAME; ?></td>
                        <td><?php echo $row->LKP_NAME; ?></td>
                        <td><?php echo $row->COURSE_TITLE; ?></td>

                        <!--td>
                                <!--a class="label label-info openBigModal" id="<?php echo $row->STUDENT_ID; ?>" data-action="" data-type="edit" title="View Accademy Information"><i class="fa fa-eye"></i></a-->
                        <!--a class="label label-default openModal " id="<?php echo $row->STUDENT_ID; ?>" data-action="" data-type="edit" title="Update Accademy Information" ><i class="fa fa-pencil"></i></a-->
                        <!--a class="label label-danger deleteItem" id="<?php echo $row->STUDENT_ID; ?>" data-action="" data-type="delete" data-field="STUDENT_ID" data-tbl=""><i class="fa fa-times"></i></a-->
                        </td-->


                    </tr>
                <?php
                endforeach;
            endif;
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Roll</th>
                <th>Faculty</th>
                <th>Department</th>
                <th>Program</th>
                <th>Semester</th>
                <th>Course</th>
                <!--th>Action</th-->
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




