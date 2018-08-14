<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<?php $this->load->view("student/common/student_common_js"); ?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Hostel Bill Genarate</h5>
    </div>

    <div class="ibox-content">
        <form class="form-horizontal" id="hostel_bill_generate" method="post">
            <span class="frmMsg"></span>

            <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Academic Session<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <select class="form-control" name="SESSION_ID" id="SESSION_ID">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($ins_session as $row):
                        ?>
                        <option value="<?php echo $row->YSESSION_ID ?>">
                        <?php echo $row->SESSION_NAME ?></option>
                        <?php   endforeach;  ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label">Hostel<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <select class="form-control" name="BUILDING_ID" id="BUILDING_ID">
                        <option value="">--Select--</option>
                        <?php foreach($resident_building as $row): ?>
                        <option value="<?php echo $row->BUILDING_ID ?>"><?php echo $row->BUILDING_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
                
            </div>
            
            <div class="form-group">
                <label class="control-label">Billing Month<span class="text-danger">*</span>
                </label>
                <div class="col-md-12">
                    <input type="text" class="form-control  " name="BILLING_MONTH" id="datepicker" >
                </div>
            </div>
            </div>

            <div class="col-md-9">
            <div class="form-group">
                <div class="col-lg-12">
                    <div id="charge_table">
                        <table class="table table-bordered">
                            <tr>
                                <td class="col-md-3">Title</td>
                                <td class="col-md-1 text-center">Rate</td>
                            </tr>
                            <?php foreach ($ac_charge_name as $row):?>
                            <tr>
                                <input  value="<?php echo $row->AC_NO?>" type="hidden" class="checked" name="AC_NO[]">
                                <td><?php echo $row->AC_NAME ?></td>
                                <td>
                                    <input type="text" id="AMOUNT" name="AMOUNT_<?php echo $row->AC_NO ?>" class="form-control text-center" value="" placeholder="" required>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                    <span class="validation"></span>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                    <span class="modal_msg pull-left"></span>
                    <input type="reset" class="btn btn-default btn-sm" value="Reset">
<!--                    <input type="button" data-action="finance/saveResidentBill" id="hostel_bill_generate_btn" class="btn btn-primary btn-sm form_submit" value="submit">-->
                    <input type="button" class="btn btn-primary btn-sm my_submit" id="hostel_bill_generate_btn"
                           data-param="" value="Search"
                           data-action="finance/residenceBillingListOfStudent"
                           data-su-action="finance/academicBill" data-view-div="res_bill_view">
                    

                </div>
            </div>

            <div id="res_bill_view">
                <span class="loadingImg"></span>
            </div>

        </form>
    </div>
</div>
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

<script>
    $(document).on('click', '.my_submit', function () {

        var form=$("#hostel_bill_generate");


        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/finance/residenceBillingListOfStudent',
            data: form.serialize(),
            beforeSend: function () {

                $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".loadingImg").html("");
                $('#res_bill_view').html(data);
            }
        });


    });

</script>