
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View All Program Part Information</h5>

                    <div class="ibox-tools">
                        <span title="Program Part Create" class="btn btn-primary btn-sm pull-right openModal"
                              data-action="setup/addProgramPart"> Add New </span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <?php $this->load->view("admin/setup/program_part/program_part_list"); ?>
                    </div>
                </div>
            </div>
