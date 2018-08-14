<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Building Accessory List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Building Accessory" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/brAccessoryFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <?php $this->load->view("admin/setup/building_accessory/br_accessory_list"); ?>
        </div>

    </div>
</div>
