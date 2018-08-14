<h4 class="green">Publication Information</h4>
<div class="ibox-content">
    <?php if (!empty($publication)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Publisher/Publication</th>
                    <th>Publish Date</th>
                    <th>Publication URL</th>
                    <th>Author</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($publication as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->TITLE; ?></td>
                        <td><?php echo $row->PUBLISHER; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->PUB_DATE)); ?></td>
                        <td><?php echo $row->PUBLICATION_URL; ?></td>
                        <td><?php echo $row->AUTHOR; ?></td>
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