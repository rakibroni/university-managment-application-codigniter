<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Committee Type List</h5>
        <!--?php if ($previlages->CREATE == 1) { ?-->
        <div class="ibox-tools">
                        <span title="Committee Create" class="btn btn-primary btn-xs pull-right openModal"
                              data-action="setup/committeeTypeFormInsert"> Add New </span>
        </div>
        <!--?php } ?-->
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/committee/com_type/com_type_list"); ?>
        </div>

    </div>
</div>