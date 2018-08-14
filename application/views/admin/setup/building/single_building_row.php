<?php if ($previlages->READ == 1) { ?>
<td <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
  <span><?php echo $sn++; ?></span><span class="hidden"
  id="loader_<?php echo $row->BUILDING_ID; ?>"></span></td>
  <td <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CAMPUS_NAME; ?></td>
  <td <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BUILDING_NAME; ?></td>
  <td <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->LKP_NAME; ?></td>
  <td <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DESC; ?></td>
  <td <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
   <?php if ($previlages->UPDATE == 1) { ?>
   <a class="label label-default openModal" id="<?php echo $row->BUILDING_ID; ?>"
     title="Update Building Information" data-action="setup/editBuilding" data-type="edit"><i
     class="fa fa-pencil"></i></a>
     <?php
   }
   if ($previlages->DELETE == 1) {
    ?>


    <a class="label label-danger deleteItem2" id="<?php echo $row->BUILDING_ID; ?>"
     title="Click For Delete" data-type="delete" data-action="setup/deleteItem" data-field="BUILDING_ID"
     data-tbl="sa_building"><i
     class="fa fa-times"></i></a>
     <?php
   }
   if ($previlages->STATUS == 1) {
    ?>

    <a class="itemStatus2" id="<?php echo $row->BUILDING_ID; ?>"
     data-status="<?php echo $row->BUILDING_ACTIVE_STATUS ?>" data-fieldId="BUILDING_ID"
     data-field="ACTIVE_STATUS" data-tbl="sa_building" data-action="setup/statusItem"
     data-su-url="setup/buildingById">
     <?php echo ($row->BUILDING_ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
   </a>
   <?php
 }
 ?>
</td>
<?php
} else {
  echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>