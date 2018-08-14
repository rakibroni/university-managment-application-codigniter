<?php if ($previlages->READ == 1) { ?>
<td <?php echo ($group_data->ACT_FG == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sr; ?></span><span
	class="hidden" id="loader_<?php echo $group_data->LKP_ID; ?>"></span></td>
	<td <?php echo ($group_data->ACT_FG == 1) ? "" : "class='inactive'"; ?>><?php echo $group_data->LKP_NAME ?></td>
	<td <?php echo ($group_data->ACT_FG == 1) ? "" : "class='inactive'"; ?>>
		<?php if ($previlages->STATUS == 1) { ?>
		<span style="cursor:pointer" id="status<?php echo $group_data->LKP_ID ?>" class="status"
			look_up_id="<?php echo $group_data->LKP_ID ?>" data-status="<?php echo $group_data->ACT_FG ?>"
			data-su-url="lookUp/lookUpById"> <?php echo ($group_data->ACT_FG == 1) ? '<span id="toggol_' . $group_data->LKP_ID . '" class="label label-success" title="Click For Inactive" >Inactive</span>' : '<span id="toggol_' . $group_data->LKP_ID . '" class="label label-danger" title="Click For Active" >Active</span>'; ?> </span>
			<?php
		}
		if ($previlages->UPDATE == 1) {
			?>
			<a class="label label-default openLookUpModal" id="<?php echo $group_data->LKP_ID; ?>" title="Edit Group Data"
				data-action="LookUp/lookupDataFormUpdate/<?php echo $group_data->GRP_ID; ?>/<?php echo $group_data->LKP_ID; ?>"
				data-type="edit"><i class="fa fa-pencil"></i></a>
				<?php } if ($previlages->DELETE == 1) { ?>
				<a class="label label-danger deletelookup" item_id="<?php echo $group_data->LKP_ID; ?>" title="Click For Delete"
					data-type="delete" data-field="LKP_ID" data-tbl="m00_lkpdata"><i class="fa fa-times"></i></a>
					<?php } ?>
				</td>
				<?php
			} else {
				echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
			}
			?>