<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Application Setting List</h5>
    <?php if ($previlages->CREATE == 1) { ?>    
    <div class="ibox-tools">
      <span title="Create Application Setting" class="btn btn-primary btn-xs pull-right openBigModal"
      data-action="applicationsetting/addApplicationSetting"> Add New </span>
    </div>
     <?php } ?>
  </div>
  <div class="ibox-content">
    <div class="table-responsive contentArea">
      <?php $this->load->view("application_setting/application_setting_list"); ?>
    </div>
  </div>
</div>
