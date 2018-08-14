<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Designation List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Designation " class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/designationFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/designation/designation_list"); ?>
        </div>

    </div>
</div>
