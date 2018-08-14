<?php if (!empty($emp_list)): foreach ($emp_list as $row) { ?>
    <div class="col-md-4">
     <a target="_blank" href="<?php echo base_url();?>/employee/employeeCardPdf/<?php echo $row->EMP_ID ?>" class="pull-right btn btn-xs btn-primary"><i class="fa fa-print "></i> </a>
        <div class="contact-box">

            <a href="#">
                <div class="col-sm-4">
                    <div class="text-center">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo base_url() ?>/upload/employee/photo/<?php echo $row->EMP_IMG ?>">
                        <div class="m-t-xs font-bold"><?php echo $row->DEPT_ABBR ?></div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3><strong><?php echo $row->FULL_ENAME ?></strong></h3>
                    <p><i class="fa fa-briefcase"></i> <?php echo $row->DESIGNATION ?> </p>
                    <address>
                        <strong><?php echo $row->EMAIL ?></strong><br>
                        
                        <abbr title="Phone">P:</abbr> <?php echo $row->MOBILE ?>
                    </address>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>

    <?php }   endif; ?>
    <div class="clearfix"></div>