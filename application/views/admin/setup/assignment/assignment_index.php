<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Assignment List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                <span title="Create assignment" class="btn btn-primary btn-xs pull-right openModal"
                      data-action="setup/assignmentFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/assignment/assignment_list"); ?>
        </div>

    </div>
</div>
