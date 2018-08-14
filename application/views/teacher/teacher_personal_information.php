<h4 class="green">Personal Information</h4>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">

            <tbody>
            <tr>
                <th>Name (English)</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->FULL_NAME)) echo $tcr_personal_info->FULL_NAME ?></td>
            </tr>
            <tr>
                <th>নাম বাংলা</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->FULL_NAME_BN)) echo $tcr_personal_info->FULL_NAME_BN ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->
                    DATH_OF_BIRTH)
                    ) echo date('Y-m-d', strtotime($tcr_personal_info->DATH_OF_BIRTH)) ?>
                </td>
            </tr>
            <tr>
                <th>Place of Birth</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->PLACE_OF_BIRTH)) echo $tcr_personal_info->PLACE_OF_BIRTH ?></td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->ms)) echo $tcr_personal_info->ms ?></td>
            </tr>
            <tr>
                <th>Spouse Name</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->SPOUSE_NAME)) echo $tcr_personal_info->SPOUSE_NAME ?></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->nt)) echo $tcr_personal_info->nt ?></td>
            </tr>
            <tr>
                <th>National ID</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->NATIONAL_ID)) echo $tcr_personal_info->NATIONAL_ID ?></td>
            </tr>
            <tr>
                <th>Passport No.</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->PASSPORT_NO)) echo $tcr_personal_info->PASSPORT_NO ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td>
                    <?php if (!empty($teacher_email)) foreach ($teacher_email as $row) {
                        echo "  $row->CONTACTS <br>";
                    } ?></td>

            </tr>
            <tr>
                <th>Mobile</th>
                <td>:</td>
                <td>
                    <?php if (!empty($teacher_contact)) foreach ($teacher_contact as $row) {
                        echo " $row->CONTACTS <br>";
                    } ?></td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->rn)) echo $tcr_personal_info->rn ?></td>
            </tr>
            <tr>
                <th>Height</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->
                    HEIGHT_FEET)
                    ) echo $tcr_personal_info->HEIGHT_FEET . '  &nbsp; Feet &nbsp; &nbsp; &nbsp;  ' . $tcr_personal_info->HEIGHT_CM . '&nbsp;   CM' ?>
                </td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->
                    WEIGHT_KG)
                    ) echo $tcr_personal_info->WEIGHT_KG . '&nbsp; KG&nbsp; &nbsp; &nbsp; &nbsp; ' . $tcr_personal_info->WEIGHT_LBS . '&nbsp;&nbsp; Pound' ?>
                </td>
            </tr>
            <tr>
                <th>Hobby</th>
                <td>:</td>
                <td>
                    <?php if (!empty($tcr_personal_info->HOBBY)) echo $tcr_personal_info->HOBBY ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>