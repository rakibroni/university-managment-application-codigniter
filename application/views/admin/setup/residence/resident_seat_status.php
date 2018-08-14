
<table class="table table-bordered">
	<tr>
		<td>Room</td>
		<td>Setas</td>
	</tr>
	
	<?php foreach ($room_status as $row): ?>
		<tr>
			<td><?php echo $row->ROOM_NAME ?></td>

			<td>
				<?php $seats=$this->db->query("SELECT 
					a.*, b.SEAT_NAME
					FROM
					resident_seat_mapping a
					LEFT JOIN
					resident_seat b ON a.SEAT_NO = b.SEAT_NO
					WHERE
					a.BUILDING_ID = $building_id AND a.FLOOR_ID = $floor_id
					AND a.ROOM_ID = $row->ROOM_ID")->result(); 
				$check='';
				foreach($seats as $row):
					$button_colour=($row->BOOKED_STATUS ==1) ? 'danger': 'warning';

					if($row->BOOKED_STATUS ==1){
						$data_action="admin/viewResidentSeatBooking";
					}else{
						$data_action="admin/residentSeatBooking";
					}

					?>
					<span id="<?php echo $row->SEAT_MAPPING_ID ?>" data-type="edit"   title="Seat Booking" data-action="<?php echo $data_action ?>" class="btn btn-<?php echo $button_colour ?> btn-xs openModal" id="search_seat_status"><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $row->SEAT_NAME ?></span>&nbsp;&nbsp;&nbsp;
				<?php endforeach;
				?>

			</td>
		</tr>
	<?php endforeach; ?>
	
</table>

 