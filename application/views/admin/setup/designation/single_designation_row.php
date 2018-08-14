
   
        <td <?php echo ($designation->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
                class="hidden" id="loader_<?php echo $designation->DESIG_ID; ?>"></span></td>
        <td <?php echo ($designation->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $designation->DESIGNATION; ?></td>
        
        <td <?php echo ($designation->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
            <?php if ($previlages->UPDATE == 1) { ?>
                <a class="label label-default openModal" id="<?php echo $designation->DESIG_ID; ?>"
                   title="Update Designation" data-action="setup/designationFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>
            <?php
            }
            if ($previlages->DELETE == 1) {
                ?>
                <a class="label label-danger deleteItem" id="<?php echo $designation->DESIG_ID; ?>"
                   title="Click For Delete" data-type="delete" data-field="DESIG_ID" data-tbl="hr_desig"><i
                        class="fa fa-times"></i></a>
            <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                <a class="itemStatus" id="<?php echo $designation->DESIG_ID; ?>"
                   data-status="<?php echo $designation->ACTIVE_STATUS ?>" data-fieldId="DESIG_ID"
                   data-field="ACTIVE_STATUS" data-tbl="hr_desig" data-su-url="setup/designationById">
                    <?php echo ($designation->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                </a>
            
        </td>
    <?php } ?>
