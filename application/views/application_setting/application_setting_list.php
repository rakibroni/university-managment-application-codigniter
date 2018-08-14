<?php if ($previlages->READ == 1) { ?>
<table class="table table-bordered gridTable">
    <thead>
        <tr>
            <th>SN</th>
            <th>Theme</th>
            <th>Logo Background</th>
            <th>Sidebar Menu Color</th>
            <th>On Click menu Color</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $sn = 1; ?>
        <?php foreach ($appli_setting as $row) { ?>
        <tr class="gradeX" id="row_<?php echo $row->APPLICATION_SETT_ID; ?>">
            <td>
                <span>
                    <?php echo $sn++; ?>

                </span>
                <span class="hidden" id="loader_<?php echo $row->PPLICATION_SETT_ID; ?>">
                </span>
            </td>
            <td><?php echo $row->APPLICATION_THEME; ?></td>
            <td><?php echo $row->LOGO_BACKGROUND; ?></td>
            <td><?php echo $row->SIDEBER_M_C; ?></td>
            <td><?php echo $row->ON_CLICK_M_B_C; ?></td>
            <td>
                <input type="hidden" value="<?php echo $row->APPLICATION_SETT_ID ?>" name="APPLICATION_SETT_ID">
                <?php if ($previlages->UPDATE == 1) { ?>
                <a class="label label-default openBigModal" id="<?php echo $row->APPLICATION_SETT_ID; ?>"
                    title="Update Building Information" data-action="applicationSetting/editApplicationForm" data-type="edit"><i
                    class="fa fa-pencil"></i>
                </a>
                <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                <a class="itemStatus2" id="<?php echo $row->APPLICATION_SETT_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BUILDING_ID"
                   data-field="ACTIVE_STATUS" data-tbl="sa_building" data-action="applicationSetting/changeStatus"
                   data-su-url="setup/buildingById">
                   <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
               </a>
               <?php
           }
           ?>
       </td>
   </tr>
   <?php } ?>
</tbody>
</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>