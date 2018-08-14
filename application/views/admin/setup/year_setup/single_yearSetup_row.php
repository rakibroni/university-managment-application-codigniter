<?php if ($previlages->READ == 1) { ?>
    <td ><span></span><span class="hidden" id="loader_<?php echo $row->YEAR_ID; ?>"></span><?php echo $row->YEAR_ID; ?>
    </td>
    <td><?php echo $row->YEAR_TITLE; ?></td>
    <td ><?php echo date('d-M-Y', strtotime($row->START_DT)); ?></td>
    <td ><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
    <td >
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->YEAR_ID; ?>"
               title="Update Year Setup Information" data-action="setup/yearSetupFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->YEAR_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="YEAR_ID" data-tbl="year_setup"><i class="fa fa-times"></i></a>
        <?php
        }

            ?>

    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>