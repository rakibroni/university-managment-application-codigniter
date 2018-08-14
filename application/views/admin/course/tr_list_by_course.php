<div class="feed-activity-list">
    <?php if(!empty($tr_list)){
    foreach($tr_list as $row):
    $user_img = ($row->USER_IMG != "")?"upload/faculty_teacher/$row->USER_IMG":"assets/img/default.png";
    ?>
    <div class="feed-element" id="row_<?php echo $row->T_ASSIGNED_CRS_ID; ?>">
        <a href="profile.html" class="pull-left">
            <img class="img-circle" src="<?php echo base_url().$user_img; ?>">
        </a>
        <div class="media-body ">
            <h4 class="pull-left"><?php if(!empty($row->FULL_NAME))echo $row->FULL_NAME ?></h4>
            <small class="pull-right label label-danger deleteItem" id="<?php echo $row->T_ASSIGNED_CRS_ID; ?>"
                   title="Click For Delete" data-type="delete" data-field="T_ASSIGNED_CRS_ID" data-tbl="techer_assigned_courses">
                <i class="fa fa-times"></i>
            </small>
        </div>
    </div>
    <?php
        endforeach;
    } else echo "No teacher found"; ?>
</div>