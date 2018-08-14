<?php if(empty($applicant)){ echo "Sorry no applicant found !";}else{ ?>
<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
        <tr>
            <th>Roll</th>
            <th>Name</th>
            <th>Remark</th>
            <th>Status</th>
            <th>Date</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sn = 1;
        foreach ($applicant as $row):
            ?>
        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>" >
            <td ><?php echo $row->ADM_ROLL_NO ?></td>
            <td >
               <a class="pull-left applicant_details"    type="button"
               data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
               data-target="#applicant_modal">
               <?php echo $row->FULL_NAME_EN ?>
           </a>
       </td>
       <td><?php echo $row->ELIGIBLE_ADM_REMARKS ?></td>
       <td>
        <?php
        if($row->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS == '1')
            echo "<span style='color: green;'>Approved</span>";
        else if($row->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS == '0')
            echo "<span style='color: red;'>Rejected</span>";
        else
            echo "";
        ?>
    </td>
    <td><?php echo $row->ELIGIBLE_ADDMISSION_DEPT_DT ?></td>
    <td class="text-center">
        <a class="label label-primary applicantApprove" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Approved">Approve</a> ||  <a class="label label-danger applicantReject" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Reject">Reject</a>
        <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span> 
    </td>
</tr>
<?php  endforeach;  ?>
</tbody>
</table>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
</script>
