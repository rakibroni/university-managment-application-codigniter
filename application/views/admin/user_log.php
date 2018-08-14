<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>User Log</h5>
        
        <div class="ibox-tools">
            
        </div>
        
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <?php if ($previlages->READ == 1) { ?>           
            <table class="table table-bordered gridTable"  table-title="Batch List" table-msg="All batch list">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>IP</th>
                        <th>Name</th> 
                        <th>Log Type</th> 
                        <th>Datetime</th> 
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($user_log)): $sn = 1; ?>
                        <?php foreach ($user_log as $row) { ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $row->IP_ADDRESS ?></td>
                            <td><?php echo $row->USERNAME ?></td>
                            <td><?php echo $row->LOG_TYPE ?></td>
                            <td><?php echo date('d-M-Y H:i' ,strtotime($row->LOGIN_DATE));  ?></td>
                        </tr>
                        
                        <?php } ?>
                    <?php endif; ?>
                </tbody>

            </table>
            <?php
        } else {
            echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
        }
        ?>
        
        
    </div>

</div>
</div>
