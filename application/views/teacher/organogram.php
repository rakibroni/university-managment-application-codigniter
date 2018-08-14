<link href="<?php echo base_url() ?>assets/getorgchart/getorgchart.css" rel="stylesheet"/>
<div class="col-md-10">
    <table id="peopleTable" style="display: none;">
        <tr>
            <th>id</th>
            <th>parent id</th>
            <th>Name</th>
            <th>Title</th>

        </tr>
        <?php if (!empty($organogam)) foreach ($organogam as $row) { ?>
            <tr>
                <td><?php echo $row->ID ?></td>
                <td><?php echo $row->PARENT_ID ?></td>
                <td><?php echo $row->NAME ?></td>
                <td><?php echo $row->TITLE ?></td>

            </tr>
        <?php } ?>

    </table>

    <div id="people"></div>
</div>
<script src="<?php echo base_url() ?>assets/getorgchart/getorgchart.js"></script>


<script type="text/javascript">

    $("#people").getOrgChart({
        theme: "deborah",


        gridView: true,
        color: "green",
        editable: false

    });
    $('#people').getOrgChart("loadFromHTMLTable", document.getElementById("peopleTable"));
</script>
 
   