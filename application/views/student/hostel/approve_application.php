<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="col-md-9"><b>Resident Application</b></div>
    </div>    
    <div class="ibox-content"> 
        <table class="table table-bordered">
            <tr>
                <th>Registration No</th>
                <th>Name</th>
                <th>Reason</th>
                <th>Application Date</th>
                <th>Present Address</th>
                <th>Parmanent Address</th>
                <th class="text-center">Action</th>
            </tr>
            <?php  foreach($resident_application as $row): ?>

                <tr>
                    <td><?php echo $row->REGISTRATION_NO ?></td>
                    <td>
                        <a class="pull-left student_details" type="button" data-user-id="<?php echo $row->STUDENT_ID; ?>" data-toggle="modal" data-target="#applicant_modal">
                            <?php echo $row->FULL_NAME_EN ?>                                    </a>
                        </td>
                        <td><?php echo $row->REASON_OF_ALLOCATION ?></td>
                        <td><?php echo date('Y-m-d',strtotime($row->APPLICANT_DT)); ?></td>
                        <td><?php  ?></td>
                        <td><?php  ?></td>
                        <td class="text-center">
                            <a class="label label-primary openModal" id="<?php echo $row->APP_ID; ?>"
                             title="Approve" data-action="teacher/residentAppAprvByDeptHead" data-type="edit"><i
                             class="fa fa-eye"></i>
                         </a>
                     </td>




                 </tr>
             <?php endforeach; ?>
         </table>


     </div>  
 </div> 
 <div class="modal inmodal fade" id="applicant_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Student Details</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 
 <script type="text/javascript">
$(document).ready(function(){
    $(".student_details").on("click", function () {
        var STUDENT_ID = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo site_url()?>/student/studentModal',
            data: {STUDENT_ID: STUDENT_ID},
            success: function (data) {
                $("#applicant_modal .modal-body").html(data);
            }
        });
    });
});
</script>