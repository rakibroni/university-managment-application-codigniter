<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                            id="loader_<?php echo $row->YSESSION_ID; ?>"></span><?php echo $row->YSESSION_ID; ?>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME.'-'.$row->DINYEAR; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_CURRENT =='1')?'Current Session':''; ?></td>
    
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->YSESSION_ID; ?>"
               title="Update Year Setup Information" data-action="setup/sessionYearFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->YSESSION_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="YSESSION_ID" data-tbl="adm_ysession"><i class="fa fa-times"></i></a>
        <?php
        }

                ?>
    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>