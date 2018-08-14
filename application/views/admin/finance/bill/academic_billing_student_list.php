<style>
    .ScrollStyle
    {
        max-height: 300px;
        overflow-y: scroll;
    }
</style>

<div class="table-responsive contentArea">
    <?php if(!empty($registered_student)) : ?>
    <div class="ScrollStyle">
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th><input class="ch" type="checkbox" id="checkAll"></th>
            <th class="col-md-4">Registration No</th>
            <th class="col-md-4">Name</th>
<!--            <th class="text-center">Actions</th>-->
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($registered_student)): $sn = 1; ?>
            <?php foreach ($registered_student as $row) { ?>
                <tr class="gradeX" id=" ">

                    <td><input value="<?php echo $row->STUDENT_ID ?>" type="checkbox"
                               name="STUDENT_ID[]" class="STUDENT_ID ch"></td>
                    <td><?php echo $row->REGISTRATION_NO ?></td>
                    <td><?php echo $row->FULL_NAME_EN ?></td>
<!--                    <td class="text-center">-->
<!---->
<!--                        <a href="--><?php //echo site_url('finance/studentPayment/'.$row->STUDENT_ID); ?><!--" target="_blank" class="btn btn-xs btn-danger">Pay >></a>-->
<!--                        <span><a href="--><?php // echo site_url(); ?><!--/student/printId/--><?php //echo $row->STUDENT_ID; ?><!--" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> Print</a></span>-->
<!--                        </a>-->
<!--                    </td>-->
                </tr>
            <?php } ?>
        <?php endif; ?>

        </tbody>


    </table>
    </div>
    <div class="form-group">
        <input type="button" class="btn btn-danger btn-sm fSubmit " id="academic_bill_generate_btn"
               data-param="" value="Generate Bill"
               data-action="finance/saveAcademicBill"
               data-su-action="finance/academicBillingListOfStudent" data-view-div="acd_bill_view">
    </div>

    <?php else: ?>
        <div class="alert alert-danger"><p class="text-center">No Student Found </p></div>
    <?php endif; ?>

</div>

<script>

    $("#checkAll").click(function () {
        $('.STUDENT_ID').prop('checked', this.checked);
    });

</script>

