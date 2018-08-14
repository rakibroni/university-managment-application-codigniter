<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>description</th>
        <th>Degree</th>
        <th>Program</th>
        <th>Admission Period</th>
        
        
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($admissionPeriod)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($admissionPeriod as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->ADM_PRG_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden" id="eventLoad_<?php echo $row->ADM_PRG_ID; ?>"></span>
                </td>                
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ADMPRG_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ADMPRG_DESC; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEGREE_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->REG_PRG_SDT)) ." - ". date('d-M-Y', strtotime($row->REG_PRG_EDT)); ?></td>
              
                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    
                    <?php  
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->ADM_PRG_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="ADM_PRG_ID"
                           data-tbl="adm_program"><i class="fa fa-times"></i></a>
                    <?php
                    }

                    
                    ?>
                    <!-- <a class="label label-warning openBigModal"
                       title="Click For Edit" data-action="setup/editAdmissionForm/<?php echo $row->APRGDESC_ID; ?>/<?php echo $row->ADM_PRG_ID; ?>" ><i class="fa fa-edit"></i></a> -->
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>description</th>
        <th>Admission Period</th>
        <th>Admission Test</th>
        <th></th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>