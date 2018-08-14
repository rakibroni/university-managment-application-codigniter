
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View All Union Information</h5>
                    <!--?php if ($previlages->CREATE == 1) { ?-->
                    <div class="ibox-tools">
                        <span title="Union Create" class="btn btn-primary btn-sm pull-right openModal"
                              data-action="setup/unionFormInsert"> Add New </span>
                    </div>
                    <!--?php } ?-->
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <?php $this->load->view("admin/setup/union/union_list"); ?>
                    </div>
                </div>
            </div>
