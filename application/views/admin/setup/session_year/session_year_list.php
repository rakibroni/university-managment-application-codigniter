    <?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Session</th>
        <th>SL No</th>
        <th>Status</th>
        <th>Trimester</th>
        <th>Bysemester</th>
       
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($sessionYear)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($sessionYear as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->YSESSION_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="yearLoad_<?php echo $row->YSESSION_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UD_SLNO; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_CURRENT =='1')?'Current Session':''; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->TRIMESTER =='1')?'Yes':'No'; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->SEMESTER =='1')?'Yes':'No'; ?></td>
                
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->YSESSION_ID; ?>"
                           title="Update Year Setup Information" data-action="setup/sessionYearFormUpdate"
                           data-type="edit"><i class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->YSESSION_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="YSESSION_ID" data-tbl="adm_ysession"><i
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
        <th>Session</th>
        <th>SL No</th>
        <th>Status</th>
        <th>Trimester</th>
        <th>Bysemester</th>
       
        <th>Action</th>
    </tr>
    </tfoot>
</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>