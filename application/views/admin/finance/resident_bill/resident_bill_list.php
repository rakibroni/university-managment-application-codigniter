<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>Session Name</th>
            <th>Building Name</th>
            <th>Billing Month</th> 
            <th>Bill Type</th> 
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php //var_dump($resident); ?>
        <?php if (!empty($resident)): ?>
            
            <?php foreach ($resident as $row) {   ?>
                <tr class="gradeX" id="">
     

                    <td ><?php  $session_year= $this->utilities->academicSessionById($row->SESSION_ID);  echo $session_year->SESSION_NAME; ?></td>
                    <td ><?php  echo  $this->utilities->findByAttribute('sa_building',array('BUILDING_ID'=>$row->RESEDENT_ID))->BUILDING_NAME?></td>                   
                    <td ><?php $data_short = date_create($row->BILLING_MONTH);  echo date_format($data_short, 'M-Y'); ?></td> 
                    <td ><?php  echo $row->AC_NAME; ?></td>
                    
                    <td >
                        <?php 
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->RESIDENT_BILL_CHD_ID;  ?>"
                               title="Click For Delete 5" data-type="delete" data-field="RESIDENT_BILL_CHD_ID" data-tbl="fn_resident_bill_chd" ><i
                                    class="fa fa-times"></i></a>

                        <?php } ?>
                    </td>

                </tr>
            <?php }?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
           <th>Session Name</th>
            <th>Building Name</th>
            <th>Billing Month</th> 
            <th>Bill Type</th> 
            <th>Action</th>
        </tr>

        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>