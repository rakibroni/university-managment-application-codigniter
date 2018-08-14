<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Notice List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                <a href="<?php echo base_url(); ?>setup/addNotice" <span title="Degree Create"
                                                                         class="btn btn-primary btn-xs pull-right "> Add New </span></a>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php if ($previlages->READ == 1) { ?>
                <table class="table table-striped table-bordered table-hover gridTable">
                    <thead>
                    <tr>
                        <th>SN</th> 
                        <th>Notice title</th>
                        <th>Description</th>
                        <th>Attachment</th>
                        <th>From Date</th>
                        <th>To Date</th> 
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;
                    foreach ($notice as $row):$i++ ?>
                        <tr id="row_<?php echo $row->NOTICE_ID; ?>">
                            <td><?php echo $i; ?></td>

                            <td><?php echo $row->N_TITLE ?></td>
                            <td><?php echo $row->N_DESC ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>upload/notice/<?php echo $row->N_ATTACHMENT ?>"
                                   alt="Not available" target="_blank"><?php echo $row->N_ATTACHMENT ?></a>
                            </td>
                            <td><?php echo date('d-M-Y', strtotime($row->START_DATE))?></td>
                            <td><?php echo date('d-M-Y', strtotime($row->END_DATE)) ?></td>

                            

                            <td>

                                <?php if ($previlages->UPDATE == 1) { ?>
                                    <a class="label label-default "
                                       href="<?php echo base_url(); ?>setup/editNotice/<?php echo $row->NOTICE_ID; ?>"><i
                                            class="fa fa-pencil"></i></a>
                                <?php
                                }
                                if ($previlages->DELETE == 1) {
                                    ?>
                                    <a class="label label-danger deleteItem"
                                       id="<?php echo $row->NOTICE_ID; ?>" title="Click For Delete"
                                       data-type="delete" data-field="NOTICE_ID" data-tbl="notice"><i
                                            class="fa fa-times"></i></a>
                                <?php
                                }


                                ?>



                                <?php

                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                     
                </table>
            <?php
            } else {
                echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
            }
            ?>
        </div>

    </div>
</div>
