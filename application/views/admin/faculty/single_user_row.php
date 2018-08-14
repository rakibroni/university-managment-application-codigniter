<td>
    <span class="hidden" id="loader_<?php echo $user->USER_ID; ?>"></span>
    
</td>
<td> 
    <div class="feed-element">
        <a class="pull-left" href="#">
            <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo base_url(); ?>assets/img/default.png">
        </a>
    </div>
</td>
<td>
    <h3><strong><?php echo $user->FULL_NAME; ?></strong></h3>
    <a href="#"><?php echo $user->DESIGNATION; ?></a>                                                     
</td>
<td>
    <p><i class="fa fa-slack"></i>Biometric ID <?php echo $user->BIOMETRIC_ID; ?></p>
    <p><i class="fa fa-envelope"></i> <?php echo $user->EMAIL; ?></p>
    <p><i class="fa fa-phone"></i> <?php echo $user->MOBILE; ?></p>
</td>
<td >
    <p><b>User Group:&nbsp;</b> <?php echo $user->USERGRP_NAME; ?></br>
    <b>User Level:&nbsp;</b><?php echo $user->UGLEVE_NAME; ?></br>
    <b>User Name:&nbsp;</b> <?php echo $user->USERNAME; ?></p>
</td>
<td >
    <a title="View user information" class="label label-info openModal" data-action="admin/viewUserLevel" data-type="edit"  id="<?php echo $user->USER_ID; ?>"> <i class="fa fa-eye"></i></a>                                                  
    <a title="Update User information" class="label label-default openBigModal" data-action="admin/updateUserLevel" data-type="edit"  id="<?php echo $user->USER_ID; ?>"> <i class="fa fa-pencil"></i></a>                                                  
</td>