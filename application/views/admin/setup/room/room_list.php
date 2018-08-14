<?php if ($previlages->READ == 1) { ?>
<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
        <tr>
            <th>SN</th>
            <th>Campus Name</th>
            <th>Building Name</th>
            <th>Floor</th>
            <th>Room No</th>
            <th>Room Name </th>
            <th>Room Type</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       <?php if (!empty($room_info)): $sn = 1; ?>
        <?php foreach ($room_info as $row) { ?>
        <tr class="gradeX" id="row_<?php echo $row->ROOM_ID; ?>">
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                <span><?php echo $sn++; ?></span><span class="hidden"
                id="courseLoad_<?php echo $row->ROOM_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CAMPUS_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BUILDING_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FLOOR_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ROOM_NO; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ROOM_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->LKP_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DESC; ?></td>

                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                   <?php if ($previlages->UPDATE == 1) { ?>
                   <a class="label label-default openModal" id="<?php echo $row->ROOM_ID; ?>"
                     title="Update Room Information" data-action="setup/editRoom" data-type="edit"><i
                     class="fa fa-pencil"></i></a>
                     <?php
                 }
                 if ($previlages->DELETE == 1) {
                    ?>
                    <a class="label label-danger deleteItem" id="<?php echo $row->ROOM_ID; ?>" title="Click For Delete"
                     data-type="delete" data-field="ROOM_ID" data-tbl="sa_room"><i class="fa fa-times"></i></a>
                     <?php
                 }

                 if ($previlages->STATUS == 1) {
                    ?>
                    <a class="itemStatus" id="<?php echo $row->ROOM_ID; ?>"
                     data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="ROOM_ID" data-field="ACTIVE_STATUS"
                     data-tbl="sa_room" data-su-url="setup/roomById">
                     <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?> </a>
                     <?php
                 }
                 ?>

             </td>
         </tr>
         <?php } ?>
     <?php endif; ?>
 </tbody>
 <tfoot>
    <tr>
        <th>SN</th>
        <th>Campus Name</th>
        <th>Building Name</th>
        <th>Floor</th>
        <th>Room No</th>
        <th>Room Name </th>
        <th>Room Type</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
</tfoot>
</table> 
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>                      