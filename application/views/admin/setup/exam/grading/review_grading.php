<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th ><input type="checkbox" id="checkAll"></th>
        <th>REGISTRATION NO</th>
        <th>NAME</th>
        <th>MOBILE</th>
        <th>PASSWORD</th>
        <th class="text-center">ACTION</th>

    </tr>
    </thead>
    <tbody id="approveApplicant" class="searchApplicant">
    <?php
    $sn = 1;
    foreach ($existing_student as $row):
        ?>
        <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">

            <td><input value="<?php echo $row->STUDENT_ID ?>" type="checkbox"
                       name="STUDENT_ID[]" class="STUDENT_ID"></td>
            <td><?php echo $row->REGISTRATION_NO ?></td>
            <td>
                <a class="pull-left student_details" type="button"
                   data-user-id="<?php echo $row->STUDENT_ID ?>" data-toggle="modal"
                   data-target="#applicant_modal">
                    <?php echo $row->FULL_NAME_EN ?>
                </a>
            </td>

            <td><?php echo $row->MOBILE_NO ?></td>

            <td><?php echo $row->LOGIN_PASSWORD ?></td>

            <td class="text-center">
                <a class="label label-default student_details" type="button"
                   data-user-id="<?php echo $row->STUDENT_ID ?>" data-toggle="modal"
                   data-target="#applicant_modal">
                    <i class="fa fa-pencil"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<script type="text/javascript">
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
</script>
