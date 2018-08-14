<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>
<body>

<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags"><?php //print_r($roll)     ?>
</div>
<?php
$availableTagsArray = '';
if (!empty($roll)) {
    foreach ($roll as $row) {
        $availableTagsArray[] = $row->ROLL_NO;
    }
}
$availableTags = json_encode($availableTagsArray);
?>
<script>
    $(function () {
        var availableTags = <?php echo $availableTags; ?>;
        $("#tags").autocomplete({
            source: availableTags
        });
    });
    //  $("#tags").on('keyup',function(){
    //
    //  });
</script>