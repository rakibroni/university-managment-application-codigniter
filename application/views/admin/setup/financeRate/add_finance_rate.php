<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal" id="financeRate" method="post">

        <span class="frmMsg"></span>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Academic Session<span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <select class="form-control" name="SESSION_ID" id="SESSION_ID">
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
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Program<span class="text-danger">*</span></label>

        <div class="col-lg-5">
            <select class="form-control" name="PROGRAM_ID" id="PROGRAM_ID">
                <option value="">--Select--</option>
                <?php  foreach ($program as $row):  ?>
                    <option  value="<?php echo $row->PROGRAM_ID ?>" ><?php echo $row->PROGRAM_NAME ?></option>
                <?php  endforeach;?>

            </select>
            <span class="validation"></span>
        </div>
        
    </div>
    <div class="hr-line-dashed"></div> 
    <div class="form-group">
        <label class="col-lg-3 control-label">Same as previous Session

        </label>
        <div class="col-lg-5">
           <input checked="" value="YES" id="PREVIOUS_SESSION_STATUS" name="PREVIOUS_SESSION_STATUS" type="radio"> Yes &nbsp;&nbsp;
           <input checked="checked" value="NO" id="PREVIOUS_SESSION_STATUS" name="PREVIOUS_SESSION_STATUS" type="radio"> No


       </div>
   </div>    
   <div id="rate_same_as" style="display: none;">    
    <div class="hr-line-dashed"></div> 
    <div class="form-group">
        <label class="col-lg-3 control-label">Previous Session
        </label>
        <div class="col-lg-5">
            <select class="form-control" name="PREVIOUS_YSESSION" id="PREVIOUS_YSESSION">
                <option>--Select--</option>
                

            </select>
            <span class="validation"></span>
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
 <div class="col-lg-10"> 
     <div id="charge_table">
        <table class="table table-bordered">
            <tr>
                <td class="col-md-1 text-center"><input type="checkbox" name="" id="checkAll"> #</td>
                <td class="col-md-3">Title</td>
                <td class="col-md-1 text-center">Rate</td>
            </tr>
            <?php foreach ($ac_charge_name as $row):?>
               <tr>
                   <td class="text-center"><input  value="<?php echo $row->AC_NO?>" type="checkbox" class="checked" name="AC_NO[]"></td>
                   <td><?php echo $row->AC_NAME ?></td>
                   <td>
                    <input type="text" id="AMOUNT" name="AMOUNT[]" class="form-control text-center" value="" placeholder="">
                </td>
            </tr>
        <?php endforeach;?>
    </table> 
</div>
<span class="validation"></span>
</div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">Is Active ?</label>

    <div class="col-lg-8">
        <?php
        $ACTIVE_STATUS = ($ac_type == 2) ? $financeRate->ACTIVE_STATUS : '';
        $checked = ($ac_type == 2) ? (($financeRate->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        <span class="modal_msg pull-left"></span>
        
        <input type="button" id="financeRateBtn" class="btn btn-primary btn-sm" value="submit">

        <input type="reset" class="btn btn-default btn-sm" value="Reset">
        <span class="loadingImg"></span>
    </div>
</div>
</form>
</div>
<script type="text/javascript">
    $("#checkAll").click(function(){        
        $('.checked').not(this).prop('checked', this.checked);
    });  
    $('#financeRateBtn').on('click',function () {
        if($("#financeRate").valid()) {            
            var url = '<?php echo site_url('finance/createFinanceRate') ?>';  
            var form_data=$("#financeRate").serialize();  
           console.log(form_data);       
            $.ajax({
                type: "POST",
                url: url,
                data:form_data,                
                success: function (data) {
                    setTimeout(function () {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            showMethod: 'slideDown',
                            timeOut: 4000
                        };

                        toastr.warning('Successfully Added', 'Done');
                    });
                }
            }); 
        }
    });
    $("#financeRate").validate({
        rules: { 
           SESSION_ID: {required:true},
           PROGRAM_ID: {required:true},
           AMOUNT: {number:true},

       },
       messages: {  
           SESSION_ID: "Required",
           PROGRAM_IDt: "Required",
           AMOUNT: "Input numbers only",

       }
   });
</script>