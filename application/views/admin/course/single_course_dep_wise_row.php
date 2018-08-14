<?php if ($previlages->READ == 1) { ?>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
  class="hidden" id="loader_<?php echo $row->COURSE_ID; ?>"></span></td>
  <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_CODE; ?></td>
  <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE; ?></td>
  <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CREDIT; ?></td>
  <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <a class="label label-info openModal" id="<?php echo $row->COURSE_ID; ?>" data-action="course/courseInfo"
     data-type="edit" title="View Course Information"><i class="fa fa-eye"></i></a>
     <?php 
     if ($previlages->UPDATE == 1) {
       ?>
       <a class="label label-default openModal" id="<?php echo $row->COURSE_ID; ?>" title="Update Course Information"
         data-action="course/courseFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>
         <?php }
         if ($previlages->DELETE == 1) {
           ?>
           <a class="label label-danger deleteItem" id="<?php echo $row->COURSE_ID; ?>" title="Click For Delete"
             data-action="setup/deleteDegree" data-type="delete" data-field="COURSE_ID" data-tbl="aca_course"><i
             class="fa fa-times"></i></a>
             <?php } ?>
           </td>
           <?php
         } else {
          echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
        }
        ?>