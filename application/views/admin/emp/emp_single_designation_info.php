<h4 class="green">Desigation Information</h4>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <th>Department  Name</th>
                <th>Desigation </th>
                <th> Default </th> 
            </tr>

            <?php foreach ($emp_info as $single_employee_desigation) { ?>

            <tr>
                <td> <?php echo $single_employee_desigation->DEPT_NAME; ?> </td>
                <td><?php echo $single_employee_desigation->DESIGNATION; ?></td>
                <td>
                    <?php 
                    if($single_employee_desigation->DEFAULT_FG==1){
                        echo "Yes";
                    }
                    else{
                        echo "No";
                    }
                    ?>
                    

                </td> 
            </tr>

            <?php }  ?>

            </tbody>
        </table>
    </div>
</div>