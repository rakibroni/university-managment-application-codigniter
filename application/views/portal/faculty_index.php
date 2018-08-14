<section class="container services" id="features">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Faculty </h5>
            </div>
            <div class="ibox-content">
                <div class="panel-body">
                    <div id="accordion" class="panel-group">
                        <?php foreach ($department as $dr) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a href="#<?php echo $dr->DEPT_ID ?>" data-parent="#accordion"
                                           data-toggle="collapse" class="collapsed"
                                           aria-expanded="false"><?php echo $dr->DEPT_NAME ?></a>
                                    </h5>
                                </div>
                                <div class="panel-collapse collapse" id="<?php echo $dr->DEPT_ID ?>"
                                     aria-expanded="false">
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php
                                            $teachers = $this->db->query("SELECT a.*, b.TEACHER_PHOTO, c.LKP_NAME AS designation
                                                                                  FROM sa_users a
                                                                                       LEFT JOIN teacher_staff_info b ON a.USER_ID = b.USER_ID
                                                                                       LEFT JOIN m00_lkpdata c ON a.DESIGNATION_ID = c.LKP_ID
                                                                             WHERE a.DEPT_ID = $dr->DEPT_ID AND a.USER_TYPE = 290")->result();
                                            if (!empty($teachers)) {
                                                foreach ($teachers as $trrow):
                                                    ?>
                                                    <div class="col-lg-3">
                                                        <div class="contact-box center-version">
                                                            <a href="profile.html">
                                                                <img src="<?php $pp = 'assets/img/default.png';
                                                                if (!empty($trrow->TEACHER_PHOTO))
                                                                    $pp = 'upload/faculty_teacher/' . $trrow->TEACHER_PHOTO;
                                                                echo base_url($pp) ?>"
                                                                     class="img-circle" alt="image">

                                                                <h3 class="m-b-xs">
                                                                    <strong><?php echo $trrow->FULL_NAME ?></strong>
                                                                </h3>

                                                                <div
                                                                    class="font-bold"><?php echo $trrow->designation ?></div>
                                                                <address class="m-t-md">
                                                                    <abbr
                                                                        title="Phone">E:</abbr> <?php echo $trrow->EMAIL ?>
                                                                    <br>
                                                                    <abbr
                                                                        title="Phone">P:</abbr> <?php echo $trrow->MOBILE ?>
                                                                </address>
                                                            </a>

                                                            <div class="contact-box-footer">
                                                                <div class="m-t-xs btn-group">
                                                                    <a class="btn btn-xs btn-white"><i
                                                                            class="fa fa-phone"></i> Call </a>
                                                                    <a class="btn btn-xs btn-white"><i
                                                                            class="fa fa-envelope"></i> Email</a>
                                                                    <a class="btn btn-xs btn-white"><i
                                                                            class="fa fa-user-plus"></i> Follow</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endforeach;
                                            } else {
                                                echo " No teacher found";
                                            } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
