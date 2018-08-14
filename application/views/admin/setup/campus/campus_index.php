<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Campus List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <span title="Create Campus" class="btn btn-primary btn-xs pull-right openModal"
            data-action="setup/campusFormInsert"> Add New </span>
        </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <?php $this->load->view("admin/setup/campus/campus_list"); ?>
        </div>

    </div>
</div>