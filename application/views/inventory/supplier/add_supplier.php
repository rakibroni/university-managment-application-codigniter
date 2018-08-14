<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtSupplierId" value="<?php echo $supplier->SUPPLIER_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Supplier Name<span
                        class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="supplierNameEng" name="supplierNameEng"
                       value="<?php echo ($ac_type == 2) ? $supplier->FULL_ENAME : '' ?>" class="form-control required"
                       placeholder="Enter Supplier Name">
                <span class="validation"></span>
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">নাম ( বাংলা )</label>

            <div class="col-lg-8">
                <input type="text" id="supplierNameBn" name="supplierNameBn"
                       value="<?php echo ($ac_type == 2) ? $supplier->FULL_BNAME : '' ?>" class="form-control"
                       placeholder="বাংলা নাম">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Short Name</label>

            <div class="col-lg-8">
                <input type="text" id="shortName" name="shortName"
                       value="<?php echo ($ac_type == 2) ? $supplier->SHORT_NAME : '' ?>" class="form-control"
                       placeholder="Enter Short Name">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Email</label>

            <div class="col-lg-8">
                <input type="email" id="email" name="email"
                       value="<?php echo ($ac_type == 2) ? $supplier->EMAIL : '' ?>" class="form-control"
                       placeholder="Enter Email">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Mobile</label>

            <div class="col-lg-8">
                <input type="email" id="mobileNo" name="mobileNo"
                       value="<?php echo ($ac_type == 2) ? $supplier->MOBILE : '' ?>" class="form-control"
                       placeholder="Enter Mobile Number">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Nationality</label>

            <div class="col-lg-8">
                <input type="text" id="nationality" name="nationality"
                       value="<?php echo ($ac_type == 2) ? $supplier->NATIONALITY : '' ?>" class="form-control"
                       placeholder="Enter Nationality">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

          <div class="form-group"><label class="col-lg-4 control-label">National ID</label>

            <div class="col-lg-8">
                <input type="text" id="nationalId" name="nationalId"
                       value="<?php echo ($ac_type == 2) ? $supplier->NATIONAL_ID : '' ?>" class="form-control"
                       placeholder="Enter National ID">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Passport No</label>

            <div class="col-lg-8">
                <input type="text" id="passportNo" name="passportNo"
                       value="<?php echo ($ac_type == 2) ? $supplier->PASSPORT_NO : '' ?>" class="form-control"
                       placeholder="Enter Passport No">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Business Type</label>

            <div class="col-lg-8">
                <input type="text" id="businessType" name="businessType"
                       value="<?php echo ($ac_type == 2) ? $supplier->BUSINESS_TYPE : '' ?>" class="form-control"
                       placeholder="Enter Business Type">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Organization Name</label>

            <div class="col-lg-8">
                <input type="text" id="organizationName" name="organizationName"
                       value="<?php echo ($ac_type == 2) ? $supplier->ORG_NAME : '' ?>" class="form-control"
                       placeholder="Enter Organization Name">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Organization Email</label>

            <div class="col-lg-8">
                <input type="email" id="organizationEmail" name="organizationEmail"
                       value="<?php echo ($ac_type == 2) ? $supplier->ORG_EMAIL : '' ?>" class="form-control"
                       placeholder="Enter Organization Email">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

          <div class="form-group"><label class="col-lg-4 control-label">Organization Mobile</label>

            <div class="col-lg-8">
                <input type="text" id="organizationMobile" name="organizationMobile"
                       value="<?php echo ($ac_type == 2) ? $supplier->ORG_MOBILE : '' ?>" class="form-control"
                       placeholder="Enter Organization Mobile">
            </div>
        </div>

         <div class="hr-line-dashed"></div>

         <div class="form-group"><label class="col-lg-4 control-label">Organization Website</label>

            <div class="col-lg-8">
                <input type="text" id="organizationWeb" name="organizationWeb"
                       value="<?php echo ($ac_type == 2) ? $supplier->ORG_WEB : '' ?>" class="form-control"
                       placeholder="Enter Organization Website">
            </div>
        </div>

         <div class="hr-line-dashed"></div>
         
         <div class="form-group"><label class="col-lg-4 control-label">Organization Address</label>

            <div class="col-lg-8">
                <input type="text" id="organizationAddress" name="organizationAddress"
                       value="<?php echo ($ac_type == 2) ? $supplier->ORG_ADDRESS : '' ?>" class="form-control"
                       placeholder="Enter Organization Address">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $supplier->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($supplier->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="inventory/updateSupplier"
                           data-su-action="inventory/supplierById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="inventory/createSupplier"
                           data-su-action="inventory/supplierList" data-type="list" value="submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>