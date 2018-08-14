<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Exam</th>
        <th>Start</th>
        <th>To</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($ex_reg_period)): $sn = 1; ?>
        <?php foreach ($ex_reg_period as $row) { ?>
          <tr class="gradeX" id="row_<?php echo $row->ERP_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->ERP_ID; ?>"></span>
                </td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EX_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-m-Y',strtotime($row->ERP_DT_FROM)); ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-m-Y',strtotime($row->ERP_DT_TO)); ?></td>


                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                        <a class="label label-default openModal" id="<?php echo $row->ERP_ID; ?>" title="Update Grade"
                           data-action="Coe/exRgPeriodFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>


                        <a class="label label-danger deleteItem" id="<?php echo $row->ERP_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="ERP_ID" data-tbl="exam_reg_period"><i
                                class="fa fa-times"></i></a>


                        <a class="itemStatus" id="<?php  echo $row->ERP_ID;  ?>"
                           data-status="<?php  echo $row->ACTIVE_STATUS  ?>" data-fieldId="ERP_ID"
                           data-field="ACTIVE_STATUS" data-tbl="exam_reg_period" data-su-url="Coe/exRgPeriodById">
                            <?php  echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>'  ?>
                        </a>

                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>

</table>