
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View All Division Information</h5>
                    <!--?php if ($previlages->CREATE == 1) { ?-->
                    <div class="ibox-tools">
                        <span title="Division Create" class="btn btn-primary btn-sm pull-right openModal"
                              data-action="setup/divisionFormInsert"> Add New </span>
                    </div>
                    <!--?php } ?-->
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <?php $this->load->view("admin/setup/division/division_list"); ?>
                    </div>

                </div>
            </div>
