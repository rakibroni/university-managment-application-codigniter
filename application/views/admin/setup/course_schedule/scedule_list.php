<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Short Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($schedule)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($schedule as $row) { ?>
            <!--                <tr class="gradeX" id="row_<?php echo $row->BR_TYPE_ID; ?>" >
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span class="hidden" id="courseLoad_<?php echo $row->BR_TYPE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BR_TYPE_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BR_SHORT_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->BR_TYPE_ID; ?>" title="Update Building Information" data-action="setup/editBuilding" data-type="edit"><i class="fa fa-pencil"></i></a>
                             <?php
            }
            if ($previlages->DELETE == 1) {
                ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->BR_TYPE_ID; ?>" title="Click For Delete" data-type="delete" data-field="BR_TYPE_ID" data-tbl="sc_br_type"><i class="fa fa-times"></i></a>
                             <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                            <a class="" id="<?php echo $row->BR_TYPE_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BR_TYPE_ID" data-field="ACTIVE_STATUS" data-tbl="sc_br_type"  data-su-url="">
                            <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                            </a>
                            <?php
            }
            ?>
                    </td>
                </tr>-->
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>