<table class="table table-bordered">
    <thead>
    <th><input type="checkbox" name="" id="checkAll"> </th>
        <th>Registration ID</th>
        <th>Name</th>
        <th>Financial Details</th>

    </thead>
    <tbody>
        <?php foreach($eligibility_student as $row): ?>
            <tr>
                <td><input type="checkbox" name="STUDENT_ID[]" class="checkList" value="<?php echo $row->STUDENT_ID ?>"></td>
                <td><?php echo $row->REGISTRATION_NO ?></td>
                <td><?php echo $row->FULL_NAME_EN ?></td>
                <td>Paid</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
 <input type="button" data-action="exam/saveExamEligibleStudent" data-su-action="exam/eligibilityStudentList" data-view-div="eligibility_div" class="btn btn-primary btn-sm pull-right form_submit" value="Submit">
 <div class="clearfix"></div>