<h4 class="green">Familly and Other Information</h4>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <td width="10%" rowspan="5"><img src="<?php $fp = 'assets/img/default.png';
                    if (!empty($fathersInfo->PARENT_PHOTO)) $fp = 'upload/teacher/parents/' . $fathersInfo->PARENT_PHOTO;
                    echo base_url($fp); ?>" class="img-responsive" alt=""></td>
            </tr>
            <tr>
                <th>Father Name</th>
                <td>:</td>
                <td><?php if (!empty($fathersInfo->PARENT_NAME)) echo $fathersInfo->PARENT_NAME ?></td>
            </tr>
            <tr>
                <th>Occupation</th>
                <td>:</td>
                <td><?php if (!empty($fathersInfo->oc)) echo $fathersInfo->oc ?></td>

            </tr>
            <tr>
                <th>Phone</th>
                <td>:</td>
                <td><?php if (!empty($fathersInfo->MOBILE_NO)) echo $fathersInfo->MOBILE_NO ?></td>

            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td><?php if (!empty($fathersInfo->EMAIL_ADRESS)) echo $fathersInfo->EMAIL_ADRESS ?></td>

            </tr>

            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <td width="10%" rowspan="5"><img src="<?php $fp = 'assets/img/default.png';
                    if (!empty($motherInfo->PARENT_PHOTO)) $fp = 'upload/teacher/parents/' . $motherInfo->PARENT_PHOTO;
                    echo base_url($fp); ?>" class="img-responsive" alt=""></td>
            </tr>
            <tr>
                <th>Father Name</th>
                <td>:</td>
                <td><?php if (!empty($motherInfo->PARENT_NAME)) echo $motherInfo->PARENT_NAME ?></td>
            </tr>
            <tr>
                <th>Occupation</th>
                <td>:</td>
                <td><?php if (!empty($motherInfo->oc)) echo $motherInfo->oc ?></td>

            </tr>
            <tr>
                <th>Phone</th>
                <td>:</td>
                <td><?php if (!empty($motherInfo->MOBILE_NO)) echo $motherInfo->MOBILE_NO ?></td>

            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td><?php if (!empty($motherInfo->EMAIL_ADRESS)) echo $motherInfo->EMAIL_ADRESS ?></td>

            </tr>

            </tbody>
        </table>
        <table width="50%" class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <th colspan="2"> Present Address</th>
            </tr>
            <?php if (!empty($local_present_adddress)) ?>
            <tr>
                <th>Division</th>
                <td><?php if (!empty($local_present_adddress->DIVIS_NAME)) echo $local_present_adddress->DIVIS_NAME ?></td>
            </tr>
            <tr>
                <th>District</th>
                <td><?php if (!empty($local_present_adddress->DIST_NAME)) echo $local_present_adddress->DIST_NAME ?></td>
            </tr>
            <tr>
                <th>Thana/Upazila</th>
                <td><?php if (!empty($local_present_adddress->thn)) echo $local_present_adddress->thn ?></td>
            </tr>
            <tr>
                <th>Police Station</th>
                <td><?php if (!empty($local_present_adddress->PLOSC)) echo $local_present_adddress->PLOSC ?></td>
            </tr>
            <tr>
                <th>Post Office</th>
                <td><?php if (!empty($local_present_adddress->POSTO)) echo $local_present_adddress->POSTO ?></td>
            </tr>
            <tr>
                <th>Village</th>
                <td><?php if (!empty($local_present_adddress->VILLAGE_WARD)) echo $local_present_adddress->VILLAGE_WARD ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>