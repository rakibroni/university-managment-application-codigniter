<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Application Status</h5>

    </div>
    <div class="ibox-content">
        <div class="contentArea">
            <?php if (!empty($applicantAdmit)) : ?>
                <center>
                    <table class="table table-striped table-bordered table-hover" style="width: 50%;">
                        <tbody>
                        <tr class="info">
                            <th>Title</th>
                            <td></td>
                            <th class="text-center">Status</th>
                        </tr>
                        <tr>
                            <th>Admission Department Approval</th>
                            <td>:</td>
                            <?php if ($applicantAdmit->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS == 1) : ?>
                                <td class="text-success" style="text-align: center">Approved</td>
                            <?php elseif ($applicantAdmit->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS == 2) : ?>
                                <td class="text-danger" style="text-align: center">Rejected</td>
                            <?php elseif ($applicantAdmit->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS == 0) : ?>
                                <td class="text-warning" style="text-align: center">Pending</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <th>Department Head Approval</th>
                            <td>:</td>
                            <?php if ($applicantAdmit->ELIGIBLE_BY_DEPT_HEAD_STATUS == 1) : ?>
                                <td class="text-success" style="text-align: center">Approved</td>
                            <?php elseif ($applicantAdmit->ELIGIBLE_BY_DEPT_HEAD_STATUS == 2) : ?>
                                <td class="text-danger" style="text-align: center">Rejected</td>
                            <?php elseif ($applicantAdmit->ELIGIBLE_BY_DEPT_HEAD_STATUS == 0) : ?>
                                <td class="text-warning" style="text-align: center">Pending</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <th>Admit Card Approval</th>
                            <td>:</td>
                            <?php if ($applicantAdmit->APPROVE_FOR_ADMIT == 1) : ?>
                                <td class="text-success" style="text-align: center">Approved</td>
                            <?php elseif ($applicantAdmit->APPROVE_FOR_ADMIT == 2) : ?>
                                <td class="text-danger" style="text-align: center">Rejected</td>
                            <?php elseif ($applicantAdmit->APPROVE_FOR_ADMIT == 0) : ?>
                                <td class="text-warning" style="text-align: center">Pending</td>
                            <?php endif; ?>
                        </tr>
                        </tbody>
                    </table>

                    <?php if ($applicantAdmit->APPROVE_FOR_ADMIT == 1) : ?>
                        <table class="table table-striped table-bordered table-hover" style="width: 50%;">
                            <tr>
                                <a href="<?php echo site_url() ?>/applicant/admitCard" class="btn btn-sm btn-primary"
                                   role="button">Click here for Admit Card <span class="glyphicon glyphicon-ok-sign"></span> </a>
                            </tr>
                        </table>
                    <?php endif; ?>
                </center>

            <?php else : ?>
                <div class="alert alert-warning">
                    <p>Please, submit your application before the deadline.</p>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>
