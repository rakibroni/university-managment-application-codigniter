<table class="table">
    <thead>
    <th>Check</th>
    <th>Marks Type</th>
    <th>Marks (in %)</th>
    </thead>
    <tbody>
    <?php
    foreach ($previous_marks_by_program as $pre_row) {
        $MARKING_TYPE[] = $pre_row->MARKING_TYPE;
        $MARKING_PER[] = $pre_row->MARK_PERCENT;
        $MARKING_id[] = $pre_row->M_POLICY_ID;
    }

    foreach ($marks_type as $row) {
        $display = 'none';
        if (!empty($MARKING_TYPE)) {

            if (in_array($row->LKP_ID, $MARKING_TYPE)) {
                $type_key = array_search($row->LKP_ID, $MARKING_TYPE);
                $is_checked = "checked='checked'";
                $mark = $MARKING_PER[$type_key];
                $id = $MARKING_id[$type_key];
                $display = '';

            } else {
                $is_checked = "";
                $display = 'none';
                $mark = "";
                $id = "";
            }
        }
        ?>
        <tr>
            <td>
                <input type="checkbox" name="MARKS_TYPE_ID[]" class="ex_policy_check" <?php if(!empty($is_checked)) echo $is_checked ?>
                       value="<?php echo $row->LKP_ID; ?>">

            </td>
            <td><label><?php echo $row->LKP_NAME; ?></label></td>
            <td>
                <div class="col-md-2">
                    <input style="display: <?php  echo  $display ?>" type="text" id="<?php echo $row->LKP_ID; ?>"
                           class="form-control numbersOnly marks_percentage"
                           name="marks_percentage[]" value="<?php  if(!empty($mark)) echo $mark;?>">
                    <input type="hidden" name="M_POLICY_ID[]" value="<?php  if(!empty($id)) echo $id;?>">
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    $(".ex_policy_check").on('click', function () {
        var marks_type_id = $(this).val();
        $("#" + marks_type_id).toggle();
    });
</script>