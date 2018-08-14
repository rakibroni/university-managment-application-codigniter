<div class="external-event alert alert-Plain">
    <p>
        <strong>
            <?php
            $date = date_create($event_date);
            echo "Date: " . date_format($date, "d/m/Y");

            ?>
        </strong>
    </p>
</div>
<div class="hr-line-dashed"></div>
<?php
if ($event): /*If any event found show the events list*/
    foreach ($event as $row):
        ?>
        <div class='external-event alert alert-info'><?php echo $row->E_TITLE; ?></div>
    <?php
    endforeach;
else: /*If not found any event*/
    ?>
    <div class='external-event alert alert-danger'><?php echo "No Event Found"; ?></div>
<?php
endif;
?>
