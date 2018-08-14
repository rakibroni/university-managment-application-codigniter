<style>
    .select2-container {
        z-index: 999999;
    }

    .pop-width {
        width: 25% !important;
    }
</style>

<div class="block-flat">
    <form class="form-horizontal frmContent" id="Leave" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtLeaveId" value="<?php echo $leave_info->LEAVE_ID; ?>"/>
            <?php
        }
        ?>

        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-4 control-label">Leave From<span
                class="text-danger">*</span>
            </label>
            <div class="col-md-6">
                <input type="text" name="start_date" class="form-control datepicker required" value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($leave_info->LEAVE_FORM))  : '' ?>">
            <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        
        <div class="form-group">
        <label class="col-lg-4 control-label">Leave To<span
            class="text-danger">*</span>
        </label>
        <div class="col-md-6">
            <input type="text" name="end_date" class="form-control datepicker required" value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($leave_info->LEAVE_TO))  : '' ?>">
        <span class="validation"></span>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
            <label class="col-md-4 control-label">Leave Reason<span
        class="text-danger">*</span></label>

            <div class="col-md-6">
                <textarea class="col-md-12 required"
                          name="leave_reason"><?php echo ($ac_type == 2) ? $leave_info->LEAVE_REASON : ''; ?></textarea>
                <span class="validation"></span>
            </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
            <label class="col-lg-4 control-label">Emergency Contact<span
        class="text-danger">*</span></label>

        <div class="col-lg-6">
            <input type="text" id="emr_contact" name="emr_contact"
                value="<?php echo ($ac_type == 2) ? $leave_info->EMR_CONTACT : '' ?>" class="form-control required"
                placeholder="Emergency Contact">
            <span class="validation"></span>
            <!-- <span class="help-block m-b-none">Example:- </span> -->
        </div>
    </div>
    <div class="hr-line-dashed"></div>

    <div class="form-group">
            <label class="col-md-4 control-label">Address During Leave<span
        class="text-danger">*</span></label>

            <div class="col-md-6">
                <textarea class="col-md-12 required"
                          name="leave_address"><?php echo ($ac_type == 2) ? $leave_info->ADDRESS_DURING_LEAVE : ''; ?></textarea>
                <span class="validation"></span>
            </div>
    </div>

    <div class="hr-line-dashed"></div>

 <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
             <table id="myTable" class="table order-list">
                <thead>

                </thead>
                <tbody>
                    <tr class="info">
                        <td>Leave Type</td>
                        <td>Days</td>             
                        <td class="text-center">Action</td>
                    </tr>
                    <tr>
                        <td class="col-sm-5">
                            <!-- <input type="text" name="name" class="form-control" /> -->
                            <select class="Type_dropdown form-control required" name="TYPE_NAME[]" id="TYPE_NAME"
                            data-tags="true" data-placeholder="Select Leave Type" data-allow-clear="true" required="required">
                            <option value="">-Select-</option>
                            <?php
                            foreach ($leaveType as $row):
                                ?>
                                <option value="<?php echo $row->LEAVE_TYPE_ID ?>"><?php echo $row->TYPE_NAME; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </td>
                    <td class="col-sm-3">
                        <input type="text" style="text-align:center;" name="TOTAL_DAYS[]"  class="form-control" required="required" />
                    </td>

                    <td class="col-sm-3 text-center">
                        <button  class="btn btn-success btn-xs" id="addLeaveTypeRow" title="Add More" type="button"><i class="glyphicon glyphicon-plus"></i></button>                            
                    </td>

                </tr>
            </tbody>

        </table>
    </div>
</div>
</div>


        <!-- <div class="form-group">
            <label class="col-lg-4 control-label">Leave Type<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="Leave_Type_dropdown form-control required" name="Leave_TYPE_ID" id="Leave_TYPE_ID"
                        data-tags="true" data-placeholder="Select Leave Type" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        foreach ($Leave_type as $row):
                            ?>
                            <option
                                value="<?php echo $row->LKP_ID ?>" <?php echo ($leave_info->Leave_TYPE == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME; ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Leave Type</option>
                        <?php
                        foreach ($Leave_type as $row):
                            ?>
                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div> -->

        


        <!-- <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-md-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $leave_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($leave_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">Click on checkbox for active status.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div> -->
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-10">
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="teacher/updateLeave"
                           data-su-action="teacher/leaveById" value="Update">
                
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="teacher/createLeaveRequest"
                           data-su-action="teacher/leaveList" data-type="list" value="Submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>

    </form>
</div>


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);


    });
    $(".select2DropdownMulti").select2({
        tags: true
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;

        $("#addLeaveTypeRow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td><select required="required" class="form-control" name="TYPE_NAME[]" id="TYPE_NAME' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($leaveType as $row) { ?>
                '<option value="<?php echo $row->LEAVE_TYPE_ID ?>"><?php echo $row->TYPE_NAME; ?></option>' +
                <?php } ?>
                '</select> </td>';
                cols += '<td><input required="required" type="text" style="text-align:center;" class="form-control" name="TOTAL_DAYS[]" id="TOTAL_DAYS' + counter + '"/></td>';
                cols += '<td class="text-center"><button class="btn btn-danger btn-xs ibtnDel" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });

        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });


    });



    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();

    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $("table.order-list").find('input[name^="price"]').each(function () {
            grandTotal += +$(this).val();
        });
        $("#grandtotal").text(grandTotal.toFixed(2));
    }
</script>

