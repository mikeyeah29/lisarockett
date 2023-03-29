<div class="wrap">

    <h1></h1>

    <div class="rwd-booking">

        <p class="h1">Confirm Booking</p>

        <?php include('inc/_header.php'); ?>

        <div class="rwd-booking-body">

            <?php include('inc/_notice.php'); ?>

            <a href="">Edit booking</a>

            

            <form action="" method="post" style="margin-top: 20px;">
                <input type="hidden" name="update_booking" value="<?php echo $vars['booking']->id; ?>">
                <button type="submit" class="rwd-btn">Confirm</button>
            </form>

        </div>

    </div>

</div>
