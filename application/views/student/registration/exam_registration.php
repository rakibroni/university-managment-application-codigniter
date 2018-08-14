
<div id="admit_card">
<div class=" ">
    <div class="ibox-title">
        <h5>Exam Registration.</h5>
    </div>
    <div class="ibox-content">
        <?php if(empty($ex_app_value)){//if student available in exam_application table
            if(empty($reg_period->EXAM_ID)) {//if available declare time period
                echo "Exams sat out-of-time";
            }else{?>
            <?php if (validation_errors() != ''): ?>
                <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif;?>
        <form class="form-horizontal" id="stu_bank_dep_form" >
            <span class="frmMsg"></span>

            <div class="form-group">
                <label class="col-lg-3 control-label">Registered  Courses</label>
                <div class="col-lg-6">
                    <ol>
                        <?php if(!empty($reg_course)) foreach($reg_course as $row):?>

                        <li ><input type="hidden" name="COURSE_ID[]" value="<?php echo $row->COURSE_ID ?>"> <?php echo $row->COURSE_TITLE.' <span style="color:#FBBC05"> [ '.$row->COURSE_CODE.' ]</span> ' ;?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Bank Branch<span style="color: red"> *</span></label>
                <div class="col-lg-3">
                    <select class="form-control " name="BANK_BRANCH_ID" id="BANK_BRANCH_ID" required="required">
                    <option value="">-Select-</option>
                        <?php if(!empty($bank_branch)) foreach($bank_branch as $row): ?>
                            <option value="<?php echo $row->BANK_BRANCH_ID ?>" > <?php echo $row->BANK_BRANCH_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div id="chk_dep_no" class="form-group ">
                <label class="col-lg-3 control-label">Deposit No<span style="color: red"> *</span></label>
                <div class="col-lg-3">
                    <input type="text" id="DEPOSITE_NO" name="DEPOSITE_NO" value="<?php echo set_value('DEPOSITE_NO'); ?>"
                           class="form-control required"
                           placeholder="Enter deposit no." required="required">
                    <input type="hidden" name="EXAM_ID" value="<?php  echo $reg_period->EXAM_ID ?>">
                    <span id="chk_dep_no_error" class="validation"></span>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-10">
                    <span class="modal_msg pull-left"></span>
                    <input type="submit" id="stu_bank_dep_btn" class="btn btn-primary btn-sm" value="submit">
                    <input type="reset" class="btn btn-default btn-sm" value="Reset">
                    <span class="loadingImg"></span>
                </div>
            </div>

        </form>
        <?php } }else{ echo "Your deposit is on processing ";} ?>
    </div>
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
    $(document).on('keyup', '#DEPOSITE_NO', function () {
        var branch_id = $("#BANK_BRANCH_ID").val();
        if(branch_id == ''){
            alert("please select branch");
            $(this).val("");
            $("#BANK_BRANCH_ID").focus();
        }else{
            var deposit_no=$(this).val();
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>student/chkDepositNo',
                data:{deposit_no:deposit_no,branch_id:branch_id},
                success:function(data){
                    if(data == 'Y'){
                      $("#chk_dep_no").removeClass('has-error');
                        $("#chk_dep_no_error").html('');
                    }else{
                        $("#chk_dep_no").addClass('has-error');
                        $("#chk_dep_no_error").html('Invalid Deposit No');
                    }
                }
            });
        }
    });
    $(document).on("submit","#stu_bank_dep_form",function(e){
        e.preventDefault();
        var  form_data=$("#stu_bank_dep_form");

        $.ajax({
           type:'POST',
            url:'<?php echo base_url(); ?>student/saveExamRegistration',
            data:form_data.serialize(),
            success:function(data){
              if(data == 'N'){
                  alert("Please enter valid deposit no");
                  $("#DEPOSITE_NO").focus();
              }else{
                  $('#admit_card').html(data);
              }
            }

        });
    });

</script>