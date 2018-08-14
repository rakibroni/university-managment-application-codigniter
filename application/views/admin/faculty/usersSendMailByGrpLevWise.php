 <?php if (!empty($user)): ?>
        <div class="ibox-content">
            <form id="frmContent" method="post" action="<?php echo site_url('admin/multipleMailSend') ?>">
                <div class="table-responsive contentArea" id="applicantList">
                    <?php if ($previlages->READ == 1) { ?>
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <thead>
                            <tr>
                               <th><input type="checkbox" id="checkAll"></th>
                               <th>Image</th>
                               <th>Name</th>
                               <th>Basic Info</th>
                               <th>User Level</th>
                           </tr>
                       </thead>
                       <tbody class="searchUser">
                        <?php
                        foreach ($user as $row):
                            ?>
                            <tr class="gradeX" id="row_<?php echo $row->USER_ID; ?>" >
                                <td><input value="<?php echo $row->USER_ID ?>" type="checkbox"
                                    name="USER_ID[]" class="USER_ID">
                                </td>
                                <td> 
                                    <div class="feed-element">
                                        <a class="pull-left" href="#">
                                            <?php $photo=($row->EMP_IMG !='')? "upload/employee/photo/".$row->EMP_IMG : 'assets/img/default.png' ?>
                                            <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo base_url($photo); ?>">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <h3><strong><?php echo $row->FULL_ENAME; ?></strong></h3>
                                    <a href="#"></a>                                                     
                                </td>
                                <td>
                                    <b> DEPT :<?php echo $row->DEPT_NAME; ?> <br> DESIG : <?php echo $row->DESIGNATION; ?></b>
                                </td>
                                <td>
                                    <p><b>User Group:&nbsp;</b> <?php echo $row->USERGRP_NAME; ?></br>
                                        <b>User Level:&nbsp;</b><?php echo $row->UGLEVE_NAME; ?></br>
                                        <b>User Name:&nbsp;</b> <?php echo $row->USERNAME; ?></p>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <div style="padding-bottom: 20px;" class="form-group">
                       <button type="submit" class="btn btn-primary pull-right">Submit</button> 
                   </div>
                   <?php
               } else {
                echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
            }
            ?>
        </div>
    </form>
</div>
<?php else: ?>

    <div class="alert alert-danger"><p class="text-center">No user Found </p> </div>                                
<?php endif; ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#checkAll").click(function () {
            $('.USER_ID').prop('checked', this.checked);
        });
    });
</script>