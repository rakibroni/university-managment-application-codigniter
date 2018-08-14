<?php if ($previlages->READ == 1) { ?>
<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Dept & Designation</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($emp_list)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($emp_list as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->EMP_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="courseLoad_<?php echo $row->EMP_ID; ?>"></span>
                </td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                    <?php $photo=($row->EMP_IMG !='')? "upload/employee/photo/".$row->EMP_IMG : 'assets/img/default.png' ?>


                    <a class="pull-left applicant_details"    type="button"
                    data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                    data-target="#applicant_modal">
                    <img class="img-circle" style="width: 30px; float: left" src="<?php echo base_url($photo); ?>" class="img-responsive" alt="">&nbsp;  <b><?php echo $row->FULL_ENAME; ?></b>
                    </a>

            </td>
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                <a class="pull-left applicant_details"    type="button"
                data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                data-target="#applicant_modal">
                <?php echo $row->MOBILE; ?>
            </a>

        </td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

            <a class="pull-left applicant_details"    type="button"
            data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
            data-target="#applicant_modal">
            <?php echo $row->EMAIL; ?>
        </a>

    </td>    
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>


    <b> DEPT :<?php echo $row->DEPT_NAME; ?> <br> DESIG : <?php echo $row->DESIGNATION; ?></b>


    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
                            <!-- <a class="label label-default openModal" id="<?php echo $row->EMP_ID; ?>"
                               title="Update Employee Information" data-action="employee/employeeFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a> -->
                               <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/employee/empFormUpdate/<?php echo $row->EMP_ID; ?>" ><i class="fa fa-pencil"></i></a>
                               <?php
                           }
                           if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->EMP_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="EMP_ID" data-tbl="hr_emp"><i
                               class="fa fa-times"></i></a>
                               <?php
                           }
                           if ($previlages->STATUS == 1) {
                            ?>
                            <a target="_blank" href="<?php echo base_url();?>/employee/employeeInfoPdf/<?php echo $row->EMP_ID ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> Print</a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>

                <th>Action</th>
            </tr>
        </tfoot>
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
                <h4 class="modal-title">Employee Details </h4>
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