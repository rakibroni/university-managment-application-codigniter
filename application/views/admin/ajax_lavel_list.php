<option value="">-Select-</option>
<?php foreach ($user_group_lavel as $row) { ?>
    <option value="<?php echo $row->UG_LEVEL_ID ?>"><?php echo $row->UGLEVE_NAME ?></option>
<?php } ?>
