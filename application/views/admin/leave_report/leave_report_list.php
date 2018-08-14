<?php if (1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Employee Name</th>
            <th width="25%">Mobile</th>
            <th width="40%">Email</th>
            <th class="col-md-1">Number of Days</th>
       
           
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($leave_report_list)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($leave_report_list as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->EMP_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->EMP_ID; ?>"></span>
                    </td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="pull-left applicant_details"    type="button"
                      data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                      data-target="#applicant_modal">
                    <?php echo $row->FULL_ENAME; ?></td>
                       <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->MOBILE; ?></td>
                          <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EMAIL; ?></td>
                           
                
                    <td class="text-center">
                    <b>
                        <a class=" leave_report "    type="button"
                      data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                      data-target="#applicant_modal">
                    <?php echo $row->NO_OF_DAYS; ?>
                      
               
                        </a>

                    </b>
                                         </td>
              
              
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
    </table>
    <?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>

<div class="modal inmodal fade" id="applicant_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Employee Details</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="applicant_modal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Employee Details</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(".applicant_details").on("click", function () {
        var EMP_ID = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo site_url()?>/employee/empModal',
            data: {EMP_ID: EMP_ID},
            success: function (data) {
                $("#applicant_modal .modal-body").html(data);
            }
        });
    });
</script>

<script type="text/javascript">
    $(".leave_report").on("click", function () {
        var EMP_ID = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo site_url()?>/employee/leaveReportsDetails',
            data: {EMP_ID: EMP_ID},
            success: function (data) {
                $("#applicant_modal .modal-body").html(data);
            }
        });
    });
</script>