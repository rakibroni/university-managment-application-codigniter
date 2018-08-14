<?php if ($previlages->READ == 1) { ?>
<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($yearSetup)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($yearSetup as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->YEAR_ID; ?>">
                <td >
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="yearLoad_<?php echo $row->YEAR_ID; ?>"></span></td>
                <td ><?php echo $row->YEAR_TITLE; ?></td>
                <td><?php echo date('d-M-Y', strtotime($row->START_DT)); ?></td>
                <td ><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
                <td >
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->YEAR_ID; ?>"
                           title="Update Year Setup Information" data-action="setup/yearSetupFormUpdate"
                           data-type="edit"><i class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->YEAR_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="YEAR_ID" data-tbl="ins_years"><i
                                class="fa fa-times"></i></a>
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
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>