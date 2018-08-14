<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Student List</h5>        
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Registration No</th>
                        <th>Name</th>                        
                        <th>Program</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($registered_student)): $sn = 1; ?>
                        <?php foreach ($registered_student as $row) { ?>
                        <tr class="gradeX" id=" ">

                          <td><?php echo $sn++; ?></td>
                          <td><?php echo $row->REGISTRATION_NO ?></td>
                          <td><?php echo $row->FULL_NAME_EN ?></td>
                          <td><?php echo $row->PROGRAM_NAME ?></td>
                          
                          <td class="text-center">

                            <a href="<?php echo site_url('finance/studentPayment/'.$row->STUDENT_ID); ?>" target="_blank" class="btn btn-xs btn-danger">Pay >></a>
                              <span><a href="<?php  echo site_url(); ?>/student/studentInfoPdf/<?php echo $row->STUDENT_ID; ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> Print</a></span>
                         </a>
                     </td>
                 </tr>
                 <?php } ?>
             <?php endif; ?>
         </tbody>

     </table>

 </div>

</div>
</div>