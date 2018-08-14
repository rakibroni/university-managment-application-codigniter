<style>
    ul {
        margin: 0;
        list-style-type: none;
    }
</style>
<form method="post" action="" id="frmModules">
    <input type="hidden" id="txtHcTemplateId" name="txtHcTemplateId" value="<?php echo $hid; ?>"/>

    <div class="card">
        <div class="table-responsive" style="overflow: hidden;" tabindex="1">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 300px;">Module Name</th>
                    <th>Create</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($active_modules as $org_module) {
                    $org_module_links = $this->utilities->findAllByAttribute("ati_module_links", array("MODULE_ID" => $org_module->MODULE_IDS, "ACTIVE_STATUS" => 1));
                    ?>
                    <tr>
                        <td colspan="6" style="background: #f7f7f7; color: #5D8C53; padding: 3px;"><span
                                class=" md-chevron-right"></span>  <?php echo $org_module->SA_MODULE_NAME; ?></td>
                    </tr>
                    <?php
                    foreach ($org_module_links as $org_module_link):
                        $org_active_module_links = $this->utilities->findByAttribute("sa_org_mlinks", array("LINK_ID" => $org_module_link->LINK_ID, "ORG_ID" => $hid));
                        
                        $application_active_link = $this->security_model->application_active_link($hid,$org_module_link->LINK_ID);//param org_id and link id
                      //  echo "<pre>";print_r($application_active_link);echo "</pre>";
                        
                        if (!empty($org_active_module_links)) {
                            $is_checked_create = ($org_active_module_links->CREATE == 1) ? "checked='checked'" : "";
                            $is_checked_read = ($org_active_module_links->READ == 1) ? "checked='checked'" : "";
                            $is_checked_update = ($org_active_module_links->UPDATE == 1) ? "checked='checked'" : "";
                            $is_checked_delete = ($org_active_module_links->DELETE == 1) ? "checked='checked'" : "";
                            $is_checked_status = ($org_active_module_links->STATUS == 1) ? "checked='checked'" : "";
                        }
                        if (!empty($application_active_link)) {
                            $is_disable_create = ($application_active_link->CREATE == 1) ? "" : "disabled";
                            $is_disable_read = ($application_active_link->READ == 1) ? "" : "disabled";
                            $is_disable_update = ($application_active_link->UPDATE == 1) ? "" : "disabled";
                            $is_disable_delete = ($application_active_link->DELETE == 1) ? "" : "disabled";
                            $is_disable_status = ($application_active_link->STATUS == 1) ? "" : "disabled";
                        }
                        ?>
                        <tr>
                            <td style="padding-left: 20px;"><?php echo $org_module_link->LINK_NAME; ?></td>
                            <td class="text-center">
                                <input type="checkbox"
                                   class="chkAssignPage" 
                                   <?php echo (!empty($org_active_module_links)) ? $is_checked_create : ""; ?>

                                   title="Create"
                                   value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->LINK_ID . ',' . 'C' . "," . $hid; ?>" 
                                    <?php echo (!empty($application_active_link)) ? $is_disable_create : ""; ?>
                                />
                            </td>
                            <td class="text-center">
                                <input type="checkbox"
                                   class="chkAssignPage" <?php echo (!empty($org_active_module_links)) ? $is_checked_read : ""; ?>
                                   title="Create"
                                   value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->LINK_ID . ',' . 'R' . "," . $hid; ?>"
                                    <?php echo (!empty($application_active_link)) ? $is_disable_read : ""; ?>
                                   />
                            </td>
                            <td class="text-center">
                                <input type="checkbox"
                                   class="chkAssignPage" <?php echo (!empty($org_active_module_links)) ? $is_checked_update : ""; ?>
                                   title="Create"
                                   value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->LINK_ID . ',' . 'U' . "," . $hid; ?>"
                                   <?php echo (!empty($application_active_link)) ? $is_disable_update : ""; ?>
                                   />
                            </td>
                            <td class="text-center">
                                <input type="checkbox"
                                       class="chkAssignPage" <?php echo (!empty($org_active_module_links)) ? $is_checked_delete : ""; ?>
                                       title="Create"
                                       value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->LINK_ID . ',' . 'D' . "," . $hid; ?>"
                                       <?php echo (!empty($application_active_link)) ? $is_disable_delete : ""; ?>
                                       />
                            </td>
                            <td class="text-center">
                                <input type="checkbox"
                                       class="chkAssignPage" <?php echo (!empty($org_active_module_links)) ? $is_checked_status : ""; ?>
                                       title="Create"
                                       value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->LINK_ID . ',' . 'S' . "," . $hid; ?>"
                                       <?php echo (!empty($application_active_link)) ? $is_disable_status : ""; ?>
                                       />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</form>