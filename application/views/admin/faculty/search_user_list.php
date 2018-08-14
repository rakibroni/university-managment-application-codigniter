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
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo base_url(); ?>assets/img/default.png">
                    </a>
                </div>
            </td>
            <td>
                <h3><strong><?php echo $row->FULL_NAME; ?></strong></h3>
                <a href="#"><?php echo $row->DESIGNATION; ?></a>                                                     
            </td>
            <td>
                <p><i class="fa fa-slack"></i>Biometric ID <?php echo $row->BIOMETRIC_ID; ?></p>
                <p><i class="fa fa-envelope"></i> <?php echo $row->EMAIL; ?></p>
                <p><i class="fa fa-phone"></i> <?php echo $row->MOBILE; ?></p>
            </td>
            <td >
                <p><b>User Group:&nbsp;</b> <?php echo $row->USERGRP_NAME; ?></br>
                <b>User Level:&nbsp;</b><?php echo $row->UGLEVE_NAME; ?></br>
                <b>User Name:&nbsp;</b> <?php echo $row->USERNAME; ?></p>
            </td>
            <td >
                <a title="View user information" class="label label-info openModal" data-action="admin/viewUserLevel" data-type="edit"  id="<?php echo $row->USER_ID; ?>"> <i class="fa fa-eye"></i></a>                                                  
                <a title="Update User information" class="label label-default openBigModal" data-action="admin/updateUserLevel" data-type="edit"  id="<?php echo $row->USER_ID; ?>"> <i class="fa fa-pencil"></i></a>                                                  
            </td>
        </tr>
    <?php
    endforeach;
    ?>