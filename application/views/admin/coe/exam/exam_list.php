<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Session</th>
        <th>Title</th>
        <th>Description</th>
        <th>From</th>
        <th>To</th>

        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($exam)): $sn = 1; ?>
        <?php foreach ($exam as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->EXAM_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="loader_<?php echo $row->EXAM_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EX_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EX_DESC; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->EX_DT_FROM)); ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->EX_DT_TO)); ?></td>


                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="label label-info openModal" id="<?php echo $row->EXAM_ID; ?>" data-action="Coe/examInfo"
                       data-type="edit" title="Exam Information"><i class="fa fa-eye"></i></a>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openBigModal" id="<?php echo $row->EXAM_ID; ?>" title="Update Exam"
                           data-action="Coe/examFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->EXAM_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="EXAM_ID" data-tbl="exam"><i
                                class="fa fa-times"></i></a>
                    <?php
                    }

                    if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->EXAM_ID; ?>"
                           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="EXAM_ID"
                           data-field="ACTIVE_STATUS" data-tbl="exam" data-su-url="Coe/examById">
                            <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
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
        <th>SN</th>
        <th>Session</th>
        <th>Title</th>
        <th>Description</th>
        <th>From</th>
        <th>To</th>

        <th>Action</th>
    </tr>
    </tfoot>
</table>