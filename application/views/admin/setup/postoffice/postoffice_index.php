<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Post Office List</h5>
        <!--?php if ($previlages->CREATE == 1) { ?-->
        <div class="ibox-tools">
                        <span title="Create Post Office" class="btn btn-primary btn-xs pull-right openModal"
                              data-action="setup/postofficeFormInsert"> Add New </span>
        </div>
        <!--?php } ?-->
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/postoffice/postoffice_list"); ?>
        </div>
    </div>
</div>
