
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student List </h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Roll No.</th>
                            <th>Password</th>
                            <th>Father</th>
                            <th>Mother</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Password Given</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sl = 0;
                        foreach ($students as $row):$sl++;
                            ?>
                            <tr id="row_<?php echo $row->STUDENT_ID?>"
                                style="background-color: <?php if ($row->PS_GVN_FG == 1) {
                                    echo "lightgoldenrodyellow";
                                } else {
                                    echo "";
                                }?>">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $row->FULL_NAME_EN ?></td>
                                <td><?php echo $row->ROLL_NO ?></td>
                                <td><?php echo $row->PASSWORD ?></td>
                                <td><?php echo $row->FATHER_NAME ?></td>
                                <td><?php echo $row->MOTHER_NAME ?></td>
                                <td><?php echo $row->CONTACTS ?></td>
                                <td><?php echo $row->DEPARTMENT ?></td>
                                <td><?php echo $row->SESSION ?></td>
                                <td><?php echo $row->SEMESTER ?></td>
                                <td>
                                    <button student-id="<?php echo $row->STUDENT_ID?>" type="button"
                                            class="fg_cng btn btn-xs btn-warning "><i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-xs btn-danger delete_row_data"
                                            attribute_id="<?php echo $row->STUDENT_ID ?>" attribute="STUDENT_ID"
                                            table_name="students_info"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

<script>
    $(document).ready(function () {
        $(".fg_cng").on('click', function () {
            if (confirm("Are You Sure?")) {
                var student_id = $(this).attr("student-id");
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url();?>admin/updateStuPasGvn',
                    data: {student_id: student_id},
                    success: function (data) {
                        if (data == 'Y') {
                            $('#row_' + student_id).css("background-color", "lightgoldenrodyellow")
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });

    $(document).on('click', '.delete_row_data', function () {
        if (confirm("Are you sure?")) {
            var attribute_id = $(this).attr('attribute_id'),
                attribute = $(this).attr('attribute'),
                table_name = $(this).attr('table_name');


            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/delRowData',
                data: {
                    attribute_id: attribute_id,
                    attribute: attribute,
                    table_name: table_name
                },
                success: function (data) {
                    if (data == 'Y') {
                        $('#row_' + attribute_id).remove();

                    }
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/delStuContact',
                data: {
                    attribute_id: attribute_id
                }

            });

        }

    });
</script>
    