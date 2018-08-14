<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Event List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Event Create" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/eventFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
            <?php $this->load->view("admin/setup/event/event_list"); ?>
    </div>
</div>
