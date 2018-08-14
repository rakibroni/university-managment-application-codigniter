<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Session List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Session Year Setup" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/sessionYearFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/session_year/session_year_list"); ?>
        </div>
    </div>
</div>
