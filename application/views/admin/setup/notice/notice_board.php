<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Notice Board</h5>
        

    </div>
    <div class="ibox-content">
        <ul class="notes">
           <?php
if(!empty($notice)):
            $i = 0;
           foreach ($notice as $row):
            $i++
            ?>
            <li>
                <div>
                    <small><?php echo date('d-m-Y', strtotime( $row->CREATE_DATE)); ?></small>
                    <h4><?php echo $row->N_TITLE ?></h4>
                    <p><?php echo $row->N_DESC ?></p>
                    <!-- <a class="deleteItem" id="<?php echo $row->NOTICE_ID; ?>" data-type="delete" data-field="NOTICE_ID" data-tbl="notice"><i class="fa fa-trash-o "></i></a> -->
                </div>
            </li>
        <?php endforeach; endif;?>
    </ul>
    <div class="clearfix"></div>

</div>
</div>
