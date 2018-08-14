<style>
    .ScrollStyle
    {
        max-height: 300px;
        overflow-y: scroll;
    }
</style>
 <form class="form-horizontal frmContent" id="existing_to_student" method="post" action="<?php echo base_url('admin/insertWiverListingData') ?>">
    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
    <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
<div class="table-responsive contentArea">
    <?php if(!empty($waiver_student)) : ?>
    <div class="ScrollStyle">
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th><input class="ch" type="checkbox" id="checkAll"></th>
            <th class="col-md-4">Registration No</th>
            <th class="col-md-4">Name</th>
            <th class="col-md-4">Waiver Type</th>
            <th class="col-md-4 text-center">Waiver Percentage</th>
<!--            <th class="text-center">Actions</th>-->
        </tr>
        </thead>

          <tbody id="approveApplicant" class="searchApplicant">
                <?php
                $sn = 1;
                foreach ($waiver_student as $row):
                    //echo "<pre>";print_r($row );exit();

                    ?>

                    <?php $student_wise_waiver_info = $this->db->get_where('student_waiver_info', 
                            array('STUDENT_ID' => $row->STUDENT_ID, 'SESSION_ID' => $s_id))->row(); ?>


                <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">

                    <td><input value="<?php echo $row->STUDENT_ID ?>" type="checkbox"
                     name="STUDENT_ID[]" class="STUDENT_ID"></td>
                     <td><?php echo $row->REGISTRATION_NO ?></td>
                     <td>  
                        <?php echo $row->FULL_NAME_EN ?>
                </td>

                <td> <select id="WAIVER_ID" name="WAIVER_ID_<?php echo $row->STUDENT_ID ?>" class="form-control required">
                            <option value="">-Select-</option>
                            <?php foreach ($waiver_type as $roww): ?>
                                <option value="<?php echo $roww->WAIVER_ID ?>" <?php if(!empty($student_wise_waiver_info->WAIVER_TYPE)) echo ($student_wise_waiver_info->WAIVER_TYPE == $roww->WAIVER_ID) ? 'selected' : '' ?>><?php echo $roww->WAIVER_NAME ?></option>
                            <?php endforeach; ?>
                        </select></td>

                <td  class="text-center">
                    <input id="" type="text" name="PERCENTAGE_<?php echo $row->STUDENT_ID; ?>" id="PERCENTAGE" 
                            value="<?php if(!empty($student_wise_waiver_info->PERCENTAGE))echo $student_wise_waiver_info->PERCENTAGE  ?>" 
                         class="form-control text-center required"
                        placeholder="">
                          
                </td>

        </tr>
    <?php endforeach; ?>
    </tbody>
       
    </table>
    <div class="col-md-12" align="right">    
        <input type="submit" class="btn btn-primary btn-sm" value="submit">
    </div>

    </div>

    <?php else: ?>
        <div class="alert alert-danger"><p class="text-center">No Student Found </p></div>
    <?php endif; ?>

</div>
</form>
<script>

    $("#checkAll").click(function () {
        $('.STUDENT_ID').prop('checked', this.checked);
    });

</script>
 <script type="text/javascript">
        $(document).ready(function(){
             
            $("#existing_to_student").validate({
                rules: {
                        
                    "STUDENT_ID[]": {required: true},

                },
                messages: {
                    "STUDENT_ID[]": "Required one",
                  

                }

            });

           
        });

    </script>