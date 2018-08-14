<?php if (!empty($filtered_result)): ?>
    <?php foreach ($filtered_result as $row): ?>
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <a class="userModal" id="<?php echo $row->USER_ID; ?>" data-action="admin/viewUser" title="User Details"
                   data-type="edit">
                    <img src="<?php echo base_url(); ?>upload/<?php echo $row->USER_IMG ?>" class="img-circle"
                         alt="image">

                    <h3 class="m-b-xs"><strong><?php echo $row->FULL_NAME ?></strong></h3>

                    <div class="font-bold"><?php echo $row->DESIGNATION; ?></div>
                </a>

                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white" data-content="<?php echo $row->MOBILE ?>" data-placement="top"
                           data-toggle="popover" data-container="body" data-original-title="" title="Mobile"><i
                                class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white" data-content="<?php echo $row->EMAIL ?>" data-placement="top"
                           data-toggle="popover" data-container="body" data-original-title="" title="Email"><i
                                class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"
                           href="<?php echo base_url(); ?>admin/editUser/<?php echo $row->USER_ID ?>"><i
                                class="fa fa-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php
else:
    ?>
    <div class="middle-box text-center animated fadeInDownBig">
        <h3 class="font-bold text-danger">No User Found</h3>
    </div>
<?php
endif;
?>