<div class="wrap">

    <h1></h1>

    <div class="rwd-booking">

        <p class="h1">Booking Calender</p>

        <?php include('inc/_header.php'); ?>

        <div class="rwd-booking-body">

            <?php include('inc/_notice.php'); ?>

            <h2>Bookings</h2>

            <table class="rwd-lr-table">
        		<thead>
        			<tr>
        				<th>Date</th>
        				<th>Time</th>
        				<th>Name</th>
        				<th>Email</th>
        				<th>Phone</th>
                        <th>Status</th>
                        <th></th>
        			</tr>
        		</thead>
        		<tbody>
                    <?php foreach ($vars['events'] as $e) { ?>

                        <?php // dd($e); ?>

                        <tr class="<?php echo ($e->type === 'pending' ? 'rwd-lr-pending-tr' : ''); ?>">
            				<td><?php echo $e->date; ?></td>
            				<td><?php echo $e->time_from . ' - ' . $e->time_to; ?></td>
            				<td><?php echo $e->first_name . ' ' . $e->last_name; ?></td>
            				<td><?php echo $e->email; ?></td>
            				<td><?php echo $e->phone; ?></td>
                            <td><?php echo $e->type; ?></td>
                            <td class="rwd-actions" data-id="<?php echo $e->id; ?>">
                                <?php if($e->type === 'pending') { ?>
                                    <!-- <form action="" method="post">
                                        <input name="approve_booking" value="<?php // echo $e->id; ?>" type="hidden" />
                                        <button class="rwd-action rwd-action--approve"></button>
                                    </form> -->
                                    <a href="?page=rwd-booking-calender-edit&booking-id=<?php echo $e->id; ?>" class="rwd-action rwd-action--approve"></a>
                                <?php }else{ ?>
                                    <a href="?page=rwd-booking-calender-edit&booking-id=<?php echo $e->id; ?>" class="rwd-action rwd-action--edit"></a>
                                <?php } ?>
                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                    <input name="delete_booking" value="<?php echo $e->id; ?>" type="hidden" />
                                    <button class="rwd-action rwd-action--delete" type="submit"></button>
                                </form>
            				</td>
            			</tr>
                    <?php } ?>
        		</tbody>
        	</table>

        </div>

    </div>

    <?php include('inc/modals/edit-event.php'); ?>

</div>
