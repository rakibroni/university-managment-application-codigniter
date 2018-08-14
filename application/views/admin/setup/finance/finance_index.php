<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Finance List</h5>
        <?php // if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
                            <span title="Finance Create" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="finance/financeFormInsert"> Add New </span>
        </div>
        <?php // } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/finance/finance_list"); ?>
        </div>

    </div>
</div>
