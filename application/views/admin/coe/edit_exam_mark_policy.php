<style>
    .select2-container {
        z-index: 999999;
    }

</style>
<form id="exam_policy_form">
    <div style="margin-bottom: 20px">
        <?php $this->load->view("common/faculty_dept_program"); ?>
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <th>Check <?php echo $previous_info->PROGRAM_ID ?></th>
            <th>Marks Type</th>
            <th>Marks (in %)</th>
            </thead>
            <tbody>
            <?php
            foreach($marks_by_program as $pre_row) {
                $MARKING_TYPE[] = $pre_row->MARKING_TYPE;
            }
           // print_r($MARKING_TYPE);
            foreach ($marks_type as $row) {

                if (in_array($row->LKP_ID, $MARKING_TYPE)) {
                    $is_checked = "checked='checked'";
                    $display='';
                } else {
                    $is_checked = "";
                    $display='none';
                }
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="MARKS_TYPE_ID[]" <?php echo $is_checked ?> class="ex_policy_check"
                               value="<?php echo $row->LKP_ID; ?>" >

                    </td>
                    <td><label><?php echo $row->LKP_NAME; ?></label></td>
                    <td>
                        <div class="col-md-2">
                            <input style="display: <?php echo $display; ?>" type="text" id="<?php echo $row->LKP_ID; ?>"
                                   class="form-control numbersOnly marks_percentage"
                                   name="marks_percentage[]" value="<?php echo $pre_row->MARK_PERCENT ?>">
                        </div>
                    </td>
                </tr>
            <?php  } ?>
            </tbody>
        </table>

    </div>

    <input type="button" name="" value="Submit" id="ex_policy_btn" class="btn btn-sm btn-primary pull-left">
</form>
<script src="<?php echo base_url(); ?>assets/js/multiselect.min.js"></script>

<script>
    $(document).ready(function () {
        $('#multiselect').multiselect();
        $("#ex_policy_btn").on('click', function (e) {
            e.preventDefault();
            var count_checked = $("[name='MARKS_TYPE_ID[]']:checked").length; // count the checked rows
            if (count_checked == 0) {
                alert("Please select any marks type to insert .");
                return false;
            } else {
                var form_data = $("#exam_policy_form");
                var tot_marks = 0;
                $(".marks_percentage").each(function () {
                    tot_marks += parseInt($(this).val()) || 0;
                });
                if (tot_marks == 100) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url()?>coe/saveDistributeMarks',
                        data: form_data.serialize(),
                        success: function (data) {
                            if (data == 'Y') {
                                alert("Insert data successfully");
                            } else if (data == 'D') {
                                alert("This program already exits");
                            }
                        }
                    });
                } else {
                    alert("Total marks percentage less than or greater than 100");
                }
            }
        });
        $(".ex_policy_check").on('click', function () {
            var marks_type_id = $(this).val();
            $("#" + marks_type_id).toggle();
        });
        $("#PROGRAM_ID").on('change', function () {
            var PROGRAM_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>coe/checkDuplicateProgram',
                data: {PROGRAM_ID:PROGRAM_ID},
                success: function (data) {
                    if (data == 'Y') {
                        alert("This program already exits please select another program ");
                    }
                }
            });
        });

    });
</script>
