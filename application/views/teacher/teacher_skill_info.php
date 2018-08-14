<h4 class="green">Skills Information</h4>
<div class="ibox-content">
    <?php if (!empty($skills)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Skill Area</th>
                    <th>Description</th>


                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($skills as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->san; ?></td>
                        <td><?php echo $row->DESCRIPTION; ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>
</div>