<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th width="25%">Room Name</th>
        <td><?php echo $building->BR_NAME . " (" . $building->BR_CODE . ")"; ?></td>
    </tr>
    <tr>
        <th width="25%">Site Capacity</th>
        <td><?php echo $building->CAPACITY; ?></td>
    </tr>

    </tbody>
    </tbody>
</table>
<h3 class="text-center">Room details</h3>
<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th>Accessory</th>
        <th style="text-align: left; ">Quantity</th>
    </tr>
    <?php foreach ($details as $row) { ?>
        <tr>
            <td><?php echo $row->ACCESSORY_NAME ?></td>
            <td style="text-align: justify; "><?php echo $row->ACCESSORY_QTY; ?></td>
        </tr>
    <?php } ?>


    </tbody>
</table>