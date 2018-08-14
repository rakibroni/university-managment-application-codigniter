<?php
$sn = 1;
foreach ($user as $row):
?>


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
<td >
<!--    <a title="View user information" class="label label-info openModal" data-action="admin/viewUserLevel" data-type="edit"  id="--><?php //echo $row->USER_ID; ?><!--"> <i class="fa fa-eye"></i></a>-->
    <!--                                                <a title="Update User information" class="label label-default openBigModal" data-action="admin/updateUserLevel" data-type="edit"  id="--><?php //echo $row->USER_ID; ?><!--"> <i class="fa fa-pencil"></i></a>                                                  -->
    <?php // if ($previlages->UPDATE == 1) : ?>
        <a class="label label-default openModal" id="<?php echo $row->USER_ID; ?>"
           title="Update User Information" data-action="admin/updateUserLevel"
           data-type="edit"><i class="fa fa-pencil"></i></a>
    <?php // endif; ?>
</td>


<?php endforeach; ?>