<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="table-responsive contentArea">

                    <table class="table table-striped table-bordered table-hover gridTable">
                        <thead>
                        <tr>
                            <th>SN</th>

                            <th>Faculty</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($teachers)) {
                            foreach ($teachers as $row) { ?>
                                <tr>
                                    <td><?php echo $row->FULL_NAME ?></td>
                                    <td><?php echo $row->FULL_NAME ?></td>
                                    <td><?php echo $row->FULL_NAME ?></td>
                                    <td><?php echo $row->FULL_NAME ?></td>
                                    <td><?php echo $row->FULL_NAME ?></td>
                                    <td><?php echo $row->FULL_NAME ?></td>
                                </tr>
                            <?php }
                        } ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>SN</th>
                            <th>Notice For</th>
                            <th>Notice title</th>
                            <th>Description</th>
                            <th>From Date</th>
                            <th>To Date</th>

                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


