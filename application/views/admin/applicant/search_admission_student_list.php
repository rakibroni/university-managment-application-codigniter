<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>Roll</th>
        <th>Name</th>
        <th>Session</th>
        <th>Department</th>
        <th>Program</th>
        <th>Mobile No.</th>
    </tr>
    </thead>
    <tbody id="approveApplicant" class="searchApplicant">
    <?php
    $sn = 1;
    foreach ($applicant as $row):
        ?>
        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>">

            <td><?php echo $row->ADM_ROLL_NO ?></td>
            <td>
                <a class="pull-left applicant_details" type="button"
                   data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
                   data-target="#applicant_modal">
                    <?php echo $row->FULL_NAME_EN ?>
                </a>
            </td>
            <td><?php echo $this->utilities->admissionSessionById($row->ADM_SESSION_ID)->SESSION_NAME ?></td>
            <td>
                <?php echo $row->DEPT_NAME ?>
            </td>
            <td><?php echo $row->PROGRAM_NAME ?></td>
            <td><?php echo $row->MOBILE_NO ?>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
</script>

