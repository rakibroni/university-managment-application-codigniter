<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View All Applicant Information</h5>

                    <div class="ibox-tools">
                        <span title="Applicant Registration" id="btnSubmit"
                              class="btn btn-primary btn-sm pull-right formSubmit " data-action="admission/applicantReg"
                              data-su-action="admission/applicantReg">Submit</span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <?php $this->load->view("admin/admission/applicant_list"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

