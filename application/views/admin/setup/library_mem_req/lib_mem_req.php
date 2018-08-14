  <?php if (!empty($rules)): ?>
    <div class="ibox-content">
        <form id="frmContent" method="post">
            <div class="table-responsive contentArea" id="applicantList">
                <table class="table table-striped table-bordered table-hover gridTable">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Rules</th>
                        </tr>
                    </thead>
                    <tbody class="searchUser">
                        <?php
                        $sn = 1;
                        foreach ($rules as $row):
                            ?>
                            <tr class="gradeX" id="row_<?php echo $row->GRP_ID; ?>" >
                                <td>
                                    <span class="hidden" id="loader_<?php echo $row->GRP_ID; ?>"></span>
                                    <?php echo $sn++; ?>
                                </td>
                                <td> 
                                    <?php echo $row->LKP_NAME ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-danger"><p class="text-center">No Rules Found </p> </div>                                
<?php endif; ?>
</div>