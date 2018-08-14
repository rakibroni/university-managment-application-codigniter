<?php if ($previlages->READ == 1) { ?>
 <div class="ibox-content">
        <form id="reportFormSubmit" class="reportFormSubmit" method="post" action="<?php echo site_url('exam/departmentWiseMarksList') ?>"> 
            <div class="col-md-3">
                <div class="form-group"> 
                    <select class="form-control" name="DEGREE_ID" id="DEGREE_ID" data-tags="true" data-placeholder="Select Group" data-allow-clear="true">
                        <option value="">Select Degree</option>
                         <?php foreach ($ins_degree as $row) { ?> 
                         <option value="<?php echo $row->DEGREE_ID ?>"><?php echo $row->DEGREE_NAME ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>               
            <div class="col-md-3">
                <div class="form-group"> 
                    <select class="form-control" name="DEP_ID" id="DEP_ID" data-tags="true" data-placeholder="Select Group" data-allow-clear="true">
                        <option value="">Select Department</option>
                         <?php foreach ($ins_dept as $row) { ?> 
                         <option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>               
            <div class="col-md-3">
                <div class="form-group"> 
                    <select class="form-control" name="EXAM_TYPE_ID" id="EXAM_TYPE_ID" data-tags="true" data-placeholder="Select Group" data-allow-clear="true">
                        <option value="">Select Exam</option>
                         <?php foreach ($exam_type as $row) { ?> 
                         <option value="<?php echo $row->EXAM_TYPE_ID ?>"><?php echo $row->EXAM_TITLE ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>           
            <div class="col-md-1"> 
              <div class="form-group"> 
                 <button type="submit" class="btn btn-primary btn-sm">Show</button>
              </div>
          </div>
      </form>

      <div class="clearfix"></div>
  </div>
  <div class="reportResult">
<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
        <tr>
            <th>SN</th>
            <th>Degree</th>
            <th>Department</th>
            <th>Exam  Type</th>
            <th>Exam Marks Type</th>
            <th>Percentage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($exam_grade_sheet)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($exam_grade_sheet as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->EXAM_GRADE_SHEET_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->EXAM_GRADE_SHEET_ID; ?>"></span>
                </td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEGREE_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EXAM_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->MARKS_TITLE; ?></td>
                <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->MARKS_PER.'%'; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                   <?php if ($previlages->UPDATE == 1) { ?>
                   <a class="label label-default openModal" id="<?php echo $row->EXAM_GRADE_SHEET_ID; ?>"
                     title="Update Exam Grade Information" data-action="exam/gradeSheetFormUpdate"
                     data-type="edit"><i class="fa fa-pencil"></i></a>
                     <?php
                 }
                 if ($previlages->DELETE == 1) {
                    ?>
                    <a class="label label-danger deleteItem2" id="<?php echo $row->EXAM_GRADE_SHEET_ID; ?>"
                     title="Click For Delete" data-type="delete" data-field="EXAM_GRADE_SHEET_ID"
                     data-action="exam/deleteItem"
                     data-tbl="exam_grade_sheet"><i
                     class="fa fa-times"></i></a>
                     <?php
                 }

                 if ($previlages->STATUS == 1) {
                    ?>
                    <a class="itemStatus2" id="<?php echo $row->EXAM_GRADE_SHEET_ID; ?>"
                     data-status="<?php echo $row->GRADE_SHEET_ACTIVE_STATUS ?>" data-fieldId="EXAM_GRADE_SHEET_ID"
                     data-field="ACTIVE_STATUS" data-tbl="exam_grade_sheet" data-action="exam/statusItem"
                     data-su-url="exam/gradeSheetById">
                     <?php echo ($row->GRADE_SHEET_ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                 </a>
                 <?php
             }
             ?>
         </td>
     </tr>
     <?php } ?>
 <?php endif; ?>
</tbody>
</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>
</div>