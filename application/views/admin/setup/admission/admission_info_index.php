<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Admission Period List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create admission date" class="btn btn-primary btn-xs pull-right openBigModal"
                                  data-action="setup/admissionInfoForm"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/admission/admission_info_list"); ?>
        </div>
    </div>
</div>
