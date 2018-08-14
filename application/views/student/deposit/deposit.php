
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Bank Deposit No.</h5>

            </div>
            <div class="ibox-content">
                <form class="form-horizontal" id="" method="post" action="<?php echo base_url(); ?>student/saveStuBankDeposit">
                    <span class="frmMsg"></span>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Deposit No<span style="color: red"> *</span></label>

                        <div class="col-lg-3">
                            <input type="text" id="DEPOSITE_NO" name="DEPOSITE_NO" value=""
                                   class="form-control numbersOnly required"
                                   placeholder="Enter deposit no.">
                            <input type="hidden" id="EXAM_ID" name="EXAM_ID" value="<?php echo $exam_id ?>">
                            <span class="validation"></span>
                        </div>
                    </div>


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <span class="modal_msg pull-left"></span>
                            <input type="submit" class="btn btn-primary btn-sm" value="submit">
                            <input type="reset" class="btn btn-default btn-sm" value="Reset">
                            <span class="loadingImg"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>


<script>

    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
    $(document).on('click', '#POLICY_FLAG', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#POLICY_FLAG").val(status);
    });
</script>