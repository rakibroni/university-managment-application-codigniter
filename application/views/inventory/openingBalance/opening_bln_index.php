<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Opening Balance List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Opening Balance" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="inventory/openingBlnFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("inventory/openingBalance/opening_bln_list"); ?>
        </div>

    </div>
</div>
