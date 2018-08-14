
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Course Content</h5>

                    <div class="ibox-tools">
                        <a class="btn btn-primary btn-sm pull-right "
                           href="<?php echo base_url(); ?>admin/courseContent"> Distribute </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <table class="table table-striped table-bordered table-hover gridTable">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Program</th>
                                <th>Semester</th>
                                <th>Session</th>
                                <th>Content</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($con_dis_list)): ?>

                                <?php $sn = 1;
                                foreach ($con_dis_list as $row) { ?>
                                    <tr class="gradeX" id="row_<?php echo $row->CONTENT_DIST_ID; ?>">
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $row->PROGRAM_NAME; ?></td>
                                        <td><?php echo $row->SEMESTER; ?></td>
                                        <td><?php echo $row->SESSION_NAME; ?></td>
                                        <td><?php echo $row->CONTENT_URI; ?></td>
                                        <td><?php echo $row->COURSE_TITLE . ' [ ' . $row->COURSE_CODE . ' ]'; ?></td>
                                        <td><i class="fa fa-edit"></i></td>
                                    </tr>
                                    <?php $sn++;
                                } ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Department</th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Course Credit</th>
                                <th>Course Category</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
