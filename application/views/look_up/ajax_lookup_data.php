<table class="table table-striped table-bordered table-hover gridTable dataTable">
    <thead>
    <tr>
        <th style="width: 5%;color: green">SN</th>
        <th style="color: green">Name</th>
        <th style="color: green" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($group_data as $rr) {
        $i = $i + 1;
        ?>
        <tr>
            <td <?php echo ($rr->ACT_FG == 1) ? "" : "class='inactive'"; ?>><span><?php echo $i; ?></span><span
                    class="hidden" id="loader_<?php echo $rr->LKP_ID; ?>"></span></td>
            <td <?php echo ($rr->ACT_FG == 1) ? "" : "class='inactive'"; ?>><?php echo $rr->LKP_NAME ?></td>
            <td <?php echo ($rr->ACT_FG == 1) ? "" : "class='inactive'"; ?>>
                <span style="cursor:pointer" id="status<?php echo $rr->LKP_ID ?>" class="status"
                      look_up_id="<?php echo $rr->LKP_ID ?>" data-status="<?php echo $rr->ACT_FG ?>"
                      data-su-url="lookUp/lookUpById"> <?php echo ($rr->ACT_FG == 1) ? '<span id="toggol_' . $rr->LKP_ID . '" class="label label-success" title="Click For Inactive" >Inactive</span>' : '<span id="toggol_' . $rr->LKP_ID . '" class="label label-danger" title="Click For Active" >Active</span>'; ?> </span>
                <a class="label label-default openLookUpModal" id="<?php echo $rr->LKP_ID; ?>" title="Edit Group Data"
                   data-action="LookUp/lookupDataFormUpdate/<?php echo $rr->GRP_ID; ?>/<?php echo $rr->LKP_ID; ?>"
                   data-type="edit"><i class="fa fa-pencil"></i></a>
                <a class="label label-danger deletelookup" item_id="<?php echo $rr->LKP_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="LKP_ID" data-tbl="m00_lkpdata"><i class="fa fa-times"></i></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>