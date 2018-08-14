<?php if ($previlages->READ == 1) { ?>
    <td ><span></span><span class="hidden"
                                                                                               id="loader_<?php echo $row->SESSION_ID; ?>"></span>
    </td>
    <td ><?php echo $row->SESSION_NAME; ?></td>
    <td ><?php echo $row->UD_SLNO; ?></td>
    <td>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->SESSION_ID; ?>"
               title="Update Session Information" data-action="setup/sessionFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->SESSION_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="SESSION_ID" data-tbl="ins_session"><i class="fa fa-times"></i></a>
        <?php
        }


            ?>



    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>