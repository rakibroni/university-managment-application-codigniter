<form class="form-horizontal frmContent" id="event" method="post">
    <div class="block-flat">
        <span class="frmMsg"></span><br>
        <div class="form-group"><label class="col-lg-2 control-label">Remarks</label>
            <div class="col-lg-10">
                <textarea id="remarks" name="remarks" rows="5" class="form-control"  placeholder="Enter Remarks"></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Remarks text here.</span>
                <span class="help-block"> <span class="text-danger">*</span> Remarks not mendatory.</span>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo $leaves->EMP_ID; ?>" name="EMP_ID">
    <input type="hidden" value="<?php echo $leaves->DEPT_ID; ?>" name="DEPT_ID">
    <input type="hidden" value="<?php echo $leaves->DESIG_ID; ?>" name="DESIG_ID">
    <input type="hidden" value="<?php echo $leaves->LEAVE_REASON; ?>" name="LEAVE_REASON">
    <input type="hidden" value="<?php echo $leaves->EMR_CONTACT; ?>" name="EMR_CONTACT">
    <input type="hidden" value="<?php echo $leaves->ADDRESS_DURING_LEAVE; ?>" name="ADDRESS_DURING_LEAVE">
    <div class="hr-line-dashed"></div>
       <div class="form-group">
            <label class="col-lg-4 control-label">Leave From<span
                class="text-danger">*</span>
            </label>
            <div class="col-md-6">
                <input type="text" name="start_date" class="form-control datepicker required" value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($leaves->LEAVE_FORM))  : '' ?>">
            <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        
        <div class="form-group">
        <label class="col-lg-4 control-label">Leave To<span
            class="text-danger">*</span>
        </label>
        <div class="col-md-6">
            <input type="text" name="end_date" class="form-control datepicker required" value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($leaves->LEAVE_TO))  : '' ?>">
        <span class="validation"></span>
        </div>
    </div>

        <div class="hr-line-dashed"></div>

 <div class="panel panel-primary">
    <div id="" class="panel-collapse collapse in" aria-expanded="true">
        <div class="panel-body">
         <table id="myTable" class="table order-list">
            <thead>
            </thead>
            <tbody>
                <tr class="info">
                    <td>Leave Type</td>
                    <td>Days</td>
                  <!--   <td class="text-center">
                        <button  class="btn btn-success btn-xs" id="addChdrowdfd" title="Add More" type="button">Action</button>

                    </td> -->
                </tr>

                <?php foreach ($leave_info as $leave_row) : ?>
                    <tr>
                       <input type="hidden" value="<?php echo $leave_row->LEAVE_ID; ?>" name="LEAVE_ID[]">
                       <input type="hidden" value="<?php echo $leave_row->LEAVE_CHD_ID; ?>" name="LEAVE_CHD_ID[]">
                       <td class="col-sm-5">


                        <select required="required" class="Item_dropdown form-control required" name="LEAVE_TYPE_ID[]" id="LEAVE_TYPE_ID"
                        data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true">
                        <?php
                                if ($ac_type == 2): // if the form action is EDIT
                                foreach ($leaveType as $row):
                                    ?>
                                    <option
                                    value="<?php echo $row->LEAVE_TYPE_ID ?>" <?php echo ($leave_row->LEAVE_TYPE_ID == $row->LEAVE_TYPE_ID) ? 'selected' : '' ?>><?php echo $row->TYPE_NAME; ?></option>
                                    <?php
                                endforeach;
                                else: // if the form action is VIEW
                                ?>
                                <option value="">Select</option>
                                <?php
                                foreach ($leaveType as $row):
                                    ?>
                                    <option value="<?php echo $row->LEAVE_TYPE_ID ?>"><?php echo $row->TYPE_NAME; ?></option>
                                    <?php
                                endforeach;
                                endif; ?>
                            </select>


                        </td>
                        <td class="col-sm-3">
                            <input required="required" style="text-align: center;" type="text" name="NO_OF_DAYS[]" value="<?php echo $leave_row->NO_OF_DAYS; ?>" class="form-control"/>
                        </td>

                      <!--   <td class="col-sm-3 text-center">
                         <button value="<?php echo $leave_row->LEAVE_CHD_ID;?>" class="btn btn-danger btn-xs ibtnDel deleteLeaveReqDetails" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button>

                     </td> -->

                 </tr>
                 <?php
                 if ($ac_type == 2) {
                  ?>
                  <input type="hidden" class="rowID" name="txtReqId[]" value="<?php  echo $leave_row->LEAVE_CHD_ID ?>"/>
                  <?php
              }
              ?>
          <?php endforeach; ?>

      </tbody>

  </table>
</div>
</div>
</div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <input type="hidden" name="requestType" value="approve">
            <input type="hidden" name="leaveId" id="leaveId" value="<?php echo $leave_id; ?>">
            <input type="hidden" class="rowID" name="txtLeaveId" value="<?php echo $leave_id; ?>"/>


            <input type="button" id="<?php echo $leave_id; ?>" class="btn btn-primary btn-sm formSubmit" data-action="teacher/updateLeaveRequest"
                   data-su-action="teacher/leaveRequestById"  value="Update">

            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;

        $("#addChdrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";


            cols += '<td><input type="hidden" value="<?php echo $leave_row->LEAVE_CHD_ID; ?>" name="LEAVE_CHD_ID[]"><input type="hidden" value="<?php echo $leave_row->LEAVE_ID; ?>" name="LEAVE_ID_C[]"><select class="form-control" name="LEAVE_TYPE_ID_N[]" id="LEAVE_TYPE_ID' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($leaveType as $row) { ?>
                '<option value="<?php echo $row->LEAVE_TYPE_ID ?>"><?php echo $row->TYPE_NAME; ?></option>' +
                <?php } ?>
                '</select> </td>';
                cols += '<td><input style="text-align:center;" type="text" class="form-control" name="NO_OF_DAYS_I[]" id="NO_OF_DAYS' + counter + '"/></td>';


                cols += '<td class="text-center"><button class="btn btn-danger btn-xs ibtnDel" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button></td></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });


        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });


    });


    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();

    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $("table.order-list").find('input[name^="price"]').each(function () {
            grandTotal += +$(this).val();
        });
        $("#grandtotal").text(grandTotal.toFixed(2));
    }

    $(document).on('click','.deleteLeaveReqDetails',function(){
        if(confirm('Are You Want To Delete?')){
            var chd_id=$(this).val();
            $.ajax({
                type:'post',
                url:'<?php echo site_url('teacher/deleteLeaveDetials'); ?>',
                data:{chd_id:chd_id},
                success:function(data){

                }
            })
        }else{

            return false;

        }
    });

</script>