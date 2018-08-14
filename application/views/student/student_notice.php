<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Notice Board</h5>
        <div class="ibox-tools">

        </div>
    </div>
    <div class="ibox-content">
        <?php if(!empty($notice)){ ?>
            <ul class="notes">
                <?php foreach ($notice as $row): ?>
                    <li>
                        <div>
                            <small>Published
                                : <?php echo $this->utilities->formatDate('d-M-Y', $row->CREATE_DATE); ?></small>
                            <h4><?php echo $row->N_TITLE; ?></h4>

                            <h5>From : <?php echo $this->utilities->formatDate('d-M-Y', $row->START_DATE); ?></h5>
                            <h5>To : <?php echo $this->utilities->formatDate('d-M-Y', $row->END_DATE); ?></h5>

                            <a href="<?php if (!empty($row->N_ATTACHMENT)) {
                                echo base_url();
                                ?>upload/notice/<?php echo $row->N_ATTACHMENT;
                            }
                            ?>" target="_blank"><i class="fa fa-download"></i></a>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
        <?php }else{ echo "Notice Not available";}?>
        <div class="clearfix"></div>
    </div>
</div>
