<?php  if(!empty($member_list)) { ?>
    <table class="table">
        <thead>
        <tr>
            <td>Member</td>
            <td>Designation </td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($member_list as $row): ?>
            <tr class="gradeX" id="row_<?php echo $row->COM_MEMBER_ID; ?>">
                <td><?php echo $row->FULL_NAME ?></td>
                <td><?php echo $row->DESIGNATION ?></td>
                <td><a class="label label-danger deleteItem" id="<?php echo $row->COM_MEMBER_ID; ?>"
                       title="Click For Delete" data-type="delete" data-field="COM_MEMBER_ID" data-tbl="committee_member"><i
                            class="fa fa-times"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php  }else{ echo '<span style="color:red"><b>No Member  Found</b></span>';} ?>