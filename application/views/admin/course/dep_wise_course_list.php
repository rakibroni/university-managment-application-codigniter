<?php if ($previlages->READ == 1) { ?>
<table class="table table-bordered gridTable"  table-title="Department Wise Course  List" table-msg="All Course list">
  <thead>
    <tr>
      <th>SN</th>
      <th>Course Code</th>
      <th>Title</th>
      <th>Credit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($dep_wise_course)): ?>
      <?php $sn = 1; ?>
      <?php foreach ($dep_wise_course as $row) { ?>
      <tr class="gradeX" id="row_<?php echo $row->COURSE_ID; ?>">
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
          <span><?php echo $sn++; ?></span><span class="hidden"
          id="loader_<?php echo $row->COURSE_ID; ?>"></span></td>
          <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_CODE; ?></td>
          <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE; ?></td>
          <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CREDIT; ?></td>
          <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
           <a class="label label-info openModal" id="<?php echo $row->COURSE_ID; ?>"
             title="View Course Information" data-action="course/depWiseCourseInfo"
             data-type="edit"><i class="fa fa-eye"></i></a>
             <?php 
             if ($previlages->UPDATE == 1) {
               ?>
               <a class="label label-default openModal" id="<?php echo $row->COURSE_ID; ?>"
                 title="Update Course Information" data-action="course/depWiseCourseFormUpdate"
                 data-type="edit"><i class="fa fa-pencil"></i></a>
                 <?php }
                 if ($previlages->DELETE == 1) {
                   ?>
                   <a class="label label-danger deleteItem" id="<?php echo $row->COURSE_ID; ?>"
                     title="Click For Delete" data-type="delete" data-field="COURSE_ID" data-tbl="aca_course"><i
                     class="fa fa-times"></i></a>
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