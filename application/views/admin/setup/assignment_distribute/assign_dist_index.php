<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Assignment Distribution List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                <span title="Create assignment distribute"
                      class="btn btn-primary btn-xs pull-right openModal"
                      data-action="setup/assignDistFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/assignment_distribute/assign_dist_list"); ?>
        </div>

    </div>
</div>

