<div class="wrap">

    <h1></h1>

    <div class="rwd-booking">

        <p class="h1">Edit Booking</p>

        <?php include('inc/_header.php'); ?>

        <div class="rwd-booking-body">

            <?php include('inc/_notice.php'); ?>

            <form action="" method="post" style="margin-top: 20px;">
                <input type="hidden" name="update_booking" value="<?php echo $vars['booking']->id; ?>">
                <!-- <input type="hidden" name="type" value="<?php // echo $vars['booking']->type; ?>"> -->
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d', strtotime($vars['booking']->date_from)); ?>">
                </div>
                <div class="form-group">
                    <label for="time-from">Time From:</label>
                    <input type="time" class="form-control" name="date_from" id="date_from" value="<?php echo date('H:i', strtotime($vars['booking']->date_from)); ?>">
                </div>
                <div class="form-group">
                    <label for="time-to">Time To:</label>
                    <input type="time" class="form-control" name="date_to" id="date_to" value="<?php echo date('H:i', strtotime($vars['booking']->date_to)); ?>">
                </div>
                <!-- <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" name="type" id="type" value="<?php // echo $vars['booking']->type; ?>">
                </div> -->
                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" class="form-control" name="first_name" id="first-name" value="<?php echo $vars['booking']->first_name; ?>">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" id="last-name" value="<?php echo $vars['booking']->last_name; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $vars['booking']->email; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $vars['booking']->phone; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description"><?php echo $vars['booking']->description; ?></textarea>
                </div>

                <?php if($vars['booking']->type === 'pending') { ?>
                    <input type="hidden" name="confirm_booking" value="Y">
                    <button type="submit" class="rwd-btn rwd-btn--orange">Save & Confirm</button>
                <?php }else{ ?>
                    <button type="submit" class="rwd-btn">Save</button>
                <?php } ?>

            </form>

        </div>

    </div>

</div>
