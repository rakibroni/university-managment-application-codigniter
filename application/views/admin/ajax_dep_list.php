<option value="">-Select-</option>
<?php foreach ($department as $row) { ?>
    <option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
<?php } ?>
