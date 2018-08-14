<?php  if(!empty($schedule)) { ?>
<table class="table">
     <thead>
     <tr>
         <td>Course</td>
         <td>Start Time</td>
         <td>End Time</td>
     </tr>
     </thead>
     <tbody>
     <?php foreach($schedule as $row): ?>
        <tr>
            <td><?php echo $row->COURSE_TITLE ?></td>
            <td><?php echo $row->START_TIME ?></td>
            <td><?php echo $row->END_TIME ?></td>
        </tr>
     <?php endforeach; ?>
     </tbody>
 </table>
<?php  }else{ echo '<span style="color:red"><b>No Exam Schedule Found</b></span>';} ?>