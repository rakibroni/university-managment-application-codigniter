<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Session Name</th>
            <th>User Define SL. No.</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($session)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($session as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->SESSION_ID; ?>">
                    <td >
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->SESSION_ID; ?>"></span></td>
                    <td ><?php echo $row->SESSION_NAME; ?></td>
                    <td ><?php echo $row->UD_SLNO; ?></td>
                    <td>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->SESSION_ID; ?>"
                               title="Update Session Information" data-action="setup/sessionFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->SESSION_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="SESSION_ID" data-tbl="ins_session"><i
                                    class="fa fa-times"></i></a>
                        <?php
                        }

                        if ($previlages->STATUS == 1) {
                            ?>
                            <a class="itemStatus" id="<?php echo $row->SESSION_ID; ?>"
                               data-status=" " data-fieldId="SESSION_ID"
                               data-field="ACTIVE_STATUS" data-tbl="ins_session" data-su-url="setup/sessionById">

                            </a>
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
            <th>SL</th>
            <th>Session Name</th>

            <th>Actions</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>