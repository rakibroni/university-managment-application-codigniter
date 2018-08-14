<div class="col-md-12">
    <div class="widget-main">
        <div class="widget-inner shortcode-typo">
            <h3>Stuff List</h3>

            <div class="row">
                <?php if (!empty($dept_wise_staff)) {
                    foreach ($dept_wise_staff as $row): ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <?php
                                        $t_d_f = 'assets/img/default.png'; //teacher default photo location
                                        if (!empty($dept_wise_staff->TEACHER_PHOTO)) {
                                            $recent_t_p = 'upload/faculty_teacher/' . $dept_wise_staff->TEACHER_PHOTO; //teacher current photo
                                            $t_d_f = $recent_t_p;
                                        }
                                        ?>
                                        <img src="<?php echo base_url($t_d_f); ?>" alt=""
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
                                                href="mailto:me@josephparkton.com">me@josephparkton.com</a><br/>
                                            <i class="glyphicon glyphicon-globe"></i> <a
                                                href="http://josephparkton.com">http://josephparkton.com</a>
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