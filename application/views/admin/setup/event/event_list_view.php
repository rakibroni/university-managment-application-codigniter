<?php
if ($event): /*If any event found show the events list*/
    foreach ($event as $row):
        ?>
        <div class='external-event navy-bg'><?php echo $row->E_TITLE; ?></div>
    <?php
    endforeach;
else: /*If not found any event*/
    ?>
    <div class='external-event alert alert-danger'><?php echo "No Event Found"; ?></div>
<?php
endif;
?>