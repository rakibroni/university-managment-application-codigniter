<table class="table table-bordered">
    <tr>
        <td class="col-md-1 text-center"><input type="checkbox" name="" id="checkAll"> #</td>
        <td class="col-md-3">Title</td>
        <td class="col-md-1 text-center">Rate</td>
    </tr>
    <?php
    $pre_rate_arr = array(); 
    $pre_rate_amount_arr = array(); 
    foreach ($pre_charge_rate as $pre_charge_rate_row) {                    
        array_push($pre_rate_arr, $pre_charge_rate_row->AC_NO);         
        array_push($pre_rate_amount_arr, $pre_charge_rate_row->AMOUNT);         
    }
    //echo "<pre>";print_r( $pre_rate_arr);exit;
    foreach ($ac_charge_name as $row):

        $checked = (in_array($row->AC_NO, $pre_rate_arr) ? "checked='checked'" : "");
       
    ?>
    <tr>
     <td class="text-center"><input  value="<?php echo $row->AC_NO ?>" type="checkbox" class="checked" name="AC_NO[]" <?php echo $checked ?> ></td>
     <td><?php echo $row->AC_NAME ?></td>
     <td>
        <input type="text" id="AMOUNT" name="AMOUNT[]" class="form-control text-center" value="<?php  $amount= $this->utilities->findByAttribute('fn_academic_charge_rate',array('PROGRAM_ID'=>$PROGRAM_ID,'SESSION_ID'=>$PREVIOUS_YSESSION,'AC_NO'=>$row->AC_NO));  if(!empty($amount->AMOUNT) ){ echo $amount->AMOUNT;} ?>" placeholder="">
    </td>
</tr>
<?php endforeach;?>
</table>