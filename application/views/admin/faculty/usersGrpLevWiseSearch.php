 <div class="ibox-title">
            <h5>User List</h5>
            <?php if ($previlages->CREATE == 1) { ?>
            <a title="View user information" class="btn btn-primary btn-xs pull-right" href="<?php echo site_url() ?>/admin/createUser" target=""> Create User</a> 
            <?php } ?>                         
        </div>
        
        <?php if (!empty($user)): ?>
            <div class="ibox-content">
                <form id="frmContent" method="post">
                    <div class="table-responsive contentArea" id="applicantList">
                        <?php if ($previlages->READ == 1) { ?>
                        <table class="table table-striped table-bordered table-hover gridTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Basic Info</th>
                                    <th>User Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="searchUser">
                                <?php
                                $sn = 1;
                                foreach ($user as $row):
                                    ?>
                                    <tr class="gradeX" id="row_<?php echo $row->USER_ID; ?>" >
                                        <td>
                                            <span class="hidden" id="loader_<?php echo $row->USER_ID; ?>"></span>
                                            <?php echo $sn++; ?>
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
                                        <td >
                                            <p><b>User Group:&nbsp;</b> <?php echo $row->USERGRP_NAME; ?></br>
                                                <b>User Level:&nbsp;</b><?php echo $row->UGLEVE_NAME; ?></br>
                                                <b>User Name:&nbsp;</b> <?php echo $row->USERNAME; ?></p>
                                            </td>
                                            <td class="text-center">
                                                <!--                                                <a title="View user information" class="label label-info openModal" data-action="admin/viewUserLevel" data-type="edit"  id="--><?php //echo $row->USER_ID; ?><!--"> <i class="fa fa-eye"></i></a>                                                  -->
                                                <!--                                                <a title="Update User information" class="label label-default openBigModal" data-action="admin/updateUserLevel" data-type="edit"  id="--><?php //echo $row->USER_ID; ?><!--"> <i class="fa fa-pencil"></i></a>                                                  -->
                                                <?php if ($previlages->UPDATE == 1) : ?>
                                                    <a class="label label-default openModal" id="<?php echo $row->USER_ID; ?>"
                                                     title="Update User Information" data-action="admin/updateUserLevel"
                                                     data-type="edit"><i class="fa fa-pencil"></i></a>
                                                 <?php endif; ?>
                                             </td>
                                         </tr>
                                         <?php
                                     endforeach;
                                     ?>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Basic Info</th>
                                        <th>User Level</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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