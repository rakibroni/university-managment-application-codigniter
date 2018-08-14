
<?php
 $attribute = array('class' => 'form-horizontal', 'id' => '', 'role' => 'form');
 echo form_open_multipart('AdminSkillDev/editDirectory/'.'/'.$directory->SD_ID.'/'.$parentId, $attribute);
 ?>
  <div class="form-group">
    <input type="text" name="directoryName" class="form-control" value="<?php echo $directory->SD_NAME; ?>" placeholder="Type Directory Name">
  </div>
  <center>
    <button type="submit" name="button" class="btn btn-md btn-primary">Update Directory</button>
  </center>
<?php echo form_close() ?>
