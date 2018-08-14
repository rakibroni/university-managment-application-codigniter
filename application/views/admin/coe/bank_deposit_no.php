<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Bank Deposit No</h5>
    </div>
    <div class="ibox-content">
        <div class="col-md-8">
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>coe/saveDep" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-lg-6 control-label">Exam<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                        <select name="EXAM_ID" id="EXAM_ID" class="form-control" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($exam as $er): ?>
                                <option value="<?php echo $er->EXAM_ID ?>"> <?php echo $er->EX_TITLE ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label">Bank Branch<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                        <select name="BANK_BRANCH_ID" id="BANK_BRANCH_ID" class="form-control" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($branch as $er): ?>
                                <option value="<?php echo $er->BANK_BRANCH_ID ?>"> <?php echo $er->BANK_BRANCH_NAME ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label">Session<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                        <select name="SESSION_ID" id="SESSION_ID" class="form-control" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($session as $er): ?>
                                <option value="<?php echo $er->SESSION_ID ?>"> <?php echo $er->SESSION_NAME ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label">Deposit Date<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                       <input type="text" class="form-control datepicker" name="DEPOSITE_DATE">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label">Upload Deposit file.<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                        <input type="file" id="" name="userfile" value="" required>
                        <span id="duplicate" style="color: red;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label"></label>
                    <input type="reset" value="Reset" class="btn btn-sm btn-default">
                    <input type="submit" value="Submit" class="btn btn-sm badge-primary">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <center>
            <style>
                table ,tr ,th ,td {border: 1px solid #000000;text-align: center;padding: 5px}
            </style>
            <table id="dp_list"  >
                <thead>
                <tr><th>Deposit No</th></tr>
                </thead>
                <tbody >
                    <tr><td>Please select exam</td></tr>
                </tbody>
            </table>

            </center>
        </div>
        <div class="clearfix"></div>


    </div>
</div>
<script>
    $(document).ready(function () {
        $("#EXAM_ID").on('change', function () {
            var EXAM_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('coe/deposit_list_by_exam_id'); ?>',
                data: {EXAM_ID: EXAM_ID},

                success: function (data) {

                    if(data){
                    $("#dp_list tbody").html(data);
                    }else{
                        $("#dp_list tbody").html("No data found");
                    }
                }

            });
        });
    });
</script>

