<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Room List</h5>

        <div class="ibox-tools">
                        <span title="Room Create" class="btn btn-primary btn-xs pull-right openModal"
                              data-action="setup/addRoom"> Add New </span>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/building/room_list"); ?>
        </div>
    </div>
</div>
