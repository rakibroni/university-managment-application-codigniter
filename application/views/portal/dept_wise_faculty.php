<div class="col-md-12">
    <div class="widget-main">
        <div class="widget-inner shortcode-typo">
            <h3>Faculty List</h3>

            <div class="row">
                <?php if (!empty($dept_wise_faculty)) {
                    foreach ($dept_wise_faculty as $row): ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <?php
                                        $t_d_f = 'assets/img/default.png'; //teacher default photo location
                                        if (!empty($dept_wise_faculty->USER_IMG)) {
                                            $recent_t_p = 'upload/faculty_teacher/' . $dept_wise_faculty->USER_IMG; //teacher current photo
                                            $t_d_f = $recent_t_p;
                                        }
                                        ?>
                                        <img style="padding: 0px 0px 0px 7px" src="<?php echo base_url($t_d_f); ?>" alt=""
                                             class="img-circle img-responsive"/>
                                    </div>
                                    <div class="col-sm-6 col-md-8">
                                        <h4><i class="glyphicon glyphicon-user"></i>
                                            <strong><?php echo $row->FULL_NAME ?></strong></h4>
                                        <small>
                                            <cite title="Pocatello, Idaho">
                                                <i class="glyphicon glyphicon-map-marker"></i> Pocatello, Idaho
                                            </cite>
                                        </small>
                                        <p>
                                            <i class="glyphicon glyphicon-envelope"></i> <a
                                                href="mailto:me@josephparkton.com"><?php echo $email= $this->db->query("select a.CONTACTS from teacher_staff_contractinfo a where a.USER_ID=$row->USER_ID and a.CONTACT_TYPE='E'")->row();if(!empty($email))echo $email->CONTACTS; ?></a><br/>
                                            <i class="glyphicon glyphicon-phone"></i> <a
                                                href="http://josephparkton.com"><?php $mobile= $this->db->query("select a.CONTACTS from teacher_staff_contractinfo a where a.USER_ID=$row->USER_ID and a.CONTACT_TYPE='M'")->row(); if(!empty($mobile))echo $mobile->CONTACTS ?></a>
                                            <br/>
                                            <i class="glyphicon glyphicon-gift"></i> July 07, 1977</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                } else {
                    echo "No data available";
                } ?>

            </div>
        </div>
    </div>
</div>