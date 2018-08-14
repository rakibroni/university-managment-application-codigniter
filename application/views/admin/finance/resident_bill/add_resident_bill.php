<div class="block-flat">
    <form class="form-horizontal frmContent" id="faculty1" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" name="txtFacultyId" class="rowID" value="<?php echo $Resident->RESIDENT_BILL_ID; ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Academic Session<span class="text-danger">*</span></label>
            <div class="col-lg-7">
               
                     <select class="form-control required" name="SESSION_ID" id="SESSION_ID" required>
                        <option value="">--Select--</option>
                        <?php
                        foreach ($ins_session as $row):
                        ?>
                        <option value="<?php echo $row->YSESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                        <?php   endforeach;  ?>
                    </select>

                <span class="validation"></span>
            </div>
        </div>



        <div class="form-group"><label class="col-lg-4 control-label">Hostel</label>
            <div class="col-lg-7">
                
                    <select class="form-control required" name="RESEDENT_ID" id="RESEDENT_ID" >
                        <option value="">--Select--</option>
                        <?php foreach($resident_building as $row): ?>
                        <option value="<?php echo $row->BUILDING_ID ?>"><?php echo $row->BUILDING_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Billing Month</label>
            <div class="col-lg-7">
                <input id="datepicker" name="BILLING_MONTH" type="text" class="form-control" >   
            </div>
        </div>

        <div class="form-group">
            <table class="table table-bordered">
                <tr>
                    <td class="col-md-3">Title</td>
                    <td class="col-md-1 text-center">Rate</td>
                </tr>
                <?php foreach ($ac_charge_name as $row):?>
                <tr>
                    <input  value="<?php echo $row->AC_NO?>" type="hidden" class="checked" name="AC_NO[]">
                    <td>
                    <?php echo $row->AC_NAME ?>
                    </td>
                    <td>
                        <input type="text" id="AMOUNT" name="AMOUNT[]" class="form-control text-center" value="" placeholder="" required>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
      </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Finance/updateResidentBill"
                data-su-action="Finance/residentBillById" value="Update">
                <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Finance/createResidentBill"
                data-su-action="Finance/residentBillList" data-type="list" value="submit">
                <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
     <br>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>
<script>
    $(document).on('click', '.checkBoxOffice', function () {
        var office = ($(this).is(':checked')) ? 1 : 0;
        $("#ADMINISTRATION").val(office);
    });
</script>

<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
$("#datepicker").datepicker({
/*startDate: "date",*/
format: "mm-yyyy",
viewMode: "months",
minViewMode: "months",
autoclose: true,
});
</script>