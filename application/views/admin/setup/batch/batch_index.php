<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Batch List</h5>
         <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create batch" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/batchFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <?php $this->load->view("admin/setup/batch/batch_list"); ?>
        </div>

    </div>
</div>
